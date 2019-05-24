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
}