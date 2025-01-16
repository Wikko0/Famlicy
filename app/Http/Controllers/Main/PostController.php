<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PostController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        Post::create([
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
            'type' => $request->type,
            'image_path' => $imagePath,
        ]);

        return redirect()->back()->withSuccess('Post added successfully!');
    }

    public function show($id)
    {
        $post = Post::with(['user', 'likes.user', 'comments.user'])->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function like($id)
    {
        $post = Post::findOrFail($id);

        $like = Like::where('post_id', $id)->where('user_id', Auth::id())->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'post_id' => $id,
                'user_id' => Auth::id(),
            ]);
        }

        return redirect()->back();
    }

    public function comment(Request $request, $id)
    {
        $request->validate(['content' => 'required|string']);

        Comment::create([
            'post_id' => $id,
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return redirect()->back();
    }
}
