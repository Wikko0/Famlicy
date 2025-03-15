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
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp3,wav,ogg,mp4,mov,avi,wmv|max:51200',
            'type' => 'required|string',
        ]);

        $filePath = null;

        $post = Post::create([
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
            'type' => $request->input('type'),
            'image_path' => null,
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $mimeType = $file->getMimeType();


            $filePath = "/images/posts/post-{$post->id}.{$extension}";


            $file->storeAs('images/posts', "post-{$post->id}.{$extension}", 'public_uploads');


            if (str_starts_with($mimeType, 'image')) {
                $image = Image::make(public_path($filePath));
                $image->save();
            }


            $post->update(['image_path' => $filePath]);
        }

        return redirect()->back()->withSuccess('Post added successfully!');
    }

    public function show($username, $type, $content): View
    {
        $post = Post::with(['user', 'likes.user', 'comments.user'])
            ->whereHas('user', function ($query) use ($username) {
                $query->where('username', $username);
            })
            ->where('type', $type)
            ->where('content', 'LIKE', "%$content%")
            ->firstOrFail();

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

    public function destroy($id): RedirectResponse
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            return redirect()->back()->withErrorS('You are not authorized to delete this post.');
        }

        if ($post->image_path && file_exists(public_path($post->image_path))) {
            unlink(public_path($post->image_path));
        }

        $post->delete();

        return redirect()->back()->withSuccess('Post deleted successfully!');
    }

    public function edit($id): View
    {
        $post = Post::findOrFail($id);
        if ($post->user_id !== Auth::id()) {
            return redirect()->back()->withErrors('You are not authorized to edit this post.');
        }

        return view('main.editPost', compact('post'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'content' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp3,wav,ogg,mp4,mov,avi,wmv|max:51200',
            'type' => 'required|string'
        ]);

        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id()) {
            return redirect()->back()->withErrors('You are not authorized to update this post.');
        }

        $post->update([
            'content' => $request->input('content'),
            'type' => $request->input('type'),
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filePath = "/images/posts/post-{$post->id}.{$extension}";

            if ($post->image_path && file_exists(public_path($post->image_path))) {
                unlink(public_path($post->image_path));
            }

            $file->move(public_path('/images/posts'), "post-{$post->id}.{$extension}");


            if (in_array($extension, ['jpeg', 'jpg', 'png', 'gif'])) {
                $image = Image::make(public_path($filePath));
                $image->save();
            }

            $post->update(['image_path' => $filePath]);
        }

        return redirect()->route('posts.show', [
            'username' => $post->user->username,
            'type' => $post->type,
            'content' => $post->content
        ])->withSuccess('Post updated successfully!');
    }

    public function loadMore(Request $request, Post $post)
    {
        $offset = (int) $request->get('offset', 0); // Без -5
        $comments = $post->comments()->orderBy('created_at', 'asc')->skip($offset)->take(5)->get();
        $hasMore = $post->comments()->count() > ($offset + 5);

        return response()->json([
            'items' => $comments->map(function ($comment) {
                return [
                    'id' => $comment->id,
                    'user_id' => $comment->user->id,
                    'user_name' => $comment->user->name,
                    'content' => $comment->content,
                    'created_at' => $comment->created_at->diffForHumans()
                ];
            }),
            'hasMore' => $hasMore
        ]);
    }

}
