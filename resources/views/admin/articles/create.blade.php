@extends('layouts.admin')

@section('title', 'Nouvel article')
@section('page_title', 'Créer un article')

@section('content')

<form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Contenu principal --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Titre --}}
            <div class="card p-6">
                <label class="block text-sm font-medium text-csj-gray-700 mb-2">
                    Titre <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title" value="{{ old('title') }}"
                       class="input-field text-lg font-medium @error('title') border-red-400 @enderror"
                       placeholder="Titre de l'article">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Extrait --}}
            <div class="card p-6">
                <label class="block text-sm font-medium text-csj-gray-700 mb-2">
                    Extrait <span class="text-csj-gray-400 text-xs">(résumé court)</span>
                </label>
                <textarea name="excerpt" rows="3"
                          class="input-field resize-none @error('excerpt') border-red-400 @enderror"
                          placeholder="Résumé court affiché dans la liste des articles...">{{ old('excerpt') }}</textarea>
                @error('excerpt')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Contenu --}}
            <div class="card p-6">
                <label class="block text-sm font-medium text-csj-gray-700 mb-2">
                    Contenu <span class="text-red-500">*</span>
                </label>
                <textarea name="content" id="content" rows="16"
                          class="input-field resize-none @error('content') border-red-400 @enderror"
                          placeholder="Contenu complet de l'article...">{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="space-y-6">

            {{-- Publication --}}
            <div class="card p-6">
                <h3 class="font-heading font-semibold text-csj-gray-900 mb-4">Publication</h3>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-csj-gray-700 mb-2">Statut</label>
                    <select name="status" class="input-field">
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Brouillon</option>
                        <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Publié</option>
                        <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>Archivé</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-csj-gray-700 mb-2">Date de publication</label>
                    <input type="datetime-local" name="published_at"
                           value="{{ old('published_at') }}"
                           class="input-field text-sm">
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="btn-primary flex-1 justify-center">
                        Enregistrer
                    </button>
                    <a href="{{ route('admin.articles.index') }}" class="btn-secondary px-4">
                        Annuler
                    </a>
                </div>
            </div>

            {{-- Catégorie --}}
            <div class="card p-6">
                <h3 class="font-heading font-semibold text-csj-gray-900 mb-4">Catégorie</h3>
                <select name="category_id" class="input-field @error('category_id') border-red-400 @enderror">
                    <option value="">Sélectionner une catégorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Image --}}
            <div class="card p-6">
                <h3 class="font-heading font-semibold text-csj-gray-900 mb-4">Image principale</h3>
                <div x-data="imagePreview()" class="space-y-3">
                    <div class="border-2 border-dashed border-csj-gray-300 rounded-xl p-6 text-center hover:border-csj-blue-400 transition-colors cursor-pointer"
                         @click="$refs.fileInput.click()">
                        <template x-if="!preview">
                            <div>
                                <svg class="w-10 h-10 text-csj-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-csj-gray-400 text-sm">Cliquer pour choisir une image</p>
                                <p class="text-csj-gray-300 text-xs mt-1">JPG, PNG, WebP — Max 2 Mo</p>
                            </div>
                        </template>
                        <template x-if="preview">
                            <img :src="preview" class="w-full h-40 object-cover rounded-lg">
                        </template>
                    </div>
                    <input type="file" name="image" x-ref="fileInput" @change="handleFile($event)"
                           accept="image/jpeg,image/png,image/webp" class="hidden">
                    @error('image')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
function imagePreview() {
    return {
        preview: null,
        handleFile(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => this.preview = e.target.result;
                reader.readAsDataURL(file);
            }
        }
    }
}
</script>
@endpush

@endsection