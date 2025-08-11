<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Riego;

interface RiegoRepositoryInterface
{
    public function getAll(): array;
    public function getById(int $id): ?Riego;
    public function create(array $data): Riego;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}