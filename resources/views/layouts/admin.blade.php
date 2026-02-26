<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Administration') | CSJ Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-csj-gray-50" x-data="{ sidebarOpen: false }">

    {{-- SIDEBAR --}}
    <aside class="fixed inset-y-0 left-0 w-64 bg-csj-gray-900 text-white z-50 transform transition-transform duration-300 flex flex-col"
       :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">

        {{-- Logo --}}
        <div class="flex items-center gap-3 px-6 py-5 border-b border-csj-gray-700">
            <div class="w-10 h-10 bg-csj-blue-600 rounded-xl flex items-center justify-center">
                <span class="text-white font-heading font-bold">CSJ</span>
            </div>
            <div>
                <p class="font-heading font-bold text-white text-sm">Administration</p>
                <p class="text-csj-gray-400 text-xs">Collège Saint Jean</p>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="px-4 py-6 space-y-1 overflow-y-auto flex-1 pb-6">

            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-csj-blue-600 text-white' : 'text-csj-gray-300 hover:bg-csj-gray-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Tableau de bord
            </a>

            <div class="pt-4 pb-2">
                <p class="text-csj-gray-500 text-xs font-medium uppercase tracking-wider px-4">Blog</p>
            </div>

            <a href="{{ route('admin.articles.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.articles.*') ? 'bg-csj-blue-600 text-white' : 'text-csj-gray-300 hover:bg-csj-gray-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
                Articles
                @php $drafts = \App\Models\Article::where('status','draft')->count() @endphp
                @if($drafts > 0)
                    <span class="ml-auto badge bg-csj-blue-500 text-white">{{ $drafts }}</span>
                @endif
            </a>

            <a href="{{ route('admin.comments.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.comments.*') ? 'bg-csj-blue-600 text-white' : 'text-csj-gray-300 hover:bg-csj-gray-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                Commentaires
                @php $pending = \App\Models\Comment::where('is_approved', false)->count() @endphp
                @if($pending > 0)
                    <span class="ml-auto badge bg-red-500 text-white">{{ $pending }}</span>
                @endif
            </a>

            <div class="pt-4 pb-2">
                <p class="text-csj-gray-500 text-xs font-medium uppercase tracking-wider px-4">Médias</p>
            </div>

            <a href="{{ route('admin.gallery.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.gallery.*') ? 'bg-csj-blue-600 text-white' : 'text-csj-gray-300 hover:bg-csj-gray-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Galerie
            </a>

            <div class="pt-4 pb-2">
                <p class="text-csj-gray-500 text-xs font-medium uppercase tracking-wider px-4">Gestion</p>
            </div>

            <a href="{{ route('admin.team.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.team.*') ? 'bg-csj-blue-600 text-white' : 'text-csj-gray-300 hover:bg-csj-gray-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Équipe
            </a>

            <a href="{{ route('admin.testimonials.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.testimonials.*') ? 'bg-csj-blue-600 text-white' : 'text-csj-gray-300 hover:bg-csj-gray-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                Témoignages
            </a>

            <a href="{{ route('admin.conduct.index') }}"
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.conduct.*') ? 'bg-csj-blue-600 text-white' : 'text-csj-gray-300 hover:bg-csj-gray-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Code de conduite
            </a>

            <a href="{{ route('admin.messages.index') }}"
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-colors {{ request()->routeIs('admin.messages.*') ? 'bg-csj-blue-600 text-white' : 'text-csj-gray-300 hover:bg-csj-gray-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Messages
                @php $unread = \App\Models\ContactMessage::where('is_read', false)->count() @endphp
                @if($unread > 0)
                    <span class="ml-auto badge bg-red-500 text-white">{{ $unread }}</span>
                @endif
            </a>
        </nav>

        {{-- User info --}}
        {{-- User info --}}
<div class="absolute bottom-0 left-0 right-0 p-4 border-t border-csj-gray-700">
    <p class="text-csj-gray-400 text-xs text-center">Collège Saint Jean des Cayes</p>
</div>
    </aside>

    {{-- OVERLAY MOBILE --}}
    <div x-show="sidebarOpen" @click="sidebarOpen = false"
         class="fixed inset-0 bg-black/50 z-40 lg:hidden"></div>

    {{-- CONTENU PRINCIPAL --}}
    <div class="lg:ml-64 min-h-screen">

        {{-- TOPBAR --}}
<header class="bg-white border-b border-csj-gray-200 px-6 py-4 flex items-center justify-between sticky top-0 z-30">
    <div class="flex items-center gap-4">
        <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-csj-gray-500 hover:text-csj-gray-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
        <h1 class="font-heading font-semibold text-csj-gray-900">@yield('page_title', 'Tableau de bord')</h1>
    </div>

    {{-- Droite : user info + actions --}}
    <div class="flex items-center gap-4">

        {{-- Badge messages non lus --}}
        @php $unread = \App\Models\ContactMessage::where('is_read', false)->count() @endphp
        @if($unread > 0)
            <a href="{{ route('admin.messages.index') }}"
               class="relative flex items-center gap-2 text-sm text-csj-gray-600 hover:text-csj-blue-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span class="absolute -top-2 -right-2 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">
                    {{ $unread }}
                </span>
            </a>
        @endif

        {{-- Voir le site --}}
<a href="{{ url('/') }}" target="_blank"
   class="text-xs px-3 py-2 rounded-lg border border-csj-gray-200 text-csj-gray-600 hover:text-csj-blue-600 hover:border-csj-blue-300 transition-colors hidden md:block">
    Voir le site
</a>

{{-- Dropdown profil --}}
<div class="relative" x-data="{ open: false }">
    <button @click="open = !open" class="flex items-center gap-2 focus:outline-none">
        <div class="w-9 h-9 rounded-full flex items-center justify-center" style="background-color: #2DB9B5;">
            <span class="text-white font-bold text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
        </div>
        <div class="hidden md:block text-left">
            <p class="text-sm font-medium text-csj-gray-900 leading-none">{{ auth()->user()->name }}</p>
            <p class="text-xs text-csj-gray-400">{{ auth()->user()->getRoleNames()->first() }}</p>
        </div>
        <svg class="w-4 h-4 text-csj-gray-400 hidden md:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>

    {{-- Menu dropdown --}}
    <div x-show="open" @click.outside="open = false"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-csj-gray-100 z-50 overflow-hidden"
         style="top: 100%;">
        <a href="{{ route('admin.profile.edit') }}"
           class="flex items-center gap-3 px-4 py-3 text-sm text-csj-gray-700 hover:bg-csj-gray-50 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            Mon profil
        </a>
        <div class="border-t border-csj-gray-100"></div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                    class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-500 hover:bg-red-50 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Déconnexion
            </button>
        </form>
    </div>
</div>
    </div>

    {{-- Flash messages --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
             class="fixed top-4 right-4 z-50 bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg text-sm flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
             class="fixed top-4 right-4 z-50 bg-red-500 text-white px-6 py-3 rounded-xl shadow-lg text-sm">
            {{ session('error') }}
        </div>
    @endif
</header>

        {{-- PAGE CONTENT --}}
        <main class="p-6">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>