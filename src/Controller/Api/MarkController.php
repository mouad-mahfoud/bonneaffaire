<?php

namespace App\Controller\Api;

use App\Service\MarkService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\View;


class MarkController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/marks", name="marks_list")
     * @View(statusCode=200)
     */
    public function getMarks(MarkService $markService)
    {
        return $markService->getAllMark();
    }
}
