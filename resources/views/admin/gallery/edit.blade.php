@extends('layouts.admin')

@section('title', 'Modifier la catégorie')
@section('page_title', 'Modifier la catégorie')

@section('content')

<div class="max-w-lg">
    <form action="{{ route('admin.gallery.update', $gallery) }}" method="POST">
        @csrf @method('PUT')
        <div class="card p-8 space-y-6">
            <div>
                <label class="block text-sm font-medium text-csj-gray-700 mb-2">Nom <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name', $gallery->name) }}" class="input-field">
            </div>
            <div>
                <label class="block text-sm font-medium text-csj-gray-700 mb-2">Description</label>
                <textarea name="description" rows="3" class="input-field resize-none">{{ old('description', $gallery->description) }}</textarea>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="btn-primary">Mettre à jour</button>
                <a href="{{ route('admin.gallery.index') }}" class="btn-secondary">Annuler</a>
            </div>
        </div>
    </form>
</div>

@endsection