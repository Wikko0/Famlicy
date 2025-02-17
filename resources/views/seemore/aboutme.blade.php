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

                    <!-- Modal for changing profile picture -->
                    <div class="modal fade" id="changeProfileImageModal" tabindex="-1" aria-labelledby="changeProfileImageModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="changeProfileImageModalLabel">Change Profile Picture</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center">
                                        <img id="modal-profile-image"
                                             src="{{ asset('images/users/user-' . $user->id . '.jpg') }}"
                                             alt="Current Profile Image"
                                             class="img-thumbnail"
                                             width="150">
                                    </div>
                                    <form id="upload-form" method="POST" action="{{ route('user.updateProfileImage', $user->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mt-3">
                                            <label for="new-profile-image" class="form-label">Upload New Image</label>
                                            <input type="file" class="form-control" name="image" id="new-profile-image" accept="image/*">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="profile">
                    <div class="add-items">
                        <a href="{{route('user.aboutme', Auth::user()->username)}}" class="item ">
                            <div class="title">About Me</div>
                            <button class="add-btn">Visit</button>
                        </a>
                        <a href="{{route('user.myinterests', Auth::user()->username)}}" class="item ">
                            <div class="title">My interests & favourites</div>
                            <button class="add-btn">Visit</button>
                        </a>
                        <a href="{{route('user.education', Auth::user()->username)}}" class="item ">
                            <div class="title">Education</div>
                            <button class="add-btn">Visit</button>
                        </a>
                        <a href="{{route('user.employment', Auth::user()->username)}}" class="item ">
                            <div class="title">Employment & vocation</div>
                            <button class="add-btn">Visit</button>
                        </a>
                        <a href="{{route('user.life', Auth::user()->username)}}" class="item ">
                            <div class="title">Life events & accomplishments</div>
                            <button class="add-btn">Visit</button>
                        </a>
                        <a href="{{route('user.goals', Auth::user()->username)}}" class="item ">
                            <div class="title">Goals & ambitions</div>
                            <button class="add-btn">Visit</button>
                        </a>
                        <a href="{{route('family.register', Auth::user()->username)}}" class="item ">
                            <div class="title">Create Account for Family Member</div>
                            <button class="add-btn">Create</button>
                        </a>
                    </div>
                    </div>
                    <!-- About Me Section -->

                    <div class="card introduction-section">
                        <div class="card-header">
                            <h3>About me</h3>
                        </div>
                        <div class="card-body">
                            @isset($user->userInformation->location)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/location-icon.png')}}" alt="Location Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Location:</div>
                                            <div
                                                class="info">{{$user->userInformation->location ?? 'Not specified'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                                @isset($user->userInformation->country)
                                    <div class="item introduction-item">
                                        <div class="item-details">
                                            <div class="img">
                                                <img src="{{asset('images/flag-icon.png')}}" alt="Country Icon"/>
                                            </div>
                                            <div class="details">
                                                <div class="name">Country:</div>
                                                <div
                                                    class="info">{{$user->userInformation->country ?? 'Not specified'}}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endisset

                                @isset($user->userInformation->marital)
                                    <div class="item introduction-item">
                                        <div class="item-details">
                                            <div class="img">
                                                <img src="{{asset('images/marital-icon.png')}}" alt="Marital Icon"/>
                                            </div>
                                            <div class="details">
                                                <div class="name">Marital Status:</div>
                                                <div
                                                    class="info">{{$user->userInformation->marital ?? 'Not specified'}}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endisset

                                @isset($user->userInformation->religious)
                                    <div class="item introduction-item">
                                        <div class="item-details">
                                            <div class="img">
                                                <img src="{{asset('images/religion-icon.png')}}" alt="Religious Icon"/>
                                            </div>
                                            <div class="details">
                                                <div class="name">Religious Status:</div>
                                                <div
                                                    class="info">{{$user->userInformation->religious ?? 'Not specified'}}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endisset

                                @isset($user->userInformation->children)
                                    <div class="item introduction-item">
                                        <div class="item-details">
                                            <div class="img">
                                                <img src="{{asset('images/children-icon.png')}}" alt="Children Icon"/>
                                            </div>
                                            <div class="details">
                                                <div class="name">Do I have children?:</div>
                                                <div
                                                    class="info">{{$user->userInformation->children ?? 'Not specified'}}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endisset

                                @isset($user->userInformation->grandchildren)
                                    <div class="item introduction-item">
                                        <div class="item-details">
                                            <div class="img">
                                                <img src="{{asset('images/children-icon.png')}}" alt="Children Icon"/>
                                            </div>
                                            <div class="details">
                                                <div class="name">Do I have grandchildren?:</div>
                                                <div
                                                    class="info">{{$user->userInformation->grandchildren ?? 'Not specified'}}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endisset

                            @isset($user->userInformation->birthday)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/calendar-icon.png')}}" alt="Calendar Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Date of Birth:</div>
                                            <div
                                                class="info">{{$user->userInformation->birthday ?? 'No birthday available'}} @if(!empty($user->died))
                                                    - {{$user->died}}
                                                @endif</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->created_at)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/member-icon.png')}}" alt="Member Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Member since:</div>
                                            <div class="info">{{$user->created_at->format('Y-m-d')}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->userInformation->instagram)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/instagram-icon.png')}}" alt="Instagram Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Instagram:</div>
                                            <div class="info">
                                                <a href="https://instagram.com/{{$user->userInformation->instagram}}"
                                                   target="_blank">
                                                    {{$user->userInformation->instagram ?? 'Not specified'}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                        </div>
                        <div class="edit-info-btn">
                            <a href="{{route('user.aboutme', $user->username)}}">
                                <button class="btn-invite">Edit Information</button>
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
                    <div class="user-part">
                        <div class="user-profile">
                            <div class="img">
                                <img src="{{asset('images/users/user-' . $user->id . '.jpg')}}" alt=""/>
                            </div>
                            <div class="user-info">
                                <div class="name">{{$user->name}}</div>
                            </div>
                        </div>
                        @if(auth()->user()->isFriendWith($user))

                                <button type="submit" class="friends-btn">
                                    <span><i class="ri-user-heart-fill"></i></span> Friend
                                </button>
                        @endif
                        @if(auth()->user()->isFriendWith($user))
                            <form action="{{ route('removeFriend', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="invite-btn unfollow">
                                    <span><i class="ri-user-delete-line"></i></span> Remove Friend
                                </button>
                            </form>
                        @elseif(auth()->user()->hasReceivedRequest($user))
                            <form action="{{ route('acceptRequest', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="invite-btn accept">
                                    <span><i class="ri-user-heart-fill"></i></span> Accept Friend Request
                                </button>
                            </form>
                            <form action="{{ route('declineRequest', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="invite-btn decline">
                                    <span><i class="ri-user-delete-line"></i></span> Decline Request
                                </button>
                            </form>
                        @elseif(auth()->user()->hasSentRequest($user))
                            <button class="invite-btn pending" disabled>
                                <span><i class="ri-time-line"></i></span> Invite Sent
                            </button>
                        @else
                            <form action="{{ route('sendRequest', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="invite-btn">
                                    <span><i class="ri-user-add-line"></i></span> Send Friend Request
                                </button>
                            </form>
                        @endif

                        <form
                            action="{{ route(auth()->user()->isFollowing($user) ? 'unfollow' : 'follow', $user->id) }}"
                            method="POST">
                            @csrf
                            <button type="submit"
                                    class="follow-btn {{ auth()->user()->isFollowing($user) ? 'unfollow' : '' }}">
                                    <span>
                                      <i class="ri-user-{{ auth()->user()->isFollowing($user) ? 'minus-fill' : 'add-line' }}"></i>
                                    </span>
                                {{ auth()->user()->isFollowing($user) ? 'Unfollow' : 'Follow' }}
                            </button>
                        </form>
                    </div>

                    <!-- About me Section -->
                    <div class="card introduction-section">
                        <div class="card-header">
                            <h3>About me</h3>
                        </div>
                        <div class="card-body">
                            @isset($user->userInformation->location)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/location-icon.png')}}" alt="Location Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Location:</div>
                                            <div
                                                class="info">{{$user->userInformation->location ?? 'Not specified'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                                @isset($user->userInformation->country)
                                    <div class="item introduction-item">
                                        <div class="item-details">
                                            <div class="img">
                                                <img src="{{asset('images/flag-icon.png')}}" alt="Country Icon"/>
                                            </div>
                                            <div class="details">
                                                <div class="name">Country:</div>
                                                <div
                                                    class="info">{{$user->userInformation->country ?? 'Not specified'}}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endisset

                                @isset($user->userInformation->marital)
                                    <div class="item introduction-item">
                                        <div class="item-details">
                                            <div class="img">
                                                <img src="{{asset('images/marital-icon.png')}}" alt="Marital Icon"/>
                                            </div>
                                            <div class="details">
                                                <div class="name">Marital Status:</div>
                                                <div
                                                    class="info">{{$user->userInformation->marital ?? 'Not specified'}}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endisset

                                @isset($user->userInformation->religious)
                                    <div class="item introduction-item">
                                        <div class="item-details">
                                            <div class="img">
                                                <img src="{{asset('images/religion-icon.png')}}" alt="Religious Icon"/>
                                            </div>
                                            <div class="details">
                                                <div class="name">Religious Status:</div>
                                                <div
                                                    class="info">{{$user->userInformation->religious ?? 'Not specified'}}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endisset

                                @isset($user->userInformation->children)
                                    <div class="item introduction-item">
                                        <div class="item-details">
                                            <div class="img">
                                                <img src="{{asset('images/children-icon.png')}}" alt="Children Icon"/>
                                            </div>
                                            <div class="details">
                                                <div class="name">Do I have children?:</div>
                                                <div
                                                    class="info">{{$user->userInformation->children ?? 'Not specified'}}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endisset

                                @isset($user->userInformation->grandchildren)
                                    <div class="item introduction-item">
                                        <div class="item-details">
                                            <div class="img">
                                                <img src="{{asset('images/children-icon.png')}}" alt="Children Icon"/>
                                            </div>
                                            <div class="details">
                                                <div class="name">Do I have grandchildren?:</div>
                                                <div
                                                    class="info">{{$user->userInformation->grandchildren ?? 'Not specified'}}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endisset

                            @isset($user->userInformation->birthday)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/calendar-icon.png')}}" alt="Calendar Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Date of Birth:</div>
                                            <div
                                                class="info">{{$user->userInformation->birthday ?? 'No birthday available'}} @if(!empty($user->died))
                                                    - {{$user->died}}
                                                @endif</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->created_at)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/member-icon.png')}}" alt="Member Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Member since:</div>
                                            <div class="info">{{$user->created_at->format('Y-m-d')}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->userInformation->instagram)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/instagram-icon.png')}}" alt="Instagram Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Instagram:</div>
                                            <div class="info">
                                                <a href="https://instagram.com/{{$user->userInformation->instagram}}"
                                                   target="_blank">
                                                    {{$user->userInformation->instagram ?? 'Not specified'}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endisset
                        </div>
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
