@extends('layouts.app')
@section('title', 'Page introuvable')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-csj-gray-50">
    <div class="text-center">
        <h1 class="text-8xl font-heading font-bold text-csj-blue-600 mb-4">404</h1>
        <h2 class="text-2xl font-heading font-semibold text-csj-gray-900 mb-4">Page introuvable</h2>
        <p class="text-csj-gray-500 mb-8">La page que vous cherchez n'existe pas.</p>
        <a href="{{ url('/') }}" class="btn-primary">Retour à l'accueil</a>
    </div>
</div>
@endsection