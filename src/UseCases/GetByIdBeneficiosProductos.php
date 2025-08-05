<?php

namespace App\UseCases;

use App\Domain\Models\BeneficioProductos;
use App\Domain\Repositories\BeneficioProductosRepositoryInterface;

class GetByIdBeneficiosProductos{

    public function __construct(private BeneficioProductosRepositoryInterface $repo){}

    public function execute(int $id): ?BeneficioProductos {
        return $this->repo->getById($id);
    }
}