<?php

namespace Dao;
use PDO;
use Models\Constants;
use Models\Product;

class ProductDetailsDao {
    private $dsn = 'mysql:dbname=ProductDetails;host=127.0.0.1';
    private $user = 'root';
    private $password = 'champ';
    private $db;
    
    public function __construct() {
        if(empty($this->db)) {
            $this->db = new PDO($this->dsn,$this->user,$this->password);
        }
    }
    
    public function storeProductDetails(Product $productObj) {
        try{
            
            $insertQuery = "insert into ProductData (productId,productName,productPrice,imageIds) values (:productId,:productName,"
                    . ":productPrice,:imageIds)" ;
            $insertPrepQuery = $this->db->prepare($insertQuery);
            $insertPrepQuery->bindValue(":productId",$productObj->getProductId(),PDO::PARAM_STR);
            $insertPrepQuery->bindValue(":productName",$productObj->getProductName(),PDO::PARAM_STR);
            $insertPrepQuery->bindValue(":productPrice",$productObj->getProductPrice(),PDO::PARAM_STR);
            $insertPrepQuery->bindValue(":imageIds",$productObj->getImageIds(),PDO::PARAM_STR);
            $insertPrepQuery->execute();
            $insertPrepQuery->closeCursor();
        } catch (Exception $ex) {
            // catch Exception
        }
        return true;
    }
    
    public function getAllProductDetails() {
        try{
            $selectQuery = "select * from ProductData";
            $selectPrepQuery = $this->db->prepare($selectQuery);
            $selectPrepQuery->execute();
            $productDetailsArr = $selectPrepQuery->fetchAll(PDO::FETCH_ASSOC);
            $selectPrepQuery->closeCursor();
        } catch (Exception $ex) {
            //catch Exception
        }
        return $productDetailsArr;
    }
}

