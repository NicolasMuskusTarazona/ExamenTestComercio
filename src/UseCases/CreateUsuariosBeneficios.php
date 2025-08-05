<?php


namespace App\UseCases;

use App\Domain\Models\UsuariosBeneficios;
use App\Domain\Repositories\UsuariosBeneficiosRepositoryInterface;

class CreateUsuariosBeneficios{

    public function __construct(private UsuariosBeneficiosRepositoryInterface $repo){}
    public function execute(array $data): ?UsuariosBeneficios{
        return $this->repo->create($data);
    }
}