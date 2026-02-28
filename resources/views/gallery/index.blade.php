@extends('layouts.app')

@section('title', 'Galerie')
@section('meta_description', 'Galerie photos du Collège Saint Jean des Cayes')

@section('content')

{{-- HERO --}}
<section class="bg-gradient-to-br from-csj-blue-900 to-csj-blue-700 text-white py-20">
    <div class="container-csj text-center">
        <span class="badge bg-white/20 text-white mb-4 inline-flex">Galerie</span>
        <h1 class="text-4xl lg:text-5xl font-heading font-bold text-white mb-4">
            Notre galerie photos
        </h1>
        <p class="text-csj-blue-100 text-xl max-w-2xl mx-auto">
            Les moments forts et souvenirs du Collège Saint Jean des Cayes.
        </p>
    </div>
</section>

{{-- CATÉGORIES --}}
<section class="py-20 bg-csj-gray-50">
    <div class="container-csj">
        @if($categories->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($categories as $category)
                <a href="{{ route('gallery.show', $category->slug) }}" class="group card-hover block">
                    <div class="aspect-video bg-csj-blue-100 overflow-hidden">
                        @php $featuredImage = $category->cover_image ?? $category->images->first()?->filename; @endphp
@if($featuredImage)
    <img src="{{ Storage::url($featuredImage) }}"
         alt="{{ $category->name }}"
         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
@else
    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-csj-blue-200 to-csj-blue-400">
        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
    </div>
@endif
                    </div>
                    <div class="p-6">
                        <h3 class="font-heading font-bold text-csj-gray-900 text-xl mb-2">{{ $category->name }}</h3>
                        @if($category->description)
                            <p class="text-csj-gray-500 text-sm mb-3">{{ $category->description }}</p>
                        @endif
                        <span class="badge-blue">{{ $category->images_count }} photo(s)</span>
                    </div>
                </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <p class="text-csj-gray-400 text-lg">Aucune galerie disponible pour le moment.</p>
            </div>
        @endif
    </div>
</section>

@endsection