<?php
require __DIR__.'/../../vendor/autoload.php';
use Services\ProductImageService;

/*
 * Cron will save resized images
 */
class SaveImageAsynchronous {
    
   private $imageService; 
    
   public function __construct() {
       $this->imageService = new ProductImageService();
   }

   public function process($options) {
       $img = $options['imageKey'];
       $this->imageService->saveResizedImages($img);
   }
}

$shortopts = "i::";
$longopts  = array(
     "imageKey::",    // Optional value
);
$options = getopt($shortopts, $longopts);
$obj = new SaveImageAsynchronous();
$obj->process($options);