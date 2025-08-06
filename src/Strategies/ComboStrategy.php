<?php
namespace App\Strategies;

class ComboStrategy implements EstrategiaInterface {
    public function aplicar(array $data) {
        // Obtener el precio del combo
        $precioCombo = $data['precio_combo'] ?? 0;

        // Aplicar descuento si el total de la compra es mayor a un valor
        $totalCompra = $data['total'] ?? 0; // Total de la compra

        if ($totalCompra > 50000) { // Supongamos que si el total supera $50,000, el combo tiene un descuento del 10%
            $descuento = $precioCombo * 0.1; // 10% de descuento
            $precioCombo -= $descuento; // Aplicar el descuento al precio del combo
        }

        return $precioCombo; // Retornar el precio final del combo con descuento si aplica
    }
}
