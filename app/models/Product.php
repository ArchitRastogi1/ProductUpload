<?php

namespace Models;

class Product {
    private $productId;
    private $productPrice;
    private $productName;
    private $imageIds;
    
    public function setProductProperties($productDetails) {
        $this->productId = $productDetails['productId'];
        $this->productPrice = $productDetails['productPrice'];
        $this->productName = $productDetails['productName'];
        $this->imageIds = $productDetails['imageIds'];
        return $this;
    }

    
    function getProductId() {
        return $this->productId;
    }

    function getProductPrice() {
        return $this->productPrice;
    }

    function getProductName() {
        return $this->productName;
    }
    
    function getImageIds() {
        return $this->imageIds;
    }

    function setProductId($productId) {
        $this->productId = $productId;
    }

    function setProductPrice($productPrice) {
        $this->productPrice = $productPrice;
    }

    function setProductName($productName) {
        $this->productName = $productName;
    }

    function setImageIds($imageIds) {
        $this->imageIds = $imageIds;
    }

}

