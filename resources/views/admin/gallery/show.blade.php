@extends('layouts.admin')

@section('title', $gallery->name)
@section('page_title', 'Photos — ' . $gallery->name)

@section('content')

{{-- Upload --}}
<div class="card p-6 mb-8">
    <h3 class="font-heading font-semibold text-csj-gray-900 mb-4">Ajouter des photos</h3>
    <form action="{{ route('admin.gallery.images.upload', $gallery) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="gallery_category_id" value="{{ $gallery->id }}">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="md:col-span-2">
                <input type="file" name="images[]" multiple accept="image/jpeg,image/png,image/webp"
                       class="block w-full text-sm text-csj-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-csj-blue-50 file:text-csj-blue-700 hover:file:bg-csj-blue-100">
                <p class="text-csj-gray-400 text-xs mt-1">Max 10 photos à la fois. Formats : JPG, PNG, WebP. Max 3 Mo/photo.</p>
            </div>
            <div>
                <input type="text" name="caption" placeholder="Légende (optionnelle)"
                       class="input-field text-sm mb-2">
                <button type="submit" class="btn-primary w-full justify-center text-sm">
                    Uploader les photos
                </button>
            </div>
        </div>
    </form>
</div>

{{-- Photos --}}
@if($images->count() > 0)
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
        @foreach($images as $image)
        <div class="group relative aspect-square bg-csj-gray-100 rounded-xl overflow-hidden">
            <img src="{{ Storage::url($image->filename) }}"
                 alt="{{ $image->caption ?? '' }}"
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/50 transition-all duration-200 flex items-center justify-center">
                <form action="{{ route('admin.gallery.images.delete', $image) }}" method="POST"
                      onsubmit="return confirm('Supprimer cette image ?')"
                      class="opacity-0 group-hover:opacity-100 transition-opacity">
                    @csrf @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </form>
            </div>
            @if($image->caption)
                <div class="absolute bottom-0 left-0 right-0 bg-black/60 text-white text-xs p-2 truncate">
                    {{ $image->caption }}
                </div>
            @endif
        </div>
        @endforeach
    </div>
@else
    <div class="text-center py-20 text-csj-gray-400">
        <svg class="w-16 h-16 mx-auto mb-4 text-csj-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <p>Aucune photo dans cette catégorie.</p>
    </div>
@endif

@endsection