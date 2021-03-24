<?php


namespace App\Rules\ValueObject;


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
class Direction extends Enum
{
    private static $shortcuts = [
        'n' => 'north',
        'e' => 'east',
        'w' => 'west',
        's' => 'south'
    ];

    static public function all() : array
    {
        return array_map(fn($v) => self::make($v), self::toValues());
    }

    public static function make($value): self
    {
        if ($value instanceof self) {
            return $value;
        }
        if (isset(self::$shortcuts[$value])) {
            $value = self::$shortcuts[$value];
        }
        return parent::make($value);
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

    public function opposite() : Direction
    {
        if ($this->equals(self::north())) {
            return self::south();
        }
        if ($this->equals(self::east())) {
            return self::west();
        }
        if ($this->equals(self::south())) {
            return self::north();
        }
        if ($this->equals(self::west())) {
            return self::east();
        }
        if ($this->equals(self::up())) {
            return self::down();
        }
        if ($this->equals(self::down())) {
            return self::up();
        }
    }
}