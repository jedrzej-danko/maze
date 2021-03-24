<?php


namespace App\Game\Action;



use App\Rules\ValueObject\Direction;

class Move
{
    private Direction $direction;

    /**
     * Move constructor.
     * @param $direction
     */
    public function __construct($direction)
    {
        $this->direction = Direction::make($direction);
    }

    /**
     * @return Direction
     */
    public function getDirection(): Direction
    {
        return $this->direction;
    }




}