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
