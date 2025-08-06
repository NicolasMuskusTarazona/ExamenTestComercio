<?php
namespace App\Strategies;

use InvalidArgumentException;

class StrategyResolver {
    public static function getStrategy(string $tipo): EstrategiaInterface {
        return match ($tipo) {
            'descuento_fijo' => new DescuentoFijoStrategy(),
            'combo' => new ComboStrategy(),
            'regalo'=> new RegaloStrategy(),
            '2x1' => new DosPorUnoStrategy(),
            'bonificacion' => new BonificacionStrategy(),
            'normal' => new NormalStrategy(),
            default => throw new InvalidArgumentException("Estrategia '$tipo' no soportada"),
        };
    }
}
