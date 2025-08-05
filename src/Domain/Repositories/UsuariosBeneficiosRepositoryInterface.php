<?php

namespace App\Domain\Repositories;

use App\Domain\Models\UsuariosBeneficios;

interface UsuariosBeneficiosRepositoryInterface
{
    public function getAll(): array;
    public function getById(int $id): ?UsuariosBeneficios;
    public function create(array $data): UsuariosBeneficios;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}