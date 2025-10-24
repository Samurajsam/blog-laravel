<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
            'content' => 'required|string|min:3|max:1000',
            'post_id' => 'required|exists:posts,id',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'content.required' => 'Treść komentarza jest wymagana.',
            'content.min' => 'Komentarz musi mieć minimum 3 znaki.',
            'content.max' => 'Komentarz może mieć maksymalnie 1000 znaków.',
            'post_id.required' => 'ID posta jest wymagane.',
            'post_id.exists' => 'Wybrany post nie istnieje.',
        ];
    }
}
