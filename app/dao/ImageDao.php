<?php

namespace Dao;
use PDO;
use Models\Constants;

class ImageDao {
    private $dsn = 'mysql:dbname=ProductDetails;host=127.0.0.1';
    private $user = 'root';
    private $password = 'champ';
    private $db;
    
    public function __construct() {
        if(empty($this->db)) {
            $this->db = new PDO($this->dsn,$this->user,$this->password);
        }
    }
    
    public function generateImageKey($ext) {
        try{
            $insertQuery = "insert into ProductImage (isProcessed,ext) values (:isProcessed,:ext)";
            $insertPrepQuery = $this->db->prepare($insertQuery);
            $insertPrepQuery->bindValue(":isProcessed", Constants::NOT_PROCESSED,PDO::PARAM_STR);
            $insertPrepQuery->bindValue(":ext",$ext,PDO::PARAM_STR);
            $insertPrepQuery->execute();
            $insertPrepQuery->closeCursor();
        } catch(Exception $ex) {
            //catch Excepiton
        }
        $id = $this->db->lastInsertId();
        return $id;
    }
    
    public function getProcessedImageIds($timeStart,$timeEnd) {
        try{
            $selectQuery = "select id,ext from ProductImage where updatedTime >= :timeStart and updatedTime <= :timeEnd and isProcessed = :isProcessed";
            $selectPrepQuery = $this->db->prepare($selectQuery);
            $selectPrepQuery->bindValue(":timeStart",$timeStart,PDO::PARAM_STR);
            $selectPrepQuery->bindValue(":timeEnd",$timeEnd,PDO::PARAM_STR);
            $selectPrepQuery->bindValue(":isProcessed",  Constants::PROCESSED);
            $selectPrepQuery->execute();
            $imagesData = $selectPrepQuery->fetchAll(PDO::FETCH_ASSOC);
            $selectPrepQuery->closeCursor();
        } catch (Exception $ex) {
            //catch Exception
        }
        return $imagesData;
    }
    
    public function saveResizedImageData($img_256,$img_512,$img) {
        $imgArr = explode(".",$img);
        $imageId = $imgArr[0];
        try{
            $updateQuery = "update ProductImage set image_256 = :img_256, image_512 = :img_512, isProcessed = :isProcessed where id = :id";
            $updatePrepQuery = $this->db->prepare($updateQuery);
            $updatePrepQuery->bindValue(":img_256", $img_256,PDO::PARAM_LOB);
            $updatePrepQuery->bindValue(":img_512", $img_512,PDO::PARAM_LOB);
            $updatePrepQuery->bindValue(":isProcessed", Constants::PROCESSED,PDO::PARAM_STR);
            $updatePrepQuery->bindValue(":id",$imageId,PDO::PARAM_INT); 
            $updatePrepQuery->execute();
            $updatePrepQuery->closeCursor();
        } catch (Exception $ex) {
            //catch Exception
        }
        return true;
    }
    
    public function getAllProcessedImageData() {
        try{
            $selectQuery = "select id,image_256,image_512 from ProductImage where isProcessed = :isProcessed";
            $selectPrepQuery = $this->db->prepare($selectQuery);
            $selectPrepQuery->bindValue(":isProcessed",  Constants::PROCESSED,PDO::PARAM_STR);
            $selectPrepQuery->execute();
            $imagesData = $selectPrepQuery->fetchAll(PDO::FETCH_ASSOC);
            $selectPrepQuery->closeCursor();
        } catch (Exception $ex) {
            //catch Exception
        }
        return $imagesData;
    }
    
    public function getImage($imageId,$column) {
        try{
            $selectQuery = "select $column from ProductImage where id = :id";
            $selectPrepQuery = $this->db->prepare($selectQuery);
            $selectPrepQuery->bindValue(":id",$imageId,PDO::PARAM_INT);
            $selectPrepQuery->execute();
            $imageData = $selectPrepQuery->fetch(PDO::FETCH_COLUMN);
            $selectPrepQuery->closeCursor();
        } catch (Exception $ex) {
            //catch Exception
        }
        return $imageData;
    }
}

