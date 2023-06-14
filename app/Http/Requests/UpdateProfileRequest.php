<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'day_of_birth' => 'nullable',
            'gender' => 'nullable',
            'country_id' => 'nullable',
            'image' => 'nullable',
            'image_header' => 'nullable',
            'title' => 'nullable',
            'bio' => 'nullable',
            // 'likes' => 'nullable',
            // 'dislikes' => 'nullable',
            'address' => 'nullable',
            'phone' => 'nullable',
            'public_email' => 'nullable',
            'user_id' => 'nullable',
            'level_id' => 'nullable',
            'sentimental_id' => 'nullable',
        ];
    }
}
