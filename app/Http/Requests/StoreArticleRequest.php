<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->hasPermissionTo('create articles');
    }

    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'min:5', 'max:255'],
            'content'     => ['required', 'string', 'min:50'],
            'excerpt'     => ['nullable', 'string', 'max:500'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'status'      => ['required', 'in:draft,published,archived'],
            'published_at'=> ['nullable', 'date'],
            'image'       => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'       => 'Le titre est obligatoire.',
            'title.min'            => 'Le titre doit contenir au moins 5 caractères.',
            'content.required'     => 'Le contenu est obligatoire.',
            'content.min'          => 'Le contenu doit contenir au moins 50 caractères.',
            'category_id.required' => 'Veuillez sélectionner une catégorie.',
            'category_id.exists'   => 'La catégorie sélectionnée est invalide.',
            'image.image'          => 'Le fichier doit être une image.',
            'image.mimes'          => 'Formats acceptés : jpeg, png, jpg, webp.',
            'image.max'            => 'L\'image ne doit pas dépasser 2 Mo.',
        ];
    }
}