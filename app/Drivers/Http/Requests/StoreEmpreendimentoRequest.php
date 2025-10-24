<?php

namespace App\Drivers\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmpreendimentoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "nome"              => ["required","string","max:200"],
            "endereco"          => ["required","string","max:255"],
            "qtd_unidades"      => ["required","integer","min:1"],
            "data_lancamento"   => ["required","date"],
        ];
    }
}
