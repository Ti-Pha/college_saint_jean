@extends('layouts.admin')

@section('title', 'Équipe')
@section('page_title', 'Équipe administrative')

@section('content')

<div class="flex justify-end mb-6">
    <a href="{{ route('admin.team.create') }}" class="btn-primary">+ Ajouter un membre</a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($members as $member)
    <div class="card p-6">
        <div class="flex items-start gap-4">
            <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0 bg-csj-blue-100">
                @if($member->photo)
                    <img src="{{ Storage::url($member->photo) }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-csj-blue-200 to-csj-blue-400">
                        <span class="text-white font-bold text-xl">{{ substr($member->name, 0, 1) }}</span>
                    </div>
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-heading font-semibold text-csj-gray-900 truncate">{{ $member->name }}</p>
                <p class="text-csj-blue-600 text-sm">{{ $member->role }}</p>
                <span class="badge {{ $member->is_active ? 'badge-green' : 'badge-gray' }} mt-2">
                    {{ $member->is_active ? 'Actif' : 'Inactif' }}
                </span>
            </div>
        </div>
        <div class="flex gap-2 mt-4 pt-4 border-t border-csj-gray-100">
            <a href="{{ route('admin.team.edit', $member) }}" class="btn-secondary text-xs py-2 flex-1 justify-center">
                Modifier
            </a>
            <form action="{{ route('admin.team.destroy', $member) }}" method="POST"
                  onsubmit="return confirm('Supprimer ce membre ?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn-danger text-xs py-2 px-4">
                    Supprimer
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="col-span-3 text-center py-20 text-csj-gray-400">
        Aucun membre pour le moment.
        <a href="{{ route('admin.team.create') }}" class="text-csj-blue-600 hover:underline ml-1">Ajouter le premier</a>
    </div>
    @endforelse
</div>

@endsection