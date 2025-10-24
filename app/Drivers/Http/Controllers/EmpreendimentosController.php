<?php

namespace App\Drivers\Http\Controllers;

use App\Drivers\Http\Requests\StoreEmpreendimentoRequest;
use App\Application\DTOs\CreateEmpreendimentoDTO;
use App\Application\UseCases\CreateEmpreendimento;
use App\Application\UseCases\ListEmpreendimentos;
use Illuminate\Support\Facades\Response;
use App\Drivers\Http\Resources\EmpreendimentoResource;
use OpenApi\Annotations as OA;

/**
 * @OA\OpenApi(
 *   @OA\Info(
 *     title="Finance API",
 *     version="1.0.0"
 *   ),
 *   @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="Local"
 *   )
 * )
 */

class EmpreendimentosController extends Controller
{
    /**
     * @OA\Get(
     *   path="/api/v1/empreendimentos",
     *   summary="Lista simples de empreendimentos",
     *   tags={"Empreendimentos"},
     *   @OA\Response(response=200, description="OK")
     * )
     */
    public function index(ListEmpreendimentos $useCase)
    {
        $rows = $useCase()->get();

        return Response::success(
        EmpreendimentoResource::collection($rows)
        );
    }

    /**
     * @OA\Post(
     *   path="/api/v1/empreendimentos",
     *   summary="Cria empreendimento",
     *   tags={"Empreendimentos"},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       required={"nome","endereco","qtd_unidades","data_lancamento"},
     *       @OA\Property(property="nome", type="string", example="Residencial Vila Verde"),
     *       @OA\Property(property="endereco", type="string", example="Rua das Palmeiras, 123 - SP"),
     *       @OA\Property(property="qtd_unidades", type="integer", example=80),
     *       @OA\Property(property="data_lancamento", type="string", format="date", example="2025-02-01")
     *     )
     *   ),
     *   @OA\Response(response=201, description="Created")
     * )
     */
    public function store(StoreEmpreendimentoRequest $req, CreateEmpreendimento $useCase)
    {
        $dto = new CreateEmpreendimentoDTO(
            nome: (string) $req->string('nome'),
            endereco: (string) $req->string('endereco'),
            qtd_unidades: (int) $req->integer('qtd_unidades'),
            data_lancamento: $req->date('data_lancamento')->toDateString(),
        );

        $created = $useCase($dto);

        return Response::success($created, 201);
    }


}
