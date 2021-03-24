<?php


namespace App\Game\Dto;


use App\Rules\Entity\Tile\Connector;
use App\Rules\ValueObject\Position;
use Webmozart\Assert\Assert;

class RoomDescription
{
    private array $exits;

    public function __construct(
        private string $description,
        private Position $position,
        array $exits
    )
    {
        Assert::allIsInstanceOf($exits, Connector::class);
        $this->exits = $exits;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return Connector[]
     */
    public function getExits() : array
    {
        return $this->exits;
    }

    public function __toString(): string
    {
        return $this->description;
    }

    /**
     * @return Position
     */
    public function getPosition(): Position
    {
        return $this->position;
    }




}