<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use App\Services\ImageUploadService;
use App\Http\Requests\StoreGalleryImageRequest;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function __construct(private ImageUploadService $imageService) {}

    public function index()
{
    $categories = GalleryCategory::withCount('images')
        ->with(['images' => function ($query) {
            $query->orderBy('order')->limit(1);
        }])
        ->latest()
        ->get();

    return view('admin.gallery.index', compact('categories'));
}

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        GalleryCategory::create($data);
        return redirect()->route('admin.gallery.index')
            ->with('success', 'Catégorie créée avec succès.');
    }

    public function show(GalleryCategory $gallery)
    {
        $images = $gallery->images()->orderBy('order')->get();
        return view('admin.gallery.show', compact('gallery', 'images'));
    }

    public function edit(GalleryCategory $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, GalleryCategory $gallery)
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:255'],
        ]);

        $gallery->update($data);
        return redirect()->route('admin.gallery.index')
            ->with('success', 'Catégorie mise à jour.');
    }

    public function destroy(GalleryCategory $gallery)
    {
        foreach ($gallery->images as $image) {
            $this->imageService->delete($image->filename);
        }
        $gallery->delete();
        return back()->with('success', 'Catégorie supprimée.');
    }

    // Upload d'images dans une catégorie
    public function uploadImages(StoreGalleryImageRequest $request, GalleryCategory $gallery)
    {
        foreach ($request->file('images') as $file) {
            $path = $this->imageService->upload($file, 'gallery');
            $gallery->images()->create([
                'filename'      => $path,
                'original_name' => $file->getClientOriginalName(),
                'caption'       => $request->caption,
            ]);
        }

        return back()->with('success', count($request->file('images')) . ' image(s) uploadée(s) avec succès.');
    }

    public function deleteImage(GalleryImage $image)
    {
        $this->imageService->delete($image->filename);
        $image->delete();
        return back()->with('success', 'Image supprimée.');
    }
}