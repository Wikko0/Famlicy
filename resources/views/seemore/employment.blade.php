@extends('layouts.main')

@section('content')
    <div class="my-favourites active-user">
        <div class="header-img">
            <img src="{{asset('images/community-share.png')}}" alt="Community Share"/>

            <div class="title">Create, Share, and Preserve Life’s Moments</div>
        </div>

        @include('include.alert')

        @if(Auth::user()->username == $user->username)
            <div class="favourite-sec">
                <div class="container">
                    <div class="user-part">
                        <div class="user-profile">
                            <div class="img">
                                <img id="profile-image"
                                     src="{{ asset('images/users/user-' . $user->id . '.jpg') }}"
                                     alt="Profile Image"
                                     data-bs-toggle="modal"
                                     data-bs-target="#changeProfileImageModal"
                                     class="img-thumbnail"
                                     width="100">
                            </div>
                            <div class="user-info">
                                <div class="name">{{ $user->name }}</div>
                            </div>
                            <button type="submit" class="friends-btn">
                                <span><i class="ri-home-2-fill"></i></span> Profile Clicks {{$clickCount}}
                            </button>
                        </div>
                    </div>

                    <!-- Profile In -->
                    @include('include.profileIn')

                    <!-- Employment Section -->

                    <div class="card introduction-section">
                            <div class="card-header">
                                <h3>Employment History</h3>
                            </div>
                            @isset($user->userEmployment)
                            <div class="card-body">
                                @foreach($user->userEmployment as $employment)
                                    <div class="item introduction-item mb-3">
                                        <div class="item-details">
                                            <div class="img">
                                                <img src="{{ asset('images/job-icon.png') }}" alt="Company Icon"/>
                                            </div>
                                            <div class="details">
                                                <div class="name">{{ $employment->name }}</div>
                                                <div class="info">
                                                    <strong>Job Title:</strong> {{ $employment->title ?? 'Not specified' }}
                                                </div>
                                                <div class="info">
                                                    <strong>Start Date:</strong> {{ \Carbon\Carbon::parse($employment->start_date)->format('d-m-Y') ?? 'Not specified' }}
                                                </div>
                                                @if($employment->end_date)
                                                    <div class="info">
                                                        <strong>End Date:</strong> {{ \Carbon\Carbon::parse($employment->end_date)->format('d-m-Y') }}
                                                    </div>
                                                @endif
                                                <div class="info">
                                                    <strong>Description:</strong> {{ $employment->description ?? 'Not specified' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @endisset

                            <div class="edit-info-btn">
                                <a href="{{ route('user.employment', $user->username) }}">
                                    <button class="btn-invite btn btn-primary">Edit Information</button>
                                </a>
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

                    <!-- Employment Section -->
                    @if($user->userEmployment->isNotEmpty())
                        <div class="card introduction-section">
                            <div class="card-header">
                                <h3>Employment History</h3>
                            </div>
                            <div class="card-body">
                                @foreach($user->userEmployment as $employment)
                                    <div class="item introduction-item mb-3">
                                        <div class="item-details">
                                            <div class="img">
                                                <img src="{{ asset('images/job-icon.png') }}" alt="Company Icon"/>
                                            </div>
                                            <div class="details">
                                                <div class="name">{{ $employment->name }}</div>
                                                <div class="info">
                                                    <strong>Job Title:</strong> {{ $employment->title ?? 'Not specified' }}
                                                </div>
                                                <div class="info">
                                                    <strong>Start Date:</strong> {{ \Carbon\Carbon::parse($employment->start_date)->format('d-m-Y') ?? 'Not specified' }}
                                                </div>
                                                @if($employment->end_date)
                                                    <div class="info">
                                                        <strong>End Date:</strong> {{ \Carbon\Carbon::parse($employment->end_date)->format('d-m-Y') }}
                                                    </div>
                                                @endif
                                                <div class="info">
                                                    <strong>Description:</strong> {{ $employment->description ?? 'Not specified' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    @endif


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
