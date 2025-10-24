<?php

namespace App\Application\UseCases;

use App\Domain\Entities\Empreendimento;
use Illuminate\Database\Eloquent\Builder;
class ListEmpreendimentos
{
    public function __invoke(): Builder
    {
        return Empreendimento::query()
            ->select(['id', 'nome', 'endereco', 'qtd_unidades', 'data_lancamento', 'created_at']);
    }

}
