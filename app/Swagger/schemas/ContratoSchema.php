<?php

namespace App\Swagger\schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *   schema="Contrato",
 *   required={"id","empreendimento_id","cliente","valor_total"},
 *   @OA\Property(property="id", type="integer", format="int64", example=987),
 *   @OA\Property(property="empreendimento_id", type="integer", example=1),
 *   @OA\Property(property="cliente", type="string", example="Fulano da Silva"),
 *   @OA\Property(property="valor_total", type="number", format="double", example=350000.75),
 *   @OA\Property(property="entrada", type="number", format="double", nullable=true, example=35000),
 *   @OA\Property(property="parcelas", type="integer", example=120),
 *   @OA\Property(property="status", type="string", enum={"aberto","quitado","inadimplente"}, example="aberto"),
 *   @OA\Property(property="assinatura_em", type="string", format="date-time"),
 * )
 */
class ContratoSchema {}
