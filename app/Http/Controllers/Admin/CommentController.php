<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $comments = Comment::with('article')
            ->latest()
            ->paginate(15);

        return view('admin.comments.index', compact('comments'));
    }

    public function approve(Comment $comment)
    {
        $this->authorize('moderate', $comment);

        $comment->update(['is_approved' => !$comment->is_approved]);

        $status = $comment->is_approved ? 'approuvé' : 'désapprouvé';
        return back()->with('success', "Commentaire {$status} avec succès.");
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        return back()->with('success', 'Commentaire supprimé avec succès.');
    }
}