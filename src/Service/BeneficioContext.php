<?php
namespace App\Services;

use App\Strategies\EstrategiaInterface;

class BeneficioContext {
    private EstrategiaInterface $strategy;

    public function __construct(EstrategiaInterface $strategy) {
        $this->strategy = $strategy;
    }

    public function aplicarBeneficio(array $data) {
        return $this->strategy->aplicar($data);
    }
}
