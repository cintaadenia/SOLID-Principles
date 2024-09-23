<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiaryRequest extends FormRequest
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
            'title' => 'required|string',
            'photo' => 'required|mimes:jpg,png,jpeg,svg',
            'description' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Silahkan isi Judul',
            'photo.required' => 'Foto Tidak boleh kosong',
            'description.required' => 'Silahkan isi Deskripsi',
        ];
    }
}
