@extends('layouts.admin')

@section('title', 'Tableau de bord')
@section('page_title', 'Tableau de bord')

@section('content')

{{-- Stats --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="card p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-csj-blue-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-csj-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
            </div>
            <span class="badge-blue">Articles</span>
        </div>
        <p class="text-3xl font-heading font-bold text-csj-gray-900">{{ $stats['articles'] }}</p>
        <p class="text-csj-gray-500 text-sm mt-1">{{ $stats['published'] }} publiés · {{ $stats['drafts'] }} brouillons</p>
    </div>

    <div class="card p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
            </div>
            @if($stats['pending_comments'] > 0)
                <span class="badge bg-red-100 text-red-700">{{ $stats['pending_comments'] }} en attente</span>
            @endif
        </div>
        <p class="text-3xl font-heading font-bold text-csj-gray-900">{{ $stats['comments'] }}</p>
        <p class="text-csj-gray-500 text-sm mt-1">Commentaires total</p>
    </div>

    <div class="card p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <span class="badge bg-purple-100 text-purple-700">Galerie</span>
        </div>
        <p class="text-3xl font-heading font-bold text-csj-gray-900">{{ $stats['images'] }}</p>
        <p class="text-csj-gray-500 text-sm mt-1">Photos en ligne</p>
    </div>

    <div class="card p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            @if($stats['unread_messages'] > 0)
                <span class="badge bg-red-100 text-red-700">{{ $stats['unread_messages'] }} non lus</span>
            @endif
        </div>
        <p class="text-3xl font-heading font-bold text-csj-gray-900">{{ $stats['messages'] }}</p>
        <p class="text-csj-gray-500 text-sm mt-1">Messages reçus</p>
    </div>
</div>

{{-- Contenu principal --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

    {{-- Derniers articles --}}
    <div class="card">
        <div class="flex items-center justify-between p-6 border-b border-csj-gray-100">
            <h2 class="font-heading font-semibold text-csj-gray-900">Derniers articles</h2>
            <a href="{{ route('admin.articles.create') }}" class="btn-primary text-xs py-2 px-4">
                + Nouvel article
            </a>
        </div>
        <div class="divide-y divide-csj-gray-100">
            @forelse($recentArticles as $article)
            <div class="flex items-center gap-4 p-4 hover:bg-csj-gray-50">
                <div class="flex-1 min-w-0">
                    <p class="font-medium text-csj-gray-900 text-sm truncate">{{ $article->title }}</p>
                    <p class="text-csj-gray-400 text-xs mt-0.5">{{ $article->created_at->diffForHumans() }}</p>
                </div>
                <span class="badge {{ $article->status === 'published' ? 'badge-green' : ($article->status === 'draft' ? 'badge-gray' : 'badge-red') }}">
                    {{ $article->status === 'published' ? 'Publié' : ($article->status === 'draft' ? 'Brouillon' : 'Archivé') }}
                </span>
                <a href="{{ route('admin.articles.edit', $article) }}" class="text-csj-blue-600 hover:text-csj-blue-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </a>
            </div>
            @empty
                <p class="text-csj-gray-400 text-sm p-6 text-center">Aucun article pour le moment.</p>
            @endforelse
        </div>
        <div class="p-4 border-t border-csj-gray-100">
            <a href="{{ route('admin.articles.index') }}" class="text-csj-blue-600 text-sm hover:text-csj-blue-700">
                Voir tous les articles →
            </a>
        </div>
    </div>

    {{-- Commentaires en attente --}}
    <div class="card">
        <div class="flex items-center justify-between p-6 border-b border-csj-gray-100">
            <h2 class="font-heading font-semibold text-csj-gray-900">Commentaires en attente</h2>
            @if($stats['pending_comments'] > 0)
                <span class="badge bg-red-100 text-red-700">{{ $stats['pending_comments'] }}</span>
            @endif
        </div>
        <div class="divide-y divide-csj-gray-100">
            @forelse($recentComments as $comment)
            <div class="p-4 hover:bg-csj-gray-50">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-csj-gray-900 text-sm">{{ $comment->author_name }}</p>
                        <p class="text-csj-gray-500 text-xs mt-0.5 line-clamp-2">{{ $comment->content }}</p>
                        <p class="text-csj-gray-400 text-xs mt-1">Sur : {{ $comment->article->title }}</p>
                    </div>
                    <div class="flex gap-2 flex-shrink-0">
                        <form action="{{ route('admin.comments.approve', $comment) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit" class="text-green-600 hover:text-green-700 p-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </button>
                        </form>
                        <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-600 p-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
                <p class="text-csj-gray-400 text-sm p-6 text-center">Aucun commentaire en attente.</p>
            @endforelse
        </div>
        <div class="p-4 border-t border-csj-gray-100">
            <a href="{{ route('admin.comments.index') }}" class="text-csj-blue-600 text-sm hover:text-csj-blue-700">
                Gérer tous les commentaires →
            </a>
        </div>
    </div>
</div>

@endsection
