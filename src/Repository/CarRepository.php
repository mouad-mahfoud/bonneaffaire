<?php


namespace App\Repository;


use App\Document\Car;
use Doctrine\ODM\MongoDB\DocumentRepository;

class CarRepository extends DocumentRepository
{
    public function findAllMarks()
    {
        return $this->createQueryBuilder('car')
            ->distinct('mark')
            ->getQuery()
            ->execute();                                                                                                    ;
    }

    public function findAllCarsWithIdsNull()
    {

        $qb = $this->createQueryBuilder('car');
        return $qb->addOr($qb->expr()->field('markId')->equals(null))
                ->addOr($qb->expr()->field('modelId')->equals(null))
                ->addOr($qb->expr()->field('cityId')->equals(null))
                ->addOr($qb->expr()->field('fuelTypeId')->equals(null))
                ->getQuery()
                ->execute();
    }

    public function findAllModelsInCarCollection()
    {
        return $this->createQueryBuilder('car')
            ->distinct('model')
            ->getQuery()
            ->execute();                                                                                                    ;
    }

    public function findAllFuelType()
    {
        return $this->createQueryBuilder('car')
            ->distinct('fuelType')
            ->getQuery()
            ->execute();                                                                                                    ;
    }

    public function findAllCities()
    {
        return $this->createQueryBuilder('car')
            ->distinct('city')
            ->getQuery()
            ->execute();                                                                                                    ;
    }

    public function findAllPriceByMark($mark)
    {
        return $this->createQueryBuilder(Car::class)
            ->eagerCursor(true)
            ->hydrate(false)
            ->select('price')
            ->field('mark')->equals($mark)
            ->getQuery()
            ->toArray();                                                                                                    ;
    }

    public function findAllModels($mark)
    {
        return $this->createQueryBuilder('car')
            ->distinct('model')
            ->field('mark')->equals($mark)
            ->getQuery()
            ->toArray();                                                                                                    ;
    }

    public function findAllPriceByModel($model)
    {
        return $this->createQueryBuilder(Car::class)
            ->eagerCursor(true)
            ->hydrate(false)
            ->select('price')
            ->field('model')->equals($model)
            ->getQuery()
            ->toArray();                                                                                                    ;
    }
    
    public function countAds($field, $value)
    {
        return $this->createQueryBuilder(Car::class)
            ->eagerCursor(true)
            ->hydrate(false)
            ->field($field)->equals($value)
            ->getQuery()
            ->execute()->count();                                                                                                   ;
    }
}