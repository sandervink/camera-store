<?php

declare(strict_types=1);

namespace CameraStore\Camera;

final class CameraApi
{
    private $repository;

    public function __construct(FileCameraRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(): array
    {
        return $this->repository->getAll();
    }

    /**
     * @param int $number
     * @return Camera
     * @throws CameraNotFoundException
     */
    public function getByNumber(int $number): Camera
    {
        return $this->repository->getByNumber($number);
    }

    public function findAllByName(string $name): array
    {
        return $this->repository->findAllByName($name);
    }
}
