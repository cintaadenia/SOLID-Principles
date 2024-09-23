<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DetailUserRequest extends FormRequest
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
            'birthday' => 'required|date',
            'gender' => 'required|string',
            'photo' => 'nullable|mimes:jpg,png,jpeg,svg',
        ];
    }
    
}