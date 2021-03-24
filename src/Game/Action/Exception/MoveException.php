<?php


namespace App\Game\Action\Exception;


use App\Game\Exception\GameLogicException;
use App\Rules\ValueObject\Direction;

class MoveException extends GameLogicException
{
    public static function noExit(Direction $direction)
    {
        return new self("There's no exit to the $direction");
    }
}