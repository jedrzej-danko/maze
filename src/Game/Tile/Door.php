<?php


namespace App\Game\Tile;


class Door extends Connector
{
    public function availableTargets(): array
    {
        return [Room::class, Corridor::class];
    }
}