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

{{-- CONTENU --}}
<section class="py-20 bg-white">
    <div class="container-csj">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-20">
            <div>
                <h2 class="section-title">Notre mission</h2>
                <p class="text-csj-gray-600 leading-relaxed mb-6">
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
            <div class="bg-gradient-to-br from-csj-blue-50 to-csj-blue-100 rounded-3xl p-10 text-center">
                <div class="w-20 h-20 bg-csj-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <span class="text-white font-heading font-bold text-3xl">CSJ</span>
                </div>
                <h3 class="font-heading font-bold text-csj-gray-900 text-2xl mb-2">Collège Saint Jean</h3>
                <p class="text-csj-blue-600 font-medium">des Cayes, Haïti</p>
            </div>
        </div>

        {{-- Valeurs --}}
        <div class="text-center mb-12">
            <h2 class="section-title">Nos valeurs</h2>
            <p class="section-subtitle">Les principes qui guident notre établissement</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['icon' => '🎓', 'title' => 'Excellence', 'desc' => 'Nous visons l\'excellence académique et personnelle pour chaque élève.'],
                ['icon' => '🤝', 'title' => 'Intégrité', 'desc' => 'Nous cultivons l\'honnêteté, le respect et la responsabilité.'],
                ['icon' => '🌟', 'title' => 'Innovation', 'desc' => 'Nous adoptons des méthodes pédagogiques modernes et adaptées.'],
            ] as $valeur)
            <div class="card p-8 text-center">
                <div class="text-5xl mb-4">{{ $valeur['icon'] }}</div>
                <h3 class="font-heading font-bold text-csj-gray-900 text-xl mb-3">{{ $valeur['title'] }}</h3>
                <p class="text-csj-gray-500 leading-relaxed">{{ $valeur['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection