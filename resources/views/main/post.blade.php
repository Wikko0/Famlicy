@extends('layouts.main')
@section('content')
    <div class="main">
        <div class="post-item">
            <div class="post-header">
                <div class="user">
                    <div class="img">
                        <img src="{{ asset('images/users/user-' . $post->user->id . '.jpg') }}" alt="User Image" />
                    </div>
                    <div class="user-details">
                        <div class="name">{{ $post->user->name }}</div>
                        <div class="time">{{ $post->created_at->diffForHumans() }}</div>
                    </div>
                </div>
            </div>
            <div class="post-content">
                <div class="desc">{{ $post->content }}</div>
            </div>
            @if ($post->image_path)
                <div class="post-image">
                    <div class="img">
                        <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post Image" />
                    </div>
                </div>
            @endif

            <div class="post-details">
                <div class="left">
                    <form action="{{ route('posts.like', $post->id) }}" method="POST">
                        @csrf
                        <button type="submit">
                            <i class="ri-thumb-up-line"></i> {{ $post->likes->count() }} Likes
                        </button>
                    </form>
                </div>
            </div>

            <div class="comments">
                <h3>Comments</h3>
                <form action="{{ route('posts.comment', $post->id) }}" method="POST">
                    @csrf
                    <textarea name="content" placeholder="Add a comment..." required></textarea>
                    <button type="submit">Comment</button>
                </form>
                <ul>
                    @foreach ($post->comments as $comment)
                        <li>
                            <strong>{{ $comment->user->name }}</strong>: {{ $comment->content }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
