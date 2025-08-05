<?php

namespace App\DTOs;

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\ValidationException;
use InvalidArgumentException;

class BeneficiosEstrategiasDTO
{
    public static function fromArray(array $data): array
    {
        try {
            v::key('tipo', v::in(['descuento_porcentaje', 'descuento_fijo', 'combo', 'bonificacion', '2x1', 'regalo', 'normal']))
            ->key('estado', v::in(['activo', 'inactivo']))
            ->assert($data);
        } catch (ValidationException $e) {
            throw new InvalidArgumentException('Campos invalidos | tipo = descuento_porcentaje o descuento_fijo o combo o bonificacion o 2x1 o regalo o normal | estado = activo o inactivo');
        }

        return $data; // datos ya validados
    }
}
