<?php
namespace App\Controllers;

use App\Domain\Repositories\UsuariosBeneficiosRepositoryInterface;
use App\DTOs\UsuariosBeneficiosDTO;
use App\UseCases\CreateUsuariosBeneficios;
use App\UseCases\GetAllUsuariosBeneficios;
use App\UseCases\GetByIdUsuariosBeneficios;
use App\UseCases\UpdateUsuariosBeneficios;
use App\UseCases\DeleteUsuariosBeneficios;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UsuariosBeneficiosController {
    public function __construct(private UsuariosBeneficiosRepositoryInterface $repo) {}

    public function index(Request $request, Response $response): Response {
        $useCase = new GetAllUsuariosBeneficios($this->repo);
        $usuarioBeneficio = $useCase->execute();
        $response->getBody()->write(json_encode($usuarioBeneficio));
        return $response;
    }

    public function show(Request $request, Response $response, array $args): Response {
        $useCase = new GetByIdUsuariosBeneficios($this->repo);
        $id = (int) $args['id'];
        $usuarioBeneficio = $useCase->execute($id);
        if (!$usuarioBeneficio) {
            $response->getBody()->write(json_encode(["error" => "Usuarios Beneficio no registrado en la plataforma"]));
            return $response->withStatus(404);
        }
        $response->getBody()->write(json_encode($usuarioBeneficio));
        return $response;
    }

    public function store(Request $request, Response $response): Response {
        $data = $request->getParsedBody();
        $data = UsuariosBeneficiosDTO::fromArray($data);
        $useCase = new CreateUsuariosBeneficios($this->repo);
        $usuarioBeneficio = $useCase->execute($data);
        $response->getBody()->write(json_encode($usuarioBeneficio));
        return $response->withStatus(201);
    }

    public function update(Request $request, Response $response, array $args): Response {
        $id = $args['id']; 
        $data = $request->getParsedBody();
        $data = UsuariosBeneficiosDTO::fromArray($data);
        $useCase = new UpdateUsuariosBeneficios($this->repo);
        $success = $useCase->execute($id, $data);
        if (!$success) {
            $response->getBody()->write(json_encode(["error" => "Usuarios Beneficio no registrado en la plataforma"]));
            return $response->withStatus(404);
        }
        $response->getBody()->write(json_encode(['message' => 'Usuarios Beneficio Actualizada']));
        return $response->withStatus(200);
    }

    public function destroy(Request $request, Response $response, array $args): Response {
        $id = $args['id'];
    
        $useCase = new DeleteUsuariosBeneficios($this->repo);
        $success = $useCase->execute($id);
    
        if (!$success) {
            $response->getBody()->write(json_encode([
                "error" => "Usuarios Beneficio no encontrada o ya fue eliminada"
            ]));
            return $response->withStatus(404);
        }
    
        $response->getBody()->write(json_encode(['message' => 'Usuarios Beneficio Eliminado']));
        return $response->withStatus(200);
    }
    
}
