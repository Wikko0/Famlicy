@extends('layouts.main')

@section('content')
    <div class="my-favourites active-user">
        <div class="header-img">
            <img src="{{asset('images/community-share.png')}}" alt="Community Share"/>

            <div class="title">Create, Share, and Preserve Life’s Moments</div>
        </div>

        @include('include.alert')
        @php
            $username = Auth::user()->username;
        @endphp
        @if(Auth::user()->username == $user->username)
            <div class="favourite-sec">
                <div class="container">
                    <div class="user-part">
                        <div class="user-profile">
                            <div class="img">
                                <div class="profile-image-container" data-bs-toggle="modal" data-bs-target="#changeProfileImageModal">
                                    <img id="profile-image"
                                         src="{{ asset('images/users/user-' . $user->id . '.jpg') }}"
                                         alt="Profile Image"
                                         class="img-thumbnail">

                                    <div class="profile-overlay">
                                        <div class="top-text">Add Profile Picture</div>
                                        <div class="plus-icon">+</div>
                                    </div>
                                </div>

                            </div>
                            <div class="user-info">
                                <div class="name">{{ $user->name }}</div>
                                @if(!empty($user->alias))
                                    <div class="country">
                                        @foreach($user->alias as $alias)
                                            <div>({{ $alias }})</div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <button type="submit" class="friends-btn">
                                <span><i class="ri-home-2-fill"></i></span> Profile Clicks {{$clickCount}}
                            </button>
                        </div>
                    </div>

                    <!-- Profile In -->
                    @include('include.profileIn')

                    <!-- About Me Section -->
                    <div class="row">

                        <div class="col-md-6">
                    <div class="card introduction-section">
                        <div class="card-header">
                            <h3>About me</h3>
                        </div>
                        <div class="edit-info-btn">
                            <a href="{{route('user.aboutme', $username)}}">
                                <button class="btn-invite">Update</button>
                            </a>
                        </div>
                    </div>
                        </div>

                    <!-- Education Section -->

                        <div class="col-md-6">
                    <div class="card introduction-section">
                            <div class="card-header">
                                <h3>Education</h3>
                            </div>
                            <div class="edit-info-btn">
                                <a href="{{ route('user.education', $username) }}">
                                    <button class="btn-invite">Update</button>
                                </a>
                            </div>
                        </div>
                        </div>


                    <!-- Employment Section -->
                        <div class="col-md-6">
                    <div class="card introduction-section">
                            <div class="card-header">
                                <h3>Employment History</h3>
                            </div>

                            <div class="edit-info-btn">
                                <a href="{{ route('user.employment', $username) }}">
                                    <button class="btn-invite btn btn-primary">Update</button>
                                </a>
                            </div>
                        </div>
                        </div>

                    <!-- Life Section -->
                        <div class="col-md-6">
                    <div class="card introduction-section">
                        <div class="card-header">
                            <h3>Life events & accomplishments</h3>
                        </div>
                        <div class="edit-info-btn">
                            <a href="{{ route('user.life', $username) }}">
                                <button class="btn-invite btn btn-primary">Update</button>
                            </a>
                        </div>
                    </div>
                        </div>
                    <!-- Goals Section -->
                        <div class="col-md-6">
                    <div class="card introduction-section">
                        <div class="card-header">
                            <h3>Goals & ambitions</h3>
                        </div>
                        <div class="edit-info-btn">
                            <a href="{{ route('user.goals', $username) }}">
                                <button class="btn-invite btn btn-primary">Update</button>
                            </a>
                        </div>
                    </div>
                        </div>
                    <!-- My interests & favourites Section -->
                        <div class="col-md-6">
                    <div class="card introduction-section">
                        <div class="card-header">
                            <h3>My interests & favourites</h3>
                        </div>
                        <div class="edit-info-btn">
                            <a href="{{route('user.myinterests', $username)}}">
                                <button class="btn-invite">Update</button>
                            </a>
                        </div>
                    </div>
                        </div>
                    </div>

                    <!-- Memorial Photos, Videos, or Audio Upload -->

                    <div class="container py-5">

                        <div class="mb-4 text-end">
                            <h2>Upload memorial photos, videos or audio</h2>
                        </div>

                        <div class="row text-center">

                            <div class="col-6 col-md-3 mb-3">
                                <a href="{{ route('user.life', ['username' => $username, 'preset' => 'The day I was born']) }}">
                                    <button class="btn btn-success btn-lg w-100">Birth/Baby</button>
                                </a>
                            </div>

                            <div class="col-6 col-md-3 mb-3">
                                <a href="{{ route('user.life', ['username' => $username, 'preset' => 'My first day at school']) }}">
                                    <button class="btn btn-success btn-lg w-100">First day at school</button>
                                </a>
                            </div>

                            <div class="col-6 col-md-3 mb-3">
                                <a href="{{ route('user.life', ['username' => $username, 'preset' => 'Today is my birthday']) }}">
                                    <button class="btn btn-success btn-lg w-100">Birthdays</button>
                                </a>
                            </div>

                            <div class="col-6 col-md-3 mb-3">
                                <a href="{{ route('user.life', ['username' => $username, 'preset' => 'Celebrating a festive moment']) }}">
                                    <button class="btn btn-success btn-lg w-100">Festive</button>
                                </a>
                            </div>

                            <div class="col-6 col-md-3 mb-3">
                                <a href="{{ route('user.life', ['username' => $username, 'preset' => 'A meal to remember']) }}">
                                    <button class="btn btn-success btn-lg w-100">Foodie</button>
                                </a>
                            </div>

                            <div class="col-6 col-md-3 mb-3">
                                <a href="{{ route('user.life', ['username' => $username, 'preset' => 'Graduation day memories']) }}">
                                    <button class="btn btn-success btn-lg w-100">Graduation</button>
                                </a>
                            </div>

                            <div class="col-6 col-md-3 mb-3">
                                <a href="{{ route('user.life', ['username' => $username, 'preset' => 'Unforgettable holiday moments']) }}">
                                    <button class="btn btn-success btn-lg w-100">Holiday</button>
                                </a>
                            </div>

                            <div class="col-6 col-md-3 mb-3">
                                <a href="{{ route('user.life', ['username' => $username, 'preset' => 'Me and my furry friend']) }}">
                                    <button class="btn btn-success btn-lg w-100">Pets</button>
                                </a>
                            </div>

                        </div>
                    </div>

                    <div class="active-user-items">
                            @foreach ($friends as $i => $friend)
                                <div class="item accept-item" data-target=".hide-item-{{$i}}">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{ asset('images/users/user-' . $friend->id . '.jpg') }}" alt=""/>
                                        </div>
                                        <div class="details">
                                            <div class="name">{{ $friend->name }}</div>
                                            <div class="status accept">Friends</div>
                                        </div>
                                    </div>

                                    <div class="hide-items hide-item-{{$i}}">
                                        <div class="hide-item-details">
                                        @foreach ($communities as $community)
                                        @if ($community->isUserMember(Auth::id()) && $community->isNotUserMember($friend->id) && !$community->hasPendingInvitation($friend->id))
                                            <form action="{{ route('community.join', ['communityId' => $community->id, 'friendId' => $friend->id]) }}" method="POST">
                                                @csrf

                                                <button type="submit" class="circle">Add to {{ $community->name }}</button>

                                            </form>
                                        @endif

                                        @endforeach
                                        </div>
                                    </div>
                                    <div class="edit-info-btn">
                                        <a href="{{route('profile', $friend->username)}}">
                                            <button class="btn-invite">Visit Profile</button>
                                        </a>
                                    </div>
                                </div>
                            @endforeach


                    @foreach($pendingFriend as $pending)
                        <div class="item">
                            <div class="item-details">
                                <div class="img">
                                    <img src="{{ asset('images/users/user-' . $pending->id . '.jpg') }}" alt=""/>
                                </div>
                                <div class="details">
                                    <div class="name">{{$pending->name}}</div>
                                    <div class="status pending">pending</div>
                                </div>
                            </div>
                            <div class="edit-info-btn">
                                <a href="{{route('profile', $pending->username)}}">
                                    <button class="btn-invite">Visit Profile</button>
                                </a>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        @elseif(in_array(Auth::user()->id, json_decode($user->admin_id ?? '[]')))
            <div class="favourite-sec">
                <div class="container">
                    <div class="user-part">
                        <div class="user-profile">
                            <div class="img">
                                <div class="profile-image-container" data-bs-toggle="modal" data-bs-target="#changeProfileImageModal">
                                    <img id="profile-image"
                                         src="{{ asset('images/users/user-' . $user->id . '.jpg') }}"
                                         alt="Profile Image"
                                         class="img-thumbnail">

                                    <div class="profile-overlay">
                                        <div class="top-text">Add Profile Picture</div>
                                        <div class="plus-icon">+</div>
                                    </div>
                                </div>

                            </div>
                            <div class="user-info">
                                <div class="name">{{ $user->name }}</div>
                                @if(!empty($user->alias))
                                    <div class="country">
                                        @foreach($user->alias as $alias)
                                            <div>({{ $alias }})</div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <button type="submit" class="friends-btn">
                                <span><i class="ri-home-2-fill"></i></span> Profile Clicks {{$clickCount}}
                            </button>
                        </div>
                    </div>

                    <!-- Profile In -->
                    @include('include.profileIn')

                    <!-- About Me Section -->
                    <div class="row">

                        <div class="col-md-6">
                            <div class="card introduction-section">
                                <div class="card-header">
                                    <h3>About me</h3>
                                </div>
                                <div class="edit-info-btn">
                                    <a href="{{route('user.aboutme', $username)}}">
                                        <button class="btn-invite">Update</button>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Education Section -->

                        <div class="col-md-6">
                            <div class="card introduction-section">
                                <div class="card-header">
                                    <h3>Education</h3>
                                </div>
                                <div class="edit-info-btn">
                                    <a href="{{ route('user.education', $username) }}">
                                        <button class="btn-invite">Update</button>
                                    </a>
                                </div>
                            </div>
                        </div>


                        <!-- Employment Section -->
                        <div class="col-md-6">
                            <div class="card introduction-section">
                                <div class="card-header">
                                    <h3>Employment History</h3>
                                </div>

                                <div class="edit-info-btn">
                                    <a href="{{ route('user.employment', $username) }}">
                                        <button class="btn-invite btn btn-primary">Update</button>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Life Section -->
                        <div class="col-md-6">
                            <div class="card introduction-section">
                                <div class="card-header">
                                    <h3>Life events & accomplishments</h3>
                                </div>
                                <div class="edit-info-btn">
                                    <a href="{{ route('user.life', $username) }}">
                                        <button class="btn-invite btn btn-primary">Update</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Goals Section -->
                        <div class="col-md-6">
                            <div class="card introduction-section">
                                <div class="card-header">
                                    <h3>Goals & ambitions</h3>
                                </div>
                                <div class="edit-info-btn">
                                    <a href="{{ route('user.goals', $username) }}">
                                        <button class="btn-invite btn btn-primary">Update</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- My interests & favourites Section -->
                        <div class="col-md-6">
                            <div class="card introduction-section">
                                <div class="card-header">
                                    <h3>My interests & favourites</h3>
                                </div>
                                <div class="edit-info-btn">
                                    <a href="{{route('user.myinterests', $username)}}">
                                        <button class="btn-invite">Update</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="active-user-items">
                        @foreach ($friends as $i => $friend)
                            <div class="item accept-item" data-target=".hide-item-{{$i}}">
                                <div class="item-details">
                                    <div class="img">
                                        <img src="{{ asset('images/users/user-' . $friend->id . '.jpg') }}" alt=""/>
                                    </div>
                                    <div class="details">
                                        <div class="name">{{ $friend->name }}</div>
                                        <div class="status accept">Friends</div>
                                    </div>
                                </div>

                                <div class="hide-items hide-item-{{$i}}">
                                    <div class="hide-item-details">
                                        @foreach ($communities as $community)
                                            @if ($community->isUserMember(Auth::id()) && $community->isNotUserMember($friend->id) && !$community->hasPendingInvitation($friend->id))
                                                <form action="{{ route('community.join', ['communityId' => $community->id, 'friendId' => $friend->id]) }}" method="POST">
                                                    @csrf

                                                    <button type="submit" class="circle">Add to {{ $community->name }}</button>

                                                </form>
                                            @endif

                                        @endforeach
                                    </div>
                                </div>
                                <div class="edit-info-btn">
                                    <a href="{{route('profile', $friend->username)}}">
                                        <button class="btn-invite">Visit Profile</button>
                                    </a>
                                </div>
                            </div>
                        @endforeach


                        @foreach($pendingFriend as $pending)
                            <div class="item">
                                <div class="item-details">
                                    <div class="img">
                                        <img src="{{ asset('images/users/user-' . $pending->id . '.jpg') }}" alt=""/>
                                    </div>
                                    <div class="details">
                                        <div class="name">{{$pending->name}}</div>
                                        <div class="status pending">pending</div>
                                    </div>
                                </div>
                                <div class="edit-info-btn">
                                    <a href="{{route('profile', $pending->username)}}">
                                        <button class="btn-invite">Visit Profile</button>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div class="favourite-sec">
                <div class="container">

                    @include('include.userPart')

                    <!-- About me Section -->

                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const acceptItems = document.querySelectorAll(".accept-item");

            acceptItems.forEach(function (item) {
                item.addEventListener("click", function () {
                    // Remove active class from all accept-items
                    acceptItems.forEach(function (acceptItem) {
                        acceptItem.classList.remove("active-user-item");
                    });

                    // Hide all .hide-items elements
                    document
                        .querySelectorAll(".hide-items")
                        .forEach(function (hideItem) {
                            hideItem.style.display = "none";
                        });

                    // Add active class to the clicked item
                    this.classList.add("active-user-item");

                    // Show the target hide-item associated with this accept-item
                    const target = this.getAttribute("data-target");
                    document.querySelector(target).style.display = "block";
                });
            });
        });
    </script>
    <script>
        document.getElementById('new-profile-image').addEventListener('change', function(event) {
            let reader = new FileReader();
            reader.onload = function(){
                document.getElementById('modal-profile-image').src = reader.result; // Показва новата снимка в модала
            };
            reader.readAsDataURL(event.target.files[0]);
        });
    </script>

@endsection
