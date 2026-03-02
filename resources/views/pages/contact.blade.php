@extends('layouts.app')

@section('title', 'Contact')
@section('meta_description', 'Contactez le Collège Saint Jean des Cayes')

@section('content')

{{-- HERO --}}
<section class="bg-gradient-to-br from-csj-blue-900 to-csj-blue-700 text-white py-20">
    <div class="container-csj text-center">
        <span class="badge bg-white/20 text-white mb-4 inline-flex">Contact</span>
        <h1 class="text-4xl lg:text-5xl font-heading font-bold text-white mb-4">
            Contactez-nous
        </h1>
        <p class="text-csj-blue-100 text-xl max-w-2xl mx-auto">
            Notre équipe est disponible pour répondre à toutes vos questions.
        </p>
    </div>
</section>

{{-- CONTENU --}}
<section class="py-20 bg-csj-gray-50">
    <div class="container-csj">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            {{-- Informations --}}
            <div class="space-y-6">
                <div class="card p-6">
                    <div class="w-12 h-12 bg-csj-blue-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-csj-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-heading font-semibold text-csj-gray-900 mb-2">Adresse</h3>
                    <p class="text-csj-gray-500 text-sm">1, rue des Oblats, Gabions des Indigènes, Les Cayes, Haïti​</p>
                </div>

                <div class="card p-6">
                    <div class="w-12 h-12 bg-csj-blue-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-csj-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="font-heading font-semibold text-csj-gray-900 mb-2">Email</h3>
                    <p class="text-csj-gray-500 text-sm">info@csjcayes.com</p>
                </div>

                <div class="card p-6">
                    <div class="w-12 h-12 bg-csj-blue-100 rounded-xl flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-csj-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-heading font-semibold text-csj-gray-900 mb-2">Horaires</h3>
                    <p class="text-csj-gray-500 text-sm">Lundi - Vendredi : 7h00 - 14h00</p>
                </div>
            </div>

            {{-- Formulaire --}}
            <div class="lg:col-span-2">
                <div class="card p-8">
                    <h2 class="font-heading font-bold text-csj-gray-900 text-2xl mb-6">
                        Envoyer un message
                    </h2>

                    @if(session('success'))
                        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-csj-gray-700 mb-2">
                                    Nom complet <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                       class="input-field @error('name') border-red-400 @enderror"
                                       placeholder="Votre nom">
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-csj-gray-700 mb-2">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                       class="input-field @error('email') border-red-400 @enderror"
                                       placeholder="votre@email.com">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-csj-gray-700 mb-2">
                                Sujet
                            </label>
                            <input type="text" name="subject" value="{{ old('subject') }}"
                                   class="input-field"
                                   placeholder="Sujet de votre message">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-csj-gray-700 mb-2">
                                Message <span class="text-red-500">*</span>
                            </label>
                            <textarea name="message" rows="6"
                                      class="input-field resize-none @error('message') border-red-400 @enderror"
                                      placeholder="Votre message...">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn-primary w-full justify-center">
                            Envoyer le message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection