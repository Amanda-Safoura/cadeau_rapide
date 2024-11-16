<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShippingRequest extends FormRequest
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
            'zone' => 'required|string|max:255',
            'price' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            // Zone
            'zone.required' => 'La zone est obligatoire.',
            'zone.string' => 'La zone doit être une chaîne de caractères.',
            'zone.max' => 'La zone ne doit pas dépasser 255 caractères.',

            // Prix
            'price.required' => 'Le prix est obligatoire.',
            'price.numeric' => 'Le prix doit être un nombre.',
        ];
    }
}
