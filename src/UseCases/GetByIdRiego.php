<?php

namespace App\UseCases;

use App\Domain\Models\Riego;
use App\Domain\Repositories\RiegoRepositoryInterface;

class GetByIdRiego{

    public function __construct(private RiegoRepositoryInterface $repo){}

    public function execute(int $id): ?Riego {
        return $this->repo->getById($id);
    }
}