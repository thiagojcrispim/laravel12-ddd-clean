<?php

use Illuminate\Support\Facades\Route;
use App\Drivers\Http\Controllers\EmpreendimentosController;

Route::prefix('v1')->group(function () {
    Route::get('/empreendimentos', [EmpreendimentosController::class, 'index']);
    Route::post('/empreendimentos', [EmpreendimentosController::class, 'store']);
});
