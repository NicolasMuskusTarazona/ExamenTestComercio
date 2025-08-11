<?php
// 7.
namespace App\Infrastructure\Repositories;

use Illuminate\Support\Collection;
use App\Domain\Models\Riego;
use App\Domain\Repositories\RiegoRepositoryInterface;

class EloquentRiegoRepository implements RiegoRepositoryInterface{
    public function getAll() : array {
        // SELECT * FROM Variedades;
        return Riego::all()->toArray();
    }

    public function getById(int $id): ?Riego {
        return Riego::where('id', $id)->first();
    }
    

    public function create(array $data): Riego {
        
        if (isset($data['id'])) {
            $exists = Riego::where('id', $data['id'])->first();
            if ($exists) {
                return $exists;
            }
        }        
        return Riego::create($data);
    }
    
    public function update(int $id, array $data): bool{
        $caracter = $this->getById($id);
        return $caracter ? $caracter->update($data) : false;
    }
    

    public function delete(int $id): bool{
        // SELECT * FROM Variedades WHERE id = $id;
        $caracter = Riego::find($id);
        // DELETE FROM Variedades WHERE id = $id;
        return $caracter ? $caracter->delete() : false;   
    }

}