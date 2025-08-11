<?php

// Contenedor
use DI\Container;

//Factory Interface
use Psr\Http\Message\ResponseFactoryInterface;

// Usuario
use App\Domain\Repositories\UserRepositoryInterface;
use App\Infrastructure\Repositories\EloquentUserRepository;

// Plantas
use App\Domain\Repositories\PlantasRepositoryInterface;
use App\Infrastructure\Repositories\EloquentPlantasRepository;

// Riego
use App\Domain\Repositories\RiegoRepositoryInterface;
use App\Infrastructure\Repositories\EloquentRiegoRepository;

// Manejo de errores
use App\Handler\CustomErrorHandler;
use Slim\Handlers\ErrorHandler;
use Slim\Interfaces\ErrorHandlerInterface;

$container = new Container();

// 1. User
$container->set(UserRepositoryInterface::class,function(){
    return new EloquentUserRepository();
});

// 2. Plantas
$container->set(PlantasRepositoryInterface::class,function(){
    return new EloquentPlantasRepository();
});

// 3. Riego
$container->set(RiegoRepositoryInterface::class,function(){
    return new EloquentRiegoRepository();
});

// Manejo de Errores
$container->set(ErrorHandlerInterface::class, function () use ($container){
    return new CustomErrorHandler(
        $container->get(ResponseFactoryInterface::class)
    );
});

return $container;