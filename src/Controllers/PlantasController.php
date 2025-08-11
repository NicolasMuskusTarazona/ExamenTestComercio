<?php
namespace App\Controllers;

use App\Domain\Repositories\PlantasRepositoryInterface;
use App\DTOs\PlantasDTO;
use App\UseCases\CreatePlantas;
use App\UseCases\GetAllPlantas;
use App\UseCases\GetByIdPlantas;
use App\UseCases\UpdatePlantas;
use App\UseCases\DeletePlantas;
use App\UseCases\GetByCategoriaPlantas;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PlantasController {
    public function __construct(private PlantasRepositoryInterface $repo) {}

    public function index(Request $request, Response $response): Response {
        $useCase = new GetAllPlantas($this->repo);
        $planta = $useCase->execute();
        $response->getBody()->write(json_encode($planta));
        return $response;
    }

    public function show(Request $request, Response $response, array $args): Response {
        $useCase = new GetByIdPlantas($this->repo);
        $id = $args['id']; 
        $planta = $useCase->execute($id);
        if (!$planta) {
            $response->getBody()->write(json_encode(["error" => "Planta no registrado en la plataforma"]));
            return $response->withStatus(404);
        }
        $response->getBody()->write(json_encode($planta));
        return $response;
    }
    public function buscarTipo(Request $request, Response $response): Response {
        $categoria = $request->getQueryParams()['categoria'] ?? null;
    
        $validos = ['cactus', 'ornamental', 'frutal','Sin familia'];
    
        if (!in_array($categoria, $validos)) {
            $response->getBody()->write(json_encode([
                'error' => 'Valor de categoria no valido. Usa: cactus, ornamental,frutal o Sin familia'
            ]));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }
    
        $resultados = $this->repo->findByCategoria($categoria);
    
        $response->getBody()->write(json_encode($resultados));
        return $response->withHeader('Content-Type', 'application/json');
    }
    public function store(Request $request, Response $response): Response {
        $data = $request->getParsedBody();
        $data = PlantasDTO::fromArray($data);
        $useCase = new CreatePlantas($this->repo);
        $planta = $useCase->execute($data);
        $response->getBody()->write(json_encode($planta));
        return $response->withStatus(201);
    }

    public function update(Request $request, Response $response, array $args): Response {
        $id = $args['id']; 
        $data = $request->getParsedBody();
        $data = PlantasDTO::fromArray($data);
        $useCase = new UpdatePlantas($this->repo);
        $success = $useCase->execute($id, $data);
        if (!$success) {
            $response->getBody()->write(json_encode(["error" => "Planta no registrado en la plataforma"]));
            return $response->withStatus(404);
        }
        $response->getBody()->write(json_encode(['message' => 'Planta Actualizada']));
        return $response->withStatus(200);
    }

    public function destroy(Request $request, Response $response, array $args): Response {
        $id = $args['id'];
    
        $useCase = new DeletePlantas($this->repo);
        $success = $useCase->execute($id);
    
        if (!$success) {
            $response->getBody()->write(json_encode([
                "error" => "Planta no encontrada o ya fue eliminada"
            ]));
            return $response->withStatus(404);
        }
    
        $response->getBody()->write(json_encode(['message' => 'Planta Eliminado']));
        return $response->withStatus(200);
    }
    
}
