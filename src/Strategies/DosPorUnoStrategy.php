<?php
namespace App\Strategies;

class DosPorUnoStrategy implements EstrategiaInterface {
    public function aplicar(array $data) {
        // Validamos que tenga los IDs requeridos
        if (!isset($data['producto_aplica_id']) || !isset($data['producto_extra_id'])) {
            return 'Faltan datos para aplicar 2x1';
        }

        // Simulamos la lógica del 2x1 con los datos actuales
        return "Aplica 2x1: compra el producto {$data['producto_aplica_id']} y recibe gratis el producto {$data['producto_extra_id']}";
    }
}
