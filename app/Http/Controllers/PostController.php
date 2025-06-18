<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CommentController;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('admin.create');
    }

    public function dashboard()
    {
        $posts = Post::where('author_id', auth()->id())->latest()->get();

         return view('admin.dashboard', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published,archived', // include status validation
        ]);

        Post::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'content' => $validated['content'],
            'author_id' => auth()->id(),
            'status' => $validated['status'], // now valid
        ]);

        return redirect('/')->with('success','Post Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
            $posts = Post::where('status', 'published')
                ->latest()
                ->get();
        return view('welcome', compact('posts'));
    }

 

    public function view(Request $request, $slug)
    {
         $post = Post::where('slug', $slug)->with('comments')->firstOrFail();

        // Handle POST: comment submission
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|string|max:255',
                'comment' => 'required|string|max:2000',
            ]);

            Comment::create([
                'post_id' => $post->id,
                'name' => $request->input('name'),
                'comment' => $request->input('comment'),
            ]);
              return redirect()->route('blogs.show', $slug)->with('success', 'Comment posted!');
        }

        return view('detail', compact('post'));
    }




    public function edit($id)
    {
        $post = Post::findOrFail($id);
    
        if ($post->author_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
        return view('admin.edit', compact('post'));
    }

  
    public function update(Request $request, $id)
    {
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'status' => 'required|in:draft,published,archived',
    ]);

    $post = Post::findOrFail($id);

    // Ensure the logged-in user owns the post
    if ($post->author_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    $post->update([
        'title' => $validated['title'],
        'slug' => \Str::slug($validated['title']),
        'content' => $validated['content'],
        'status' => $validated['status'], 
    ]);

    return redirect()->route('dashboard')->with('success', 'Post updated successfully!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Ensure the logged-in user owns the post
        if ($post->author_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $post->delete();

        return redirect()->route('dashboard')->with('success', 'Post deleted successfully!');
    }
}