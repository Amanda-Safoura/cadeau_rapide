<?php

namespace App\Http\Requests;

use App\CustomHelpers;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdatePartnerProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->route()->parameter('partner') == $this->cookie('partner_id'))
            return true;

        return false;
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
                'min:4',
                'max:255',
                Rule::unique('partners', 'name')->ignore($this->route()->parameter('partner'))
            ],
            'category_id' => ['required', 'exists:partner_categories,id'],
            'picture_1' => 'nullable|file|image',
            'picture_2' => 'nullable|file|image',
            'picture_3' => 'nullable|file|image',
            'picture_4' => 'nullable|file|image',
            'short_description' => 'nullable|string|max:200',
            'offers' => 'required|string',
            'description' => 'required|string',
            'phone_number' => 'required|string',
            'adress' => 'nullable|string',
            'tags' => 'nullable|string|max:255',
            'min_amount' => 'required|numeric|min:10000',
            'partner' => 'exists:partners,id'
        ];
    }

    public function messages()
    {
        return [
            // Nom
            'name.required' => 'Le nom est obligatoire.',
            'name.string' => 'Le nom doit être une chaîne de caractères.',
            'name.min' => 'Le nom doit comporter au moins 4 caractères.',
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'name.unique' => 'Ce nom est déjà utilisé.',

            // Catégorie
            'category_id.required' => 'La catégorie est obligatoire.',
            'category_id.exists' => 'La catégorie sélectionnée n\'existe pas.',

            // Images
            'picture_1.file' => 'Le fichier 1 doit être une image valide.',
            'picture_1.image' => 'Le fichier 1 doit être une image.',
            'picture_2.file' => 'Le fichier 2 doit être une image valide.',
            'picture_2.image' => 'Le fichier 2 doit être une image.',
            'picture_3.file' => 'Le fichier 3 doit être une image valide.',
            'picture_3.image' => 'Le fichier 3 doit être une image.',
            'picture_4.file' => 'Le fichier 4 doit être une image valide.',
            'picture_4.image' => 'Le fichier 4 doit être une image.',

            // Description courte
            'short_description.string' => 'La description courte doit être une chaîne de caractères.',
            'short_description.max' => 'La description courte ne doit pas dépasser 200 caractères.',

            // Offres
            'offers.required' => 'Les offres sont obligatoires.',
            'offers.string' => 'Les offres doivent être une chaîne de caractères.',

            // Description
            'description.required' => 'La description est obligatoire.',
            'description.string' => 'La description doit être une chaîne de caractères.',

            // Numéro de téléphone
            'phone_number.required' => 'Le numéro de téléphone est obligatoire.',
            'phone_number.string' => 'Le numéro de téléphone doit être une chaîne de caractères.',

            // Adresse
            'adress.string' => 'L\'adresse doit être une chaîne de caractères.',

            // Tags
            'tags.string' => 'Les tags doivent être une chaîne de caractères.',
            'tags.max' => 'Les tags ne doivent pas dépasser 255 caractères.',

            // Montant minimal
            'min_amount.required' => 'Le montant minimum est obligatoire.',
            'min_amount.numeric' => 'Le montant minimum doit être un nombre.',
            'min_amount.min' => 'Le montant minimum doit être d\'au moins 10 000.',

            // Partenaire
            'partner.exists' => 'Le partenaire sélectionné n\'existe pas.',
        ];
    }



    protected function passedValidation()
    {
        $offers = '';
        $lines = CustomHelpers::extractLines($this->input('offers'));

        foreach ($lines as $line) {
            $offers .= $line . '--separator--';
        }

        return $this->merge([
            'slug' => Str::slug($this->input('name')),
            'offers' => $offers,
        ]);
    }
}
