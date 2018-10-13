<?php

declare(strict_types=1);

namespace CameraStore\Camera;

final class CameraApiFactory
{
    public static function getCameraApi(): CameraApi
    {
        static $cameraApi;

        if (is_null($cameraApi)) {
            $cameraApi = new CameraApi(
                new FileCameraRepository(dirname(dirname(__DIR__)) . '/resources/cameras-defb.csv')
            );
        }

        return $cameraApi;
    }
}
