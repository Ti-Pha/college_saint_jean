@extends('layouts.admin')

@section('title', 'Modifier l\'article')
@section('page_title', 'Modifier l\'article')

@section('content')

<form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Contenu principal --}}
        <div class="lg:col-span-2 space-y-6">

            <div class="card p-6">
                <label class="block text-sm font-medium text-csj-gray-700 mb-2">
                    Titre <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title" value="{{ old('title', $article->title) }}"
                       class="input-field text-lg font-medium @error('title') border-red-400 @enderror">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="card p-6">
                <label class="block text-sm font-medium text-csj-gray-700 mb-2">Extrait</label>
                <textarea name="excerpt" rows="3"
                          class="input-field resize-none">{{ old('excerpt', $article->excerpt) }}</textarea>
            </div>

            <div class="card p-6">
                <label class="block text-sm font-medium text-csj-gray-700 mb-2">
                    Contenu <span class="text-red-500">*</span>
                </label>
                <textarea name="content" rows="16"
                          class="input-field resize-none @error('content') border-red-400 @enderror">{{ old('content', $article->content) }}</textarea>
                @error('content')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="space-y-6">

            <div class="card p-6">
                <h3 class="font-heading font-semibold text-csj-gray-900 mb-4">Publication</h3>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-csj-gray-700 mb-2">Statut</label>
                    <select name="status" class="input-field">
                        <option value="draft" {{ old('status', $article->status) === 'draft' ? 'selected' : '' }}>Brouillon</option>
                        <option value="published" {{ old('status', $article->status) === 'published' ? 'selected' : '' }}>Publié</option>
                        <option value="archived" {{ old('status', $article->status) === 'archived' ? 'selected' : '' }}>Archivé</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-csj-gray-700 mb-2">Date de publication</label>
                    <input type="datetime-local" name="published_at"
                           value="{{ old('published_at', $article->published_at?->format('Y-m-d\TH:i')) }}"
                           class="input-field text-sm">
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="btn-primary flex-1 justify-center">
                        Mettre à jour
                    </button>
                    <a href="{{ route('admin.articles.index') }}" class="btn-secondary px-4">
                        Annuler
                    </a>
                </div>
            </div>

            <div class="card p-6">
                <h3 class="font-heading font-semibold text-csj-gray-900 mb-4">Catégorie</h3>
                <select name="category_id" class="input-field">
                    <option value="">Sélectionner une catégorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="card p-6">
                <h3 class="font-heading font-semibold text-csj-gray-900 mb-4">Image principale</h3>
                <div x-data="imagePreview('{{ $article->image ? Storage::url($article->image) : '' }}')" class="space-y-3">
                    @if($article->image)
                        <img src="{{ Storage::url($article->image) }}"
                             class="w-full h-40 object-cover rounded-xl mb-3">
                    @endif
                    <div class="border-2 border-dashed border-csj-gray-300 rounded-xl p-4 text-center hover:border-csj-blue-400 transition-colors cursor-pointer"
                         @click="$refs.fileInput.click()">
                        <template x-if="!preview">
                            <p class="text-csj-gray-400 text-sm">Changer l'image</p>
                        </template>
                        <template x-if="preview">
                            <img :src="preview" class="w-full h-32 object-cover rounded-lg">
                        </template>
                    </div>
                    <input type="file" name="image" x-ref="fileInput" @change="handleFile($event)"
                           accept="image/jpeg,image/png,image/webp" class="hidden">
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
function imagePreview(existing = null) {
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