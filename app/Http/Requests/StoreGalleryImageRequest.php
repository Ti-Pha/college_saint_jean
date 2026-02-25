<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGalleryImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->hasPermissionTo('manage gallery');
    }

    public function rules(): array
    {
        return [
            'gallery_category_id' => ['required', 'integer', 'exists:gallery_categories,id'],
            'images'              => ['required', 'array', 'min:1', 'max:10'],
            'images.*'            => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'caption'             => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'gallery_category_id.required' => 'Veuillez sélectionner une catégorie.',
            'gallery_category_id.exists'   => 'La catégorie sélectionnée est invalide.',
            'images.required'              => 'Veuillez sélectionner au moins une image.',
            'images.max'                   => 'Maximum 10 images à la fois.',
            'images.*.image'               => 'Chaque fichier doit être une image.',
            'images.*.mimes'               => 'Formats acceptés : jpeg, png, jpg, webp.',
            'images.*.max'                 => 'Chaque image ne doit pas dépasser 3 Mo.',
        ];
    }
}