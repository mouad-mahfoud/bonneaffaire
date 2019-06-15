<?php


namespace App\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

class ModelRepository extends DocumentRepository
{
    public function findAllMarks()
    {
        return $this->createQueryBuilder('m')
            ->getQuery()
            ->execute();                                                                                                    ;
    }

    public function count()
    {
        return $this->createQueryBuilder('m')
            ->getQuery()
            ->execute()
            ->count();                                                                                                    ;
    }

    public function checkIfExist(string $model)
    {
        return $this->createQueryBuilder('m')
            ->field('name')->equals($model)
            ->getQuery()
            ->execute()
            ->count();                                                                                                    ;
    }
}