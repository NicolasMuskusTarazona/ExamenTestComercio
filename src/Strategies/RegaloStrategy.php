<?php
namespace App\Strategies;

class RegaloStrategy implements EstrategiaInterface {
    public function aplicar(array $data) {
        $totalCompra = $data['total'] ?? 0;
        $montoMinimo = 30000; // Monto mínimo para aplicar regalo

        if ($totalCompra >= $montoMinimo) {
            $regalo = $data['regalo'] ?? 'Producto sorpresa';
            return 'Regalo aplicado: '.$regalo;
        } else {
            return 'No aplica regalo (compra mínima: $'.$montoMinimo.')';
        }
    }
}
