@extends('layouts.app')

@section('title', $category->name)

@section('content')

{{-- HERO --}}
<section class="bg-gradient-to-br from-csj-blue-900 to-csj-blue-700 text-white py-20">
    <div class="container-csj text-center">
        <a href="{{ route('gallery.index') }}" class="text-csj-blue-200 hover:text-white text-sm flex items-center gap-2 mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Retour à la galerie
        </a>
        <h1 class="text-4xl lg:text-5xl font-heading font-bold text-white mb-4">
            {{ $category->name }}
        </h1>
        <p class="text-csj-blue-100">{{ $images->count() }} photo(s)</p>
    </div>
</section>

{{-- IMAGES --}}
<section class="py-20 bg-csj-gray-50">
    <div class="container-csj">
        @if($images->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" x-data="lightbox()">
                @foreach($images as $index => $image)
                <div class="group relative aspect-square bg-csj-blue-100 rounded-xl overflow-hidden cursor-pointer"
                     @click="open({{ $index }})">
                    <img src="{{ Storage::url($image->filename) }}"
                         alt="{{ $image->caption ?? $category->name }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300 lazy">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors duration-300 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                        </svg>
                    </div>
                </div>
                @endforeach

                {{-- Lightbox --}}
                <div x-show="isOpen" x-transition
                     class="fixed inset-0 bg-black/90 z-50 flex items-center justify-center p-4"
                     @keydown.escape.window="close()"
                     @keydown.arrow-left.window="prev()"
                     @keydown.arrow-right.window="next()">

                    <button @click="close()" class="absolute top-4 right-4 text-white hover:text-csj-blue-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <button @click="prev()" class="absolute left-4 text-white hover:text-csj-blue-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>

                    <img :src="images[current]" class="max-h-screen max-w-full object-contain rounded-lg">

                    <button @click="next()" class="absolute right-4 text-white hover:text-csj-blue-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>

                    <div class="absolute bottom-4 text-white text-sm">
                        <span x-text="current + 1"></span> / {{ $images->total() }}
                    </div>
                </div>
            </div>

            {{-- Pagination --}}
            @if($images->hasPages())
            <div class="flex justify-center mt-12">
                <div class="flex items-center gap-2">
                    @if($images->onFirstPage())
                        <span class="px-4 py-2 rounded-xl text-sm font-medium border border-csj-gray-200 text-csj-gray-300 cursor-not-allowed">
                            ← Précédent
                        </span>
                    @else
                        <a href="{{ $images->previousPageUrl() }}"
                           class="px-4 py-2 rounded-xl text-sm font-medium border border-csj-gray-200 text-csj-gray-600 hover:border-csj-blue-300 hover:text-csj-blue-600 transition-colors">
                            ← Précédent
                        </a>
                    @endif

                    @foreach($images->getUrlRange(1, $images->lastPage()) as $page => $url)
                        <a href="{{ $url }}"
                           class="w-9 h-9 rounded-xl text-sm font-medium flex items-center justify-center transition-colors
                           {{ $page == $images->currentPage() ? 'text-white' : 'border border-csj-gray-200 text-csj-gray-600 hover:border-csj-blue-300 hover:text-csj-blue-600' }}"
                           style="{{ $page == $images->currentPage() ? 'background-color: #0DCAF0;' : '' }}">
                            {{ $page }}
                        </a>
                    @endforeach

                    @if($images->hasMorePages())
                        <a href="{{ $images->nextPageUrl() }}"
                           class="px-4 py-2 rounded-xl text-sm font-medium border border-csj-gray-200 text-csj-gray-600 hover:border-csj-blue-300 hover:text-csj-blue-600 transition-colors">
                            Suivant →
                        </a>
                    @else
                        <span class="px-4 py-2 rounded-xl text-sm font-medium border border-csj-gray-200 text-csj-gray-300 cursor-not-allowed">
                            Suivant →
                        </span>
                    @endif
                </div>
            </div>
            @endif

        @else
            <div class="text-center py-20">
                <p class="text-csj-gray-400 text-lg">Aucune photo dans cette catégorie.</p>
            </div>
        @endif
    </div>
</section>

@push('scripts')
<script>
function lightbox() {
    return {
        isOpen: false,
        current: 0,
        images: @json($images->map(fn($img) => Storage::url($img->filename))),
        open(index) {
            this.current = index;
            this.isOpen = true;
            document.body.style.overflow = 'hidden';
        },
        close() {
            this.isOpen = false;
            document.body.style.overflow = '';
        },
        prev() {
            this.current = (this.current - 1 + this.images.length) % this.images.length;
        },
        next() {
            this.current = (this.current + 1) % this.images.length;
        }
    }
}
</script>
@endpush

@endsection