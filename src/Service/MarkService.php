<?php


namespace App\Service;


use App\Document\Car;
use Doctrine\ODM\MongoDB\DocumentManager;

class MarkService
{

    private $dm;

    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }

    /**
     * @return DocumentManager
     */
    public function getAllMark()
    {
        return $this->dm->getRepository(Car::class)->findAllMarks();
    }

}