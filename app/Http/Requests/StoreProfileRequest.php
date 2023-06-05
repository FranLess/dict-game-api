<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfileRequest extends FormRequest
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
            'day_of_birth' => 'nullable|string',
            'gender' => 'nullable|string',
            'country_id' => 'required|integer',
            'image' => 'nullable|image',
            'image_header' => 'nullable|image',
            'title' => 'nullable|string',
            'bio' => 'nullable|string',
            'likes' => 'nullable|integer',
            'dislikes' => 'nullable|integer',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'public_email' => 'nullable|string',
            'user_id' => 'required|integer',
            'level_id' => 'required|integer',
            'sentimental_id' => 'nullable|integer',
        ];
    }
}
