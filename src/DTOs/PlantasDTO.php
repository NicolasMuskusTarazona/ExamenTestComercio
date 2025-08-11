<?php

namespace App\DTOs;

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\ValidationException;
use InvalidArgumentException;

class PlantasDTO
{
    public static function fromArray(array $data): array
    {
        try {
            v::key('categoria', v::in(['cactus', 'ornamental', 'frutal','Sin familia']))
            ->assert($data);
        } catch (ValidationException $e) {
            throw new InvalidArgumentException('Campos invalidos | categoria = cactus o ornamental o frutal o Sin familia');
        }

        return $data; // datos ya validados
    }
}
