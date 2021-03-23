<?php


namespace App\UI\CLI;


use App\Application\Command\StartGame;
use App\Application\Dto\RoomDescription;
use App\Application\Query\CurrentRoomQuery;
use App\Game\TileFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class Game extends Command
{
    protected static $defaultName = 'app:game';

    private TileFactory $tileFactory;

    /**
     * Game constructor.
     * @param TileFactory $tileFactory
     * @param MessageBusInterface $bus
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
        $output->getFormatter()->setStyle('passage', new OutputFormatterStyle('#ff0'));

        $command = new StartGame();
        $this->bus->dispatch($command);

        
        $this->lookAround($output);
        $helper = $this->getHelper('question');
        $prompt = new Question("What's now? ");
        $action = $helper->ask($input, $output, $prompt);
        $output->writeln('Your action: ' . $action);
//        $tile = $this->tileFactory->makeTile(null, null);
//        var_dump($tile);
//        die();
////        while (true) {
//            $question = new ChoiceQuestion('Gdzie chcesz pójść:', Directions::all());
//            $question->setErrorMessage('Nie możesz pójść na %s');
////
//            $direction = $helper->ask($input, $output, $question);
//            $output->writeln('Poszedłeś: '. $direction);
//            var_dump($direction);
//        }

        return 0;
    }
    
    private function lookAround(OutputInterface $output)
    {
        $result = $this->bus->dispatch(new CurrentRoomQuery());
        /** @var RoomDescription $description */
        $description = $result->last(HandledStamp::class)->getResult();
        $output->writeln($description->getDescription());
        $exits = [];
        foreach ($description->getExits() as $direction => $connector) {
            $exits[] = sprintf('<comment>%s</comment>', $connector->description($direction));
        }
        // $exits = array_map(fn($exit) => "<comment>$exit</comment>", $description->getExits());
        $output->writeln('Visible exits:');
        $output->writeln(join("\n", $exits));
    }

    private function actions()
    {

    }
}