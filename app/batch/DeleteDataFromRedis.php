<?php
require __DIR__.'/../../vendor/autoload.php';
use Services\RedisService;
use Dao\ImageDao;

/*
 * Cron will delete data processed data from last one 
 */
class DeleteDataFromRedis {

    private $imageDao;
    private $redisService;
    
    public function __construct() {
        $this->imageDao = new ImageDao;
        $this->redisService = new RedisService;
    }

    public function process() {
        $startTime = date('Y-m-d H:i:s', strtotime("- 1 hours"));
        $currentTime = date('Y-m-d H:i:s');
        $processedImageKeys = $this->imageDao->getProcessedImageIds($startTime, $currentTime);
        foreach($processedImageKeys as $img) {
            echo "Deleting ImageKey -".$img['id'].".".$img['ext']."\n";
            $this->redisService->deleteImageFromRedis($img['id'].".".$img['ext']);
        }
        echo "Processed Data has been deleted from redis";
    }
}

$obj = new DeleteDataFromRedis();
$obj->process();