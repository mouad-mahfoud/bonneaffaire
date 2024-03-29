<?php

namespace App\Controller\Api;

use App\Service\MarkService;
use App\Service\ModelService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\View;


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
}
