<?php

namespace App\Http\Requests;

use App\Enum\PersonStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends FormRequest
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
            'empresa'      => 'required|numeric|max:9999',
            'codigo'       => 'required|numeric|max:9999|unique:App\Models\Client,codigo,'.$this->client->codigo,
            'razao_social' => 'required|string|max:255',
            'tipo'         => ['required', Rule::enum(PersonStatus::class)],
            'cpf_cnpj'     => 'required|cpf_cnpj'
        ];
    }

    public function messages(): array
    {
        return [
            'empresa.required'      => 'O campo Empresa é obrigatório',
            'empresa.numeric'       => 'O campo Empresa deve ser um número decimal',
            'codigo.required'       => 'O campo Código é obrigatório',
            'codigo.numeric'        => 'O campo Código deve ser um número decimal',
            'codigo.unique'         => 'O código informado já existe',
            'razao_social.required' => 'O campo Razão Social é obrigatório',
            'tipo.required'         => 'O campo Tipo é obrigatório',
            'cpf_cnpj.required'     => 'O campo CPF/CNPJ é obrigatório',
            'cpf_cnpj.cpf_cnpj'     => 'O campo CPF/CNPJ é inválido',
        ];        
    }
}
