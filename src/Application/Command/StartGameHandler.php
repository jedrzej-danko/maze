<?php


namespace App\Application\Command;


use App\Application\GamePersistenceInterface;
use App\Game\Board;
use App\Game\Game;
use App\Game\Tile\EntryTile;
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
        $game = new Game($board);

        $this->persistence->persist($game);
    }


}