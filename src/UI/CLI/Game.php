<?php


namespace App\UI\CLI;


use App\Application\Command\StartGame;
use App\Application\Query\CurrentRoomQuery;
use App\Game\TileFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class Game extends Command
{
    protected static $defaultName = 'app:game';

    private TileFactory $tileFactory;

    /**
     * Game constructor.
     * @param TileFactory $tileFactory
     */
    public function __construct(
        TileFactory $tileFactory,
        private MessageBusInterface $bus
    )
    {
        $this->tileFactory = $tileFactory;
        parent::__construct();
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = new StartGame();
        $this->bus->dispatch($command);

        $result = $this->bus->dispatch(new CurrentRoomQuery());
        $description = $result->last(HandledStamp::class);
        $output->writeln($description->getResult());
//        $helper = $this->getHelper('question');
//        $tile = $this->tileFactory->makeTile(null, null);
//        var_dump($tile);
//        die();
//        while (true) {
//            $question = new ChoiceQuestion('Gdzie chcesz pójść:', Directions::all());
//            $question->setErrorMessage('Nie możesz pójść na %s');
//
//            $direction = $helper->ask($input, $output, $question);
//            $output->writeln('Poszedłeś: '. $direction);
//            var_dump($direction);
//        }

        return 0;
    }
}