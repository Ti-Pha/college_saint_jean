@extends('layouts.app')

@section('title', 'Notre équipe')
@section('meta_description', 'Découvrez l\'équipe administrative du Collège Saint Jean des Cayes')

@section('content')

{{-- HERO --}}
<section class="bg-gradient-to-br from-csj-blue-900 to-csj-blue-700 text-white py-20">
    <div class="container-csj text-center">
        <span class="badge bg-white/20 text-white mb-4 inline-flex">Équipe</span>
        <h1 class="text-4xl lg:text-5xl font-heading font-bold text-white mb-4">
            Notre équipe administrative
        </h1>
        <p class="text-csj-blue-100 text-xl max-w-2xl mx-auto">
            Des professionnels dévoués au service de l'excellence éducative.
        </p>
    </div>
</section>

{{-- MEMBRES --}}
<section class="py-20 bg-csj-gray-50">
    <div class="container-csj">
        @if($members->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($members as $member)
                <div class="card p-8 text-center">
                    <div class="w-24 h-24 rounded-full overflow-hidden mx-auto mb-6 bg-csj-blue-100">
                        @if($member->photo)
                            <img src="{{ Storage::url($member->photo) }}"
                                 alt="{{ $member->name }}"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-csj-blue-200 to-csj-blue-400">
                                <span class="text-white font-heading font-bold text-2xl">
                                    {{ substr($member->name, 0, 1) }}
                                </span>
                            </div>
                        @endif
                    </div>
                    <h3 class="font-heading font-bold text-csj-gray-900 text-xl mb-1">{{ $member->name }}</h3>
                    <p class="text-csj-blue-600 font-medium text-sm mb-4">{{ $member->role }}</p>
                    @if($member->description)
                        <p class="text-csj-gray-500 text-sm leading-relaxed">{{ $member->description }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <p class="text-csj-gray-400 text-lg">Aucun membre de l'équipe pour le moment.</p>
            </div>
        @endif
    </div>
</section>

@endsection