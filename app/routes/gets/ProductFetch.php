<?php

use Services\ProductDataService;
use Services\ProductImageService;

$app->get('/gets/productData', function() use ($app) {
    $productDataService = new ProductDataService;
    $allProductData = $productDataService->getAllProductData();
    $app->render('/gets/ProductFetch.php', array('allProductData' => $allProductData));
});


$app->get('/gets/getImage', function() use ($app) {
    $imageId = $app->request->get('image_id');
    $size = $app->request->get('size');
    $productImageService = new ProductImageService;
    $productImageService->getImage($imageId,$size);
});