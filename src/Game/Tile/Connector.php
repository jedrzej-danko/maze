<?php


namespace App\Game\Tile;


abstract class Connector
{
    private Tile $tile1;
    private ?Tile $tile2;

    /**
     * Connector constructor.
     * @param Tile $tile1
     */
    public function __construct(Tile $tile1)
    {
        $this->tile1 = $tile1;
    }

    /**
     * @param Tile $tile2
     */
    public function setTile2(Tile $tile2): void
    {
        $this->tile2 = $tile2;
    }

    /**
     * @return Tile
     */
    public function getTile1(): Tile
    {
        return $this->tile1;
    }

    /**
     * @return Tile|null
     */
    public function getTile2(): ?Tile
    {
        return $this->tile2;
    }

    abstract public function availableTargets() : array;
}