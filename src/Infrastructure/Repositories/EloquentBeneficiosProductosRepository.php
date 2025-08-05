<?php
// 7.
namespace App\Infrastructure\Repositories;

use Illuminate\Support\Collection;
use App\Domain\Models\BeneficioProductos;
use App\Domain\Repositories\BeneficioProductosRepositoryInterface;

class EloquentBeneficiosProductosRepository implements BeneficioProductosRepositoryInterface{
    public function getAll() : array {
        // SELECT * FROM Variedades;
        return BeneficioProductos::all()->toArray();
    }

    public function getById(int $id): ?BeneficioProductos {
        return BeneficioProductos::where('id', $id)->first();
    }
    

    public function create(array $data): BeneficioProductos {
        
        if (isset($data['id'])) {
            $exists = BeneficioProductos::where('id', $data['id'])->first();
            if ($exists) {
                return $exists;
            }
        }        
        return BeneficioProductos::create($data);
    }
    
    public function update(int $id, array $data): bool{
        $caracter = $this->getById($id);
        return $caracter ? $caracter->update($data) : false;
    }
    

    public function delete(int $id): bool{
        // SELECT * FROM Variedades WHERE id = $id;
        $caracter = BeneficioProductos::find($id);
        // DELETE FROM Variedades WHERE id = $id;
        return $caracter ? $caracter->delete() : false;   
    }

}