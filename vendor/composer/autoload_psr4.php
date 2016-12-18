<?php

// autoload_psr4.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'Slim\\Views\\' => array($vendorDir . '/slim/views'),
    'Services\\' => array($baseDir . '/app/services'),
    'Predis\\' => array($vendorDir . '/predis/predis/src'),
    'Models\\' => array($baseDir . '/app/models'),
    'League\\Flysystem\\' => array($vendorDir . '/league/flysystem/src'),
    'Dao\\' => array($baseDir . '/app/dao'),
    'Batch\\' => array($baseDir . '/app/batch'),
);
