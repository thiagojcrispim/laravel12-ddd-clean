<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entities\Empreendimento;
use App\Domain\Repositories\EmpreendimentoRepository;

class EloquentEmpreendimentoRepository implements EmpreendimentoRepository
{
    public function create(array $attrs): array
    {
        return Empreendimento::create($attrs)->toArray();
    }

    public function find(int $id): ?array
    {
        $m = Empreendimento::find($id);
        return $m?->toArray();
    }

    public function update(int $id, array $attrs): array
    {
        $m = Empreendimento::findOrFail($id);
        $m->update($attrs);
        return $m->toArray();
    }

    public function delete(int $id): void
    {
        Empreendimento::findOrFail($id)->delete();
    }


}
