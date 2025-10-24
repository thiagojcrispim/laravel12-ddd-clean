<?php

namespace App\Drivers\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListEmpreendimentosRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'page'      => ['sometimes','integer','min:1'],
            'per_page'  => ['sometimes','integer','min:1','max:100'],
            'search'    => ['sometimes','string','max:100'],
            'sort'      => ['sometimes','string'],
        ];
    }
}
