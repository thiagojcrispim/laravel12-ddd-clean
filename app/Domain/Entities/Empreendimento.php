<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empreendimento extends Model
{
    use SoftDeletes;

    protected $table = "empreendimentos";

    protected $fillable = [
        "nome", "endereco", "qtd_unidades", "data_lancamento",
    ];

    protected $casts = [
        "qtd_unidades" => "integer",
        "data_lancamento" => "date",
    ];
}
