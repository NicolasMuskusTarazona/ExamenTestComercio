<?php

namespace App\UseCases;

use App\Domain\Models\Plantas;
use App\Domain\Repositories\PlantasRepositoryInterface;

class GetByIdPlantas{

    public function __construct(private PlantasRepositoryInterface $repo){}

    public function execute(int $id): ?Plantas {
        return $this->repo->getById($id);
    }
}