<?php

namespace Services;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local as Adapter;

class FileService {
    private $local;
    private $fileDir = '/home/archita/Documents/MyDocs/codes/assignment/';
    
    public function __construct() {
        if(empty($this->local)) {
            $this->local = new Filesystem(new Adapter($this->fileDir));
        }
    }
    
    //this method saves image file in given folder
    public function saveFileInFolder($img,$imageData) {
        $this->local->write($img,$imageData);
    }
    
    //this method saves delete file from folder
    public function DeleteFileFromFolder($img) {
        $this->local->delete($img);
    }
}

