<?php

namespace App\Http\Requests;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'documento' => 'required|string|max:18|min:14'
        ];
    }

    public function messages(): array
    {
        return [
            'documento.required' => 'É necessário que o campo "documento" seja informado.',
            'documento.min' => 'O campo "documento" precisa ter pelomenos 14 caracteres.',
            'documento.max' => 'O campo "documento" precisa ter no máximo 18 caracteres.'
        ];
    }
}
