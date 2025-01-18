@extends('layouts.main')
@section('content')
    <section class="welcome-section">
        <div class="container">
            @include('include.leftMenu')

            <div class="main">
                @include('include.alert')

                <div class="post-items-sec">
                        <div class="post-item">
                            <div class="post-header">
                                <div class="user">
                                    <div class="img">
                                        <img src="{{ asset('images/users/user-' . $post->user->id . '.jpg') }}" alt="User Image" />
                                    </div>
                                    <div class="user-details">
                                        <div class="name">{{ $post->user->name }}</div>
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
                                    <a href="" class="share" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span><i class="ri-share-forward-line"></i></span>
                                        <span class="share-text">Share</span>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('posts.show', $post->id)) }}" target="_blank"><i class="fab fa-facebook"></i> Facebook</a></li>
                                        <li><a class="dropdown-item" href="https://m.me/?text={{ urlencode(route('posts.show', $post->id)) }}" target="_blank"><i class="fab fa-facebook-messenger"></i> Messenger</a></li>
                                        <li><a class="dropdown-item" href="https://wa.me/?text={{ urlencode(route('posts.show', $post->id)) }}" target="_blank"><i class="fab fa-whatsapp"></i> WhatsApp</a></li>
                                        <li><a class="dropdown-item" href="https://twitter.com/intent/tweet?url={{ urlencode(route('posts.show', $post->id)) }}" target="_blank"><i class="fab fa-twitter"></i> X (Twitter)</a></li>
                                        <li><a class="dropdown-item" href="https://flipboard.com/subscribe/bookmarklet?url={{ urlencode(route('posts.show', $post->id)) }}" target="_blank"><i class="fab fa-flipboard"></i> Flipboard</a></li>
                                        <li><a class="dropdown-item" href="mailto:?subject=Check this out&body={{ urlencode(route('posts.show', $post->id)) }}"><i class="fas fa-envelope"></i> Email</a></li>
                                    </ul>
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

                </div>
            </div>
            @include('include.invite')
        </div>
    </section>

    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul id="infoList" class="list-group">
                        <li class="list-group-item">Loading...</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
