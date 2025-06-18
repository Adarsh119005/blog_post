<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $slug)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'comment' => 'required|string|max:2000',
        ]);

        $post = \App\Models\Post::where('slug', $slug)->firstOrFail();

        Comment::create([
            'post_id' => $post->id,
            'name' => $request->name,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Comment added!');
    }
}