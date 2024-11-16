<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePartnerCategoryRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('partner_categories', 'name')->ignore($this->route()->parameter('partner_category'))
            ],
            'short_description' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('partner_categories', 'short_description')->ignore($this->route()->parameter('partner_category'))
            ],
            'icon' => 'required|string|max:100',
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Le nom est requis.',
            'name.string' => 'Le nom doit être une chaîne de caractères.',
            'name.max' => 'Le nom ne peut pas dépasser 100 caractères.',
            'name.unique' => 'Le nom doit être unique.',

            'short_description.nullable' => 'La description courte est facultative.',
            'short_description.string' => 'La description courte doit être une chaîne de caractères.',
            'short_description.max' => 'La description courte ne peut pas dépasser 255 caractères.',
            'short_description.unique' => 'La description courte doit être unique.',

            'icon.required' => 'L\'icône est requise.',
            'icon.string' => 'L\'icône doit être une chaîne de caractères.',
            'icon.max' => 'L\'icône ne peut pas dépasser 100 caractères.',
        ];
    }
}
