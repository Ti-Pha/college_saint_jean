@extends('layouts.app')

@section('title', 'Code de conduite')
@section('meta_description', 'Code de conduite et règlement intérieur du Collège Saint Jean des Cayes')

@section('content')

{{-- HERO --}}
<section class="bg-gradient-to-br from-csj-blue-900 to-csj-blue-700 text-white py-20">
    <div class="container-csj">
        <span class="badge bg-white/20 text-white mb-4 inline-flex">Règlement</span>
        <h1 class="text-4xl lg:text-5xl font-heading font-bold text-white mb-4">
            Code de conduite
        </h1>
        <p class="text-csj-blue-100 text-xl max-w-2xl">
            Les règles et valeurs qui régissent la vie au sein de notre établissement.
        </p>
    </div>
</section>

{{-- CONTENU --}}
<section class="py-20 bg-white">
    <div class="container-csj max-w-4xl">

        <div class="card p-10 mb-8">
            <h2 class="font-heading font-bold text-csj-gray-900 text-2xl mb-6 flex items-center gap-3">
                <span class="w-10 h-10 bg-csj-blue-100 rounded-xl flex items-center justify-center text-csj-blue-600 font-bold">1</span>
                Respect et discipline
            </h2>
            <ul class="space-y-3 text-csj-gray-600">
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-csj-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Respecter les enseignants, le personnel et les autres élèves.
                </li>
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-csj-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Respecter les horaires d'entrée et de sortie de l'établissement.
                </li>
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-csj-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Maintenir une tenue vestimentaire correcte et conforme au règlement.
                </li>
            </ul>
        </div>

        <div class="card p-10 mb-8">
            <h2 class="font-heading font-bold text-csj-gray-900 text-2xl mb-6 flex items-center gap-3">
                <span class="w-10 h-10 bg-csj-blue-100 rounded-xl flex items-center justify-center text-csj-blue-600 font-bold">2</span>
                Engagement académique
            </h2>
            <ul class="space-y-3 text-csj-gray-600">
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-csj-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Assister à tous les cours et participer activement.
                </li>
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-csj-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Remettre les devoirs et travaux dans les délais impartis.
                </li>
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-csj-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Interdiction formelle de toute forme de triche ou plagiat.
                </li>
            </ul>
        </div>

        <div class="card p-10 mb-10">
            <h2 class="font-heading font-bold text-csj-gray-900 text-2xl mb-6 flex items-center gap-3">
                <span class="w-10 h-10 bg-csj-blue-100 rounded-xl flex items-center justify-center text-csj-blue-600 font-bold">3</span>
                Vie en communauté
            </h2>
            <ul class="space-y-3 text-csj-gray-600">
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-csj-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Prendre soin des installations et du matériel scolaire.
                </li>
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-csj-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Favoriser un environnement sain, inclusif et bienveillant.
                </li>
                <li class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-csj-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Toute forme de violence ou harcèlement est strictement interdite.
                </li>
            </ul>
        </div>

        {{-- Bouton téléchargement PDF (à activer plus tard) --}}
        @php $pdfExists = Storage::disk('public')->exists('conduct/code-de-conduite.pdf'); @endphp

        @if($pdfExists)
            <a href="{{ Storage::url('conduct/code-de-conduite.pdf') }}"
            download
            class="btn-primary inline-flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Télécharger en PDF
            </a>
        @else
            <button disabled class="btn-primary opacity-50 cursor-not-allowed inline-flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                Télécharger en PDF
            </button>
            <p class="text-csj-gray-400 text-sm mt-2">Disponible prochainement</p>
        @endif
    </div>
</section>

@endsection