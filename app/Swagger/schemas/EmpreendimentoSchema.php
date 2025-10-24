<?php

namespace App\Swagger\schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *   schema="Empreendimento",
 *   required={"id","nome"},
 *   description="Empreendimento (domínio)",
 *   @OA\Property(property="id", type="integer", format="int64", example=1),
 *   @OA\Property(property="nome", type="string", maxLength=255, example="Residencial Alfa"),
 *   @OA\Property(property="status", type="string", enum={"ativo","inativo"}, example="ativo"),
 *   @OA\Property(property="created_at", type="string", format="date-time"),
 *   @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class EmpreendimentoSchema {}
