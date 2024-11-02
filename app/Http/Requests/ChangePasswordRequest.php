<?php

namespace App\Http\Requests;

use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->input('origin') && is_string($this->input('origin'))) {

            $origin = AuthController::getTokenEmail($this->input('origin'));

            if (User::whereEmail($origin)->firstOrFail())
                return true;
        }
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
            'origin' => 'bail|required|string',
            'password' => 'bail|required|confirmed|string|min:8|max:40',
            'password_confirmation' => 'required',
        ];
    }
}
