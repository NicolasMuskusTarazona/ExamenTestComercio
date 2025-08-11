<?php
// 7.
namespace App\Infrastructure\Repositories;

use Illuminate\Support\Collection;
use App\Domain\Models\Plantas;
use App\Domain\Repositories\PlantasRepositoryInterface;

class EloquentPlantasRepository implements PlantasRepositoryInterface{
    public function getAll() : array {
        // SELECT * FROM Variedades;
        return Plantas::all()->toArray();
    }

    public function getById(int $id): ?Plantas {
        return Plantas::where('id', $id)->first();
    }
    

    public function create(array $data): Plantas {
        
        if (isset($data['id'])) {
            $exists = Plantas::where('id', $data['id'])->first();
            if ($exists) {
                return $exists;
            }
        }        
        return Plantas::create($data);
    }
    
    public function update(int $id, array $data): bool{
        $caracter = $this->getById($id);
        return $caracter ? $caracter->update($data) : false;
    }
    

    public function delete(int $id): bool{
        // SELECT * FROM Variedades WHERE id = $id;
        $caracter = Plantas::find($id);
        // DELETE FROM Variedades WHERE id = $id;
        return $caracter ? $caracter->delete() : false;   
    }
    public function findByCategoria(string $categoria): array {
        return Plantas::where('categoria', 'LIKE', "%$categoria%")->get()->toArray();
    }
}