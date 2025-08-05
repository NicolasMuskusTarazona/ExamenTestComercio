<?php

namespace App\UseCases;

use App\Domain\Repositories\UsuariosBeneficiosRepositoryInterface;

class DeleteUsuariosBeneficios{

    public function __construct(private UsuariosBeneficiosRepositoryInterface $repo){}

    public function execute(int $id): bool {
        return $this->repo->delete($id);
    }
}