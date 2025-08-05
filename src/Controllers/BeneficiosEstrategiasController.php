<?php
namespace App\Controllers;

use App\Domain\Repositories\BeneficiosEstrategiasRepositoryInterface;
use App\DTOs\BeneficiosEstrategiasDTO;
use App\UseCases\CreateBeneficiosEstrategias;
use App\UseCases\GetAllBeneficiosEstrategias;
use App\UseCases\GetByIdBeneficiosEstrategias;
use App\UseCases\UpdateBeneficiosEstrategias;
use App\UseCases\DeleteBeneficiosEstrategias;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BeneficiosEstrategiasController {
    public function __construct(private BeneficiosEstrategiasRepositoryInterface $repo) {}

    public function index(Request $request, Response $response): Response {
        $useCase = new GetAllBeneficiosEstrategias($this->repo);
        $BeneficiosEstrategia = $useCase->execute();
        $response->getBody()->write(json_encode($BeneficiosEstrategia));
        return $response;
    }

    public function show(Request $request, Response $response, array $args): Response {
        $useCase = new GetByIdBeneficiosEstrategias($this->repo);
        $id = (int) $args['id'];
        $BeneficiosEstrategia = $useCase->execute($id);
        if (!$BeneficiosEstrategia) {
            $response->getBody()->write(json_encode(["error" => "Beneficio Estrategia no registrado en la plataforma"]));
            return $response->withStatus(404);
        }
        $response->getBody()->write(json_encode($BeneficiosEstrategia));
        return $response;
    }

    public function store(Request $request, Response $response): Response {
        $data = $request->getParsedBody();
        $data = BeneficiosEstrategiasDTO::fromArray($data);
        $useCase = new CreateBeneficiosEstrategias($this->repo);
        $BeneficiosEstrategia = $useCase->execute($data);
        $response->getBody()->write(json_encode($BeneficiosEstrategia));
        return $response->withStatus(201);
    }
    public function buscarPorTipo(Request $request, Response $response): Response {
        $tipo = $request->getQueryParams()['tipo'] ?? null;
    
        $validos = ['descuento_fijo', 'combo', 'bonificacion', '2x1', 'regalo', 'normal'];
    
        if (!in_array($tipo, $validos)) {
            $response->getBody()->write(json_encode([
                'error' => 'Valor de tipo no valido. Usa: descuento_fijo, combo, bonificacion, 2x1, regalo o normal'
            ]));
            return $response->withStatus(400)->withHeader('Content-Type', 'application/json');
        }
    
        $resultados = $this->repo->findByTipo($tipo);
    
        $response->getBody()->write(json_encode($resultados));
        return $response->withHeader('Content-Type', 'application/json');
    }
    public function update(Request $request, Response $response, array $args): Response {
        $id = $args['id']; // SIN (int)
        $data = $request->getParsedBody();
        $data = BeneficiosEstrategiasDTO::fromArray($data);
        $useCase = new UpdateBeneficiosEstrategias($this->repo);
        $success = $useCase->execute($id, $data);
        if (!$success) {
            $response->getBody()->write(json_encode(["error" => "Beneficio Estrategia no registrado en la plataforma"]));
            return $response->withStatus(404);
        }
        $response->getBody()->write(json_encode(['message' => 'Beneficio Estrategia Actualizada']));
        return $response->withStatus(200);
    }
    public function destroy(Request $request, Response $response, array $args): Response {
        $id = $args['id'];
    
        $useCase = new DeleteBeneficiosEstrategias($this->repo);
        $success = $useCase->execute($id);
    
        if (!$success) {
            $response->getBody()->write(json_encode([
                "error" => "Beneficio Estrategia no encontrada o ya fue eliminada"
            ]));
            return $response->withStatus(404);
        }
    
        $response->getBody()->write(json_encode(['message' => 'Beneficio Estrategia Eliminada']));
        return $response->withStatus(200);
    }
    
}
