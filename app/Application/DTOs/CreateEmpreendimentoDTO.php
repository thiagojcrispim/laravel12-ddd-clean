<?php

namespace App\Application\DTOs;

class CreateEmpreendimentoDTO
{
    public function __construct(
        public string $nome,
        public string $endereco,
        public int $qtd_unidades,
        public string $data_lancamento,
    ) {}

    public function toArray(): array
    {
        return [
            "nome" => $this->nome,
            "endereco" => $this->endereco,
            "qtd_unidades" => $this->qtd_unidades,
            "data_lancamento" => $this->data_lancamento,
        ];
    }
}
