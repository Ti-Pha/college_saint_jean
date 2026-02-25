<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Comment;
use App\Models\ContactMessage;
use App\Models\GalleryImage;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'articles'         => Article::count(),
            'published'        => Article::where('status', 'published')->count(),
            'drafts'           => Article::where('status', 'draft')->count(),
            'comments'         => Comment::count(),
            'pending_comments' => Comment::where('is_approved', false)->count(),
            'images'           => GalleryImage::count(),
            'messages'         => ContactMessage::count(),
            'unread_messages'  => ContactMessage::where('is_read', false)->count(),
        ];

        $recentArticles = Article::with(['category', 'author'])
            ->latest()
            ->take(5)
            ->get();

        $recentComments = Comment::with('article')
            ->where('is_approved', false)
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentArticles', 'recentComments'));
    }
}