<?php

namespace Services;
use Dao\ProductDetailsDao;
use Dao\ImageDao;


class ProductDataService {
    
    private $productDetailsDao;
    private $imageDao;
    
    public function __construct() {
        $this->productDetailsDao = new ProductDetailsDao;
        $this->imageDao = new ImageDao;
        
    }
    
    public function getAllProductData() {
        $allProductDetailsArr = $this->productDetailsDao->getAllProductDetails();
        $formattedImageData = $this->getFormattedImageData();
        $productData = array();
        foreach($allProductDetailsArr as $key => $productDetail) {
            $imageIdsArr = explode(",", $productDetail['imageIds']);
            $count = 0;
            foreach($imageIdsArr as $img) {
                $allProductDetailsArr[$key]['image256'][$count] = base64_encode($formattedImageData[$img]['image_256']);
                $allProductDetailsArr[$key]['image512'][$count] = base64_encode($formattedImageData[$img]['image_512']);
                $allProductDetailsArr[$key]['images'][$count] = $img;
                $count++;
            }
        }
        return $allProductDetailsArr;
    }
    
    private function getFormattedImageData() {
        $allImageData = $this->imageDao->getAllProcessedImageData();
        $formattedImageData = array();
        foreach ($allImageData as $imageData) {
            $formattedImageData[$imageData['id']] = $imageData;
        }
        return $formattedImageData;
    }
}

