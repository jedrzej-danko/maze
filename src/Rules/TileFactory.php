<?php


namespace App\Rules;



use App\Rules\Entity\Board;
use App\Rules\Entity\Tile\Connector;
use App\Rules\Entity\Tile\Corridor;
use App\Rules\Entity\Tile\Room;
use App\Rules\Entity\Tile\Tile;
use App\Rules\ValueObject\Direction;
use App\Rules\ValueObject\Position;

class TileFactory
{

    public function makeTile(Board $board, Position $position) : Tile
    {
        $connectors = [];
        $noTileAtDirections = [];

        foreach (Direction::horizontal() as $direction) {
            $neighbour = $board->getTileAt($position->positionInDirection($direction));
            if (null === $neighbour) {
                $noTileAtDirections[] = $direction;
                continue;
            }
            $connector = $neighbour->getDoorDirectedTo($direction->opposite());
            if (null === $connector) {
                continue;
            }
            $connectors[(string) $direction] = $connector;
        }

        $availableTiles = [Corridor::class, Room::class];
        foreach ($connectors as $connector) {
            $availableTiles = array_intersect($availableTiles, $connector->availableTargets());
        }



        $tileClass = $availableTiles[array_rand($availableTiles, 1)];
        /** @var Tile $tile */
        $tile = new $tileClass;
        foreach ($connectors as $direction => $connector) {
            $tile->setDoorAtDirection(Direction::make($direction), $connector);
        }
        foreach ($noTileAtDirections as $direction) {
            $door = $this->makeDoor($tile);
            if ($door) {
                $tile->setDoorAtDirection(Direction::make($direction), $door);
            }
        }

        return $tile;
    }

    private function makeDoor(Tile $tile) : ?Connector
    {
        $k100 = rand(1, 100);
        if ($k100 <= 33) {
            return null;
        }
        $availableDoors = $tile->possibleExits();
        $doorType = $availableDoors[array_rand($availableDoors, 1)];

        return new $doorType($tile);
    }
}