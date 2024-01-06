<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthLoginRequest extends FormRequest
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
            'email'                 => 'required|email|min:6|max:255',
            'password'              => 'required|string|min:6|max:255',
            'g-recaptcha-response'  => 'required|captcha'
        ];
    }


    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function attributes(): array
    {
        return [
            'email'                => 'E-Posta',
            'password'             => 'Şifre',
            'g-recaptcha-response' => 'Ben Robot Değilim',
        ];
    }
}
