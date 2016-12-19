<?php

namespace Services;
use Dao\ProductDetailsDao;
use Dao\ImageDao;
use Models\Constants;


class ProductDataService {
    
    private $productDetailsDao;
    private $imageDao;
    private $productImageService;
    
    public function __construct() {
        $this->productDetailsDao = new ProductDetailsDao;
        $this->imageDao = new ImageDao;
        $this->productImageService = new ProductImageService;
        
    }
    
    public function getAllProductData() {
        $allProductDetailsArr = $this->productDetailsDao->getAllProductDetails();
        $formattedImageData = $this->getFormattedImageData();
        $productData = array();
        foreach($allProductDetailsArr as $key => $productDetail) {
            $imageIdsArr = explode(",", $productDetail['imageIds']);
            $count = 0;
            foreach($imageIdsArr as $img) {
                $imgIds = explode('.',$img);
                $allProductDetailsArr[$key]['image256'][$count] = $this->productImageService->getImage($imgIds[0], Constants::IMAGE_256);
                $allProductDetailsArr[$key]['image512'][$count] = $this->productImageService->getImage($imgIds[0], Constants::IMAGE_512);;
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

