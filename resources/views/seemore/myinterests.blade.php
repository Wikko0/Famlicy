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

                    <!-- My interests & favourites Section -->

                    <div class="card introduction-section">
                        <div class="card-header">
                            <h3>My interests & favourites</h3>
                        </div>
                        <div class="card-body">
                            @isset($user->userInformation->color)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/color-icon.png')}}" alt="Color Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite color:</div>
                                            <div
                                                class="info">{{$user->userInformation->color ?? 'No bio available'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->userInformation->animal)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/animal-icon.png')}}" alt="Animal Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite animal:</div>
                                            <div
                                                class="info">{{$user->userInformation->animal ?? 'No bio available'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->userInformation->hobby)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/hobby-icon.png')}}" alt="Hobby Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite hobby:</div>
                                            <div
                                                class="info">{{$user->userInformation->hobby ?? 'No bio available'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->userInformation->fruit)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/fruit-icon.png')}}" alt="Fruit Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite fruit:</div>
                                            <div
                                                class="info">{{$user->userInformation->fruit ?? 'No bio available'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->userInformation->cuisine)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/cuisine-icon.png')}}" alt="Cuisine Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite cuisine:</div>
                                            <div
                                                class="info">{{$user->userInformation->cuisine ?? 'No bio available'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->userInformation->drink)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/drink-icon.png')}}" alt="Drink Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite drink:</div>
                                            <div
                                                class="info">{{$user->userInformation->drink ?? 'No bio available'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->userInformation->dessert)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/dessert-icon.png')}}" alt="Dessert Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite dessert:</div>
                                            <div
                                                class="info">{{$user->userInformation->dessert ?? 'No bio available'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->userInformation->book)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/book-icon.png')}}" alt="Book Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite book:</div>
                                            <div
                                                class="info">{{$user->userInformation->book ?? 'No bio available'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->userInformation->author)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/author-icon.png')}}" alt="Author Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite author:</div>
                                            <div
                                                class="info">{{$user->userInformation->author ?? 'No bio available'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->userInformation->music_genre)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/music-icon.png')}}" alt="Music genre Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite music genre:</div>
                                            <div
                                                class="info">{{$user->userInformation->music_genre ?? 'No bio available'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->userInformation->music_artist)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/music-artist-icon.png')}}"
                                                 alt="Musical artist Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite musical artist:</div>
                                            <div
                                                class="info">{{$user->userInformation->music_artist ?? 'No bio available'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->userInformation->film)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/film-icon.png')}}" alt="Film Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite film:</div>
                                            <div
                                                class="info">{{$user->userInformation->film ?? 'No bio available'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->userInformation->actor)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/actor-icon.png')}}" alt="Actor Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite actor:</div>
                                            <div
                                                class="info">{{$user->userInformation->actor ?? 'No bio available'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->userInformation->sport)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/sport-icon.png')}}" alt="Sport Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite sport:</div>
                                            <div
                                                class="info">{{$user->userInformation->sport ?? 'No bio available'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                        </div>
                        <div class="edit-info-btn">
                            <a href="{{route('user.myinterests', $user->username)}}">
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
                    @include('include.userPart')

                    <!-- My interests & favourites Section -->
                    <div class="card introduction-section">
                        <div class="card-header">
                            <h3>My interests & favourites</h3>
                        </div>
                        <div class="card-body">
                            @isset($user->userInformation->color)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/color-icon.png')}}" alt="Color Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite color:</div>
                                            <div
                                                class="info">{{$user->userInformation->color ?? 'No bio available'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->userInformation->animal)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/animal-icon.png')}}" alt="Animal Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite animal:</div>
                                            <div
                                                class="info">{{$user->userInformation->animal ?? 'No bio available'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->userInformation->hobby)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/hobby-icon.png')}}" alt="Hobby Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite hobby:</div>
                                            <div
                                                class="info">{{$user->userInformation->hobby ?? 'No bio available'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->userInformation->fruit)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/fruit-icon.png')}}" alt="Fruit Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite fruit:</div>
                                            <div
                                                class="info">{{$user->userInformation->fruit ?? 'No bio available'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->userInformation->cuisine)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/cuisine-icon.png')}}" alt="Cuisine Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite cuisine:</div>
                                            <div
                                                class="info">{{$user->userInformation->cuisine ?? 'No bio available'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->userInformation->drink)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/drink-icon.png')}}" alt="Drink Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite drink:</div>
                                            <div
                                                class="info">{{$user->userInformation->drink ?? 'No bio available'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->userInformation->dessert)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/dessert-icon.png')}}" alt="Dessert Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite dessert:</div>
                                            <div
                                                class="info">{{$user->userInformation->dessert ?? 'No bio available'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->userInformation->book)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/book-icon.png')}}" alt="Book Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite book:</div>
                                            <div
                                                class="info">{{$user->userInformation->book ?? 'No bio available'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->userInformation->author)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/author-icon.png')}}" alt="Author Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite author:</div>
                                            <div
                                                class="info">{{$user->userInformation->author ?? 'No bio available'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->userInformation->music_genre)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/music-icon.png')}}" alt="Music genre Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite music genre:</div>
                                            <div
                                                class="info">{{$user->userInformation->music_genre ?? 'No bio available'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->userInformation->music_artist)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/music-artist-icon.png')}}"
                                                 alt="Musical artist Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite musical artist:</div>
                                            <div
                                                class="info">{{$user->userInformation->music_artist ?? 'No bio available'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->userInformation->film)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/film-icon.png')}}" alt="Film Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite film:</div>
                                            <div
                                                class="info">{{$user->userInformation->film ?? 'No bio available'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->userInformation->actor)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/actor-icon.png')}}" alt="Actor Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite actor:</div>
                                            <div
                                                class="info">{{$user->userInformation->actor ?? 'No bio available'}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            @isset($user->userInformation->sport)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/sport-icon.png')}}" alt="Sport Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite sport:</div>
                                            <div
                                                class="info">{{$user->userInformation->sport ?? 'No bio available'}}</div>
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
