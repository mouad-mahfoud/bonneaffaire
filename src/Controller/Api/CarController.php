<?php

namespace App\Controller\Api;

use App\Document\City;
use App\Document\FuelType;
use App\Document\Mark;
use App\Service\CarService;
use Doctrine\ODM\MongoDB\DocumentManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Phpml\ModelManager;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\View;

class CarController extends AbstractFOSRestController
{

    private $dm;

    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }

    /**
     * @Rest\Get(
     *     "/cote/{cityId}/{markId}/{modelId}/{fuelTypeId}/{mileageMax}/{mileageMin}/{fiscalPower}/{modelYear}",
     *     name="get_cote"
     * )
     * @View(statusCode=200)
     */
    public function getCote($cityId, $markId, $modelId, $fuelTypeId, $mileageMax, $mileageMin, $fiscalPower, $modelYear)
    {

        dump([
            $cityId, $markId, $modelId, $fuelTypeId, $mileageMax, $mileageMin, $fiscalPower, $modelYear
        ]);
        die();

        $modelManager = new ModelManager();
        $restoredClassifier = $modelManager->restoreFromFile('');


        $restoredClassifier->predict([3, 2]);
    }

    /**
     * @Rest\Get("/cities", name="cities_list")
     * @View(statusCode=200)
     */
    public function getCities()
    {
        return $this->dm->getRepository(City::class)->findAllCities();
    }

    /**
     * @Rest\Get("/fuelTypes", name="fuelTypes_list")
     * @View(statusCode=200)
     */
    public function getfuelTypes()
    {
        return $this->dm->getRepository(FuelType::class)->getAll();
    }

    /**
     * @Rest\Get("/marks/ids", name="car_marks_ids_list")
     * @View(statusCode=200)
     */
    public function getMarks()
    {
        return $this->dm->getRepository(Mark::class)->findAllMarks();
    }
}
