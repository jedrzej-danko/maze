<?php


namespace App\Game\Action;


use App\Game\Action\Exception\MoveException;
use App\Game\GamePersistenceInterface;
use App\Rules\TileFactory;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class MoveHandler implements MessageHandlerInterface
{
    public function __construct(
        private GamePersistenceInterface $persistence,
        private TileFactory $tileFactory
    )
    {
    }

    public function __invoke(Move $move)
    {
        $game = $this->persistence->getGame();

        $currentTile = $game->getCurrentTile();
        $doors = $currentTile->getDoorDirectedTo($move->getDirection());
        if (!$doors) {
            throw MoveException::noExit($move->getDirection());
        }

        $target = $doors->getOtherEnd($currentTile);
        $targetPosition = $game->currentPosition()->positionInDirection($move->getDirection());
        if (!$target) {
            $game->moveToNewTile($targetPosition, $this->tileFactory);
        } else {
            $game->move($targetPosition);
        }


        echo "You moved to {$move->getDirection()}\n";
    }

}