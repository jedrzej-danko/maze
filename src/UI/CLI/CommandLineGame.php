<?php


namespace App\UI\CLI;


use App\Game\Action\Exception\QuitGameException;
use App\Game\Dto\RoomDescription;
use App\Game\Exception\GameLogicException;
use App\Game\Game;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Messenger\MessageBusInterface;

class CommandLineGame extends Command
{
    protected static $defaultName = 'app:game';

    /**
     * Game constructor.
     * @param Game $game
     * @param MessageBusInterface $bus
     */
    public function __construct(
        private Game $game,
        private MessageBusInterface $bus
    )
    {
        parent::__construct();
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->getFormatter()->setStyle('passage', new OutputFormatterStyle('#ff0'));

        $this->game->startGame();

        while (true) {

            $this->display($output, $this->game->describe());

            $helper = $this->getHelper('question');
            $prompt = new Question("What's now? ");
            $action = $helper->ask($input, $output, $prompt);
            try {
                $this->game->resolve($action);
            } catch (GameLogicException $e) {
                $output->writeln('<error>' . $e->getMessage() . '</error>');
            } catch (QuitGameException $e) {
                $output->writeln($e->getMessage());
                return self::SUCCESS;
            } catch (Exception $e) {
                $output->writeln(get_class($e));
                throw $e;
            }
        }

        return self::FAILURE;
    }

    private function display(OutputInterface $output, RoomDescription $description)
    {
        $output->writeln("Position: X: {$description->getPosition()->getX()}, Y: {$description->getPosition()->getY()}");
        $output->writeln($description->getDescription());
        $exits = [];
        foreach ($description->getExits() as $direction => $connector) {
            $exits[] = sprintf('<comment>%s</comment>', $connector->description($direction));
        }
        // $exits = array_map(fn($exit) => "<comment>$exit</comment>", $description->getExits());
        $output->writeln('Visible exits:');
        $output->writeln(join("\n", $exits));
    }


}