<?php

namespace App\Http\Requests;

use App\Models\Shipping;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    private $networksByCountry = [
        '229' => ['MTN', 'MOOV'],
        '221' => ['ORANGE SN', 'FREE SN'],
        '225' => ['ORANGE CI', 'MOOV CI'],
        '228' => ['TOGOCOM TG', 'MOOV TG'],
    ];

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
     */ public function rules(): array
    {
        return [
            'user_id' => ['required', 'numeric', 'exists:users,id'],
            'amount' => ['required', 'numeric', 'min:10000'],
            'personal_message' => ['nullable', 'string', 'max:500'],
            'client_name' => ['required', 'string', 'max:255'],
            'client_email' => ['required', 'email', 'max:255'],
            'client_phone' => ['required', 'numeric', 'min_digits:8', 'max_digits:15'],

            'is_client_beneficiary' => ['required', 'numeric', 'in:0,1'],

            // Validate beneficiary details only if `is_client_beneficiary` is false
            'beneficiary_name' => ['required_if:is_client_beneficiary,false', 'nullable', 'string', 'max:255'],
            'beneficiary_email' => ['nullable', 'email', 'max:255'],
            'beneficiary_phone' => ['required_if:is_client_beneficiary,false', 'nullable', 'numeric', 'min_digits:8', 'max_digits:15'],

            'is_customized' => ['required', 'numeric', 'in:0,1'],
            'customization_fee' => ['required_if:is_customized,true', 'nullable', 'numeric'],

            'requires_delivery' => ['required', 'numeric', 'in:0,1'],

            // Delivery details validation only if delivery is required
            'delivery_address' => ['required_if:requires_delivery,true', 'nullable', 'string', 'max:500'],
            'delivery_date' => ['required_if:requires_delivery,true', 'nullable', 'date', 'after:today'],
            'shipping_id' => ['required', 'numeric', 'exists:shippings,id'],

            'partner_id' => ['required', 'numeric', 'exists:partners,id'],

            'payment_method' => ['required', 'string', 'in:mobile,card'],

            // Règles pour le paiement
            'total_amount' => ['required', 'numeric', 'min:10000'],
            'payment_phone' => ['required_if:payment_method,mobile', 'nullable', 'numeric', 'min_digits:8', 'max_digits:15'],
            'payment_network' => ['required_if:payment_method,mobile', 'nullable', 'string', 'in:MTN,MOOV,MOOV TG,TOGOCOM TG,ORANGE SN,MTN CI,FREE SN,ORANGE CI,MOOV CI,WAVE CI,MOOV BF,ORANGE BF'],
            'payment_otp' => ['nullable', 'string'], // Only required for ORANGE SN

            // Règles pour le paiement par carte
            'cardType' => ['required_if:payment_method,card', 'nullable', 'in:VISA,MASTERCARD'],
            'firstNameCard' => ['required_if:payment_method,card', 'nullable', 'string', 'max:255'],
            'lastNameCard' => ['required_if:payment_method,card', 'nullable', 'string', 'max:255'],
            'emailCard' => ['required_if:payment_method,card', 'nullable', 'email', 'max:255'],
            'countryCard' => ['required_if:payment_method,card', 'nullable', 'string', 'max:100'],
            'addressCard' => ['required_if:payment_method,card', 'nullable', 'string', 'max:500'],
            'districtCard' => ['required_if:payment_method,card', 'nullable', 'string', 'max:100'],
            'currency' => ['required_if:payment_method,card', 'nullable', 'in:XOF,USD,EUR']
        ];
    }

    protected function prepareForValidation()
    {
        $shipping = Shipping::findOrFail($this->input('shipping_id'));

        $total_amount = 0 + $shipping->price;
        if ($this->input('is_customized') == '1') $total_amount += env('CUSTOMIZATION_FEE');
        if ($this->input('amount')) $total_amount += (int)($this->input('amount'));


        $dial_code = '229';
        foreach ($this->networksByCountry as $code => $networks) {
            foreach ($networks as $network) {
                if ($this->input('payment_network') == $network) {
                    $dial_code = $code;
                }
            }
        }

        return $this->merge(
            [
                'total_amount' => $total_amount,
                'customization_fee' => env('CUSTOMIZATION_FEE'),
                'payment_phone' => $dial_code . $this->input('payment_phone'),
                'user_id' => auth()->user()->id
            ]
        );
    }


    public function messages()
    {
        return [
            'amount.required' => 'Le montant du chèque cadeau est obligatoire.',
            'amount.numeric' => 'Le montant doit être un nombre.',
            'amount.min' => 'Le montant doit être supérieur à zéro.',

            'client_name.required' => 'Le nom du client est obligatoire.',
            'client_email.required' => 'L\'adresse email du client est obligatoire.',
            'client_email.email' => 'Veuillez entrer une adresse email valide.',
            'client_phone.required' => 'Le numéro de téléphone du client est obligatoire.',
            'client_phone.min_digits' => 'Le numéro de téléphone doit contenir au moins 8 chiffres.',

            'beneficiary_name.required_if' => 'Le nom du bénéficiaire est requis si vous n\'êtes pas le bénéficiaire.',
            'beneficiary_email.email' => 'Veuillez entrer une adresse email valide pour le bénéficiaire.',
            'beneficiary_phone.required_if' => 'Le numéro de téléphone du bénéficiaire est requis si vous n\'êtes pas le bénéficiaire.',

            'delivery_address.required_if' => 'L\'adresse de livraison est obligatoire si la livraison est requise.',
            'delivery_date.required_if' => 'La date de livraison est obligatoire si la livraison est requise.',
            'delivery_date.after' => 'La date de livraison doit être postérieure à aujourd\'hui.',

            'partner_id.required' => 'L\'ID du partenaire est obligatoire.',
            'partner_id.exists' => 'Le partenaire sélectionné est invalide.',

            // Messages pour le paiement
            'payment_phone.required_if' => 'Le numéro de téléphone pour le paiement est obligatoire.',
            'payment_phone.min_digits' => 'Le numéro de téléphone doit contenir au moins 8 chiffres.',

            'payment_network.required_if' => 'Veuillez sélectionner un réseau de paiement valide.',
            'payment_network.in' => 'Le réseau de paiement sélectionné n\'est pas valide.',

            'payment_otp.string' => 'Veuillez entrer un code OTP valide.',

            // Messages pour le paiement par carte
            'firstNameCard.required_if' => 'Le prénom est obligatoire.',
            'firstNameCard.max' => 'Le prénom ne doit pas dépasser 255 caractères.',
            'lastNameCard.required_if' => 'Le nom est obligatoire.',
            'lastNameCard.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'emailCard.required_if' => 'L\'email est obligatoire.',
            'emailCard.email' => 'Veuillez fournir une adresse email valide.',
            'countryCard.required_if' => 'Le pays est obligatoire.',
            'addressCard.required_if' => 'L\'adresse est obligatoire.',
            'addressCard.max' => 'L\'adresse ne doit pas dépasser 500 caractères.',
            'districtCard.required_if' => 'Le district est obligatoire.',
            'currency.required_if' => 'La devise est obligatoire.',
            'currency.in' => 'La devise sélectionnée n\'est pas valide.'
        ];
    }
}
