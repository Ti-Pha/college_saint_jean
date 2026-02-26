<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function __construct(private ImageUploadService $imageService) {}

    public function index()
    {
        $testimonials = Testimonial::orderBy('order')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => ['required', 'string', 'max:100'],
            'role'      => ['required', 'string', 'max:100'],
            'content'   => ['required', 'string', 'max:500'],
            'rating'    => ['required', 'integer', 'min:1', 'max:5'],
            'order'     => ['nullable', 'integer'],
            'is_active' => ['boolean'],
            'photo'     => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $this->imageService->upload($request->file('photo'), 'testimonials');
        }

        $data['is_active'] = $request->boolean('is_active', true);
        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Témoignage ajouté avec succès.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'name'      => ['required', 'string', 'max:100'],
            'role'      => ['required', 'string', 'max:100'],
            'content'   => ['required', 'string', 'max:500'],
            'rating'    => ['required', 'integer', 'min:1', 'max:5'],
            'order'     => ['nullable', 'integer'],
            'is_active' => ['boolean'],
            'photo'     => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            if ($testimonial->photo) $this->imageService->delete($testimonial->photo);
            $data['photo'] = $this->imageService->upload($request->file('photo'), 'testimonials');
        }

        $data['is_active'] = $request->boolean('is_active', true);
        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Témoignage mis à jour avec succès.');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->photo) $this->imageService->delete($testimonial->photo);
        $testimonial->delete();
        return back()->with('success', 'Témoignage supprimé.');
    }
}