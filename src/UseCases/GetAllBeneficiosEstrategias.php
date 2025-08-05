<?php

namespace App\UseCases;

use App\Domain\Repositories\BeneficiosEstrategiasRepositoryInterface;

class GetAllBeneficiosEstrategias{
    public function __construct(private BeneficiosEstrategiasRepositoryInterface $repo){}
    public function execute(): array{
        return $this->repo->getAll();
    }
}