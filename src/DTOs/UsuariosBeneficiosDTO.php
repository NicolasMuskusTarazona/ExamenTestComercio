<?php

namespace App\DTOs;

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\ValidationException;
use InvalidArgumentException;
use DateTime;

// Manejo de erroes fechas
class UsuariosBeneficiosDTO
{
    public static function fromArray(array $data): array
    {
        try {
            v::key('fecha_asignacion', v::date('Y-m-d'))
            ->assert($data);
        } catch (ValidationException $e) {
            throw new InvalidArgumentException('Campos invalidos fecha_asignacion');
        }
        $data['fecha_asignacion'] = (new DateTime($data['fecha_asignacion']))->format('Y-m-d');
        return $data; // datos ya validados
    }
}
