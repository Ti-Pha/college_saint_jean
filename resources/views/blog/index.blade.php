@extends('layouts.app')

@section('title', 'Blog')
@section('meta_description', 'Actualités et articles du Collège Saint Jean des Cayes')

@section('content')

{{-- HERO --}}
<section class="bg-gradient-to-br from-csj-blue-900 to-csj-blue-700 text-white py-20">
    <div class="container-csj">
        <span class="badge bg-white/20 text-white mb-4 inline-flex">Blog</span>
        <h1 class="text-4xl lg:text-5xl font-heading font-bold text-white mb-4">
            Actualités & Articles
        </h1>
        <p class="text-csj-blue-100 text-xl max-w-2xl">
            Restez informés de toute la vie du Collège Saint Jean des Cayes.
        </p>
    </div>
</section>

{{-- CONTENU --}}
<section class="py-20 bg-csj-gray-50">
    <div class="container-csj">
        <div class="flex flex-col lg:flex-row gap-10">

            {{-- Articles --}}
            <div class="flex-1">
                @if($articles->count() > 0)
                    <div class="space-y-8">
                        @foreach($articles as $article)
                        <article class="card-hover flex flex-col md:flex-row overflow-hidden">
                            {{-- Image --}}
                            <div class="md:w-64 flex-shrink-0 aspect-video md:aspect-auto bg-csj-blue-100">
                                @if($article->image)
                                    <img src="{{ Storage::url($article->image) }}"
                                         alt="{{ $article->title }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full min-h-48 flex items-center justify-center bg-gradient-to-br from-csj-blue-100 to-csj-blue-200">
                                        <svg class="w-12 h-12 text-csj-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            {{-- Contenu --}}
                            <div class="p-6 flex flex-col justify-between flex-1">
                                <div>
                                    <div class="flex items-center gap-3 mb-3">
                                        <span class="badge-blue">{{ $article->category->name }}</span>
                                        <span class="text-csj-gray-400 text-xs">
                                            {{ $article->published_at->format('d M Y') }}
                                        </span>
                                    </div>
                                    <h2 class="font-heading font-bold text-csj-gray-900 text-xl mb-3 hover:text-csj-blue-600 transition-colors">
                                        <a href="{{ route('blog.show', $article->slug) }}">
                                            {{ $article->title }}
                                        </a>
                                    </h2>
                                    @if($article->excerpt)
                                        <p class="text-csj-gray-500 text-sm leading-relaxed line-clamp-2">
                                            {{ $article->excerpt }}
                                        </p>
                                    @endif
                                </div>
                                <div class="flex items-center justify-between mt-4 pt-4 border-t border-csj-gray-100">
                                    <div class="flex items-center gap-4 text-csj-gray-400 text-xs">
                                        <span>Par {{ $article->author->name }}</span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                            </svg>
                                            {{ $article->likes->count() }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                            </svg>
                                            {{ $article->approvedComments->count() }}
                                        </span>
                                    </div>
                                    <a href="{{ route('blog.show', $article->slug) }}"
                                       class="text-csj-blue-600 text-sm font-medium hover:text-csj-blue-700 flex items-center gap-1">
                                        Lire l'article
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-10">
                        {{ $articles->links() }}
                    </div>
                @else
                    <div class="text-center py-20">
                        <p class="text-csj-gray-400 text-lg">Aucun article publié pour le moment.</p>
                    </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <aside class="lg:w-80 space-y-8">

                {{-- Recherche --}}
                <div class="card p-6">
                    <h3 class="font-heading font-semibold text-csj-gray-900 mb-4">Rechercher</h3>
                    <form action="{{ route('blog.index') }}" method="GET">
                        <div class="flex gap-2">
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="Rechercher..."
                                   class="input-field text-sm">
                            <button type="submit" class="btn-primary px-4 py-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Catégories --}}
                <div class="card p-6">
                    <h3 class="font-heading font-semibold text-csj-gray-900 mb-4">Catégories</h3>
                    <ul class="space-y-2">
                        @foreach($categories as $category)
                        <li>
                            <a href="{{ route('blog.index', ['category' => $category->slug]) }}"
                               class="flex items-center justify-between py-2 px-3 rounded-lg hover:bg-csj-blue-50 hover:text-csj-blue-600 transition-colors text-csj-gray-600 text-sm {{ request('category') == $category->slug ? 'bg-csj-blue-50 text-csj-blue-600' : '' }}">
                                <span>{{ $category->name }}</span>
                                <span class="badge-gray text-xs">{{ $category->articles_count }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        </div>
    </div>
</section>

@endsection