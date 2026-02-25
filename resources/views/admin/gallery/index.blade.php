@extends('layouts.admin')

@section('title', 'Galerie')
@section('page_title', 'Gestion de la galerie')

@section('content')

<div class="flex justify-end mb-6">
    <a href="{{ route('admin.gallery.create') }}" class="btn-primary">+ Nouvelle catégorie</a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($categories as $category)
    <div class="card overflow-hidden">
        <div class="aspect-video bg-csj-blue-100">
    @php $featuredImage = $category->cover_image ?? $category->images->first()?->filename; @endphp
    @if($featuredImage)
        <img src="{{ Storage::url($featuredImage) }}" class="w-full h-full object-cover">
    @else
        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-csj-blue-200 to-csj-blue-400">
            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
    @endif
</div>
        <div class="p-5">
            <div class="flex items-center justify-between mb-3">
                <h3 class="font-heading font-semibold text-csj-gray-900">{{ $category->name }}</h3>
                <span class="badge-blue">{{ $category->images_count }} photo(s)</span>
            </div>
            @if($category->description)
                <p class="text-csj-gray-500 text-sm mb-4">{{ $category->description }}</p>
            @endif
            <div class="flex gap-2">
                <a href="{{ route('admin.gallery.show', $category) }}" class="btn-primary text-xs py-2 flex-1 justify-center">
                    Gérer les photos
                </a>
                <a href="{{ route('admin.gallery.edit', $category) }}" class="btn-secondary text-xs py-2 px-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </a>
                <form action="{{ route('admin.gallery.destroy', $category) }}" method="POST"
                      onsubmit="return confirm('Supprimer cette catégorie et toutes ses photos ?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-danger text-xs py-2 px-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-3 text-center py-20 text-csj-gray-400">
        Aucune catégorie pour le moment.
        <a href="{{ route('admin.gallery.create') }}" class="text-csj-blue-600 hover:underline ml-1">Créer la première</a>
    </div>
    @endforelse
</div>

@endsection