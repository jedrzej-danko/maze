<?php


namespace App\Game;


use App\Game\Tile\Connector;
use App\Game\Tile\Corridor;
use App\Game\Tile\Tile;

class TileFactory
{

    public function makeTile(?Connector $connector, ?Directions $fromDirection)
    {
        $availableTiles = $connector?->availableTargets() ?? [Corridor::class];
        $tileClass = $availableTiles[array_rand($availableTiles, 1)];

        /** @var Tile $tile */
        $tile = new $tileClass;

        $doors = $this->generateDoors($tile, $connector, $fromDirection);
        $tile->setDoors($doors);

        return $tile;
    }

    private function generateDoors(Tile $tile, ?Connector $connector, ?Directions $fromDirection)
    {
        $doors = array_map(fn($dir) => null, Directions::horizontal());
        if ($fromDirection && $connector) {
            $doors[(string) $fromDirection] = $connector;
            $connector->setTile2($tile);
        }


        foreach (Directions::horizontal() as $direction) {
            if (! $doors[(string) $direction]) {
                $doors[(string) $direction] = $this->makeDoor($tile);
            }
        }

        // var_dump($doors); die();

        return $doors;
    }

    private function makeDoor(Tile $tile) : ?Connector
    {
        $k100 = rand(1, 100);
        var_dump($k100);
        if ($k100 <= 33) {
            return null;
        }
        $availableDoors = $tile->possibleExits();
        $doorType = $availableDoors[array_rand($availableDoors, 1)];

        return new $doorType($tile);
    }
}