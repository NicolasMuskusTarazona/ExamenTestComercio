<?php

namespace App\UseCases;

use App\Domain\Models\BeneficiosEstrategias;
use App\Domain\Repositories\BeneficiosEstrategiasRepositoryInterface;

class GetByIdBeneficiosEstrategias{

    public function __construct(private BeneficiosEstrategiasRepositoryInterface $repo){}

    public function execute(int $id): ?BeneficiosEstrategias {
        return $this->repo->getById($id);
    }
}