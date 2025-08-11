<?php

namespace App\UseCases;

use App\Domain\Repositories\RiegoRepositoryInterface;

class DeleteRiego{

    public function __construct(private RiegoRepositoryInterface $repo){}

    public function execute(int $id): bool {
        return $this->repo->delete($id );
    }
}