<?php


namespace App\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;

class MarkRepository extends DocumentRepository
{
    public function findAllMarks()
    {
        return $this->createQueryBuilder('m')
            ->eagerCursor(true)
            ->hydrate(false)
            ->getQuery()
            ->toArray();                                                                                                  ;
    }

    public function count()
    {
        return $this->createQueryBuilder('m')
            ->getQuery()
            ->execute()
            ->count();                                                                                                    ;
    }

    public function checkIfExist(string $mark)
    {
        return $this->createQueryBuilder('m')
            ->field('name')->equals($mark)
            ->getQuery()
            ->execute()
            ->count();                                                                                                    ;
    }
}