<?php

declare(strict_types=1);

namespace CameraStore\Camera;

final class FileCameraRepository implements CameraRepository
{
    private const CSV_COLUMN_COUNT = 3;

    private const KEY_NUMBER = 'number';
    private const KEY_NAME = 'name';
    private const KEY_LATITUDE = 'latitude';
    private const KEY_LONGITUDE = 'longitude';

    private $cameraData = [];

    public function __construct($pathToFile)
    {
        if (!file_exists($pathToFile)) {
            throw new \Exception('CSV file could not be found.');
        }

        $fileHandle = fopen($pathToFile, 'r');
        if ($fileHandle !== false) {
            while (($data = fgetcsv($fileHandle, 0, ';')) !== false) {
                // Skip lines with too few columns
                if (count($data) !== self::CSV_COLUMN_COUNT) {
                    continue;
                }

                // Trim all columns
                $data = array_map('trim', $data);

                // Skip header line
                if (strtoupper($data[0]) === 'CAMERA') {
                    continue;
                }

                $this->parseCameraDataFromCsv($data);
            }
        }
        fclose($fileHandle);
    }

    private function parseCameraDataFromCsv($csvData)
    {
        // The first column should contain a three-digit camera number
        if (!preg_match('/\d{3}/', $csvData[0], $numberMatch)) {
            return;
        }

        $cameraNumber = (int)$numberMatch[0];

        $this->cameraData[$cameraNumber] = [
            self::KEY_NUMBER => $cameraNumber,
            self::KEY_NAME => $csvData[0],
            self::KEY_LATITUDE => $csvData[1],
            self::KEY_LONGITUDE => $csvData[2],
        ];
    }

    /**
     * @param int $number
     * @return Camera
     * @throws CameraNotFoundException
     */
    public function getByNumber(int $number): Camera
    {
        if (!array_key_exists($number, $this->cameraData)) {
            throw new CameraNotFoundException("Camera with number $number could not be found.");
        }

        $cameraData = $this->cameraData[$number];

        return new Camera(
            $cameraData[self::KEY_NUMBER],
            $cameraData[self::KEY_NAME],
            $cameraData[self::KEY_LATITUDE],
            $cameraData[self::KEY_LONGITUDE]
        );
    }

    /**
     * @param string $name
     * @return array
     */
    public function findAllByName(string $name): array
    {
        // Case-insensitive name search
        $cameras = array_filter($this->cameraData, function($data) use ($name) {
            return stristr($data[self::KEY_NAME], $name) !== false;
        });

        // Create camera instances of all data found
        return array_map(function($data) {
            return new Camera(
                $data[self::KEY_NUMBER],
                $data[self::KEY_NAME],
                $data[self::KEY_LATITUDE],
                $data[self::KEY_LONGITUDE]
            );
        }, $cameras);
    }
}
