<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    public function viewAny(?User $user): bool
    {
        return true; // Public
    }

    public function view(?User $user, Article $article): bool
    {
        if ($article->status === 'published') {
            return true;
        }
        return $user && ($user->hasRole(['admin', 'directeur', 'secretaire']));
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create articles');
    }

    public function update(User $user, Article $article): bool
    {
        if ($user->hasRole('admin')) return true;
        if ($user->hasPermissionTo('edit articles')) {
            // Secrétaire ne peut modifier que ses propres articles
            if ($user->hasRole('secretaire')) {
                return $article->author_id === $user->id;
            }
            return true;
        }
        return false;
    }

    public function delete(User $user, Article $article): bool
    {
        if ($user->hasRole('admin')) return true;
        if ($user->hasPermissionTo('delete articles')) {
            return $article->author_id === $user->id || $user->hasRole('directeur');
        }
        return false;
    }

    public function publish(User $user): bool
    {
        return $user->hasPermissionTo('publish articles');
    }
}