<?php

namespace App\Domain\Repositories;

use App\Domain\Models\BeneficioProductos;

interface BeneficioProductosRepositoryInterface
{
    public function getAll(): array;
    public function getById(int $id): ?BeneficioProductos;
    public function create(array $data): BeneficioProductos;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}