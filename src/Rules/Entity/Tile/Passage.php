<?php


namespace App\Rules\Entity\Tile;


use App\Rules\ValueObject\Direction;

class Passage extends Connector
{
    public function availableTargets(): array
    {
        return [Corridor::class];
    }

    public function description(Direction|string $direction): string
    {
        return "A corridor leading to the $direction";
    }

}