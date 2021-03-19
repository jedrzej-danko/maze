<?php


namespace App\Game;


use Spatie\Enum\Enum;

/**
 * Class Movements
 * @package App\Game
 * @method static self north()
 * @method static self east()
 * @method static self south()
 * @method static self west()
 * @method static self up()
 * @method static self down()
 */
class Directions extends Enum
{
    static public function all() : array
    {
        return array_map(fn($v) => self::make($v), self::toValues());
    }

    static public function horizontal() : array
    {
        return [
            'north' => self::north(),
            'east' => self::east(),
            'south' => self::south(),
            'west' => self::west()
        ];
    }
}