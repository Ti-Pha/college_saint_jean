@extends('layouts.admin')

@section('title', 'Ajouter un témoignage')
@section('page_title', 'Ajouter un témoignage')

@section('content')

<div class="max-w-2xl">
    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
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
                    <select name="role" class="input-field @error('role') border-red-400 @enderror">
                        <option value="">Sélectionner</option>
                        <option value="Ancien élève" {{ old('role') === 'Ancien élève' ? 'selected' : '' }}>Ancien élève</option>
                        <option value="Parent d'élève" {{ old('role') === "Parent d'élève" ? 'selected' : '' }}>Parent d'élève</option>
                        <option value="Élève actuel" {{ old('role') === 'Élève actuel' ? 'selected' : '' }}>Élève actuel</option>
                        <option value="Partenaire" {{ old('role') === 'Partenaire' ? 'selected' : '' }}>Partenaire</option>
                        <option value="Autre" {{ old('role') === 'Autre' ? 'selected' : '' }}>Autre</option>
                    </select>
                    @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-csj-gray-700 mb-2">Témoignage <span class="text-red-500">*</span></label>
                <textarea name="content" rows="4" class="input-field resize-none @error('content') border-red-400 @enderror"
                          placeholder="Témoignage...">{{ old('content') }}</textarea>
                @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-csj-gray-700 mb-2">Note <span class="text-red-500">*</span></label>
                    <select name="rating" class="input-field">
                        @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" {{ old('rating', 5) == $i ? 'selected' : '' }}>{{ $i }} étoile(s)</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-csj-gray-700 mb-2">Ordre</label>
                    <input type="number" name="order" value="{{ old('order', 0) }}" class="input-field" min="0">
                </div>
                <div class="flex items-center gap-3 pt-6">
                    <input type="checkbox" name="is_active" id="is_active" value="1" checked class="w-4 h-4 rounded" style="accent-color: #2DB9B5;">
                    <label for="is_active" class="text-sm font-medium text-csj-gray-700">Actif</label>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-csj-gray-700 mb-2">Photo</label>
                <input type="file" name="photo" accept="image/jpeg,image/png,image/webp"
                       class="block w-full text-sm text-csj-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-csj-blue-50 file:text-csj-blue-700 hover:file:bg-csj-blue-100">
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">Ajouter le témoignage</button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn-secondary">Annuler</a>
            </div>
        </div>
    </form>
</div>

@endsection