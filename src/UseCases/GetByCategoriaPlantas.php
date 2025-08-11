<?php
namespace App\UseCases;

use App\Domain\Repositories\PlantasRepositoryInterface;

class GetByCategoriaPlantas {
    public function __construct(private PlantasRepositoryInterface $repo) {}

    public function execute(string $categoria): array {
        return $this->repo->findByCategoria($categoria);
    }
}
