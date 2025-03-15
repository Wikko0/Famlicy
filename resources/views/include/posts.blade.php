<div class="post-items-sec">

    @foreach ($posts as $index => $post)
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
                        <a class="time" href="{{ route('posts.show', [
                            'username' => $post->user->username,
                            'type' => $post->type,
                            'content' => Str::words($post->content, 5, '')
                        ]) }}">

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
                @php
                    $fileExtension = pathinfo($post->image_path, PATHINFO_EXTENSION);
                    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                    $audioExtensions = ['mp3', 'wav', 'ogg'];
                    $videoExtensions = ['mp4', 'mov', 'avi', 'wmv'];
                @endphp

                <div class="post-media">
                    @if (in_array($fileExtension, $imageExtensions))
                        <div class="post-image">
                            <div class="img">
                                <img src="{{ asset($post->image_path) }}" alt="Post Image" />
                            </div>
                        </div>
                    @elseif (in_array($fileExtension, $audioExtensions))
                        <div class="post-audio">
                            <audio controls>
                                <source src="{{ asset($post->image_path) }}" type="audio/{{ $fileExtension }}">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    @elseif (in_array($fileExtension, $videoExtensions))
                        <div class="post-video">
                            <video controls width="100%">
                                <source src="{{ asset($post->image_path) }}" type="video/{{ $fileExtension }}">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    @endif
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
                        <a href="#" class="toggle-comments" data-post-id="{{ $post->id }}">
                            {{ $post->comments->count() }} comments
                        </a>
                    </div>
                    @if($post->user->id == Auth::user()->id)
                        <div class="edit-post">
                            <a href="{{ route('posts.edit', $post->id) }}">
                                Edit
                            </a>
                        </div>
                        <div class="delete-post">
                            <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $post->id }}').submit();">
                                Delete
                            </a>
                            <form id="delete-form-{{ $post->id }}" action="{{ route('posts.delete', $post->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    @endif
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
                    <a href="#" class="toggle-comments" data-post-id="{{ $post->id }}">
                        <span><i class="ri-chat-1-line"></i></span>
                        <span class="engage-text">Comments</span>
                    </a>
                    <a href="" class="share" data-bs-toggle="dropdown" aria-expanded="false">
                        <span><i class="ri-share-forward-line"></i></span>
                        <span class="share-text">Share</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('posts.show', [
        'username' => $post->user->username,
        'type' => $post->type,
        'content' => Str::words($post->content, 5, '')
    ])) }}" target="_blank">
                                <i class="fab fa-facebook"></i> Facebook
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="https://m.me/?text={{ urlencode(route('posts.show', [
        'username' => $post->user->username,
        'type' => $post->type,
        'content' => Str::words($post->content, 5, '')
    ])) }}" target="_blank">
                                <i class="fab fa-facebook-messenger"></i> Messenger
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="https://wa.me/?text={{ urlencode(route('posts.show', [
        'username' => $post->user->username,
        'type' => $post->type,
        'content' => Str::words($post->content, 5, '')
    ])) }}" target="_blank">
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="https://twitter.com/intent/tweet?url={{ urlencode(route('posts.show', [
        'username' => $post->user->username,
        'type' => $post->type,
        'content' => Str::words($post->content, 5, '')
    ])) }}" target="_blank">
                                <i class="fab fa-twitter"></i> X (Twitter)
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="mailto:?subject=Check this out&body={{ urlencode(route('posts.show', [
        'username' => $post->user->username,
        'type' => $post->type,
        'content' => Str::words($post->content, 5, '')
    ])) }}">
                                <i class="fas fa-envelope"></i> Email
                            </a>
                        </li>

                    </ul>
                </div>
                <div class="right">
                    <form action="{{ route(auth()->user()->isFollowing($post->user) ? 'unfollow' : 'follow', $post->user->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="follow-btn {{ auth()->user()->isFollowing($post->user) ? 'unfollow' : '' }}">
                            <span><i class="ri-user-{{ auth()->user()->isFollowing($post->user) ? 'minus-fill' : 'add-line' }}"></i></span>
                            {{ auth()->user()->isFollowing($post->user) ? 'Unfollow' : 'Follow' }}
                        </button>
                    </form>
                </div>
            </div>
            <div class="comments-container" id="comments-container-{{ $post->id }}" style="display: none;">
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

                <div class="comments-list" id="comments-list-{{ $post->id }}">
                    @foreach ($post->comments->take(5) as $comment)
                        <div class="single-comment" data-comment-id="{{ $comment->id }}">
                            <div class="comment-header">
                                <div class="comment-img">
                                    <img src="{{ asset('images/users/user-' . $comment->user->id . '.jpg') }}" alt="User Image">
                                </div>
                                <div class="comment-info">
                                    <a href="{{ route('profile', $comment->user->username) }}" class="comment-author">
                                        {{ $comment->user->name }}
                                    </a>
                                    <span class="comment-time">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <div class="comment-body">
                                <p>{{ $comment->content }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($post->comments->count() > 5)
                    <button class="load-more-comments" data-post-id="{{ $post->id }}" data-offset="5">
                        <i class="ri-arrow-down-s-line"></i>
                        <span class="load-more-text">Load more comments</span>
                    </button>
                @endif

            </div>
        </div>


        @if (($index + 1) % 3 == 0)
            @include('ads.ad-container-970')
        @endif
    @endforeach

    <div class="pagination">
        {{ $posts->links('pagination::bootstrap-4') }}
    </div>
</div>

