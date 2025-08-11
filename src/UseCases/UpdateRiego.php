<?php

namespace App\UseCases;

use App\Domain\Repositories\RiegoRepositoryInterface;

class UpdateRiego{

    public function __construct(private RiegoRepositoryInterface $repo){}

    public function execute(int $id, array $data): bool {
        $caracteristica = $this->repo->getById($id);
        return $caracteristica ? $this->repo->update($id, $data) : false;
    } 
}
