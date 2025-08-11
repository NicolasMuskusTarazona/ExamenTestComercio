<?php

use App\Controllers\RiegoController;
use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;
use Slim\App;

return function (App $app) {
    $app->group('/riego', function ($group) {
        $group->get('', [RiegoController::class, 'index']); // index por la funcion creada dentro de campercontoller
        $group->get('/{id}', [RiegoController::class, 'show']);
        $group->post('', [RiegoController::class, 'store']);
        $group->put('/{id}', [RiegoController::class, 'update']);
        $group->delete('/{id}', [RiegoController::class, 'destroy']);
    })->add(new RoleMiddleware('admin'))->add(new AuthMiddleware());
};
