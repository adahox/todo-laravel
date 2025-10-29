<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTodoRequest extends FormRequest
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
            'item' => 'required|max:50'
        ];
    }

    public function messages(): array
    {
        return [
            'item.required' => 'O item do seu todo não pode ser vazio.',
            'item.max' => 'O item do seu todo deve conter no máximo 50 caracteres.',
        ];
    }
}
