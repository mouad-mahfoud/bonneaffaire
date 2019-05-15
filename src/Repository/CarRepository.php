<?php


namespace App\Repository;


use Doctrine\MongoDB\Query\Query;
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
}