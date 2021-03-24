<?php


namespace App\Game\Action;


use App\Game\GamePersistenceInterface;

use App\Rules\Entity\Board;
use App\Rules\Entity\GameState;
use App\Rules\Entity\Tile\EntryTile;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class StartGameHandler implements MessageHandlerInterface
{
    private GamePersistenceInterface $persistence;

    /**
     * StartGameHandler constructor.
     * @param GamePersistenceInterface $persistence
     */
    public function __construct(GamePersistenceInterface $persistence)
    {
        $this->persistence = $persistence;
    }

    public function __invoke(StartGame $command)
    {
        $board = new Board(new EntryTile());
        $game = new GameState($board);

        $this->persistence->persist($game);
    }


}