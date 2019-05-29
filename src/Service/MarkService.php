<?php


namespace App\Service;


use App\Document\Car;
use Doctrine\ODM\MongoDB\DocumentManager;
use Phpml\Math\Statistic\Mean;

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
        $marks = [];
        $markList = $this->dm->getRepository(Car::class)->findAllMarks();
        foreach ($markList as $mark)
        {
            array_push($marks, ['mark' => $mark, 'price' => $this->getPriceMode($mark)]);
        }
        return $marks;
    }

    /**
     * @return float
     */
    public function getPriceMode($mark): float
    {

        $prices = [];
        $priceList = $this->dm->getRepository(Car::class)->findAllPriceByMark($mark);
        foreach ($priceList as $price)
        {
            array_push($prices, (int)$price['price']);
        }
        return Mean::mode($prices);

    }

}