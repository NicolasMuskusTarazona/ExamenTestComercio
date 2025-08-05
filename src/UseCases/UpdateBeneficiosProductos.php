<?php

namespace App\UseCases;

use App\DTOs\BeneficiosProductosDTO;
use App\Domain\Repositories\BeneficioProductosRepositoryInterface;

class UpdateBeneficiosProductos{

    public function __construct(private BeneficioProductosRepositoryInterface $repo){}

    public function execute(int $id, array $data): bool {
        return $this->repo->update($id,$data);
    }
}