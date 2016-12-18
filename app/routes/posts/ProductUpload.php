<?php

use Services\ProductImageService;
use Services\ProductDetailsService;
use Models\Product;

/**
 * This method save image in redis and generate image data in ProductImage database
 */
$app->post('/posts/imageUpload', function() use ($app) {
    $fileDataArr = getFileData();
    $productUploadService = new ProductImageService;
    $imageId = $productUploadService->saveImageAndGenerateId($fileDataArr);
    $response = $app->response();
    $response->write($imageId);
    $response->status(200);
    return $response;
});

/**
 * This method saves product details in db and resize images to given size
 */
$app->post('/posts/productDetails', function() use ($app){
   $productDetailsService = new ProductDetailsService;
   $product = new Product;   
   $productData = $app->request->post();
   $productObj = $product->setProductProperties($productData);
   $response = $productDetailsService->saveProductDetails($productObj);
   return $response;
});

function getFileData() {
    $tmpName = $_FILES['photo']['tmp_name'];
    $name = $_FILES['photo']['name'];
    $type = pathinfo($name, PATHINFO_EXTENSION);
    $fp      = fopen($tmpName, 'r');
    $content = fread($fp, filesize($tmpName));
    return array('content' => $content, 'ext' => $type);
}