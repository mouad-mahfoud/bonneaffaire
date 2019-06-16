<?php

namespace App\Controller\Api;

use App\Service\MarkService;
use App\Service\ModelService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\View;

header("Access-Control-Allow-Origin: *");
class ModelController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/models/{mark}", name="models_list")
     * @View(statusCode=200)
     */
    public function getModels($mark, ModelService $modelService)
    {
        return $modelService->getAllModel($mark);
    }

    /**
     * @Rest\Get("/models/count-ads/{mark}", name="models_count_ads")
     * @View(statusCode=200)
     */
    public function getMarksWithCountAds($mark, ModelService $modelService)
    {
        return $modelService->getAllModelsWithNumberOfAds($mark);
    }
}
