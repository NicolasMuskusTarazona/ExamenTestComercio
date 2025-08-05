<?php

namespace App\Domain\Repositories;

use App\Domain\Models\BeneficiosEstrategias;

interface BeneficiosEstrategiasRepositoryInterface
{
    public function getAll(): array;
    public function getById(int $id): ?BeneficiosEstrategias;
    public function findByTipo(string $tipo): array;
    public function create(array $data): BeneficiosEstrategias;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}