<?php


namespace App\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

class CityRepository extends DocumentRepository
{
    public function findAllCities()
    {
        return $this->createQueryBuilder('c')
            ->eagerCursor(true)
            ->hydrate(false)
            ->getQuery()
            ->toArray();
    }

    public function count()
    {
        return $this->createQueryBuilder('c')
            ->getQuery()
            ->execute()
            ->count();
    }

    public function checkIfExist(string $city)
    {
        return $this->createQueryBuilder('c')
            ->field('name')->equals($city)
            ->getQuery()
            ->execute()
            ->count();
    }
}
