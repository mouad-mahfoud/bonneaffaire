<?php

namespace App\Controller\Api;

use App\Service\MarkService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\View;

class CarController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/marks", name="api_car")
     * @View(statusCode=200)
     */
    public function getMarks(MarkService $markService)
    {
        //dump($markService->getAllMark());die;
        return $markService->getAllMark();
    }
}
