<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'listingId' => 'required|integer',
            'comment_text' => 'required|string|max:255',
        ]);

        $comment = Comment::create([
            'listingId' => $request->listingId,
            'userId' => Auth::id(),
            'comment_text' => $request->comment_text,
        ]);

        return response()->json($comment->load('user'), 201);
    }

    public function index($listingId)
    {
        $comments = Comment::where('listingId', $listingId)->with('user')->get();
        return response()->json($comments);
    }
}
