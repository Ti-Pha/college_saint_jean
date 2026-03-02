<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function __construct(private ImageUploadService $imageService) {}

    public function index()
    {
        $members = TeamMember::orderBy('order')->get();
        return view('admin.team.index', compact('members'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'name'        => ['required', 'string', 'max:255'],
        'role'        => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string'],
        'order'       => ['nullable', 'integer'],
        'photo'       => ['nullable', 'string'], // base64
    ]);

    $data = $request->only(['name', 'role', 'description', 'order']);
    $data['is_active'] = $request->boolean('is_active', true);

    if ($request->filled('photo') && str_starts_with($request->photo, 'data:image')) {
        $data['photo'] = $this->saveBase64Image($request->photo, 'team');
    }

    $data['order'] = $data['order'] ?? 0;
    TeamMember::create($data);

    return redirect()->route('admin.team.index')->with('success', 'Membre ajouté avec succès.');
}

private function saveBase64Image(string $base64, string $folder): string
{
    $image = str_replace(['data:image/jpeg;base64,', 'data:image/png;base64,', 'data:image/webp;base64,'], '', $base64);
    $image = base64_decode($image);
    $filename = $folder . '/' . uniqid() . '.jpg';
    \Storage::disk('public')->put($filename, $image);
    return $filename;
}

    public function edit(TeamMember $team)
    {
        return view('admin.team.edit', compact('team'));
    }

    public function update(Request $request, TeamMember $team)
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:150'],
            'role'        => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:500'],
            'order'       => ['nullable', 'integer'],
            'is_active'   => ['boolean'],
            'photo'       => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        if ($request->hasFile('photo')) {
            if ($team->photo) $this->imageService->delete($team->photo);
            $data['photo'] = $this->imageService->upload($request->file('photo'), 'team');
        }

        $data['is_active'] = $request->boolean('is_active', true);
        $team->update($data);

        return redirect()->route('admin.team.index')
            ->with('success', 'Membre mis à jour avec succès.');
    }

    public function destroy(TeamMember $team)
    {
        if ($team->photo) $this->imageService->delete($team->photo);
        $team->delete();
        return back()->with('success', 'Membre supprimé.');
    }

    public function show(TeamMember $team)
    {
        return redirect()->route('admin.team.edit', $team);
    }
}