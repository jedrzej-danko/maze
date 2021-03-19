<?php


namespace App\Game\Tile;


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

    abstract public function description() : string;

    abstract public function possibleExits() : array;
}