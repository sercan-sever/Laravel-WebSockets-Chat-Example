<?php

namespace App\Http\Requests;

use App\Enums\ImageTypeEnum;
use App\Enums\SizeEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAvatarRequest extends FormRequest
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
            'avatar' => 'required|image|mimes:' . ImageTypeEnum::ImageMime->value . '|max:' . SizeEnum::Size5->value,
        ];
    }


    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'avatar' => 'Avatar',
        ];
    }
}
