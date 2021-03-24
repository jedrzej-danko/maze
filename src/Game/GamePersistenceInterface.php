<?php


namespace App\Game;

use App\Rules\Entity\GameState;

interface GamePersistenceInterface
{
    public function stateExists() : bool;
    public function getGame() : GameState;
    public function persist(GameState $game);
}