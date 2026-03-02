@extends('layouts.app')

@section('title', 'Code de conduite')
@section('meta_description', 'Code de conduite et règlement intérieur du Collège Saint Jean des Cayes')

@section('content')

{{-- HERO --}}
<section class="bg-gradient-to-br from-csj-blue-900 to-csj-blue-700 text-white py-20">
    <div class="container-csj text-center">
        <span class="badge bg-white/20 text-white mb-4 inline-flex">Règlement</span>
        <h1 class="text-4xl lg:text-5xl font-heading font-bold text-white mb-4">
            Code de conduite
        </h1>
        <p class="text-csj-blue-100 text-xl max-w-2xl mx-auto">
            Les règles et valeurs qui régissent la vie au sein de notre établissement.
        </p>
    </div>
</section>

{{-- CONTENU --}}
<section class="py-20 bg-white">
    <div class="container-csj max-w-4xl">

        <div class="max-w-3xl mx-auto space-y-3" x-data="{ open: null }">

    @foreach([
        ['num' => 1, 'title' => 'Respect et discipline', 'items' => [
            'Respecter les enseignants, le personnel et les autres élèves.',
            "Respecter les horaires d'entrée et de sortie de l'établissement.",
            'Maintenir une tenue vestimentaire correcte et conforme au règlement.',
        ]],
        ['num' => 2, 'title' => 'Engagement académique', 'items' => [
            'Assister à tous les cours et participer activement.',
            'Remettre les devoirs et travaux dans les délais impartis.',
            'Interdiction formelle de toute forme de triche ou plagiat.',
        ]],
        ['num' => 3, 'title' => 'Vie en communauté', 'items' => [
            'Prendre soin des installations et du matériel scolaire.',
            'Favoriser un environnement sain, inclusif et bienveillant.',
            'Toute forme de violence ou harcèlement est strictement interdite.',
        ]],
    ] as $section)

    <div class="bg-white rounded-2xl overflow-hidden"
         style="border: 1px solid rgba(13, 202, 240, 0.3); box-shadow: 0 0 15px rgba(13, 202, 240, 0.1);">

        {{-- Header --}}
        <button type="button"
                @click="open === {{ $section['num'] }} ? open = null : open = {{ $section['num'] }}"
                class="w-full flex items-center justify-between px-6 py-4 text-left hover:bg-csj-gray-50 transition-colors">
            <div class="flex items-center gap-4">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white font-bold text-sm flex-shrink-0"
                     style="background-color: #0DCAF0;">
                    {{ $section['num'] }}
                </div>
                <span class="font-heading font-bold text-csj-gray-900">{{ $section['title'] }}</span>
            </div>
            <svg class="w-5 h-5 text-csj-gray-400 transition-transform duration-300"
                 :class="open === {{ $section['num'] }} ? 'rotate-180' : ''"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>

        {{-- Contenu --}}
        <div x-show="open === {{ $section['num'] }}"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="px-6 pb-5 border-t border-csj-gray-100">
            <ul class="mt-4 space-y-3">
                @foreach($section['items'] as $item)
                <li class="flex items-start gap-3 text-sm" style="color: #6C757D;">
                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0" style="color: #0DCAF0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ $item }}
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    @endforeach

</div>


        <div class="text-center mt-8">
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
    </div>
</section>

@endsection