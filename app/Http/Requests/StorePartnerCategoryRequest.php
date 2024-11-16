<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePartnerCategoryRequest extends FormRequest
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
            'name' => 'required|string|max:100|unique:partner_categories,name',
            'icon' => 'required|string|max:100',
            'short_description' => 'nullable|string|max:255|unique:partner_categories,short_description',
        ];
    }

    public function messages()
    {
        return [
            // Nom
            'name.required' => 'Le nom est obligatoire.',
            'name.string' => 'Le nom doit être une chaîne de caractères.',
            'name.max' => 'Le nom ne doit pas dépasser 100 caractères.',
            'name.unique' => 'Ce nom est déjà utilisé.',

            // Icône
            'icon.required' => 'L\'icône est obligatoire.',
            'icon.string' => 'L\'icône doit être une chaîne de caractères.',
            'icon.max' => 'L\'icône ne doit pas dépasser 100 caractères.',

            // Description courte
            'short_description.nullable' => 'La description courte est optionnelle.',
            'short_description.string' => 'La description courte doit être une chaîne de caractères.',
            'short_description.max' => 'La description courte ne doit pas dépasser 255 caractères.',
            'short_description.unique' => 'Cette description courte est déjà utilisée.',
        ];
    }
}
