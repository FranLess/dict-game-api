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
            'day_of_birth' => 'nullable|date',
            'gender' => 'nullable|string',
            'country_id' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_header' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'nullable|string',
            'bio' => 'nullable|string',
            'likes' => 'nullable|integer',
            'dislikes' => 'nullable|integer',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'public_email' => 'nullable|string',
            'user_id' => 'nullable|integer',
            'level_id' => 'nullable|integer',
            'sentimental_id' => 'nullable|integer',
        ];
    }
}
