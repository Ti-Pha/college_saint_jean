@extends('layouts.admin')

@section('title', 'Témoignages')
@section('page_title', 'Gestion des témoignages')

@section('content')

<div class="flex justify-end mb-6">
    <a href="{{ route('admin.testimonials.create') }}" class="btn-primary">+ Ajouter un témoignage</a>
</div>

<div class="card overflow-hidden">
    <table class="w-full">
        <thead class="bg-csj-gray-50 border-b border-csj-gray-100">
            <tr>
                <th class="text-left px-6 py-4 text-xs font-medium text-csj-gray-500 uppercase tracking-wider">Personne</th>
                <th class="text-left px-6 py-4 text-xs font-medium text-csj-gray-500 uppercase tracking-wider hidden md:table-cell">Témoignage</th>
                <th class="text-left px-6 py-4 text-xs font-medium text-csj-gray-500 uppercase tracking-wider">Note</th>
                <th class="text-left px-6 py-4 text-xs font-medium text-csj-gray-500 uppercase tracking-wider">Statut</th>
                <th class="text-right px-6 py-4 text-xs font-medium text-csj-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-csj-gray-100">
            @forelse($testimonials as $testimonial)
            <tr class="hover:bg-csj-gray-50 transition-colors">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0">
                            @if($testimonial->photo)
                                <img src="{{ Storage::url($testimonial->photo) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center font-bold text-white text-sm" style="background-color: #2DB9B5;">
                                    {{ substr($testimonial->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <p class="font-medium text-csj-gray-900 text-sm">{{ $testimonial->name }}</p>
                            <span class="text-xs px-2 py-0.5 rounded-full font-medium" style="background-color: #8FD4D2; color: #1F2937;">
                                {{ $testimonial->role }}
                            </span>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 hidden md:table-cell">
                    <p class="text-csj-gray-500 text-sm line-clamp-2 max-w-xs">{{ $testimonial->content }}</p>
                </td>
                <td class="px-6 py-4">
                    <div class="flex gap-0.5">
                        @for($i = 0; $i < $testimonial->rating; $i++)
                        <svg class="w-4 h-4" style="color: #2DB9B5;" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        @endfor
                    </div>
                </td>
                <td class="px-6 py-4">
                    <span class="badge {{ $testimonial->is_active ? 'badge-green' : 'badge-gray' }}">
                        {{ $testimonial->is_active ? 'Actif' : 'Inactif' }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.testimonials.edit', $testimonial) }}"
                           class="text-csj-gray-400 hover:text-csj-blue-600 p-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                        <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST"
                              onsubmit="return confirm('Supprimer ce témoignage ?')">
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
                    Aucun témoignage pour le moment.
                    <a href="{{ route('admin.testimonials.create') }}" class="text-csj-blue-600 hover:underline ml-1">Ajouter le premier</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection