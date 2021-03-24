<?php


namespace App\Infrastructure;


use App\Game\GamePersistenceInterface;
use App\Rules\Entity\GameState;

class StaticGamePersistence implements GamePersistenceInterface
{
    private static GameState $game;

    public function stateExists(): bool
    {
        return self::$game !== null;
    }


    public function getGame(): GameState
    {
        return self::$game;
    }

    public function persist(GameState $game)
    {
        self::$game = $game;
    }


}