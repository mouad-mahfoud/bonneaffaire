<?php

namespace App\Command\Ml;

use App\Document\Car;
use App\Document\FuelType;
use App\Document\Mark;
use App\Document\Model;
use Doctrine\ODM\MongoDB\DocumentManager;
use Phpml\ModelManager;
use Phpml\Regression\SVR;
use Phpml\SupportVectorMachine\Kernel;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SvrCarPriceCommand extends Command
{
    protected static $defaultName = 'app:svr-car-price';
    private $documentManager;
    private $logger;
    private $container;

    public function __construct(DocumentManager $documentManager, LoggerInterface $logger, ContainerInterface $container)
    {
        parent::__construct();
        $this->documentManager = $documentManager;
        $this->logger = $logger;
        $this->container = $container;
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $io = new SymfonyStyle($input, $output);
        $regression = new SVR(Kernel::LINEAR);
        $cars = $this->documentManager->getRepository(Car::class)->findAll();

        $samples = [];
        $targets = [];
        $i = 0;
        foreach ($cars as $car) {
            array_push($samples, [
                $car->getCityId(), $car->getMarkId(), $car->getModelId(), $car->getFuelTypeId(), $car->getMileageMax(),
                $car->getMileageMin(), $car->getFiscalPower(), (int)$car->getModelYear()->format('Y')
            ]);
            array_push($targets, $car->getPrice());
            $io->note(sprintf('%s ==> %s Dh | annonce N° : %s', $car->getTitle(), $car->getPrice(), $i++));
        }

        $io->note('training...');
        $start_time = microtime(true);
            $regression->train($samples, $targets);
        $end_time = microtime(true);

        echo " Execution time of training = ".($end_time - $start_time)." sec";


        $start_time = microtime(true);
            $predect =  $regression->predict([2, 2, 2, 1, 39999, 35000, 10, 1970]);
        $end_time = microtime(true);
        echo " predict time = ".($end_time - $start_time)." sec";

        $io->success(sprintf('%s Dh',$predect)) ;




//      $filepath = '/path/to/store/the/model';
        $modelManager = new ModelManager();
        $modelManager->saveToFile($regression, $this->container->getParameter('ml_models_directory'));
        $io->success(sprintf('Model enregistré ;-)')) ;

    }
}
