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

{{-- RAISONS --}}
<section class="py-20 bg-csj-gray-50">
    <div class="container-csj">
        <div class="text-center mb-12">
            <h2 class="section-title">Raisons pour lesquelles nous sommes meilleurs</h2>
            <p class="section-subtitle">Ce qui fait la différence au Collège Saint Jean des Cayes</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
            @foreach([
                ['icon' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17H3a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2h-2', 'title' => "Qualité de l'enseignement", 'desc' => 'Des enseignants qualifiés et passionnés qui utilisent des méthodes pédagogiques efficaces'],
                ['icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'title' => 'Ressources pédagogiques', 'desc' => 'Des installations modernes, des bibliothèques bien fournies, et des technologies de pointe'],
                ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'title' => 'Soutien aux élèves', 'desc' => 'Un accompagnement personnalisé pour aider les élèves à surmonter les défis académiques'],
                ['icon' => 'M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z', 'title' => 'Réputation et résultats', 'desc' => "Une école reconnue pour ses excellents résultats académiques et ses anciens élèves qui réussissent dans divers domaines"],
                ['icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'title' => 'Préparation à la vie professionnelle', 'desc' => 'Des programmes qui préparent les élèves aux défis du marché du travail, incluant des stages et des formations pratiques'],
                ['icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'title' => 'Engagement communautaire', 'desc' => "Des initiatives qui encouragent les élèves à s'impliquer dans leur communauté et à développer un sens de la responsabilité sociale"],
                ['icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'title' => 'Programmes académiques diversifiés', 'desc' => 'Une offre variée de programmes qui répondent aux intérêts et aux besoins des élèves'],
                ['icon' => 'M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => 'Activités parascolaires', 'desc' => 'Activités sportives, artistiques et culturelles pour développer les talents des élèves'],
                ['icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'title' => 'Environnement inclusif', 'desc' => 'Une culture de tolérance et de respect où chaque élève se sent valorisé et accepté'],
            ] as $item)
            <div class="bg-white rounded-2xl p-6 text-center hover:-translate-y-2 transition-all duration-300 group cursor-default"
                 style="box-shadow: 0 0 20px rgba(13, 202, 240, 0.15); border: 1px solid rgba(13, 202, 240, 0.3);">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-5 mx-auto transition-all duration-300 group-hover:scale-110"
                     style="background-color: #0DCAF0;">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                    </svg>
                </div>
                <h3 class="font-heading font-bold text-base mb-3" style="color: #1F2937;">{{ $item['title'] }}</h3>
                <p class="text-sm leading-relaxed" style="color: #6C757D;">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection