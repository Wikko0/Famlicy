@extends('layouts.main')
@section('content')
    <section class="welcome-section">
        <div class="container">
            @include('include.leftMenu')

            <div class="main">
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
                <div class="share-memory">
                    <div class="img">
                        <img src="{{ asset('images/users/user-' . Auth::user()->id . '.jpg') }}" alt="User Image" />
                    </div>
                    <div class="input-box">
                        <input
                            type="text"
                            name=""
                            id=""
                            placeholder="Share your memory with everyone"
                        />
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
                    </div>
                </div>

                <div class="post-items-sec">
                    <div class="post-item">
                        <div class="post-header">
                            <div class="user">
                                <div class="img">
                                    <img src="../assets/user-2.png" alt="" />
                                </div>
                                <div class="user-details">
                                    <div class="name">Freda Reilly</div>
                                    <div class="time">9h</div>
                                </div>
                            </div>
                            <div class="type-name">
                                <div class="type">Content type</div>
                            </div>
                        </div>
                        <div class="post-content">
                            <div class="desc">
                                Mattis pulvinar fames nisl eget tortor. Urna lacus etiam at
                                non at amet praesent urna. Scelerisque at eget pellentesque
                                faucibus cum blandit nunc est. Amet in aliquam vitae di...
                            </div>
                        </div>
                        <div class="post-image">
                            <div class="img">
                                <img src="../assets/post.png" alt="" />
                            </div>
                        </div>
                        <div class="post-details">
                            <div class="left">
                                <div class="date-time">01-Dec-2025</div>
                                <a href="" class="total-react">
                                    <span><i class="ri-thumb-up-line"></i></span>
                                    You and 46 others
                                </a>
                            </div>
                            <div class="right">
                                <div class="total-engage">
                                    <a href="">24 engagements</a>
                                </div>
                                <div class="total-share">
                                    <a href="">12 Share</a>
                                </div>
                            </div>
                        </div>

                        <div class="react-section">
                            <div class="left">
                                <a href="" class="like">
                                    <span><i class="ri-thumb-up-fill"></i></span>
                                    <span class="like-text">Like</span>
                                </a>
                                <a href="" class="engage">
                                    <span><i class="ri-chat-1-line"></i></span>
                                    <span class="engage-text">Engagements</span>
                                </a>
                                <a href="" class="share">
                                    <span><i class="ri-share-forward-line"></i></span>
                                    <span class="share-text">Share</span>
                                </a>
                            </div>
                            <div class="right">
                                <button class="follow-btn">Follow</button>
                            </div>
                        </div>
                        <div class="add-engage">
                            <div class="img">
                                <img src="../assets/user.png" alt="" />
                            </div>
                            <div class="engage-box">
                                <input type="text" placeholder="Add a engagements..." />
                                <button class="send-btn">
                                    <i class="ri-send-plane-fill"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            @include('include.invite')
        </div>
    </section>
@endsection
