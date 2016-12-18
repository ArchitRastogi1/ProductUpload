<?php

namespace Services;
use Predis\Autoloader;
use Predis\Client;

class RedisService {
    private $redis;
    
    public function __construct() {
        if(empty($this->redis)) {
            Autoloader::register();
            $this->redis = new Client('tcp://127.0.0.1:6379'."?read_write_timeout=0");
        }
    }
    
    public function setImageToRedis($imageKey,$content) {
        $this->redis->set($imageKey,$content);
        return true;
    }
    
    public function getImageFromRedis($imageKey) {
        $imageData = $this->redis->get($imageKey);
        return $imageData;
    }
    
    public function deleteImageFromRedis($imageKey) {
        $this->redis->del($imageKey);
    }
}

