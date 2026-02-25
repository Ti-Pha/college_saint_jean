<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\TeamMember;
use App\Models\GalleryCategory;

class PageController extends Controller
{
    public function home()
{
    $latestArticles = Article::with(['category', 'author'])
        ->published()
        ->latest('published_at')
        ->take(3)
        ->get();

    $galleryCategories = GalleryCategory::withCount('images')
        ->with(['images' => function ($query) {
            $query->orderBy('order')->limit(1);
        }])
        ->latest()
        ->take(4)
        ->get();

    return view('pages.home', compact('latestArticles', 'galleryCategories'));
}

    public function about()
    {
        return view('pages.about');
    }

    public function team()
    {
        $members = TeamMember::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('pages.team', compact('members'));
    }

    public function conduct()
    {
        return view('pages.conduct');
    }
}