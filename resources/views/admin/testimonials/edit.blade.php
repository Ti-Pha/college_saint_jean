@extends('layouts.admin')

@section('title', 'Modifier le témoignage')
@section('page_title', 'Modifier le témoignage')

@section('content')

<div class="max-w-2xl">
    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="card p-8 space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-csj-gray-700 mb-2">Nom <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $testimonial->name) }}" class="input-field">
                </div>
                <div>
                    <label class="block text-sm font-medium text-csj-gray-700 mb-2">Rôle <span class="text-red-500">*</span></label>
                    <select name="role" class="input-field">
                        <option value="">Sélectionner</option>
                        @foreach(["Ancien élève", "Parent d'élève", "Élève actuel", "Partenaire", "Autre"] as $role)
                        <option value="{{ $role }}" {{ old('role', $testimonial->role) === $role ? 'selected' : '' }}>{{ $role }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-csj-gray-700 mb-2">Témoignage <span class="text-red-500">*</span></label>
                <textarea name="content" rows="4" class="input-field resize-none">{{ old('content', $testimonial->content) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-csj-gray-700 mb-2">Note</label>
                    <select name="rating" class="input-field">
                        @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>{{ $i }} étoile(s)</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-csj-gray-700 mb-2">Ordre</label>
                    <input type="number" name="order" value="{{ old('order', $testimonial->order) }}" class="input-field" min="0">
                </div>
                <div class="flex items-center gap-3 pt-6">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                           {{ $testimonial->is_active ? 'checked' : '' }} class="w-4 h-4 rounded" style="accent-color: #2DB9B5;">
                    <label for="is_active" class="text-sm font-medium text-csj-gray-700">Actif</label>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-csj-gray-700 mb-2">Photo</label>
                @if($testimonial->photo)
                    <img src="{{ Storage::url($testimonial->photo) }}" class="w-16 h-16 rounded-full object-cover mb-3">
                @endif
                <input type="file" name="photo" accept="image/jpeg,image/png,image/webp"
                       class="block w-full text-sm text-csj-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-csj-blue-50 file:text-csj-blue-700 hover:file:bg-csj-blue-100">
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">Mettre à jour</button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn-secondary">Annuler</a>
            </div>
        </div>
    </form>
</div>

@endsection