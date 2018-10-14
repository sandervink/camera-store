<?php

declare(strict_types=1);

require_once dirname(dirname(dirname(__DIR__))) . '/vendor/autoload.php';

use CameraStore\Camera\Camera;
use CameraStore\Camera\CameraApiFactory;

$cameras = CameraApiFactory::getCameraApi()->getAll();

header('Content-Type: application/json');
echo json_encode([
    'cameras' => array_map(function(Camera $camera) {
        return $camera->asArray();
    }, $cameras),
]);