<?php

// Contenedor
use DI\Container;

//Factory Interface
use Psr\Http\Message\ResponseFactoryInterface;

// Usuario
use App\Domain\Repositories\UserRepositoryInterface;
use App\Infrastructure\Repositories\EloquentUserRepository;

use App\Domain\Repositories\BeneficiosEstrategiasRepositoryInterface;
use App\Infrastructure\Repositories\EloquentBeneficiosEstrategiasRepository;

// Manejo de errores
use App\Handler\CustomErrorHandler;
use Slim\Handlers\ErrorHandler;
use Slim\Interfaces\ErrorHandlerInterface;

$container = new Container();

// 1. User
$container->set(UserRepositoryInterface::class,function(){
    return new EloquentUserRepository();
});

// 1. Beneficios Estrategias
$container->set(BeneficiosEstrategiasRepositoryInterface::class,function(){
    return new EloquentBeneficiosEstrategiasRepository();
});

// Manejo de Errores
$container->set(ErrorHandlerInterface::class, function () use ($container){
    return new CustomErrorHandler(
        $container->get(ResponseFactoryInterface::class)
    );
});

return $container;