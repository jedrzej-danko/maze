<?php


namespace App\Rules\Entity\Tile;


class Room extends Tile
{
    public function possibleExits(): array
    {
        return [Door::class];
    }

    public function description(): string
    {
        return "You are in the room";
    }


}