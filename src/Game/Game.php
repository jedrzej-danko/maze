<?php


namespace App\Game;


class Game
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

    /**
     * @return Board
     */
    public function getBoard(): Board
    {
        return $this->board;
    }




}