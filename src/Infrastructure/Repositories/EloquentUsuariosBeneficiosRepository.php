<?php
namespace App\Infrastructure\Repositories;

use Illuminate\Support\Collection;
use App\Domain\Models\UsuariosBeneficios;
use App\Domain\Repositories\UsuariosBeneficiosRepositoryInterface;

class EloquentUsuariosBeneficiosRepository implements UsuariosBeneficiosRepositoryInterface{
    public function getAll() : array {
        // SELECT * FROM Variedades;
        return UsuariosBeneficios::all()->toArray();
    }

    public function getById(int $id): ?UsuariosBeneficios {
        return UsuariosBeneficios::where('id', $id)->first();
    }
    

    public function create(array $data): UsuariosBeneficios {
        
        if (isset($data['id'])) {
            $exists = UsuariosBeneficios::where('id', $data['id'])->first();
            if ($exists) {
                return $exists;
            }
        }        
        return UsuariosBeneficios::create($data);
    }
    
    public function update(int $id, array $data): bool{
        $caracter = $this->getById($id);
        return $caracter ? $caracter->update($data) : false;
    }
    

    public function delete(int $id): bool{
        // SELECT * FROM Variedades WHERE id = $id;
        $caracter = UsuariosBeneficios::find($id);
        // DELETE FROM Variedades WHERE id = $id;
        return $caracter ? $caracter->delete() : false;   
    }

}