<?php


namespace App\Rules\Entity\Tile;



use App\Rules\Exception\ConnectorException;
use App\Rules\ValueObject\Direction;

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
        $this->tile2 = null;
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

    public function getOtherEnd(Tile $tile) : ?Tile
    {
        if ($tile === $this->tile1) {
            return $this->tile2;
        }
        if ($tile === $this->tile2) {
            return $this->tile1;
        }

        throw ConnectorException::illegalDoors();
    }

    abstract public function availableTargets() : array;

    public function description(string|Direction $direction) : string
    {
        return "A connector directed <passage>$direction</passage>";
    }

}