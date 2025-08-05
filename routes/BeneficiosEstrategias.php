<?php

use App\Controllers\BeneficiosEstrategiasController;
use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;
use Slim\App;

return function (App $app) {
    $app->group('/beneficios_estrategias', function ($group) {
        $group->get('', [BeneficiosEstrategiasController::class, 'index']);
        $group->get('/tipo', [BeneficiosEstrategiasController::class, 'buscarPorTipo']); // QueryParams
        $group->get('/{id}', [BeneficiosEstrategiasController::class, 'show']);
    });

    $app->group('/beneficios_estrategiasAdmin', function ($group) {
        $group->post('', [BeneficiosEstrategiasController::class, 'store']);
        $group->put('/{id}', [BeneficiosEstrategiasController::class, 'update']);
        $group->delete('/{id}', [BeneficiosEstrategiasController::class, 'destroy']);
    })->add(new RoleMiddleware('admin'))->add(new AuthMiddleware());
};
