<?php

namespace App\Http\Controllers;

use App\Models\GalleryCategory;

class GalleryController extends Controller
{
    public function index()
    {
        $categories = GalleryCategory::withCount('images')
            ->with(['images' => function ($query) {
                $query->orderBy('order')->limit(1);
            }])
            ->latest()
            ->get();

        return view('gallery.index', compact('categories'));
    }

    public function show(string $slug)
    {
        $category = GalleryCategory::where('slug', $slug)->firstOrFail();
        $images   = $category->images()->orderBy('order')->get();

        return view('gallery.show', compact('category', 'images'));
    }
}