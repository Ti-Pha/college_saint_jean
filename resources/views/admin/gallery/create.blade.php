@extends('layouts.admin')

@section('title', 'Nouvelle catégorie')
@section('page_title', 'Nouvelle catégorie galerie')

@section('content')

<div class="max-w-lg">
    <form action="{{ route('admin.gallery.store') }}" method="POST">
        @csrf
        <div class="card p-8 space-y-6">
            <div>
                <label class="block text-sm font-medium text-csj-gray-700 mb-2">Nom <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="input-field @error('name') border-red-400 @enderror"
                       placeholder="ex: Graduation 2024">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-csj-gray-700 mb-2">Description</label>
                <textarea name="description" rows="3" class="input-field resize-none"
                          placeholder="Description de cette catégorie...">{{ old('description') }}</textarea>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="btn-primary">Créer la catégorie</button>
                <a href="{{ route('admin.gallery.index') }}" class="btn-secondary">Annuler</a>
            </div>
        </div>
    </form>
</div>

@endsection