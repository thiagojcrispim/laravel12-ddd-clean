<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Repositories\EmpreendimentoRepository;
use App\Infrastructure\Persistence\EloquentEmpreendimentoRepository;

class DomainServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(EmpreendimentoRepository::class, EloquentEmpreendimentoRepository::class);
    }

    public function boot(): void {}
}
