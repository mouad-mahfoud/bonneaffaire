<?php

namespace App\Command\DataPreprocessing;

use App\Document\Car;
use App\Document\City;
use App\Document\FuelType;
use App\Document\Mark;
use App\Document\Model;
use Doctrine\ODM\MongoDB\DocumentManager;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CarDataCleaningCommand extends Command
{
    protected static $defaultName = 'app:car-data-cleaning';
    private $documentManager;
    private $logger;

    public function __construct(DocumentManager $documentManager, LoggerInterface $logger)
    {
        parent::__construct();
        $this->documentManager = $documentManager;
        $this->logger = $logger;
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

        /*$this->removeDocumentsIfContaineNullValues();
        $this->cleaningMark($io);
        $this->cleaningModel($io);
        $this->cleaningFuelType($io);
        $this->cleaningCities($io);*/
        $this->matchMarksAndModelIds($io);
    }

    private function cleaningMark(SymfonyStyle $io)
    {
        $marks = $this->documentManager->getRepository(Car::class)->findAllMarks();

        foreach ($marks as $key => $val) {
            if ($this->documentManager->getRepository(Mark::class)->checkIfExist($val) < 1) {

                $mark = new Mark();
                $mark->setName($val);

                $this->documentManager->persist($mark);
                $this->documentManager->flush();

                $io->success(sprintf('%s Added', $val));
            } else {
                $io->note(sprintf('%s exist', $val));
            }
        }
    }

    private function cleaningModel(SymfonyStyle $io)
    {
        $models = $this->documentManager->getRepository(Car::class)->findAllModelsInCarCollection();

        foreach ($models as $key => $val) {
            if ($this->documentManager->getRepository(Model::class)->checkIfExist($val) < 1) {

                $model = new Model();
                $model->setName($val);

                $this->documentManager->persist($model);
                $this->documentManager->flush();

                $io->success(sprintf('model : %s Added', $val));
            } else {
                $io->note(sprintf('model :  %s exist', $val));
            }
        }
    }

    private function cleaningFuelType(SymfonyStyle $io)
    {
        $fuelTypes = $this->documentManager->getRepository(Car::class)->findAllFuelType();

        foreach ($fuelTypes as $key => $val) {

            if ($this->documentManager->getRepository(FuelType::class)->checkIfExist($val) < 1) {
                $model = new FuelType();
                $model->setName($val);

                $this->documentManager->persist($model);
                $this->documentManager->flush();

                $io->success(sprintf('FuelType : %s Added', $val));
            } else {
                $io->note(sprintf('FuelType :  %s exist', $val));
            }
        }
    }

    private function cleaningCities(SymfonyStyle $io)
    {
        $fuelTypes = $this->documentManager->getRepository(Car::class)->findAllCities();

        foreach ($fuelTypes as $key => $val) {
            if ($this->documentManager->getRepository(City::class)->checkIfExist($val) < 1) {

                $model = new City();
                $model->setName($val);

                $this->documentManager->persist($model);
                $this->documentManager->flush();

                $io->success(sprintf('City : %s Added', $val));
            } else {
                $io->note(sprintf('City :  %s exist', $val));
            }
        }
    }

    private function matchMarksAndModelIds(SymfonyStyle $io)
    {

        $cars = $this->documentManager->getRepository(Car::class)->findAllCarsWithIdsNull();



        foreach ($cars as $car) {

            $modelId = $this->documentManager->getRepository(Model::class)
                ->findByName($car->getModel())[0]
                ->getId();
            $car->setModelId($modelId);

            $markId = $this->documentManager->getRepository(Mark::class)
                ->findByName($car->getMark())[0]
                ->getId();
            $car->setMarkId($markId);

            $cityId = $this->documentManager->getRepository(City::class)
                ->findByName($car->getCity())[0]
                ->getId();
            $car->setCityId($cityId);

            $fuelTypeId = $this->documentManager->getRepository(FuelType::class)
                ->findByName($car->getFuelType())[0]
                ->getId();
            $car->setFuelTypeId($fuelTypeId);

            $this->documentManager->persist($car);
            $this->documentManager->flush();

            $io->success(sprintf('Model : %s ==> %s', $car->getModel(), $modelId));
            $io->success(sprintf('Mark  : %s ==> %s', $car->getMark(), $markId));
            $io->success(sprintf('Fuel Type  : %s ==> %s', $car->getFuelType(), $fuelTypeId));
            $io->success(sprintf('City  : %s ==> %s', $car->getCity(), $cityId));

        }
    }

    private function removeDocumentsIfContaineNullValues()
    {
        $collection = $this->documentManager->getDocumentCollection(Car::class);
        $collection->remove(array('model' => null));
        $collection->remove(array('mark' => null));
        $collection->remove(array('city' => null));
        $collection->remove(array('fiscalPower' => null));
        $collection->remove(array('fuelType' => null));
    }
}
