<?php

use App\Controllers\BeneficioProductosController;
use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;
use Slim\App;

return function (App $app) {
    $app->group('/beneficio_productos', function ($group) {
        $group->get('', [BeneficioProductosController::class, 'index']);
        $group->get('/{id}', [BeneficioProductosController::class, 'show']);
        $group->post('', [BeneficioProductosController::class, 'store']);
        $group->put('/{id}', [BeneficioProductosController::class, 'update']);
        $group->delete('/{id}', [BeneficioProductosController::class, 'destroy']);
    });
};
