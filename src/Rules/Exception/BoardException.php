<?php


namespace App\Rules\Exception;


use App\Rules\ValueObject\Position;

class BoardException extends RuleException
{
    public static function emptyPosition(Position $position)
    {
        return new self("There's no tile on position ({$position->getX()}, {$position->getY()})");
    }
}