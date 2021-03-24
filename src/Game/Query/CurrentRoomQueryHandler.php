<?php


namespace App\Game\Query;


use App\Game\Dto\RoomDescription;
use App\Game\GamePersistenceInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class CurrentRoomQueryHandler implements MessageHandlerInterface
{
    use HandleTrait;


    /**
     * CurrentRoomQueryHandler constructor.
     * @param MessageBusInterface $messageBus
     * @param GamePersistenceInterface $persistence
     */
    public function __construct(
        MessageBusInterface $messageBus,
        private GamePersistenceInterface $persistence
    )
    {
        $this->messageBus = $messageBus;
    }

    public function __invoke(CurrentRoomQuery $query)
    {
        $game = $this->persistence->getGame();
        $currentTile = $game->getCurrentTile();

        return new RoomDescription($currentTile->description(), $game->currentPosition(), $currentTile->getDoors());
    }
}