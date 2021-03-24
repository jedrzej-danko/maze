<?php


namespace App\Game\Action;


use App\Game\Action\Exception\QuitGameException;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class QuitHandler implements MessageHandlerInterface
{
    public function __invoke(Quit $command)
    {
        throw new QuitGameException('Bye!');
    }
}