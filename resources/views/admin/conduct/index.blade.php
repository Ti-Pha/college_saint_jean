@extends('layouts.admin')

@section('title', 'Code de conduite')
@section('page_title', 'Code de conduite — PDF')

@section('content')

<div class="max-w-lg">
    <div class="card p-8 space-y-6">

        {{-- Statut actuel --}}
        <div class="flex items-center gap-3 p-4 rounded-xl {{ $pdf ? 'bg-green-50 border border-green-200' : 'bg-csj-gray-50 border border-csj-gray-200' }}">
            <svg class="w-8 h-8 {{ $pdf ? 'text-green-500' : 'text-csj-gray-300' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <div>
                <p class="font-medium text-sm {{ $pdf ? 'text-green-700' : 'text-csj-gray-500' }}">
                    {{ $pdf ? 'PDF disponible' : 'Aucun PDF uploadé' }}
                </p>
                @if($pdf)
                    <a href="{{ Storage::url('conduct/code-de-conduite.pdf') }}"
                       target="_blank"
                       class="text-xs text-green-600 hover:underline">
                        Voir le PDF actuel
                    </a>
                @endif
            </div>
        </div>

        {{-- Upload --}}
        <form action="{{ route('admin.conduct.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-csj-gray-700 mb-2">
                    {{ $pdf ? 'Remplacer le PDF' : 'Uploader le PDF' }}
                </label>
                <input type="file" name="pdf" accept="application/pdf"
                       class="block w-full text-sm text-csj-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-csj-blue-50 file:text-csj-blue-700 hover:file:bg-csj-blue-100">
                <p class="text-csj-gray-400 text-xs mt-1">Format PDF uniquement. Max 10 Mo.</p>
                @error('pdf') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="btn-primary w-full justify-center">
                Uploader le PDF
            </button>
        </form>

        {{-- Supprimer --}}
        @if($pdf)
        <form action="{{ route('admin.conduct.destroy') }}" method="POST"
              onsubmit="return confirm('Supprimer le PDF ?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn-danger w-full justify-center">
                Supprimer le PDF
            </button>
        </form>
        @endif

    </div>
</div>

@endsection