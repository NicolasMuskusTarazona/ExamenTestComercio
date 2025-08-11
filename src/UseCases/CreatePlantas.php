<?php


namespace App\UseCases;

use App\Domain\Models\Plantas;
use App\Domain\Repositories\PlantasRepositoryInterface;

class CreatePlantas{

    public function __construct(private PlantasRepositoryInterface $repo){}
    public function execute(array $data): ?Plantas{
        return $this->repo->create($data);
    }
}