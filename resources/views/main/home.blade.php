@extends('layouts.main')
@section('content')
    @if(Auth::user())
        <section class="welcome-section">
            <div class="container">
               @include('include.leftMenu')
                <div class="main">
                    <!-- Форма за добавяне на пост -->
                    <div class="share-memory">
                        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="img">
                                <img src="{{ asset('images/users/user-' . Auth::user()->id . '.jpg') }}" alt="User Image" />
                            </div>
                            <div class="input-box">
                                <input
                                    type="text"
                                    name="content"
                                    placeholder="Share your memory with everyone"
                                    required
                                />
                                <input type="file" name="image" accept="image/*" />
                                <button type="submit">
                                    <svg
                                        width="17"
                                        height="17"
                                        viewBox="0 0 17 17"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M3.8125 16L11.7812 8.5L15.5312 12.25M3.8125 16H13.1875C14.7408 16 16 14.7408 16 13.1875V8.5M3.8125 16C2.2592 16 1 14.7408 1 13.1875V3.8125C1 2.2592 2.2592 1 3.8125 1H9.90625M12.25 2.90826L14.1674 1M14.1674 1L16 2.822M14.1674 1V5.6875M6.625 5.21875C6.625 5.9954 5.9954 6.625 5.21875 6.625C4.4421 6.625 3.8125 5.9954 3.8125 5.21875C3.8125 4.4421 4.4421 3.8125 5.21875 3.8125C5.9954 3.8125 6.625 4.4421 6.625 5.21875Z"
                                            stroke="#2A804E"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Секция с постове -->
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

                                <!-- Пост детайли -->
                                <div class="post-details">
                                    <div class="left">
                                        <form action="{{ route('posts.like', $post->id) }}" method="POST">
                                            @csrf
                                            <button type="submit">
                                                <i class="ri-thumb-up-line"></i> {{ $post->likes->count() }} Likes
                                            </button>
                                        </form>
                                    </div>
                                    <div class="right">
                                        <a href="{{ route('posts.show', $post->id) }}" class="total-share">
                                            View Post
                                        </a>
                                    </div>
                                </div>

                                <!-- Коментари -->
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
                        @endforeach
                    </div>
                </div>
                @include('include.invite')
            </div>
        </section>
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
