<?php

use App\Controllers\PlantasController;
use App\Middleware\AuthMiddleware;
use App\Middleware\RoleMiddleware;
use Slim\App;

return function (App $app) {
    $app->group('/plantas', function ($group) {
        $group->get('', [PlantasController::class, 'index']); // index por la funcion creada dentro de campercontoller
        $group->get('/tipo', [PlantasController::class, 'buscarTipo']); // QueryParams
        $group->get('/{id}', [PlantasController::class, 'show']);
        $group->post('', [PlantasController::class, 'store']);
        $group->put('/{id}', [PlantasController::class, 'update']);
        $group->delete('/{id}', [PlantasController::class, 'destroy']);
    })->add(new RoleMiddleware('admin'))->add(new AuthMiddleware());
};
