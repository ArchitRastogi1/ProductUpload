<?php

namespace Services;
use Dao\ProductDetailsDao;
use Models\Product;
use Services\ProductImageService;

class ProductDetailsService {
    private $productDetailsDao;
    private $productImageService;
    
    public function __construct() {
        $this->productDetailsDao = new ProductDetailsDao;
        $this->productImageService = new ProductImageService;
    }
    
    //this method saves product details and resized images in db
    public function saveProductDetails(Product $productObj) {
        $imageIds = explode(",",$productObj->getImageIds());
        //$imageIds = array("66.jpg");
        foreach($imageIds as $img) {
            $this->productImageService->saveResizedImages($img);
        }
        $this->productDetailsDao->storeProductDetails($productObj);
        return true;
    }
}
