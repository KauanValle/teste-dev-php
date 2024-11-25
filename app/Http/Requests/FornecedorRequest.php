<?php

namespace App\Http\Requests;

use App\Helpers\Formatter;
use Illuminate\Foundation\Http\FormRequest;

class FornecedorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
        if (isset($this->documento)) {
            $this->merge([
                'documento' => Formatter::formatCnpj($this->documento),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return $this->getRulesWithMethod();
    }

    private function getRulesWithMethod()
    {
        $method = $this->getMethod();
        if($method === 'PUT' || $method === 'GET') {
            return [
                'documento' => 'string|max:18|min:14',
                'razao_social' => 'string|max:255',
                'telefone' => 'string|max:11',
                'cep' => 'string|max:8',
                'natureza_juridica' => 'string|max:255',
                'situacao_cadastral' => 'string|max:255'
            ];
        }

        if($method === 'POST' || $method === 'DELETE'){
            return [
                'documento' => 'required|string|max:18|min:14'
            ];
        }
    }

    public function messages(): array
    {
        return [
            'documento.required' => 'É necessário que o campo "documento" seja informado.',
            'documento.min' => 'O campo "documento" precisa ter pelomenos 14 caracteres.',
            'documento.max' => 'O campo "documento" precisa ter no máximo 18 caracteres.',
            'razao_social.string' => 'O campo "razão social" deve ser um texto válido.',
            'razao_social.max' => 'O campo "razão social" pode ter no máximo 255 caracteres.',
            'telefone.string' => 'O campo "telefone" deve ser um texto válido.',
            'telefone.max' => 'O campo "telefone" pode ter no máximo 11 caracteres.',
            'cep.string' => 'O campo "CEP" deve ser um texto válido.',
            'cep.max' => 'O campo "CEP" pode ter no máximo 8 caracteres.',
            'natureza_juridica.string' => 'O campo "natureza jurídica" deve ser um texto válido.',
            'natureza_juridica.max' => 'O campo "natureza jurídica" pode ter no máximo 255 caracteres.',
            'situacao_cadastral.string' => 'O campo "situação cadastral" deve ser um texto válido.',
            'situacao_cadastral.max' => 'O campo "situação cadastral" pode ter no máximo 255 caracteres.',
        ];
    }
}
