@extends('layouts.main')
@section('content')
    @if(Auth::user())
        <section class="welcome-section">
            <div class="container">
               @include('include.leftMenu')

                <div class="main">
                    @include('include.alert')

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
    @else
        <section class="hero-section">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 col-lg-7 left">
                        <div class="title">
                            Celebrate Life, Share Memories, protect Everlasting Legacies Join
                            Famlicy Today!
                        </div>
                        <div class="sub-title">
                            A platform for family and close friends to celebrate the lives we
                            live, the memories we make, and the legacies we leave.
                        </div>
                        <div class="desc">
                            Imagine a place where you can honor the memories of loved ones,
                            capture precious moments, and create a lasting legacy. Whether
                            you're celebrating those who've passed on or sharing your life's
                            journey with close friends and family, Famlicy offers you a
                            private and meaningful way to do it.
                        </div>
                        <div class="btn-sec mt-4">
                            <button class="registerBtn">register</button>
                            <button class="loginBtn">login</button>
                        </div>
                    </div>
                    <div class="col-lg-5 right">
                        <div class="img">
                            <img src="{{asset('images/hero.png')}}" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="join-famlacy">
            <div class="container">
                <div class="card-section">
                    <div class="card-item">
                        <div class="content">
                            <div class="number">1</div>
                            <div class="title">Create Personal & Legacy Profiles</div>
                            <div class="desc">
                                Build profiles for yourself or family members, whether they're
                                living or have transitioned. Share their story and preserve
                                their legacy.
                            </div>
                        </div>
                        <div class="img">
                            <img src="{{asset('images/card-img-1.png')}}" alt="" />
                        </div>
                    </div>

                    <div class="card-item">
                        <div class="content">
                            <div class="number">2</div>
                            <div class="title">Private Sharing with Famlicy Circles</div>
                            <div class="desc">
                                Stay connected with select family members and close friends.
                                Share photos, videos, stories, and milestones that are
                                meaningful to you-visible only to your trusted circle.
                            </div>
                        </div>
                        <div class="img">
                            <img src="{{asset('images/card-img-2.png')}}" alt="" />
                        </div>
                    </div>

                    <div class="card-item">
                        <div class="content">
                            <div class="number">3</div>
                            <div class="title">Capture Life's Moments</div>
                            <div class="desc">
                                Upload photos, videos, and thoughts directly from your phone or
                                device. Organize these memories on a personalized timeline to
                                revisit and reflect.
                            </div>
                        </div>
                        <div class="img">
                            <img src="{{asset('images/card-img-3.png')}}" alt="" />
                        </div>
                    </div>

                    <div class="card-item">
                        <div class="content">
                            <div class="number">4</div>
                            <div class="title">Set Goals and Achieve Together</div>
                            <div class="desc">
                                Plan your future by setting personal, family, or vocational
                                goals. Whether it's health, career, or family-focused, track
                                your progress alongside loved ones.
                            </div>
                        </div>
                        <div class="img">
                            <img src="{{asset('images/card-img-4.png')}}" alt="" />
                        </div>
                    </div>

                    <div class="card-item">
                        <div class="content">
                            <div class="number">5</div>
                            <div class="title">Interactive Timeline</div>
                            <div class="desc">
                                Invite family and friends to contribute their memories, stories,
                                or media to your timeline. Celebrate each other's lives,
                                accomplishments, and dreams-together.
                            </div>
                        </div>
                        <div class="img">
                            <img src="{{asset('images/card-img-5.png')}}" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="story-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="content">
                            <div class="title">Your Story, Your Circle, Your Legacy</div>
                            <div class="desc">
                                Famlicy isn't just about preserving the past. It's about
                                celebrating the present and shaping the future, one memory, one
                                goal at a time.
                            </div>
                            <div class="sub-title">
                                Sign up today and start building your legacy with the ones who
                                matter most.
                            </div>
                            <div class="btn-sec mt-4">
                                <button class="registerBtn">register</button>
                                <button class="loginBtn">login</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 right">
                        <div class="img">
                            <img src="{{asset('images/story.png')}}" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="refer-friend">
            <div class="container">
                <div class="content">
                    <div class="title">Refer family or friend</div>
                    <div class="desc">
                        Register now and get our latest updates and promos.
                    </div>
                    <div class="input-box">
                        <input type="email" placeholder="Enter your email" />
                        <button class="joinBtn">Join</button>
                    </div>
                </div>
            </div>
        </section>
    @endif

@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var infoModal = document.getElementById("infoModal");

            infoModal.addEventListener("show.bs.modal", function (event) {
                var button = event.relatedTarget;
                var postId = button.getAttribute("data-post-id");
                var type = button.getAttribute("data-type");
                var modalTitle = document.getElementById("infoModalLabel");
                var infoList = document.getElementById("infoList");

                modalTitle.innerText = type === "likes" ? "People who liked this post" : "Comments";
                infoList.innerHTML = "<li class='list-group-item'>Loading...</li>";

                var url = type === "likes" ? `/posts/${postId}/likes` : `/posts/${postId}/comments`;

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        infoList.innerHTML = "";

                        if (data.items.length > 0) {
                            data.items.forEach(function (item) {
                                var li = document.createElement("li");
                                li.classList.add("list-group-item");

                                if (type === "likes") {
                                    li.innerHTML = `
                                <div class="d-flex align-items-start">
                                    <img src="/images/users/user-${item.user_id}.jpg" width="30" class="rounded-circle me-2">
                                    <strong>${item.user_name}</strong>
                                </div>
                            `;
                                } else {
                                    li.innerHTML = `
                                <div class="d-flex align-items-start">
                                    <img src="/images/users/user-${item.user_id}.jpg" width="30" class="rounded-circle me-2">
                                    <div>
                                        <strong>${item.user_name}</strong>
                                        <p class="mb-0">${item.content}</p>
                                        <small class="text-muted">${item.created_at}</small>
                                    </div>
                                </div>
                            `;
                                }

                                infoList.appendChild(li);
                            });
                        } else {
                            infoList.innerHTML = `<li class='list-group-item'>No ${type} yet.</li>`;
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching data:", error);
                        infoList.innerHTML = "<li class='list-group-item text-danger'>Error loading data.</li>";
                    });
            });
        });

        function previewImage() {
            const file = document.getElementById('image-input').files[0];
            const reader = new FileReader();

            reader.onloadend = function() {
                const imagePreviewContainer = document.getElementById('image-preview-container');
                const imagePreview = document.getElementById('image-preview');


                imagePreview.src = reader.result;
                imagePreviewContainer.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>

@endsection
