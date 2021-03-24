<?php


namespace App\Rules\Entity\Tile;


use App\Rules\ValueObject\Direction;

abstract class Tile
{

    public array $doors = [
        'north' => null,
        'east' => null,
        'south' => null,
        'west' => null
    ];

    /**
     * Tile constructor.
     */
    public function __construct()
    {
    }

    public function setDoors(array $doors)
    {
        foreach ($doors as $direction => $door) {
            if (array_key_exists($direction, $this->doors)) {
                $this->doors[$direction] = $door;
            }
        }
    }

    public function setDoorAtDirection(Direction $direction, Connector $connector)
    {
        if ($connector->getTile1() !== $this) {
            $connector->setTile2($this);
        }
        $this->doors[(string) $direction] = $connector;
    }

    /**
     * @return Connector[]
     */
    public function getDoors(): array
    {
        return array_filter($this->doors, fn($d) => null !== $d);
    }

    public function getDoorDirectedTo(Direction $direction) : ?Connector
    {
        if ($this->doors[(string) $direction]) {
            return $this->doors[(string) $direction];
        }
        return null;
    }



    abstract public function description() : string;

    abstract public function possibleExits() : array;
}