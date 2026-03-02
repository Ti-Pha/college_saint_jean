@extends('layouts.app')

@section('title', 'À propos')
@section('meta_description', 'Découvrez l\'histoire et la mission du Collège Saint Jean des Cayes')

@section('content')

{{-- HERO --}}
<section class="bg-gradient-to-br from-csj-blue-900 to-csj-blue-700 text-white py-20">
    <div class="container-csj text-center">
        <span class="badge bg-white/20 text-white mb-4 inline-flex">À propos</span>
        <h1 class="text-4xl lg:text-5xl font-heading font-bold text-white mb-4">
            Notre histoire
        </h1>
        <p class="text-csj-blue-100 text-xl max-w-2xl mx-auto">
            Découvrez l'histoire, la mission et les valeurs du Collège Saint Jean des Cayes.
        </p>
    </div>
</section>

{{-- MISSION + VISION --}}
<section class="py-20 bg-white">
    <div class="container-csj">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-stretch mb-20">

            {{-- Mission --}}
            <div class="card p-10" style="box-shadow: 0 0 20px rgba(13, 202, 240, 0.2); border: 1px solid rgba(13, 202, 240, 0.3);">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-6" style="background-color: #0DCAF0;">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h3 class="font-heading font-bold text-csj-gray-900 text-2xl mb-4">Notre mission</h3>
                <p class="text-csj-gray-600 leading-relaxed mb-4">
                    Le Collège Saint Jean des Cayes est un établissement d'enseignement
                    secondaire fondé avec la mission de former des jeunes citoyens compétents,
                    responsables et engagés dans leur communauté.
                </p>
                <p class="text-csj-gray-600 leading-relaxed">
                    Notre approche pédagogique combine excellence académique, développement
                    personnel et valeurs chrétiennes pour préparer nos élèves aux défis
                    du monde moderne.
                </p>
            </div>

            {{-- Vision --}}
            <div class="card p-10" style="box-shadow: 0 0 20px rgba(13, 202, 240, 0.2); border: 1px solid rgba(13, 202, 240, 0.3);">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-6" style="background-color: #0DCAF0;">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
                <h3 class="font-heading font-bold text-csj-gray-900 text-2xl mb-4">Notre vision</h3>
                <p class="text-csj-gray-600 leading-relaxed mb-4">
                    Être reconnu comme un établissement d'excellence en Haïti, formant des leaders
                    capables de contribuer positivement au développement de leur pays et de la société.
                </p>
                <p class="text-csj-gray-600 leading-relaxed">
                    Nous aspirons à offrir un environnement d'apprentissage stimulant où chaque
                    élève peut développer son plein potentiel intellectuel, moral et social.
                </p>
            </div>
        </div>

        {{-- Valeurs --}}
        <div class="text-center mb-12">
            <h2 class="section-title">Nos valeurs</h2>
            <p class="section-subtitle">Les principes qui guident notre établissement</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <div class="card p-8 text-center group hover:-translate-y-2 transition-all duration-300"
                 style="box-shadow: 0 0 20px rgba(13, 202, 240, 0.2); border: 1px solid rgba(13, 202, 240, 0.3);">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-5 group-hover:scale-110 transition-transform duration-300" style="background-color: #0DCAF0;">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
                <h3 class="font-heading font-bold text-csj-gray-900 text-xl mb-3">Excellence</h3>
                <p class="text-csj-gray-500 leading-relaxed">Nous visons l'excellence académique et personnelle pour chaque élève.</p>
            </div>

            <div class="card p-8 text-center group hover:-translate-y-2 transition-all duration-300"
                 style="box-shadow: 0 0 20px rgba(13, 202, 240, 0.2); border: 1px solid rgba(13, 202, 240, 0.3);">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-5 group-hover:scale-110 transition-transform duration-300" style="background-color: #0DCAF0;">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="font-heading font-bold text-csj-gray-900 text-xl mb-3">Intégrité</h3>
                <p class="text-csj-gray-500 leading-relaxed">Nous cultivons l'honnêteté, le respect et la responsabilité.</p>
            </div>

            <div class="card p-8 text-center group hover:-translate-y-2 transition-all duration-300"
                 style="box-shadow: 0 0 20px rgba(13, 202, 240, 0.2); border: 1px solid rgba(13, 202, 240, 0.3);">
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-5 group-hover:scale-110 transition-transform duration-300" style="background-color: #0DCAF0;">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                </div>
                <h3 class="font-heading font-bold text-csj-gray-900 text-xl mb-3">Innovation</h3>
                <p class="text-csj-gray-500 leading-relaxed">Nous adoptons des méthodes pédagogiques modernes et adaptées.</p>
            </div>

        </div>
    </div>
</section>

@endsection