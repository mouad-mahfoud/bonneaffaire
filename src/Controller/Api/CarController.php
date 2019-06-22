<?php

namespace App\Controller\Api;

use App\Document\Car;
use App\Document\City;
use App\Document\FuelType;
use App\Document\Mark;
use Doctrine\ODM\MongoDB\DocumentManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Phpml\ModelManager;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class CarController extends AbstractFOSRestController
{
    private $dm;
    private $parameterBag;

    public function __construct(DocumentManager $dm, ParameterBagInterface $parameterBag)
    {
        $this->dm = $dm;
        $this->parameterBag = $parameterBag;
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
        $modelManager = new ModelManager();
        $restoredClassifier = $modelManager->restoreFromFile($this->parameterBag->get('ml_model_CarSvrModel'));
//dump($this->dm->getRepository(Car::class)->getPriceAndMileageMax($modelId));die;
        return new JsonResponse([
            $this->dm->getRepository(Car::class)->getPriceAndMileageMax($modelId),
            $restoredClassifier->predict([
                $cityId, $markId, $modelId, $fuelTypeId, $mileageMax, $mileageMin, $fiscalPower, $modelYear
            ])
        ]);
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
