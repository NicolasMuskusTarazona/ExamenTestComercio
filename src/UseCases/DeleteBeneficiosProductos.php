<?php

namespace App\UseCases;

use App\Domain\Repositories\BeneficioProductosRepositoryInterface;

class DeleteBeneficiosProductos{

    public function __construct(private BeneficioProductosRepositoryInterface $repo){}

    public function execute(int $id): bool {
        return $this->repo->delete($id);
    }
}