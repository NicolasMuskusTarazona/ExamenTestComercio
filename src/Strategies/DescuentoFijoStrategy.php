<?php
namespace App\Strategies;

class DescuentoFijoStrategy implements EstrategiaInterface {
    public function aplicar(array $data) {
        $total = $data['total'];
        $descuento = $data['monto_descuento'] ?? 0;
        return $total - $descuento;
    }
}
