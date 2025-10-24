@'
<?php
use Illuminate\Foundation\Testing\RefreshDatabase;


use function Pest\Laravel\{postJson, assertDatabaseHas};

uses(RefreshDatabase::class);


it('cria empreendimento válido e retorna 201', function () {
    $payload = [
        'nome' => 'Residencial Vila Verde',
        'endereco' => 'Rua das Palmeiras, 123 - SP',
        'qtd_unidades' => 80,
        'data_lancamento' => '2025-02-01',
    ];

    postJson('/api/v1/empreendimentos', $payload)
        ->assertCreated()
        ->assertJsonPath('data.nome', 'Residencial Vila Verde');

    assertDatabaseHas('empreendimentos', [
        'nome' => 'Residencial Vila Verde',
        'qtd_unidades' => 80,
    ]);
});

