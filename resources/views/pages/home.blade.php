@extends('layouts.app')

@section('title', 'Accueil')
@section('meta_description', 'Bienvenue au Collège Saint Jean des Cayes - Excellence académique et formation intégrale')

@section('content')

{{-- HERO SECTION --}}
<section class="relative overflow-hidden" x-data="carousel()">

    {{-- Images carousel --}}
    <div class="absolute inset-0 z-0">
        <template x-for="(image, index) in images" :key="index">
            <div x-show="current === index"
                 x-transition:enter="transition-opacity duration-1000"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity duration-1000"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                 :style="'background-image: url(' + image + ')'">
            </div>
        </template>
        {{-- Overlay --}}
        <div class="absolute inset-0 bg-csj-blue-900/75"></div>
        {{-- Cercles décoratifs --}}
        <div class="absolute top-0 right-0 w-96 h-96 bg-white opacity-5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-white opacity-5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
    </div>

    {{-- Contenu --}}
    <div class="container-csj py-24 lg:py-32 relative z-10 text-white text-center">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-3xl lg:text-5xl font-heading font-bold text-white leading-tight mb-6">
            Collège Saint Jean
            <span class="text-csj-blue-200">des Cayes</span>
        </h1>
        <p class="text-csj-blue-100 text-lg leading-relaxed mb-10 max-w-2xl mx-auto">
            Un établissement d'excellence dédié à la formation intégrale des jeunes,
            alliant rigueur académique, valeurs humaines et innovation pédagogique.
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('about') }}"
               class="px-8 py-3 rounded-lg font-medium transition-all duration-200 bg-white text-csj-blue-700 hover:bg-csj-blue-50">
                Découvrir l'école
            </a>
            <a href="{{ route('contact') }}"
               class="px-8 py-3 rounded-lg font-medium transition-all duration-200 text-white border-2 border-white hover:bg-white hover:text-csj-blue-700">
                Nous contacter
            </a>
        </div>
    </div>

    {{-- Indicateurs carousel --}}
    <div class="flex gap-2 mt-12 justify-center">
        <template x-for="(image, index) in images" :key="index">
            <button @click="current = index"
                    class="h-3 rounded-full transition-all duration-300"
                    :class="current === index ? 'bg-white w-8' : 'bg-white/40 w-3'">
            </button>
        </template>
    </div>
</div>
</section>

{{-- STATISTIQUES --}}
<section class="bg-white border-b border-csj-gray-100">
    <div class="container-csj py-12">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8" x-data="counters()">
            <div class="text-center">
                <p class="text-4xl font-heading font-bold mb-2" style="color: #0DCAF0;"
                   x-text="counts[0] + '+'"></p>
                <p class="text-csj-gray-500 text-sm font-medium">Élèves</p>
            </div>
            <div class="text-center">
                <p class="text-4xl font-heading font-bold mb-2" style="color: #0DCAF0;"
                   x-text="counts[1] + '+'"></p>
                <p class="text-csj-gray-500 text-sm font-medium">Professeurs</p>
            </div>
            <div class="text-center">
                <p class="text-4xl font-heading font-bold mb-2" style="color: #0DCAF0;"
                   x-text="counts[2] + '+'"></p>
                <p class="text-csj-gray-500 text-sm font-medium">Années d'expérience</p>
            </div>
            <div class="text-center">
                <p class="text-4xl font-heading font-bold mb-2" style="color: #0DCAF0;"
                   x-text="counts[3] + '%'"></p>
                <p class="text-csj-gray-500 text-sm font-medium">Taux de réussite</p>
            </div>
        </div>
    </div>
</section>


{{-- SECTION BLOG --}}
<section class="py-20 bg-csj-gray-50">
    <div class="container-csj">
        <div class="flex items-center justify-between mb-12">
            <div>
                <h2 class="section-title">Dernières actualités</h2>
                <p class="section-subtitle mb-0">Restez informés de la vie du collège</p>
            </div>
            <a href="{{ route('blog.index') }}" class="btn-secondary hidden md:inline-flex">
                Voir tout le blog
            </a>
        </div>

        @if($latestArticles->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($latestArticles as $article)
        <article class="card-hover flex flex-col">
            {{-- Image --}}
            <div class="h-40 bg-csj-blue-100 overflow-hidden">
                @if($article->image)
                    <img src="{{ Storage::url($article->image) }}"
                         alt="{{ $article->title }}"
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-csj-blue-100 to-csj-blue-200">
                        <svg class="w-10 h-10 text-csj-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                @endif
            </div>

            {{-- Contenu --}}
            <div class="p-4 flex flex-col flex-1">
                <div class="flex items-center gap-2 mb-2">
                    <span class="badge-blue text-xs">{{ $article->category->name }}</span>
                    <span class="text-csj-gray-400 text-xs">{{ $article->published_at->format('d M Y') }}</span>
                </div>
                <h3 class="font-heading font-semibold text-csj-gray-900 text-sm mb-2 line-clamp-2 hover:text-csj-blue-600 transition-colors">
                    <a href="{{ route('blog.show', $article->slug) }}">{{ $article->title }}</a>
                </h3>
                @if($article->excerpt)
                    <p class="text-csj-gray-500 text-xs leading-relaxed line-clamp-2 mb-3">{{ $article->excerpt }}</p>
                @endif
                <div class="flex items-center justify-between pt-3 border-t border-csj-gray-100 mt-auto">
                    <span class="text-csj-gray-400 text-xs">Par {{ $article->author->name }}</span>
                    <a href="{{ route('blog.show', $article->slug) }}"
                       class="text-csj-blue-600 text-xs font-medium hover:text-csj-blue-700 flex items-center gap-1">
                        Lire
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </article>
        @endforeach
    </div>
        @else
            <div class="text-center py-16">
                <p class="text-csj-gray-400 text-lg">Aucun article publié pour le moment.</p>
            </div>
        @endif

        <div class="text-center mt-10 md:hidden">
            <a href="{{ route('blog.index') }}" class="btn-primary">Voir tout le blog</a>
        </div>
    </div>
</section>

{{-- SECTION GALERIE --}}
<section class="py-20 bg-white">
    <div class="container-csj">
        <div class="flex items-center justify-between mb-12">
            <div>
                <h2 class="section-title">Notre galerie</h2>
                <p class="section-subtitle mb-0">Les moments forts de notre école</p>
            </div>
            <a href="{{ route('gallery.index') }}" class="btn-secondary hidden md:inline-flex">
                Voir toute la galerie
            </a>
        </div>

        @if($galleryCategories->count() > 0)
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($galleryCategories as $category)
                <a href="{{ route('gallery.show', $category->slug) }}"
                   class="group relative aspect-square bg-csj-blue-100 rounded-2xl overflow-hidden">
                    @php $featuredImage = $category->cover_image ?? $category->images->first()?->filename; @endphp
                    @if($featuredImage)
                        <img src="{{ Storage::url($featuredImage) }}"
                             alt="{{ $category->name }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-csj-blue-200 to-csj-blue-400 flex items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-4">
                        <div>
                            <p class="text-white font-heading font-semibold">{{ $category->name }}</p>
                            <p class="text-white/70 text-xs">{{ $category->images_count }} photo(s)</p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-16">
                <p class="text-csj-gray-400 text-lg">Aucune galerie disponible pour le moment.</p>
            </div>
        @endif
    </div>
</section>



{{-- TÉMOIGNAGES --}}
<section class="py-20 bg-white">
    <div class="container-csj">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="section-title">Ce qu'ils disent de nous</h2>
                <p class="text-csj-gray-500">Témoignages de notre communauté</p>
            </div>

            @if($testimonials->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($testimonials as $testimonial)
                <div class="card p-6 flex flex-col">
                    {{-- Étoiles --}}
                    <div class="flex gap-1 mb-4">
                        @for($i = 0; $i < $testimonial->rating; $i++)
                        <svg class="w-4 h-4" style="color: #0DCAF0;" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        @endfor
                    </div>
                    {{-- Témoignage --}}
                    <p class="text-sm leading-relaxed flex-1 mb-6" style="color: #4B5563;">
                        "{{ $testimonial->content }}"
                    </p>
                    {{-- Auteur --}}
                    <div class="flex items-center gap-3 pt-4 border-t border-csj-gray-100">
                        <div class="w-12 h-12 rounded-full overflow-hidden flex-shrink-0">
                            @if($testimonial->photo)
                                <img src="{{ Storage::url($testimonial->photo) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center font-bold text-white text-sm" style="background-color: #0DCAF0;">
                                    {{ substr($testimonial->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <p class="font-heading font-semibold text-sm" style="color: #1F2937;">{{ $testimonial->name }}</p>
                            <span class="text-xs px-2 py-0.5 rounded-full font-medium" style="background-color: #0DCAF0; color: #1F2937;">
                                {{ $testimonial->role }}
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
                <p class="text-center text-csj-gray-400">Aucun témoignage pour le moment.</p>
            @endif
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
function carousel() {
    return {
        current: 0,
        interval: null,
        images: [
            '{{ asset("images/hero1.jpg") }}',
            '{{ asset("images/hero2.jpg") }}',
            '{{ asset("images/hero3.jpg") }}',
            '{{ asset("images/hero4.jpeg") }}',
            '{{ asset("images/hero5.jpg") }}',
            '{{ asset("images/hero6.jpg") }}',
        ],
        init() {
            this.interval = setInterval(() => {
                this.current = (this.current + 1) % this.images.length;
            }, 5000);
        },
    }
}

function counters() {
    return {
        counts: [0, 0, 0, 0],
        targets: [1000, 30, 50, 98],
        init() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        this.targets.forEach((target, i) => {
                            let start = 0;
                            const duration = 2000;
                            const step = target / (duration / 16);
                            const timer = setInterval(() => {
                                start += step;
                                if (start >= target) {
                                    this.counts[i] = target;
                                    clearInterval(timer);
                                } else {
                                    this.counts[i] = Math.floor(start);
                                }
                            }, 16);
                        });
                        observer.disconnect();
                    }
                });
            });
            observer.observe(this.$el);
        }
    }
}
</script>
@endpush