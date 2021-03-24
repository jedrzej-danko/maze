<?php


namespace App\Game;


use App\Game\Action\Move;
use App\Game\Action\Quit;
use App\Game\Action\StartGame;
use App\Game\Dto\RoomDescription;
use App\Game\Exception\UnknownActionException;
use App\Game\Query\CurrentRoomQuery;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class Game
{

    public function __construct(
        private GamePersistenceInterface $persistence,
        private MessageBusInterface $bus
    )
    {

    }

    public function startGame()
    {
        $this->bus->dispatch(new StartGame());
    }

    public function describe()
    {
        $result = $this->bus->dispatch(new CurrentRoomQuery());
        /** @var RoomDescription $description */
        $description = $result->last(HandledStamp::class)->getResult();
        return $description;
    }

    public function actions()
    {
        return [
            'n' => Move::class,
            's' => Move::class,
            'e' => Move::class,
            'w' => Move::class,
            'q' => Quit::class
        ];
    }

    public function resolve($action)
    {
        $availableCommands = $this->actions();
        if (array_key_exists($action, $availableCommands)) {
            $command = new ($availableCommands[$action])($action);
            try {
                $this->bus->dispatch($command);
            } catch (HandlerFailedException $e) {
                throw $e->getPrevious();
            }
        } else {
            throw new UnknownActionException("I don't know how to do $action");
        }
    }



}