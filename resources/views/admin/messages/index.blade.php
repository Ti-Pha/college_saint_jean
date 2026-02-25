@extends('layouts.admin')

@section('title', 'Messages')
@section('page_title', 'Messages de contact')

@section('content')

<div class="card overflow-hidden">
    <table class="w-full">
        <thead class="bg-csj-gray-50 border-b border-csj-gray-100">
            <tr>
                <th class="text-left px-6 py-4 text-xs font-medium text-csj-gray-500 uppercase tracking-wider">Expéditeur</th>
                <th class="text-left px-6 py-4 text-xs font-medium text-csj-gray-500 uppercase tracking-wider hidden md:table-cell">Sujet</th>
                <th class="text-left px-6 py-4 text-xs font-medium text-csj-gray-500 uppercase tracking-wider hidden lg:table-cell">Message</th>
                <th class="text-left px-6 py-4 text-xs font-medium text-csj-gray-500 uppercase tracking-wider">Statut</th>
                <th class="text-right px-6 py-4 text-xs font-medium text-csj-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-csj-gray-100">
            @forelse($messages as $message)
            <tr class="hover:bg-csj-gray-50 transition-colors {{ !$message->is_read ? 'bg-csj-blue-50/30' : '' }}">
                <td class="px-6 py-4">
                    <p class="font-medium text-csj-gray-900 text-sm {{ !$message->is_read ? 'font-bold' : '' }}">
                        {{ $message->name }}
                    </p>
                    <p class="text-csj-gray-400 text-xs">{{ $message->email }}</p>
                    <p class="text-csj-gray-400 text-xs mt-0.5">{{ $message->created_at->diffForHumans() }}</p>
                </td>
                <td class="px-6 py-4 hidden md:table-cell">
                    <p class="text-csj-gray-600 text-sm">{{ $message->subject ?? 'Sans sujet' }}</p>
                </td>
                <td class="px-6 py-4 hidden lg:table-cell">
                    <p class="text-csj-gray-500 text-sm line-clamp-2 max-w-xs">{{ $message->message }}</p>
                </td>
                <td class="px-6 py-4">
                    <span class="badge {{ $message->is_read ? 'badge-green' : 'badge-blue' }}">
                        {{ $message->is_read ? 'Lu' : 'Non lu' }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-2">
                        @if(!$message->is_read)
                        <form action="{{ route('admin.messages.read', $message) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit" class="text-sm px-3 py-1.5 rounded-lg border border-csj-blue-300 text-csj-blue-600 hover:bg-csj-blue-50 transition-colors">
                                Marquer lu
                            </button>
                        </form>
                        @endif
                        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST"
                              onsubmit="return confirm('Supprimer ce message ?')">
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
                    Aucun message reçu pour le moment.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($messages->hasPages())
    <div class="px-6 py-4 border-t border-csj-gray-100">
        {{ $messages->links() }}
    </div>
    @endif
</div>

@endsection