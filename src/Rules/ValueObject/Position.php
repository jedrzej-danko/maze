<?php


namespace App\Rules\ValueObject;


use RuntimeException;

class Position
{
    private int $x;
    private int $y;

    /**
     * Position constructor.
     * @param int $x
     * @param int $y
     */
    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    public function positionInDirection(Direction $direction) : Position
    {
        switch ($direction) {
            case Direction::north():
                return new Position($this->getX(), $this->getY() + 1);
            case Direction::south():
                return new Position($this->getX(), $this->getY() - 1);
            case Direction::east():
                return new Position($this->getX() + 1, $this->getY());
            case Direction::west():
                return new Position($this->getX() - 1, $this->getY());
        }
        throw new RuntimeException("Unhandled direction $direction");
    }

}