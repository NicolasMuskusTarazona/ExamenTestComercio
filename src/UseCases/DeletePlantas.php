<?php

namespace App\UseCases;

use App\Domain\Repositories\PlantasRepositoryInterface;

class DeletePlantas{

    public function __construct(private PlantasRepositoryInterface $repo){}

    public function execute(int $id): bool {
        return $this->repo->delete($id );
    }
}