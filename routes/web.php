<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\TeamMemberController;

/*
|--------------------------------------------------------------------------
| Routes Publiques
|--------------------------------------------------------------------------
*/

// Pages statiques
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/a-propos', [PageController::class, 'about'])->name('about');
Route::get('/equipe', [PageController::class, 'team'])->name('team');
Route::get('/code-de-conduite', [PageController::class, 'conduct'])->name('conduct');

// Blog public
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::post('/blog/{article}/comment', [BlogController::class, 'storeComment'])->name('blog.comment');
Route::post('/blog/{article}/like', [BlogController::class, 'like'])->name('blog.like');

// Galerie publique
Route::get('/galerie', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/galerie/{slug}', [GalleryController::class, 'show'])->name('gallery.show');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Sitemap
Route::get('/sitemap.xml', function () {
    $sitemap = \Spatie\Sitemap\Sitemap::create()
        ->add(\Spatie\Sitemap\Tags\Url::create('/')
            ->setChangeFrequency('weekly')
            ->setPriority(1.0))
        ->add(\Spatie\Sitemap\Tags\Url::create('/a-propos')
            ->setChangeFrequency('monthly')
            ->setPriority(0.8))
        ->add(\Spatie\Sitemap\Tags\Url::create('/equipe')
            ->setChangeFrequency('monthly')
            ->setPriority(0.7))
        ->add(\Spatie\Sitemap\Tags\Url::create('/blog')
            ->setChangeFrequency('daily')
            ->setPriority(0.9))
        ->add(\Spatie\Sitemap\Tags\Url::create('/galerie')
            ->setChangeFrequency('weekly')
            ->setPriority(0.7))
        ->add(\Spatie\Sitemap\Tags\Url::create('/contact')
            ->setChangeFrequency('monthly')
            ->setPriority(0.6));

    // Ajouter tous les articles publiés
    \App\Models\Article::published()->get()->each(function ($article) use ($sitemap) {
        $sitemap->add(\Spatie\Sitemap\Tags\Url::create('/blog/' . $article->slug)
            ->setLastModificationDate($article->updated_at)
            ->setChangeFrequency('weekly')
            ->setPriority(0.8));
    });

    return response($sitemap->render(), 200)
        ->header('Content-Type', 'application/xml');
})->name('sitemap');

/*
|--------------------------------------------------------------------------
| Routes Administration (protégées)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Articles
        Route::resource('articles', ArticleController::class);

        // Commentaires
        Route::get('comments', [CommentController::class, 'index'])->name('comments.index');
        Route::patch('comments/{comment}/approve', [CommentController::class, 'approve'])->name('comments.approve');
        Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

        // Galerie
        Route::resource('gallery', AdminGalleryController::class);

        // Upload images dans une catégorie
        Route::post('gallery/{gallery}/images', [AdminGalleryController::class, 'uploadImages'])->name('gallery.images.upload');
        Route::delete('gallery/images/{image}', [AdminGalleryController::class, 'deleteImage'])->name('gallery.images.delete');

        // Équipe
        Route::resource('team', TeamMemberController::class);

        // Messages de contact
        Route::get('messages', [App\Http\Controllers\Admin\ContactMessageController::class, 'index'])->name('messages.index');
        Route::patch('messages/{message}/read', [App\Http\Controllers\Admin\ContactMessageController::class, 'markAsRead'])->name('messages.read');
        Route::delete('messages/{message}', [App\Http\Controllers\Admin\ContactMessageController::class, 'destroy'])->name('messages.destroy');

        // Code de conduite PDF
        Route::get('conduct', [App\Http\Controllers\Admin\ConductController::class, 'index'])->name('conduct.index');
        Route::post('conduct', [App\Http\Controllers\Admin\ConductController::class, 'upload'])->name('conduct.upload');
        Route::delete('conduct', [App\Http\Controllers\Admin\ConductController::class, 'destroy'])->name('conduct.destroy');

        // Témoignages
        Route::resource('testimonials', \App\Http\Controllers\Admin\TestimonialController::class);

        // Profil
        Route::get('profile', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
        Route::patch('profile/password', [\App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('profile.password');
    });

/*
|--------------------------------------------------------------------------
| Routes Auth (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';