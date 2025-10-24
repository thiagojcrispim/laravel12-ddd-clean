<?php

namespace App\Domain\Repositories;

interface EmpreendimentoRepository
{
    public function create(array $attrs): array;
    public function find(int $id): ?array;
    public function update(int $id, array $attrs): array;
    public function delete(int $id): void;

}
