<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetChatViewRequest extends FormRequest
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
            'receiverID' => 'required|numeric|min:1',
        ];
    }


    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function attributes(): array
    {
        return [
            'receiverID' => 'Alıcı ID',
        ];
    }
}
