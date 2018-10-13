<?php

declare(strict_types=1);

namespace CameraStore\Camera;

final class Camera
{
    private $number;
    private $name;
    private $latitude;
    private $longitude;

    public function __construct(int $number, string $name, string $latitude, string $longitude)
    {
        $this->number = $number;
        $this->name = $name;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLatitude(): string
    {
        return $this->latitude;
    }

    public function getLongitude(): string
    {
        return $this->longitude;
    }

    public function asArray(): array
    {
        return [
            'number' => $this->getNumber(),
            'name' => $this->getName(),
            'latitude' => $this->getLatitude(),
            'longitude' => $this->getLongitude(),
        ];
    }
}