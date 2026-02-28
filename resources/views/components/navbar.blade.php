<nav class="bg-white shadow-sm border-b border-csj-gray-100 sticky top-0 z-40" x-data="{ open: false }">
    <div class="container-csj">
        <div class="flex items-center justify-between h-20">

            {{-- LOGO --}}
            <a href="{{ url('/') }}">
    <img src="{{ asset('images/logo.png') }}" alt="Collège Saint Jean des Cayes" class="h-12 w-auto">
</a>

            {{-- NAVIGATION DESKTOP --}}
            <div class="hidden lg:flex items-center gap-1">
                <a href="{{ url('/') }}"
                   class="px-4 py-2 rounded-lg text-csj-gray-700 hover:text-csj-blue-600 hover:bg-csj-blue-50 font-medium text-sm transition-all duration-200 {{ request()->is('/') ? 'text-csj-blue-600 bg-csj-blue-50' : '' }}">
                    Accueil
                </a>
                <a href="{{ route('about') }}"
                   class="px-4 py-2 rounded-lg text-csj-gray-700 hover:text-csj-blue-600 hover:bg-csj-blue-50 font-medium text-sm transition-all duration-200 {{ request()->routeIs('about') ? 'text-csj-blue-600 bg-csj-blue-50' : '' }}">
                    À propos
                </a>
                <a href="{{ route('team') }}"
                   class="px-4 py-2 rounded-lg text-csj-gray-700 hover:text-csj-blue-600 hover:bg-csj-blue-50 font-medium text-sm transition-all duration-200 {{ request()->routeIs('team') ? 'text-csj-blue-600 bg-csj-blue-50' : '' }}">
                    Équipe
                </a>
                <a href="{{ route('blog.index') }}"
                   class="px-4 py-2 rounded-lg text-csj-gray-700 hover:text-csj-blue-600 hover:bg-csj-blue-50 font-medium text-sm transition-all duration-200 {{ request()->routeIs('blog.*') ? 'text-csj-blue-600 bg-csj-blue-50' : '' }}">
                    Blog
                </a>
                <a href="{{ route('gallery.index') }}"
                   class="px-4 py-2 rounded-lg text-csj-gray-700 hover:text-csj-blue-600 hover:bg-csj-blue-50 font-medium text-sm transition-all duration-200 {{ request()->routeIs('gallery.*') ? 'text-csj-blue-600 bg-csj-blue-50' : '' }}">
                    Galerie
                </a>
                <a href="{{ route('conduct') }}"
                   class="px-4 py-2 rounded-lg text-csj-gray-700 hover:text-csj-blue-600 hover:bg-csj-blue-50 font-medium text-sm transition-all duration-200 {{ request()->routeIs('conduct') ? 'text-csj-blue-600 bg-csj-blue-50' : '' }}">
                    Code de conduite
                </a>
                <a href="{{ route('contact') }}"
                   class="px-4 py-2 rounded-lg text-csj-gray-700 hover:text-csj-blue-600 hover:bg-csj-blue-50 font-medium text-sm transition-all duration-200 {{ request()->routeIs('contact') ? 'text-csj-blue-600 bg-csj-blue-50' : '' }}">
                    Contact
                </a>
            </div>

            {{-- BOUTONS AUTH --}}
            <div class="hidden lg:flex items-center gap-3">
                @auth
    @if(auth()->user()->hasAnyRole(['admin', 'directeur', 'secretaire']))
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" class="flex items-center gap-2 focus:outline-none">
                <div class="w-9 h-9 rounded-full overflow-hidden flex-shrink-0">
                    @if(auth()->user()->avatar)
                        <img src="{{ Storage::url(auth()->user()->avatar) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-9 h-9 rounded-full flex items-center justify-center text-white font-bold text-sm" style="background-color: #0DCAF0;">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                    @endif
                </div>
                <span class="text-sm font-medium text-csj-gray-700 hidden md:block">{{ auth()->user()->name }}</span>
                <svg class="w-4 h-4 text-csj-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="open" @click.outside="open = false"
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-csj-gray-100 z-50 overflow-hidden"
                 style="top: 100%;">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 text-sm text-csj-gray-700 hover:bg-csj-gray-50">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Tableau de bord
                </a>
                <a href="{{ route('admin.profile.edit') }}"
                   class="flex items-center gap-3 px-4 py-3 text-sm text-csj-gray-700 hover:bg-csj-gray-50">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Mon profil
                </a>
                <div class="border-t border-csj-gray-100"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-500 hover:bg-red-50">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Déconnexion
                    </button>
                </form>
            </div>
        </div>
    @endif
@else
    <a href="{{ route('login') }}" class="btn-primary text-sm py-2">
        Connexion
    </a>
@endauth
            </div>

            {{-- BURGER MENU MOBILE --}}
            <button @click="open = !open" class="lg:hidden p-2 rounded-lg text-csj-gray-700 hover:bg-csj-gray-100">
                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- MENU MOBILE --}}
        <div x-show="open" x-transition class="lg:hidden border-t border-csj-gray-100 py-4 space-y-1">
            <a href="{{ url('/') }}" class="block px-4 py-3 rounded-lg text-csj-gray-700 hover:bg-csj-blue-50 hover:text-csj-blue-600 font-medium">Accueil</a>
            <a href="{{ route('about') }}" class="block px-4 py-3 rounded-lg text-csj-gray-700 hover:bg-csj-blue-50 hover:text-csj-blue-600 font-medium">À propos</a>
            <a href="{{ route('team') }}" class="block px-4 py-3 rounded-lg text-csj-gray-700 hover:bg-csj-blue-50 hover:text-csj-blue-600 font-medium">Équipe</a>
            <a href="{{ route('blog.index') }}" class="block px-4 py-3 rounded-lg text-csj-gray-700 hover:bg-csj-blue-50 hover:text-csj-blue-600 font-medium">Blog</a>
            <a href="{{ route('gallery.index') }}" class="block px-4 py-3 rounded-lg text-csj-gray-700 hover:bg-csj-blue-50 hover:text-csj-blue-600 font-medium">Galerie</a>
            <a href="{{ route('conduct') }}" class="block px-4 py-3 rounded-lg text-csj-gray-700 hover:bg-csj-blue-50 hover:text-csj-blue-600 font-medium">Code de conduite</a>
            <a href="{{ route('contact') }}" class="block px-4 py-3 rounded-lg text-csj-gray-700 hover:bg-csj-blue-50 hover:text-csj-blue-600 font-medium">Contact</a>
            @auth
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-lg bg-csj-blue-600 text-white font-medium text-center mt-2">Tableau de bord</a>
            @else
                <a href="{{ route('login') }}" class="block px-4 py-3 rounded-lg bg-csj-blue-600 text-white font-medium text-center mt-2">Connexion</a>
            @endauth
        </div>
    </div>
</nav>