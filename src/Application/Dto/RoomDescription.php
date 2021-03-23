<?php


namespace App\Application\Dto;


use App\Game\Tile\Connector;
use Webmozart\Assert\Assert;

class RoomDescription
{
    private array $exits;

    public function __construct(
        private string $description,
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


}