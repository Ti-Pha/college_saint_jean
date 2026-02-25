<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Article;
use Illuminate\Pagination\Paginator;
use App\Models\Comment;
use App\Models\GalleryImage;
use App\Policies\ArticlePolicy;
use App\Policies\CommentPolicy;
use App\Policies\GalleryImagePolicy;

class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        Article::class      => ArticlePolicy::class,
        Comment::class      => CommentPolicy::class,
        GalleryImage::class => GalleryImagePolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    
    // Pagination avec Tailwind
    Paginator::useTailwind();

    Gate::define('access-admin', function ($user) {
        return $user->hasAnyRole(['admin', 'directeur', 'secretaire']);
    });
    }
}