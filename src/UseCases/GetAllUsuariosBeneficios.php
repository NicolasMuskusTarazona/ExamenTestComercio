<?php

namespace App\UseCases;

use App\Domain\Repositories\UsuariosBeneficiosRepositoryInterface;

class GetAllUsuariosBeneficios{
    public function __construct(private UsuariosBeneficiosRepositoryInterface $repo){}
    public function execute(): array{
        return $this->repo->getAll();
    }
}