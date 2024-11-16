<?php

namespace App\Http\Requests;

use App\Models\Shipping;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

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
            'sold' => ['required', 'numeric'],
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

            'validity_duration' => ['required', 'numeric', 'min:1'],

            // Delivery details validation only if delivery is required
            'shipping_id' => ['required', 'numeric', 'exists:shippings,id'],
            'delivery_address' => ['required', 'string', 'max:500'],
            'delivery_date' => ['required', 'date', 'after:today'],
            'delivery_contact' => ['nullable', 'string'],
            'shipping_zone' => ['required', 'string'],
            'shipping_price' => ['required', 'numeric'],

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
        $shipping_price = 0;
        $shipping = Shipping::find($this->input('shipping_id'));
        if ($shipping) $shipping_price = $shipping->price;

        $settings = DB::table('gift_card_settings')->first();
        $customization_fee = $settings ? $settings->customization_fee : 0;
        $validity_duration = $settings ? $settings->validity_duration : 1;

        $total_amount = 0;
        if ($this->input('amount')) $total_amount += (int)($this->input('amount'));
        if ($this->input('amount')) $sold = (int)($this->input('amount')) ?? 0;
        if ($this->input('is_customized') == '1') $total_amount += $customization_fee;
        $total_amount += $shipping_price;

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
                'shipping_zone' => $shipping->zone ?? 'N/A',
                'shipping_price' => $shipping_price ?? 0,
                'validity_duration' => $validity_duration,
                'total_amount' => $total_amount,
                'sold' => $sold,
                'customization_fee' => $customization_fee,
                'payment_phone' => $dial_code . $this->input('payment_phone'),
                'user_id' => auth()->user()->id
            ]
        );
    }

    public function messages()
    {
        return [
            // Montant
            'amount.required' => 'Le montant du chèque cadeau est obligatoire.',
            'amount.numeric' => 'Le montant doit être un nombre.',
            'amount.min' => 'Le montant doit être supérieur ou égal à 10 000.',

            // Informations client
            'client_name.required' => 'Le nom du client est obligatoire.',
            'client_email.required' => 'L\'adresse email du client est obligatoire.',
            'client_email.email' => 'Veuillez entrer une adresse email valide.',
            'client_email.max' => 'L\'adresse email ne doit pas dépasser 255 caractères.',
            'client_phone.required' => 'Le numéro de téléphone du client est obligatoire.',
            'client_phone.numeric' => 'Le numéro de téléphone doit être un nombre.',
            'client_phone.min_digits' => 'Le numéro de téléphone doit contenir au moins 8 chiffres.',
            'client_phone.max_digits' => 'Le numéro de téléphone ne doit pas dépasser 15 chiffres.',

            // Bénéficiaire
            'beneficiary_name.required_if' => 'Le nom du bénéficiaire est requis si vous n\'êtes pas le bénéficiaire.',
            'beneficiary_name.nullable' => 'Le nom du bénéficiaire peut être vide.',
            'beneficiary_email.email' => 'Veuillez entrer une adresse email valide pour le bénéficiaire.',
            'beneficiary_email.max' => 'L\'adresse email du bénéficiaire ne doit pas dépasser 255 caractères.',
            'beneficiary_phone.required_if' => 'Le numéro de téléphone du bénéficiaire est requis si vous n\'êtes pas le bénéficiaire.',
            'beneficiary_phone.numeric' => 'Le numéro de téléphone du bénéficiaire doit être un nombre.',
            'beneficiary_phone.min_digits' => 'Le numéro de téléphone du bénéficiaire doit contenir au moins 8 chiffres.',
            'beneficiary_phone.max_digits' => 'Le numéro de téléphone du bénéficiaire ne doit pas dépasser 15 chiffres.',

            // Livraison
            'delivery_address.required' => 'L\'adresse de livraison est obligatoire.',
            'delivery_address.max' => 'L\'adresse de livraison ne doit pas dépasser 500 caractères.',
            'delivery_date.required' => 'La date de livraison est obligatoire.',
            'delivery_date.date' => 'Veuillez entrer une date valide.',
            'delivery_date.after' => 'La date de livraison doit être postérieure à aujourd\'hui.',
            'delivery_contact.string' => 'Le contact de livraison doit être une chaîne de caractères.',
            'shipping_zone.required' => 'La zone de livraison est obligatoire.',
            'shipping_zone.string' => 'La zone de livraison doit être une chaîne de caractères.',
            'shipping_price.required' => 'Le prix de la livraison est obligatoire.',
            'shipping_price.numeric' => 'Le prix de la livraison doit être un nombre.',

            // Partenaire
            'partner_id.required' => 'L\'ID du partenaire est obligatoire.',
            'partner_id.exists' => 'Le partenaire sélectionné est invalide.',

            // Paiement
            'payment_method.required' => 'Le mode de paiement est obligatoire.',
            'payment_method.string' => 'Le mode de paiement doit être une chaîne de caractères.',
            'payment_method.in' => 'Le mode de paiement sélectionné est invalide.',
            'total_amount.required' => 'Le montant total est obligatoire.',
            'total_amount.numeric' => 'Le montant total doit être un nombre.',
            'total_amount.min' => 'Le montant total doit être supérieur ou égal à 10 000.',

            'payment_phone.required_if' => 'Le numéro de téléphone pour le paiement est obligatoire.',
            'payment_phone.numeric' => 'Le numéro de téléphone pour le paiement doit être un nombre.',
            'payment_phone.min_digits' => 'Le numéro de téléphone doit contenir au moins 8 chiffres.',
            'payment_phone.max_digits' => 'Le numéro de téléphone ne doit pas dépasser 15 chiffres.',

            'payment_network.required_if' => 'Veuillez sélectionner un réseau de paiement valide.',
            'payment_network.in' => 'Le réseau de paiement sélectionné n\'est pas valide.',

            'payment_otp.string' => 'Veuillez entrer un code OTP valide.',

            // Paiement par carte
            'cardType.required_if' => 'Le type de carte est obligatoire.',
            'cardType.in' => 'Le type de carte sélectionné n\'est pas valide.',
            'firstNameCard.required_if' => 'Le prénom du titulaire de la carte est obligatoire.',
            'firstNameCard.max' => 'Le prénom ne doit pas dépasser 255 caractères.',
            'lastNameCard.required_if' => 'Le nom du titulaire de la carte est obligatoire.',
            'lastNameCard.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'emailCard.required_if' => 'L\'email du titulaire de la carte est obligatoire.',
            'emailCard.email' => 'Veuillez entrer une adresse email valide.',
            'emailCard.max' => 'L\'adresse email ne doit pas dépasser 255 caractères.',
            'countryCard.required_if' => 'Le pays du titulaire de la carte est obligatoire.',
            'countryCard.max' => 'Le pays ne doit pas dépasser 100 caractères.',
            'addressCard.required_if' => 'L\'adresse du titulaire de la carte est obligatoire.',
            'addressCard.max' => 'L\'adresse ne doit pas dépasser 500 caractères.',
            'districtCard.required_if' => 'Le district du titulaire de la carte est obligatoire.',
            'currency.required_if' => 'La devise est obligatoire.',
            'currency.in' => 'La devise sélectionnée n\'est pas valide.',
        ];
    }
}
