<?php

namespace App\Application\DTOs;

class UpdateEmpreendimentoDTO
{
    public function __construct(
        public ?string $nome = null,
        public ?string $endereco = null,
        public ?int $qtd_unidades = null,
        public ?string $data_lancamento = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            "nome" => $this->nome,
            "endereco" => $this->endereco,
            "qtd_unidades" => $this->qtd_unidades,
            "data_lancamento" => $this->data_lancamento,
        ], fn ($v) => !is_null($v));
    }
}
