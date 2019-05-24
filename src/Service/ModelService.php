<?php


namespace App\Service;


use App\Document\Car;
use Doctrine\ODM\MongoDB\DocumentManager;
use Phpml\Math\Statistic\Mean;

class ModelService
{

    private $dm;

    public function __construct(DocumentManager $dm)
    {
        $this->dm = $dm;
    }

    /**
     * @return DocumentManager
     */
    public function getAllModel($mark)
    {
        $models = [];
        $modelsList = $this->dm->getRepository(Car::class)->findAllModels($mark);
        foreach ($modelsList as $model)
        {
            array_push($models, [$model => $this->getPriceModel($model)]);
        }
        return $models;
    }

    /**
     * @return float
     */
    public function getPriceModel($model): float
    {
        $prices = [];
        $priceList = $this->dm->getRepository(Car::class)->findAllPriceByModel($model);
        foreach ($priceList as $price)
        {
            array_push($prices, (int)$price['price']);
        }
        return Mean::mode($prices);

    }

}