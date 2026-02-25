@extends('layouts.admin')

@section('title', 'Articles')
@section('page_title', 'Gestion des articles')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-csj-gray-500 text-sm">{{ $articles->total() }} article(s) au total</p>
    <a href="{{ route('admin.articles.create') }}" class="btn-primary">
        + Nouvel article
    </a>
</div>

<div class="card overflow-hidden">
    <table class="w-full">
        <thead class="bg-csj-gray-50 border-b border-csj-gray-100">
            <tr>
                <th class="text-left px-6 py-4 text-xs font-medium text-csj-gray-500 uppercase tracking-wider">Article</th>
                <th class="text-left px-6 py-4 text-xs font-medium text-csj-gray-500 uppercase tracking-wider hidden md:table-cell">Catégorie</th>
                <th class="text-left px-6 py-4 text-xs font-medium text-csj-gray-500 uppercase tracking-wider hidden lg:table-cell">Auteur</th>
                <th class="text-left px-6 py-4 text-xs font-medium text-csj-gray-500 uppercase tracking-wider">Statut</th>
                <th class="text-right px-6 py-4 text-xs font-medium text-csj-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-csj-gray-100">
            @forelse($articles as $article)
            <tr class="hover:bg-csj-gray-50 transition-colors">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        @if($article->image)
                            <img src="{{ Storage::url($article->image) }}"
                                 class="w-10 h-10 rounded-lg object-cover flex-shrink-0">
                        @else
                            <div class="w-10 h-10 rounded-lg bg-csj-blue-100 flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-csj-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                            </div>
                        @endif
                        <div class="min-w-0">
                            <p class="font-medium text-csj-gray-900 text-sm truncate max-w-xs">{{ $article->title }}</p>
                            <p class="text-csj-gray-400 text-xs mt-0.5">{{ $article->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 hidden md:table-cell">
                    <span class="badge-blue text-xs">{{ $article->category->name }}</span>
                </td>
                <td class="px-6 py-4 hidden lg:table-cell">
                    <p class="text-csj-gray-600 text-sm">{{ $article->author->name }}</p>
                </td>
                <td class="px-6 py-4">
                    <span class="badge {{
                        $article->status === 'published' ? 'badge-green' :
                        ($article->status === 'draft' ? 'badge-gray' : 'badge-red')
                    }}">
                        {{ $article->status === 'published' ? 'Publié' :
                           ($article->status === 'draft' ? 'Brouillon' : 'Archivé') }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-2">
                        @if($article->status === 'published')
                        <a href="{{ route('blog.show', $article->slug) }}" target="_blank"
                           class="text-csj-gray-400 hover:text-csj-blue-600 p-1" title="Voir">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </a>
                        @endif
                        <a href="{{ route('admin.articles.edit', $article) }}"
                           class="text-csj-gray-400 hover:text-csj-blue-600 p-1" title="Modifier">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                        <form action="{{ route('admin.articles.destroy', $article) }}" method="POST"
                              onsubmit="return confirm('Supprimer cet article ?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-csj-gray-400 hover:text-red-500 p-1" title="Supprimer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-12 text-center text-csj-gray-400">
                    Aucun article pour le moment.
                    <a href="{{ route('admin.articles.create') }}" class="text-csj-blue-600 hover:underline ml-1">
                        Créer le premier article
                    </a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($articles->hasPages())
    <div class="px-6 py-4 border-t border-csj-gray-100">
        {{ $articles->links() }}
    </div>
    @endif
</div>

@endsection