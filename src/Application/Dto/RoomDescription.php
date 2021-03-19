<?php


namespace App\Application\Dto;


class RoomDescription
{
    public function __construct(
        private string $description
    )
    {
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    public function __toString(): string
    {
        return $this->description;
    }


}