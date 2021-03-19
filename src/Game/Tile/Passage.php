<?php


namespace App\Game\Tile;


class Passage extends Connector
{
    public function availableTargets(): array
    {
        return [Corridor::class];
    }

}