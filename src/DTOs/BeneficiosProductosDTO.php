<?php

namespace App\DTOs;

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\ValidationException;
use InvalidArgumentException;

class BeneficiosProductosDTO
{
    public static function fromArray(array $data): array
    {
        try {
            v::key('tipo_asociacion', v::in(['principal', 'regalo','extra']))
            ->assert($data);
        } catch (ValidationException $e) {
            throw new InvalidArgumentException('Campos invalidos | tipo_asociacion = principal o regalo o extra');
        }

        return $data; // datos ya validados
    }
}
