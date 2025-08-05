<?php

use App\Controllers\UsuariosBeneficiosController;
use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;
use Slim\App;

return function (App $app) {
    $app->group('/usuario_beneficios', function ($group) {
        $group->get('', [UsuariosBeneficiosController::class, 'index']);
        $group->get('/{id}', [UsuariosBeneficiosController::class, 'show']);
    });

    $app->group('/usuario_beneficiosAdmin', function ($group) {
        $group->post('', [UsuariosBeneficiosController::class, 'store']);
        $group->put('/{id}', [UsuariosBeneficiosController::class, 'update']);
        $group->delete('/{id}', [UsuariosBeneficiosController::class, 'destroy']);
    })->add(new RoleMiddleware('admin'))->add(new AuthMiddleware());
};
