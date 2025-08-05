<?php
namespace App\Controllers;

use App\Domain\Repositories\BeneficioProductosRepositoryInterface;
use App\DTOs\BeneficiosProductosDTO;
use App\UseCases\CreateBeneficiosProductos;
use App\UseCases\GetAllBeneficiosProductos;
use App\UseCases\GetByIdBeneficiosProductos;
use App\UseCases\UpdateBeneficiosProductos;
use App\UseCases\DeleteBeneficiosProductos;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BeneficioProductosController {
    public function __construct(private BeneficioProductosRepositoryInterface $repo) {}

    public function index(Request $request, Response $response): Response {
        $useCase = new GetAllBeneficiosProductos($this->repo);
        $BeneficiosProductos = $useCase->execute();
        $response->getBody()->write(json_encode($BeneficiosProductos));
        return $response;
    }

    public function show(Request $request, Response $response, array $args): Response {
        $useCase = new GetByIdBeneficiosProductos($this->repo);
        $id = (int) $args['id'];
        $BeneficiosProductos = $useCase->execute($id);
        if (!$BeneficiosProductos) {
            $response->getBody()->write(json_encode(["error" => "Beneficio Productos no registrado en la plataforma"]));
            return $response->withStatus(404);
        }
        $response->getBody()->write(json_encode($BeneficiosProductos));
        return $response;
    }

    public function store(Request $request, Response $response): Response {
        $data = $request->getParsedBody();
        $data = BeneficiosProductosDTO::fromArray($data);
        $useCase = new CreateBeneficiosProductos($this->repo);
        $BeneficiosProductos = $useCase->execute($data);
        $response->getBody()->write(json_encode($BeneficiosProductos));
        return $response->withStatus(201);
    }

    public function update(Request $request, Response $response, array $args): Response {
        $id = $args['id']; // SIN (int)
        $data = $request->getParsedBody();
        $data = BeneficiosProductosDTO::fromArray($data);
        $useCase = new UpdateBeneficiosProductos($this->repo);
        $success = $useCase->execute($id, $data);
        if (!$success) {
            $response->getBody()->write(json_encode(["error" => "Beneficio Productos no registrado en la plataforma"]));
            return $response->withStatus(404);
        }
        $response->getBody()->write(json_encode(['message' => 'Beneficio Productos Actualizada']));
        return $response->withStatus(200);
    }
    public function destroy(Request $request, Response $response, array $args): Response {
        $id = $args['id'];
    
        $useCase = new DeleteBeneficiosProductos($this->repo);
        $success = $useCase->execute($id);
    
        if (!$success) {
            $response->getBody()->write(json_encode([
                "error" => "Beneficio Productos no encontrada o ya fue eliminada"
            ]));
            return $response->withStatus(404);
        }
    
        $response->getBody()->write(json_encode(['message' => 'Beneficio Productos Eliminada']));
        return $response->withStatus(200);
    }
    
}
