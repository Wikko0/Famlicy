@extends('layouts.main')
@section('content')
    <section class="welcome-section">
        <div class="container">
            @include('include.leftMenu')

            <div class="main">
                @include('include.alert')

                <div class="community-info">
                    <h1 class="community-name">{{ $community->name }}</h1>
                    <p class="community-description">{{ $community->description }}</p>
                    @if($community->hasPendingInvitation(Auth::user()->id))
                        <form action="{{ route('community.accept', ['communityId' => $community->id]) }}" method="POST">
                            @csrf

                            <button type="submit" class="invite-btn accept">
                            <span><i class="ri-user-add-line"></i></span> Accept Request
                            </button>
                        </form>
                    @endif
                </div>
                @if($community->isUserMember(Auth::user()->id))

                    @include('include.shareMemory')

                    <div class="post-items-sec">
                        @foreach ($posts as $post)
                            <div class="post-item">
                                <div class="post-header">
                                    <div class="user">
                                        <div class="img">
                                            <img src="{{ asset('images/users/user-' . $post->user->id . '.jpg') }}" alt="User Image" />
                                        </div>
                                        <div class="user-details">

                                            <a class="name" href="{{ route('profile', $post->user->username) }}">
                                                {{ $post->user->name }}
                                            </a>

                                            <a class="time" href="{{ route('posts.show', $post->id) }}">
                                                {{ $post->created_at->diffForHumans() }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="type-name">
                                        <div class="type">{{ $post->type }}</div>
                                    </div>
                                </div>
                                <div class="post-content">
                                    <div class="desc">{{ $post->content }}</div>
                                </div>
                                @if ($post->image_path)
                                    <div class="post-image">
                                        <div class="img">
                                            <img src="{{ asset($post->image_path) }}" alt="Post Image" />
                                        </div>
                                    </div>
                                @endif
                                <div class="post-details">
                                    <div class="left">
                                        <div class="date-time">{{ $post->created_at->format('d-M-Y') }}</div>
                                        <a href="#" class="total-react" data-bs-toggle="modal" data-bs-target="#infoModal" data-type="likes" data-post-id="{{ $post->id }}">
                                            <span><i class="ri-thumb-up-line"></i></span>
                                            {{ $post->likes->count() }} Likes
                                        </a>
                                    </div>
                                    <div class="right">
                                        <div class="total-engage">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#infoModal" data-type="comments" data-post-id="{{ $post->id }}">
                                                {{ $post->comments->count() }} comments
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="react-section">
                                    <div class="left">
                                        <form id="like-form-{{ $post->id }}" action="{{ route('posts.like', $post->id) }}" method="POST">
                                            @csrf
                                            <a href="#" onclick="event.preventDefault(); document.getElementById('like-form-{{ $post->id }}').submit();" class="like">
                                                <span><i class="ri-thumb-up-{{ $post->likes->where('user_id', auth()->id())->isNotEmpty() ? 'fill' : 'line' }}"></i></span>
                                                <span class="like-text">Like</span>
                                            </a>
                                        </form>

                                        <a href="#" class="engage" data-bs-toggle="modal" data-bs-target="#infoModal" data-type="comments" data-post-id="{{ $post->id }}">
                                            <span><i class="ri-chat-1-line"></i></span>
                                            <span class="engage-text">Comments</span>
                                        </a>
                                        <a href="" class="share">
                                            <span><i class="ri-share-forward-line"></i></span>
                                            <span class="share-text">Share</span>
                                        </a>
                                    </div>
                                    <div class="right">
                                        <form
                                            action="{{ route(auth()->user()->isFollowing($post->user) ? 'unfollow' : 'follow', $post->user->id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit"
                                                    class="follow-btn {{ auth()->user()->isFollowing($post->user) ? 'unfollow' : '' }}">
                                    <span>
                                      <i class="ri-user-{{ auth()->user()->isFollowing($post->user) ? 'minus-fill' : 'add-line' }}"></i>
                                    </span>
                                                {{ auth()->user()->isFollowing($post->user) ? 'Unfollow' : 'Follow' }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <form action="{{ route('posts.comment', $post->id) }}" method="POST">
                                    @csrf
                                    <div class="add-engage">
                                        <div class="img">
                                            <img src="{{ asset('images/users/user-' . Auth::user()->id . '.jpg') }}" alt="User Image" />
                                        </div>
                                        <div class="engage-box">
                                            <input type="text" name="content" placeholder="Add a comment..." required />
                                            <button type="submit" class="send-btn">
                                                <i class="ri-send-plane-fill"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        @endforeach
                    </div>
                @endif
            </div>
            @include('include.invite')
        </div>
    </section>
@endsection
