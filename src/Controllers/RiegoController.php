<?php
namespace App\Controllers;

use App\Domain\Repositories\RiegoRepositoryInterface;
use App\UseCases\CreateRiego;
use App\UseCases\GetAllRiego;
use App\UseCases\GetByIdRiego;
use App\UseCases\UpdateRiego;
use App\UseCases\DeleteRiego;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class RiegoController {
    public function __construct(private RiegoRepositoryInterface $repo) {}

    public function index(Request $request, Response $response): Response {
        $useCase = new GetAllRiego($this->repo);
        $riego = $useCase->execute();
        $response->getBody()->write(json_encode($riego));
        return $response;
    }

    public function show(Request $request, Response $response, array $args): Response {
        $useCase = new GetByIdRiego($this->repo);
        $id = $args['id']; 
        $riego = $useCase->execute($id);
        if (!$riego) {
            $response->getBody()->write(json_encode(["error" => "Riego no registrado en la plataforma"]));
            return $response->withStatus(404);
        }
        $response->getBody()->write(json_encode($riego));
        return $response;
    }

    public function store(Request $request, Response $response): Response {
        $data = $request->getParsedBody();
        $useCase = new CreateRiego($this->repo);
        $riego = $useCase->execute($data);
        $response->getBody()->write(json_encode($riego));
        return $response->withStatus(201);
    }

    public function update(Request $request, Response $response, array $args): Response {
        $id = $args['id']; 
        $data = $request->getParsedBody();
        $useCase = new UpdateRiego($this->repo);
        $success = $useCase->execute($id, $data);
        if (!$success) {
            $response->getBody()->write(json_encode(["error" => "Riego no registrado en la plataforma"]));
            return $response->withStatus(404);
        }
        $response->getBody()->write(json_encode(['message' => 'Riego Actualizada']));
        return $response->withStatus(200);
    }

    public function destroy(Request $request, Response $response, array $args): Response {
        $id = $args['id'];
    
        $useCase = new DeleteRiego($this->repo);
        $success = $useCase->execute($id);
    
        if (!$success) {
            $response->getBody()->write(json_encode([
                "error" => "Riego no encontrada o ya fue eliminada"
            ]));
            return $response->withStatus(404);
        }
    
        $response->getBody()->write(json_encode(['message' => 'Riego Eliminado']));
        return $response->withStatus(200);
    }
    
}
