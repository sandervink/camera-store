<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

const CLI_PARAMETER_NAME = 'name';

// Before we start executing anything, make sure the right options are passed
$cliOptions = getopt('', [CLI_PARAMETER_NAME . ':']);
if (empty($cliOptions) || $cliOptions[CLI_PARAMETER_NAME] === '') {
    echo "No search parameters supplied. Example usage: php search.php --name neude\n";
    exit;
}

$cameraApi = \CameraStore\Camera\CameraApiFactory::getCameraApi();

$cameras = $cameraApi->findAllByName($cliOptions[CLI_PARAMETER_NAME]);
if (empty($cameras)) {
    echo "No cameras found!\n";
    exit;
}

/** @var \CameraStore\Camera\Camera $camera */
foreach ($cameras as $camera) {
    echo implode(' | ', $camera->asArray()) . "\n";
}
