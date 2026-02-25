@extends('layouts.admin')

@section('title', 'Commentaires')
@section('page_title', 'Gestion des commentaires')

@section('content')

<div class="card overflow-hidden">
    <table class="w-full">
        <thead class="bg-csj-gray-50 border-b border-csj-gray-100">
            <tr>
                <th class="text-left px-6 py-4 text-xs font-medium text-csj-gray-500 uppercase tracking-wider">Auteur</th>
                <th class="text-left px-6 py-4 text-xs font-medium text-csj-gray-500 uppercase tracking-wider hidden md:table-cell">Commentaire</th>
                <th class="text-left px-6 py-4 text-xs font-medium text-csj-gray-500 uppercase tracking-wider hidden lg:table-cell">Article</th>
                <th class="text-left px-6 py-4 text-xs font-medium text-csj-gray-500 uppercase tracking-wider">Statut</th>
                <th class="text-right px-6 py-4 text-xs font-medium text-csj-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-csj-gray-100">
            @forelse($comments as $comment)
            <tr class="hover:bg-csj-gray-50 transition-colors">
                <td class="px-6 py-4">
                    <p class="font-medium text-csj-gray-900 text-sm">{{ $comment->author_name }}</p>
                    <p class="text-csj-gray-400 text-xs">{{ $comment->author_email }}</p>
                    <p class="text-csj-gray-400 text-xs mt-0.5">{{ $comment->created_at->diffForHumans() }}</p>
                </td>
                <td class="px-6 py-4 hidden md:table-cell">
                    <p class="text-csj-gray-600 text-sm line-clamp-2 max-w-xs">{{ $comment->content }}</p>
                </td>
                <td class="px-6 py-4 hidden lg:table-cell">
                    <a href="{{ route('blog.show', $comment->article->slug) }}" target="_blank"
                       class="text-csj-blue-600 hover:underline text-sm line-clamp-1 max-w-xs block">
                        {{ $comment->article->title }}
                    </a>
                </td>
                <td class="px-6 py-4">
                    <span class="badge {{ $comment->is_approved ? 'badge-green' : 'badge-gray' }}">
                        {{ $comment->is_approved ? 'Approuvé' : 'En attente' }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-2">
                        <form action="{{ route('admin.comments.approve', $comment) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit"
                                    class="text-sm px-3 py-1.5 rounded-lg border transition-colors {{ $comment->is_approved ? 'border-csj-gray-200 text-csj-gray-500 hover:bg-csj-gray-50' : 'border-green-300 text-green-600 hover:bg-green-50' }}">
                                {{ $comment->is_approved ? 'Désapprouver' : 'Approuver' }}
                            </button>
                        </form>
                        <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST"
                              onsubmit="return confirm('Supprimer ce commentaire ?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-csj-gray-400 hover:text-red-500 p-1">
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
                    Aucun commentaire pour le moment.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($comments->hasPages())
    <div class="px-6 py-4 border-t border-csj-gray-100">
        {{ $comments->links() }}
    </div>
    @endif
</div>

@endsection