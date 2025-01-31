<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'content' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|string'
        ]);

        $imagePath = null;

        $post = Post::create([
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
            'type' => $request->input('type'),
            'image_path' => $imagePath,
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $photoPath = $image->storeAs(
                '/images/posts',
                'post-' . $post->id . '.jpg',
                ['disk' => 'public_uploads']
            );

            $image = Image::make(public_path("{$photoPath}"));
            $image->save();


            $post->update(['image_path' => $photoPath]);
        }

        return redirect()->back()->withSuccess('Post added successfully!');
    }

    public function show($id): View
    {
        $post = Post::with(['user', 'likes.user', 'comments.user'])->findOrFail($id);
        return view('main.post', compact('post'));
    }

    public function like($id): RedirectResponse
    {
        $post = Post::findOrFail($id);

        $like = Like::where('post_id', $id)->where('user_id', Auth::id())->first();

        if ($like) {
            $like->delete();
            return redirect()->back()->withSuccess('Unliked successfully!');
        } else {
            Like::create([
                'post_id' => $id,
                'user_id' => Auth::id(),
            ]);
        }

        return redirect()->back()->withSuccess('Liked successfully!');
    }

    public function comment(Request $request, $id): RedirectResponse
    {
        $request->validate(['content' => 'required|string']);

        Comment::create([
            'post_id' => $id,
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
        ]);

        return redirect()->back()->withSuccess('Comment added successfully!');
    }
}
