<?php


namespace App\UseCases;

use App\Domain\Models\Riego;
use App\Domain\Repositories\RiegoRepositoryInterface;

class CreateRiego{

    public function __construct(private RiegoRepositoryInterface $repo){}
    public function execute(array $data): ?Riego{
        return $this->repo->create($data);
    }
}