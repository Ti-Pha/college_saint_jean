<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Public
    }

    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'min:2', 'max:150'],
            'email'   => ['required', 'email', 'max:150'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'min:20', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Votre nom est obligatoire.',
            'name.min'         => 'Le nom doit contenir au moins 2 caractères.',
            'email.required'   => 'Votre email est obligatoire.',
            'email.email'      => 'Veuillez entrer un email valide.',
            'message.required' => 'Le message est obligatoire.',
            'message.min'      => 'Le message doit contenir au moins 20 caractères.',
            'message.max'      => 'Le message ne doit pas dépasser 2000 caractères.',
        ];
    }
}