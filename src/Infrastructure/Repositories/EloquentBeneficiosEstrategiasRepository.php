<?php
// 7.
namespace App\Infrastructure\Repositories;

use Illuminate\Support\Collection;
use App\Domain\Models\BeneficiosEstrategias;
use App\Domain\Repositories\BeneficiosEstrategiasRepositoryInterface;

class EloquentBeneficiosEstrategiasRepository implements BeneficiosEstrategiasRepositoryInterface{
    public function getAll() : array {
        // SELECT * FROM Variedades;
        return BeneficiosEstrategias::all()->toArray();
    }

    public function getById(int $id): ?BeneficiosEstrategias {
        return BeneficiosEstrategias::where('id', $id)->first();
    }
    

    public function create(array $data): BeneficiosEstrategias {
        
        if (isset($data['id'])) {
            $exists = BeneficiosEstrategias::where('id', $data['id'])->first();
            if ($exists) {
                return $exists;
            }
        }        
        return BeneficiosEstrategias::create($data);
    }
    
    public function update(int $id, array $data): bool{
        $caracter = $this->getById($id);
        return $caracter ? $caracter->update($data) : false;
    }
    

    public function delete(int $id): bool{
        // SELECT * FROM Variedades WHERE id = $id;
        $caracter = BeneficiosEstrategias::find($id);
        // DELETE FROM Variedades WHERE id = $id;
        return $caracter ? $caracter->delete() : false;   
    }

    public function findByTipo(string $tipo): array {
        return BeneficiosEstrategias::where('tipo', 'LIKE', "%$tipo%")->get()->toArray();
    }
}