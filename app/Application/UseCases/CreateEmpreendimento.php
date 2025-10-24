<?php

namespace App\Application\UseCases;

use App\Application\DTOs\CreateEmpreendimentoDTO;
use App\Domain\Repositories\EmpreendimentoRepository;

class CreateEmpreendimento
{
    public function __construct(private EmpreendimentoRepository $repo) {}

    public function __invoke(CreateEmpreendimentoDTO $dto): array
    {
        return $this->repo->create($dto->toArray());
    }
}
