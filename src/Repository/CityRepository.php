<?php


namespace App\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

class CityRepository extends DocumentRepository
{
    public function findAllMarks()
    {
        return $this->createQueryBuilder('c')
            ->getQuery()
            ->execute();                                                                                                    ;
    }

    public function count()
    {
        return $this->createQueryBuilder('c')
            ->getQuery()
            ->execute()
            ->count();                                                                                                    ;
    }

    public function checkIfExist(string $city)
    {
        return $this->createQueryBuilder('c')
            ->field('name')->equals($city)
            ->getQuery()
            ->execute()
            ->count();                                                                                                    ;
    }
}