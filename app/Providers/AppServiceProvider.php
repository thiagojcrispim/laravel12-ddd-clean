<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Domain\Repositories\EmpreendimentoRepository::class,
            \App\Infrastructure\Persistence\EloquentEmpreendimentoRepository::class
        );
    }

    public function boot(): void
    {
        Response::macro('success', function ($data = null, int $status = 200, array $meta = []) {
            return response()->json([
                'success' => true,
                'data'    => $data,
                'meta'    => $meta,
            ], $status);
        });

        Response::macro('fail', function (string $message, int $status = 400, array $errors = []) {
            return response()->json([
                'success' => false,
                'message' => $message,
                'errors'  => $errors,
            ], $status);
        });

        Response::macro('paginated', function (Paginator $paginator) {
            return Response::success($paginator->items(), 200, [
                'current_page' => $paginator->currentPage(),
                'per_page'     => $paginator->perPage(),
                'total'        => $paginator->total(),
                'last_page'    => method_exists($paginator, 'lastPage') ? $paginator->lastPage() : null,
            ]);
        });
    }
}
