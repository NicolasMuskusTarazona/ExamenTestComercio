<?php

namespace App\UseCases;

use App\Domain\Repositories\PlantasRepositoryInterface;

class UpdatePlantas{

    public function __construct(private PlantasRepositoryInterface $repo){}

    public function execute(int $id, array $data): bool {
        $caracteristica = $this->repo->getById($id);
        return $caracteristica ? $this->repo->update($id, $data) : false;
    } 
}
