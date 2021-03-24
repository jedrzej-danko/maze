<?php


namespace App\Rules\Entity\Tile;


use App\Rules\ValueObject\Direction;

class Door extends Connector
{
    public function availableTargets(): array
    {
        return [Room::class, Corridor::class];
    }

    public function description(Direction|string $direction): string
    {
        return "A doors leading to $direction";
    }
}