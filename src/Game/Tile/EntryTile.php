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
        return "This is a labirynt entry. You see a large gate, carved out of rock. The portal is decorated with skulls and bones motifs. " .
            "The gate is open. Darkness flows from under the mountain";
    }



}