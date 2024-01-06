<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMessageRequest extends FormRequest
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
            'messageID'      => 'required|numeric|min:1',
            'receiverID'     => 'required|numeric|min:1',
            'update_message' => 'required|string|min:1|max:5000',
        ];
    }


    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function attributes(): array
    {
        return [
            'messageID'      => 'Mesaj ID ',
            'receiverID'     => 'Alıcı ID ',
            'update_message' => 'Mesaj ',
        ];
    }
}
