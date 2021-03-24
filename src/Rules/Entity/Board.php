<?php


namespace App\Rules\Entity;



use App\Rules\Entity\Tile\Tile;
use App\Rules\Exception\BoardException;
use App\Rules\TileFactory;
use App\Rules\ValueObject\Position;

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
        if (!$this->getTileAt($position)) {
            throw BoardException::emptyPosition($position);
        }
        $this->currentPosition = $position;
    }

    public function getTileAt(Position $position) : ?Tile
    {
        if (isset($this->map[$position->getX()][$position->getY()])) {
            return $this->map[$position->getX()][$position->getY()];
        }
        return null;
    }

    public function putTileAt(Position $position, Tile $tile)
    {
        $this->map[$position->getX()][$position->getY()] = $tile;
    }

    public function createTileAt(Position $position, TileFactory $factory)
    {
        $tile = $factory->makeTile($this, $position);
        $this->putTileAt($position, $tile);
    }




}