<?php


namespace App\Rules\Entity;


use App\Rules\Entity\Tile\Tile;
use App\Rules\TileFactory;
use App\Rules\ValueObject\Position;

class GameState
{
    private Board $board;

    /**
     * Game constructor.
     * @param Board $board
     */
    public function __construct(Board $board)
    {
        $this->board = $board;
    }

    public function getCurrentTile() : Tile
    {
        return $this->board->getTileAt($this->board->getCurrentPosition());
    }

    public function currentPosition() : Position
    {
        return $this->board->getCurrentPosition();
    }

    public function moveToNewTile(Position $position, TileFactory $tileFactory)
    {
        $this->board->createTileAt($position, $tileFactory);
        $this->board->setCurrentPosition($position);
    }

    public function move(Position $position)
    {
        $this->board->setCurrentPosition($position);
    }
}