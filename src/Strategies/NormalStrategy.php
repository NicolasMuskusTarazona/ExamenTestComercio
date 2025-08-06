<?php
namespace App\Strategies;

class NormalStrategy implements EstrategiaInterface {
    public function aplicar(array $data) {
        return 'No se aplica ninguna estrategia especial';
    }
}
