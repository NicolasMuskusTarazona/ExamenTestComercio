<?php

namespace App\UseCases;

use App\Domain\Models\UsuariosBeneficios;
use App\Domain\Repositories\UsuariosBeneficiosRepositoryInterface;

class GetByIdUsuariosBeneficios{

    public function __construct(private UsuariosBeneficiosRepositoryInterface $repo){}

    public function execute(int $id): ?UsuariosBeneficios {
        return $this->repo->getById($id);
    }
}