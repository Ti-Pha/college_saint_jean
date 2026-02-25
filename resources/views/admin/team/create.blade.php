@extends('layouts.admin')

@section('title', 'Ajouter un membre')
@section('page_title', 'Ajouter un membre')

@section('content')

<div class="max-w-2xl">
    <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card p-8 space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-csj-gray-700 mb-2">Nom <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" class="input-field @error('name') border-red-400 @enderror">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-csj-gray-700 mb-2">Rôle <span class="text-red-500">*</span></label>
                    <input type="text" name="role" value="{{ old('role') }}" class="input-field @error('role') border-red-400 @enderror" placeholder="ex: Directeur pédagogique">
                    @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-csj-gray-700 mb-2">Description</label>
                <textarea name="description" rows="3" class="input-field resize-none" placeholder="Brève description...">{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-csj-gray-700 mb-2">Ordre d'affichage</label>
                    <input type="number" name="order" value="{{ old('order', 0) }}" class="input-field" min="0">
                </div>
                <div class="flex items-center gap-3 pt-6">
                    <input type="checkbox" name="is_active" id="is_active" value="1" checked class="w-4 h-4 text-csj-blue-600 rounded">
                    <label for="is_active" class="text-sm font-medium text-csj-gray-700">Membre actif</label>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-csj-gray-700 mb-2">Photo</label>
                <input type="file" name="photo" accept="image/jpeg,image/png,image/webp"
                       class="block w-full text-sm text-csj-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-csj-blue-50 file:text-csj-blue-700 hover:file:bg-csj-blue-100">
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">Ajouter le membre</button>
                <a href="{{ route('admin.team.index') }}" class="btn-secondary">Annuler</a>
            </div>
        </div>
    </form>
</div>

@endsection