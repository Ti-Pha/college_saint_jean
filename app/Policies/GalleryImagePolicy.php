<?php

namespace App\Policies;

use App\Models\GalleryImage;
use App\Models\User;

class GalleryImagePolicy
{
    public function viewAny(?User $user): bool
    {
        return true; // Public
    }

    public function manage(User $user): bool
    {
        return $user->hasPermissionTo('manage gallery');
    }

    public function delete(User $user, GalleryImage $image): bool
    {
        return $user->hasPermissionTo('manage gallery');
    }
}