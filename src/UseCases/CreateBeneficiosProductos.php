<?php


namespace App\UseCases;

use App\Domain\Models\BeneficioProductos;
use App\Domain\Repositories\BeneficioProductosRepositoryInterface;

class CreateBeneficiosProductos{

    public function __construct(private BeneficioProductosRepositoryInterface $repo){}
    public function execute(array $data): ?BeneficioProductos{
        return $this->repo->create($data);
    }
}