<?php


namespace App\Service;


use App\Document\Car;
use Doctrine\ODM\MongoDB\DocumentManager;
use Phpml\Math\Statistic\Mean;

class CarService
{

    private $dm;

    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }

    /**
     * @return DocumentManager
     */
    public function getAllCities()
    {
        return $this->dm->getRepository(Car::class)->findAllCities();
    }

}