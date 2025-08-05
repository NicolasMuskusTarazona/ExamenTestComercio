<?php

namespace App\UseCases;

use App\Domain\Repositories\BeneficioProductosRepositoryInterface;

class GetAllBeneficiosProductos{
    public function __construct(private BeneficioProductosRepositoryInterface $repo){}
    public function execute(): array{
        return $this->repo->getAll();
    }
}