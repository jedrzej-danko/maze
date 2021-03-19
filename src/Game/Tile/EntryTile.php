<?php


namespace App\Game\Tile;


use App\Game\Directions;

class EntryTile extends Corridor
{


    /**
     * EntryTile constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->doors[(string) Directions::north()] = new Passage($this);
    }

    public function description(): string
    {
        return "This is labirynt entry";
    }



}