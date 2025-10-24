<?php
namespace App\Drivers\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmpreendimentoResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'             => $this->id,
            'nome'           => $this->nome,
            'endereco'       => $this->endereco,
            'qtd_unidades'   => (int) $this->qtd_unidades,
            'data_lancamento'=> $this->data_lancamento?->format('Y-m-d'),
            'created_at'     => $this->created_at?->toIso8601String(),
        ];
    }
}
