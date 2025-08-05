<?php


namespace App\UseCases;

use App\Domain\Models\BeneficiosEstrategias;
use App\Domain\Repositories\BeneficiosEstrategiasRepositoryInterface;

class CreateBeneficiosEstrategias{

    public function __construct(private BeneficiosEstrategiasRepositoryInterface $repo){}
    public function execute(array $data): ?BeneficiosEstrategias{
        return $this->repo->create($data);
    }
}