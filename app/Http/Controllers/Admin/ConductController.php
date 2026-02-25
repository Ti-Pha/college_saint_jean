<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConductController extends Controller
{
    public function index()
    {
        $pdf = Storage::disk('public')->exists('conduct/code-de-conduite.pdf');
        return view('admin.conduct.index', compact('pdf'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'pdf' => ['required', 'file', 'mimes:pdf', 'max:10240'],
        ]);

        // Supprimer l'ancien si existe
        if (Storage::disk('public')->exists('conduct/code-de-conduite.pdf')) {
            Storage::disk('public')->delete('conduct/code-de-conduite.pdf');
        }

        $request->file('pdf')->storeAs('conduct', 'code-de-conduite.pdf', 'public');

        return back()->with('success', 'PDF uploadé avec succès.');
    }

    public function destroy()
    {
        Storage::disk('public')->delete('conduct/code-de-conduite.pdf');
        return back()->with('success', 'PDF supprimé.');
    }
}