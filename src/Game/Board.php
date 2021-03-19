<?php


namespace App\Game;


use App\Game\Tile\Tile;

class Board
{
    private Position $currentPosition;
    private array $map = [];

    public function __construct(Tile $startTile)
    {
        $this->map[0] = [];
        $this->map[0][0] = $startTile;
        $this->currentPosition = new Position(0,0);
    }

    public function getCurrentPosition() : Position
    {
        return $this->currentPosition;
    }

    public function setCurrentPosition(Position $position)
    {
        if ($this->getTileAt($position)) {
            $this->currentPosition = $position;
        }
    }

    public function getTileAt(Position $position) : ?Tile
    {
        if (isset($this->map[$position->getX()][$position->getY()])) {
            return $this->map[$position->getX()][$position->getY()];
        }
        return null;
    }


}