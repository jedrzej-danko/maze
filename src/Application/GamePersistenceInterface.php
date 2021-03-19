<?php


namespace App\Application;


use App\Game\Game;

interface GamePersistenceInterface
{
    public function getGame() : Game;
    public function persist(Game $game);
}