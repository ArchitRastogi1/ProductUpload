<?php

namespace Services;
use Dao\ImageDao;
use Services\RedisService;
use Services\FileService;
use Imagick;
use Models\Constants;

class ProductImageService {
    
    private $imageDao;
    private $redisService;
    private $fileService;
    
    public function __construct() {
        $this->imageDao = new ImageDao;
        $this->redisService = new RedisService;
        $this->fileService = new FileService;
    }
    //this method generate imageIdKey and save key value data in redis
    public function saveImageAndGenerateId($fileDataArr) {
        $imageKey = $this->imageDao->generateImageKey($fileDataArr['ext']);
        $this->redisService->setImageToRedis($imageKey.".".$fileDataArr['ext'],$fileDataArr['content']);
        return $imageKey.".".$fileDataArr['ext'];
    }
    
    //this method gets data back from redis and  saves resized images in db 
    public function saveResizedImages($img) {
        
        $imageData = $this->redisService->getImageFromRedis($img);
        $this->fileService->saveFileInFolder($img, $imageData); //saving redis image data in a file, for resizing purpose
        $image_256 = $this->getResizeImage(Constants::IMAGE_256,$img);
        $image_512 = $this->getResizeImage(Constants::IMAGE_512,$img);
        $this->imageDao->saveResizedImageData($image_256,$image_512,$img);
        $this->fileService->deleteFileFromFolder($img); // deleting data from folder
        return true;
    }
    
    //this method returns resized image blob data 
    private function getResizeImage($size,$img) {
        $imagick = new Imagick(realpath('/home/archita/Documents/MyDocs/codes/assignment/'.$img));
        $imagick->resizeimage($size,$size,imagick::FILTER_POINT,1, false);
        return $imagick->getimageblob();
    }
    
    //this method displays image in browser
    public function getImage($imageId,$size) {
        if($size == Constants::IMAGE_256) {
            $imageData = $this->imageDao->getImage($imageId,'image_256');
        } else{
            $imageData = $this->imageDao->getImage($imageId,'image_512');
        }
        echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '"/>';
    }
    
}
