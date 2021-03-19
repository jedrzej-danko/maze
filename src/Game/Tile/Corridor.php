<?php


namespace App\Game\Tile;


class Corridor extends Tile
{
    public function possibleExits(): array
    {
        return [Door::class, Passage::class];
    }

    public function description(): string
    {
        return "You are in the corridor";
    }

}