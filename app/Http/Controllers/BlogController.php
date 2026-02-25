<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with(['category', 'author', 'likes', 'approvedComments'])
            ->published();

        // Filtre par catégorie
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Recherche
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        $articles = $query->latest('published_at')->paginate(6)->withQueryString();

        $categories = Category::withCount(['articles' => function ($q) {
            $q->published();
        }])->get();

        return view('blog.index', compact('articles', 'categories'));
    }

    public function show(string $slug)
    {
        $article = Article::with(['category', 'author', 'approvedComments', 'likes'])
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        // Incrémenter les vues
        $article->increment('views');

        // Articles similaires
        $related = Article::with(['category', 'author'])
            ->published()
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('blog.show', compact('article', 'related'));
    }

    public function storeComment(StoreCommentRequest $request, Article $article)
    {
        $article->comments()->create([
            'author_name'  => $request->author_name,
            'author_email' => $request->author_email,
            'content'      => $request->content,
            'ip_address'   => $request->ip(),
            'is_approved'  => false,
        ]);

        return back()->with('success', 'Votre commentaire a été soumis et est en attente de modération.');
    }

    public function like(Request $request, Article $article)
    {
        $userId    = auth()->id();
        $ipAddress = $request->ip();

        // Vérifier si déjà liké
        $existing = $article->likes()
            ->when($userId, fn($q) => $q->where('user_id', $userId))
            ->when(!$userId, fn($q) => $q->where('ip_address', $ipAddress))
            ->first();

        if ($existing) {
            $existing->delete();
            $liked = false;
        } else {
            $article->likes()->create([
                'user_id'    => $userId,
                'ip_address' => $ipAddress,
            ]);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'count' => $article->likes()->count(),
        ]);
    }
}