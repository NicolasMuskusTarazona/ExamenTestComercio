<?php

namespace App\UseCases;

use App\Domain\Repositories\UsuariosBeneficiosRepositoryInterface;

class UpdateUsuariosBeneficios{

    public function __construct(private UsuariosBeneficiosRepositoryInterface $repo){}

    public function execute(int $id, array $data): bool {
        return $this->repo->update($id,$data);
    }
}