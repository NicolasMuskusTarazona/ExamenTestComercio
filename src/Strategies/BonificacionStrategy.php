<?php
namespace App\Strategies;

class BonificacionStrategy implements EstrategiaInterface {
    public function aplicar(array $data) {
        return 'Bonificacion aplicada correctamente';
    }
}
