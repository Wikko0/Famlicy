@extends('layouts.main')
@section('content')

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
@endsection
