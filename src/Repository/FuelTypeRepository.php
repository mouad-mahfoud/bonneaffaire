<?php


namespace App\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

class FuelTypeRepository extends DocumentRepository
{
    public function findAllMarks()
    {
        return $this->createQueryBuilder('ft')
            ->getQuery()
            ->execute();                                                                                                    ;
    }

    public function count()
    {
        return $this->createQueryBuilder('ft')
            ->getQuery()
            ->execute()
            ->count();                                                                                                    ;
    }

    public function checkIfExist(string $fuelType)
    {
        return $this->createQueryBuilder('ft')
            ->field('name')->equals($fuelType)
            ->getQuery()
            ->execute()
            ->count();                                                                                                    ;
    }
}