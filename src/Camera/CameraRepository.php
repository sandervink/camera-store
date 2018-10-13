<?php

declare(strict_types=1);

namespace CameraStore\Camera;

interface CameraRepository
{
    /**
     * @param int $number
     * @return Camera
     * @throws CameraNotFoundException
     */
    public function getByNumber(int $number): Camera;

    public function findAllByName(string $name): array;
}