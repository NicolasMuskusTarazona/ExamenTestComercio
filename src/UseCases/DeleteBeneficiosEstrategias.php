<?php

namespace App\UseCases;

use App\Domain\Repositories\BeneficiosEstrategiasRepositoryInterface;

class DeleteBeneficiosEstrategias{

    public function __construct(private BeneficiosEstrategiasRepositoryInterface $repo){}

    public function execute(int $id): bool {
        return $this->repo->delete($id);
    }
}