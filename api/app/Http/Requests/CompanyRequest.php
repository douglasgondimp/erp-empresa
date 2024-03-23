<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'codigo'       => 'required|decimal:4,0|unique:App\Models\Company,codigo',
            'empresa'      => 'required|decimal:4,0',
            'sigla'        => 'required|string|max:40',
            'razao_social' => 'required|string|max:255', 
        ];
    }

    public function messages(): array
    {
        return [
            'codigo.required'       => 'O campo Código é obrigatório.',
            'codigo.unique'         => 'O campo Código já existe.',
            'codigo.decimal'        => 'O campo Código deve ser um número.',
            'empresa.decimal'       => 'O campo Empresa deve ser um número.',
            'empresa.required'      => 'O campo Empresa é obrigatório.',
            'sigla.required'        => 'O campo Sigla é obrigatório.',
            'razao_social.required' => 'O campo Razão Social é obrigatório.',
        ];
    }
}
