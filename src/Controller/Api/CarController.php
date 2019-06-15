<?php

namespace App\Controller\Api;

use FOS\RestBundle\Controller\AbstractFOSRestController;

class CarController extends AbstractFOSRestController
{

    /**
     * @Rest\Get(
     *     "/cote/{cityId}/{markId}/{modelId}/{FuelTypeId}/{MileageMax}/{}/{}/{}/{}/{}/{}/{}",
     *     name="get_cote"
     * )
     * @View(statusCode=200)
     */
    public function getCote()
    {
        $modelManager = new ModelManager();
        $restoredClassifier = $modelManager->restoreFromFile('');
        $restoredClassifier->predict([3, 2]);

    }

}
