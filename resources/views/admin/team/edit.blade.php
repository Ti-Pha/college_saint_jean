@extends('layouts.admin')

@section('title', 'Modifier le membre')
@section('page_title', 'Modifier le membre')

@section('content')

<div class="max-w-2xl">
    <form action="{{ route('admin.team.update', $team) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="card p-8 space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-csj-gray-700 mb-2">Nom <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $team->name) }}" class="input-field">
                </div>
                <div>
                    <label class="block text-sm font-medium text-csj-gray-700 mb-2">Rôle <span class="text-red-500">*</span></label>
                    <input type="text" name="role" value="{{ old('role', $team->role) }}" class="input-field">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-csj-gray-700 mb-2">Description</label>
                <textarea name="description" rows="3" class="input-field resize-none">{{ old('description', $team->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-csj-gray-700 mb-2">Ordre d'affichage</label>
                    <input type="number" name="order" value="{{ old('order', $team->order) }}" class="input-field" min="0">
                </div>
                <div class="flex items-center gap-3 pt-6">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                           {{ $team->is_active ? 'checked' : '' }} class="w-4 h-4 text-csj-blue-600 rounded">
                    <label for="is_active" class="text-sm font-medium text-csj-gray-700">Membre actif</label>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-csj-gray-700 mb-2">Photo</label>
                @if($team->photo)
                    <img src="{{ Storage::url($team->photo) }}" class="w-20 h-20 rounded-xl object-cover mb-3">
                @endif
                <input type="file" name="photo" accept="image/jpeg,image/png,image/webp"
                       class="block w-full text-sm text-csj-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-csj-blue-50 file:text-csj-blue-700 hover:file:bg-csj-blue-100">
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">Mettre à jour</button>
                <a href="{{ route('admin.team.index') }}" class="btn-secondary">Annuler</a>
            </div>
        </div>
    </form>
</div>

@endsection