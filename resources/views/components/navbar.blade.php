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
                        <a href="{{ route('admin.dashboard') }}" class="btn-primary text-sm py-2">
                            Tableau de bord
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-secondary text-sm py-2">
                            Déconnexion
                        </button>
                    </form>
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