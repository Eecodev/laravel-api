<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'image' => ['nullable', 'image', 'max:1024'],
            'title' => ['required', 'min:3', 'max:200', 'unique:projects'],
            'description' => ['nullable'],
            'url' => ['required'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'technologies' => ['exists:technologies,id']
        ];
    }

    public function messages()
    {
        return [
            'image.url' => 'L\'immagine deve essere di tipo url',
            'image.max' => 'L\'immagine deve essere massimo 1MB',
            'title.required' => 'Il titolo è obbligatorio',
            'title.min' => 'Il titolo deve avere almeno :min caratteri',
            'title.max' => 'Il titolo deve avere massimo :max caratteri',
            'title.unique' => 'Questo titolo esiste già',
            'url' => 'L\'url è obbligatorio'
        ];

    }
}
