@extends('layouts.app')

@section('title', $article->title)
@section('meta_description', $article->excerpt)

@section('content')

<section class="py-16 bg-white">
    <div class="container-csj">
        <div class="flex flex-col lg:flex-row gap-12">

            {{-- Article principal --}}
            <article class="flex-1 max-w-3xl">

                {{-- Breadcrumb --}}
                <nav class="flex items-center gap-2 text-sm text-csj-gray-400 mb-8">
                    <a href="{{ route('blog.index') }}" class="hover:text-csj-blue-600">Blog</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    <span class="text-csj-gray-600 line-clamp-1">{{ $article->title }}</span>
                </nav>

                {{-- Catégorie & Date --}}
                <div class="flex items-center gap-3 mb-6">
                    <span class="badge-blue">{{ $article->category->name }}</span>
                    <span class="text-csj-gray-400 text-sm">{{ $article->published_at->format('d M Y') }}</span>
                    <span class="text-csj-gray-400 text-sm">{{ $article->views }} vues</span>
                </div>

                {{-- Titre --}}
                <h1 class="text-3xl lg:text-4xl font-heading font-bold text-csj-gray-900 mb-6 leading-tight">
                    {{ $article->title }}
                </h1>

                {{-- Auteur --}}
                <div class="flex items-center gap-3 mb-8 pb-8 border-b border-csj-gray-100">
                    <div class="w-10 h-10 rounded-full bg-csj-blue-100 flex items-center justify-center">
                        <span class="text-csj-blue-600 font-bold text-sm">
                            {{ substr($article->author->name, 0, 1) }}
                        </span>
                    </div>
                    <div>
                        <p class="font-medium text-csj-gray-900 text-sm">{{ $article->author->name }}</p>
                        <p class="text-csj-gray-400 text-xs">Auteur</p>
                    </div>
                </div>

                {{-- Image principale --}}
                @if($article->image)
                    <div class="aspect-video rounded-2xl overflow-hidden mb-8">
                        <img src="{{ Storage::url($article->image) }}"
                             alt="{{ $article->title }}"
                             class="w-full h-full object-cover">
                    </div>
                @endif

                {{-- Contenu --}}
                <div class="prose prose-lg prose-blue max-w-none mb-10">
                    {!! $article->content !!}
                </div>

                {{-- Likes --}}
                <div class="flex items-center gap-4 py-6 border-y border-csj-gray-100 mb-10"
                     x-data="likeSystem({{ $article->id }}, {{ $article->likes->count() }})">
                    <button @click="toggleLike()"
                            class="flex items-center gap-2 px-6 py-3 rounded-xl border-2 transition-all duration-200"
                            :class="liked ? 'border-red-400 bg-red-50 text-red-500' : 'border-csj-gray-200 text-csj-gray-500 hover:border-red-300'">
                        <svg class="w-5 h-5" :fill="liked ? 'currentColor' : 'none'" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        <span x-text="count + ' J\'aime'"></span>
                    </button>
                </div>

                {{-- Commentaires --}}
                <div class="mb-10">
                    <h3 class="font-heading font-bold text-csj-gray-900 text-xl mb-6">
                        {{ $article->approvedComments->count() }} Commentaire(s)
                    </h3>

                    @forelse($article->approvedComments as $comment)
                    <div class="flex gap-4 mb-6 pb-6 border-b border-csj-gray-100">
                        <div class="w-10 h-10 rounded-full bg-csj-blue-100 flex items-center justify-center flex-shrink-0">
                            <span class="text-csj-blue-600 font-bold text-sm">
                                {{ substr($comment->author_name, 0, 1) }}
                            </span>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="font-medium text-csj-gray-900 text-sm">{{ $comment->author_name }}</span>
                                <span class="text-csj-gray-400 text-xs">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-csj-gray-600 text-sm leading-relaxed">{{ $comment->content }}</p>
                        </div>
                    </div>
                    @empty
                        <p class="text-csj-gray-400 text-sm mb-6">Aucun commentaire pour le moment. Soyez le premier !</p>
                    @endforelse
                </div>

                {{-- Formulaire commentaire --}}
                <div class="card p-8">
                    <h3 class="font-heading font-bold text-csj-gray-900 text-xl mb-6">
                        Laisser un commentaire
                    </h3>

                    @if(session('success'))
                        <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('blog.comment', $article->id) }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-csj-gray-700 mb-2">
                                    Nom <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="author_name" value="{{ old('author_name') }}"
                                       class="input-field @error('author_name') border-red-400 @enderror"
                                       placeholder="Votre nom">
                                @error('author_name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-csj-gray-700 mb-2">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email" name="author_email" value="{{ old('author_email') }}"
                                       class="input-field @error('author_email') border-red-400 @enderror"
                                       placeholder="votre@email.com">
                                @error('author_email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-csj-gray-700 mb-2">
                                Commentaire <span class="text-red-500">*</span>
                            </label>
                            <textarea name="content" rows="4"
                                      class="input-field resize-none @error('content') border-red-400 @enderror"
                                      placeholder="Votre commentaire...">{{ old('content') }}</textarea>
                            @error('content')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn-primary">
                            Publier le commentaire
                        </button>
                    </form>
                </div>
            </article>

            {{-- Sidebar --}}
            <aside class="lg:w-72 space-y-8">
                @if($related->count() > 0)
                <div class="card p-6">
                    <h3 class="font-heading font-semibold text-csj-gray-900 mb-4">Articles similaires</h3>
                    <div class="space-y-4">
                        @foreach($related as $rel)
                        <a href="{{ route('blog.show', $rel->slug) }}" class="flex gap-3 group">
                            <div class="w-16 h-16 rounded-lg bg-csj-blue-100 flex-shrink-0 overflow-hidden">
                                @if($rel->image)
                                    <img src="{{ Storage::url($rel->image) }}" alt="{{ $rel->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-csj-blue-200 to-csj-blue-300"></div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <p class="text-csj-gray-900 text-sm font-medium group-hover:text-csj-blue-600 transition-colors line-clamp-2">
                                    {{ $rel->title }}
                                </p>
                                <p class="text-csj-gray-400 text-xs mt-1">{{ $rel->published_at->format('d M Y') }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </aside>
        </div>
    </div>
</section>

@push('scripts')
<script>
function likeSystem(articleId, initialCount) {
    return {
        liked: false,
        count: initialCount,
        async toggleLike() {
            try {
                const response = await fetch(`/blog/${articleId}/like`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                    }
                });
                const data = await response.json();
                this.liked = data.liked;
                this.count = data.count;
            } catch (error) {
                console.error('Erreur like:', error);
            }
        }
    }
}
</script>
@endpush

@endsection