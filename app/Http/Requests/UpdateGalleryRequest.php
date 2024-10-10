<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGalleryRequest extends FormRequest
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
            'photo_update' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:8000',
        ];
    }

    public function messages(): array
    {
        return [
            'photo_update.max' => 'Ukuran foto tidak boleh lebih dari 8MB',
        ];
    }
}
