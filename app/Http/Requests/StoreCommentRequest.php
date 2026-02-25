<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Public
    }

    public function rules(): array
    {
        return [
            'author_name'  => ['required', 'string', 'min:2', 'max:100'],
            'author_email' => ['required', 'email', 'max:150'],
            'content'      => ['required', 'string', 'min:10', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'author_name.required'  => 'Votre nom est obligatoire.',
            'author_name.min'       => 'Le nom doit contenir au moins 2 caractères.',
            'author_email.required' => 'Votre email est obligatoire.',
            'author_email.email'    => 'Veuillez entrer un email valide.',
            'content.required'      => 'Le commentaire est obligatoire.',
            'content.min'           => 'Le commentaire doit contenir au moins 10 caractères.',
            'content.max'           => 'Le commentaire ne doit pas dépasser 1000 caractères.',
        ];
    }
}