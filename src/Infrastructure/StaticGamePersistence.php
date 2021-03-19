<?php


namespace App\Infrastructure;


use App\Application\GamePersistenceInterface;
use App\Game\Game;

class StaticGamePersistence implements GamePersistenceInterface
{
    private static Game $game;

    public function getGame(): Game
    {
        return self::$game;
    }

    public function persist(Game $game)
    {
        self::$game = $game;
    }


}