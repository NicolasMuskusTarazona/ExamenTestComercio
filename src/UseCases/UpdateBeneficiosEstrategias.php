<?php

namespace App\UseCases;

use App\DTOs\BeneficiosEstrategiasDTO;
use App\Domain\Repositories\BeneficiosEstrategiasRepositoryInterface;

class UpdateBeneficiosEstrategias{

    public function __construct(private BeneficiosEstrategiasRepositoryInterface $repo){}

    public function execute(int $id, array $data): bool {
        return $this->repo->update($id,$data);
    }
}