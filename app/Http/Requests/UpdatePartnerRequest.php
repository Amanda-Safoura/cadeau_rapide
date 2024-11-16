<?php

namespace App\Http\Requests;

use App\CustomHelpers;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UpdatePartnerRequest extends FormRequest
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
            'min_amount' => 'required|numeric',
            'commission_percent' => 'required|numeric|max:100'
        ];
    }

    public function messages()
    {
        return [
            // Nom
            'name.required' => 'Le nom du partenaire est obligatoire.',
            'name.string' => 'Le nom du partenaire doit être une chaîne de caractères.',
            'name.min' => 'Le nom du partenaire doit comporter au moins 4 caractères.',
            'name.max' => 'Le nom du partenaire ne doit pas dépasser 255 caractères.',
            'name.unique' => 'Ce nom de partenaire est déjà pris.',

            // Catégorie
            'category_id.required' => 'La catégorie du partenaire est obligatoire.',
            'category_id.exists' => 'La catégorie sélectionnée est invalide.',

            // Images
            'picture_1.nullable' => 'La première image est optionnelle.',
            'picture_1.file' => 'Le fichier de la première image doit être valide.',
            'picture_1.image' => 'Le fichier de la première image doit être une image.',

            'picture_2.nullable' => 'La deuxième image est optionnelle.',
            'picture_2.file' => 'Le fichier de la deuxième image doit être valide.',
            'picture_2.image' => 'Le fichier de la deuxième image doit être une image.',

            'picture_3.nullable' => 'La troisième image est optionnelle.',
            'picture_3.file' => 'Le fichier de la troisième image doit être valide.',
            'picture_3.image' => 'Le fichier de la troisième image doit être une image.',

            'picture_4.nullable' => 'La quatrième image est optionnelle.',
            'picture_4.file' => 'Le fichier de la quatrième image doit être valide.',
            'picture_4.image' => 'Le fichier de la quatrième image doit être une image.',

            // Description courte
            'short_description.nullable' => 'La description courte est optionnelle.',
            'short_description.string' => 'La description courte doit être une chaîne de caractères.',
            'short_description.max' => 'La description courte ne doit pas dépasser 200 caractères.',

            // Offres
            'offers.required' => 'Les offres du partenaire sont obligatoires.',
            'offers.string' => 'Les offres doivent être une chaîne de caractères.',

            // Description
            'description.required' => 'La description du partenaire est obligatoire.',
            'description.string' => 'La description doit être une chaîne de caractères.',

            // Numéro de téléphone
            'phone_number.required' => 'Le numéro de téléphone est obligatoire.',
            'phone_number.string' => 'Le numéro de téléphone doit être une chaîne de caractères.',

            // Adresse
            'adress.nullable' => 'L\'adresse est optionnelle.',
            'adress.string' => 'L\'adresse doit être une chaîne de caractères.',

            // Tags
            'tags.nullable' => 'Les tags sont optionnels.',
            'tags.string' => 'Les tags doivent être une chaîne de caractères.',
            'tags.max' => 'Les tags ne doivent pas dépasser 255 caractères.',

            // Montant minimal
            'min_amount.required' => 'Le montant minimum est obligatoire.',
            'min_amount.numeric' => 'Le montant minimum doit être un nombre.',

            // Commission
            'commission_percent.required' => 'Le pourcentage de commission est obligatoire.',
            'commission_percent.numeric' => 'Le pourcentage de commission doit être un nombre.',
            'commission_percent.max' => 'Le pourcentage de commission ne peut pas dépasser 100.',
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
