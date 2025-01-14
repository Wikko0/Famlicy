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
                                <img src="{{asset('images/users/user-' . $user->id . '.jpg')}}" alt=""/>
                            </div>
                            <div class="user-info">
                                <div class="name">{{$user->name}}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Introduction Section -->

                    <div class="card introduction-section">
                        <div class="card-header">
                            <h3>Introduction</h3>
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

                            @isset($user->userInformation->bio)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/color-icon.png')}}" alt="Color Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite color:</div>
                                            <div
                                                class="info">{{$user->userInformation->bio ?? 'No bio available'}}</div>
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
                            <a href="{{route('user.information', $user->username)}}">
                                <button class="btn-invite">Edit Information</button>
                            </a>
                        </div>
                    </div>


                    <div class="active-user-items">
                        <div
                            class="item accept-item active-user-item"
                            data-target=".hide-item-one"
                        >
                            <div class="item-details">
                                <div class="img">
                                    <img src="../assets/user-1.webp" alt=""/>
                                </div>
                                <div class="details">
                                    <div class="name">Carles Vendas</div>
                                    <div class="status accept">Accepted</div>
                                </div>
                            </div>
                        </div>

                        <div class="item accept-item" data-target=".hide-item-two">
                            <div class="item-details">
                                <div class="img">
                                    <img src="../assets/user-3.webp" alt=""/>
                                </div>
                                <div class="details">
                                    <div class="name">Richard miad</div>
                                    <div class="status accept">Accepted</div>
                                </div>
                            </div>
                        </div>

                        <div class="item accept-item" data-target=".hide-item-three">
                            <div class="item-details">
                                <div class="img">
                                    <img src="../assets/user-7.webp" alt=""/>
                                </div>
                                <div class="details">
                                    <div class="name">stepine matthe</div>
                                    <div class="status accept">Accepted</div>
                                </div>
                            </div>
                        </div>

                        <div class="hide-items hide-item-one">
                            <div class="hide-item-details">
                                <div class="circle">Add to Family circle</div>
                                <div class="circle">Add to Vocational circle</div>
                                <div class="circle">Add to Inner circle</div>
                                <div class="circle">Add to Educational circle</div>
                                <div class="circle">Add to Spritual circle</div>
                                <div class="circle">Add to Financial circle</div>
                            </div>
                        </div>

                        <div class="hide-items hide-item-two">
                            <div class="hide-item-details">
                                <div class="circle">Add to Financial circle</div>
                                <div class="circle">Add to Family circle</div>
                                <div class="circle">Add to Educational circle</div>
                                <div class="circle">Add to Spritual circle</div>
                                <div class="circle">Add to Vocational circle</div>
                                <div class="circle">Add to Inner circle</div>
                            </div>
                        </div>

                        <div class="hide-items hide-item-three">
                            <div class="hide-item-details">
                                <div class="circle">Add to Inner circle</div>
                                <div class="circle">Add to Family circle</div>
                                <div class="circle">Add to Vocational circle</div>
                                <div class="circle">Add to Educational circle</div>
                                <div class="circle">Add to Spritual circle</div>
                                <div class="circle">Add to Financial circle</div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="item-details">
                                <div class="img">
                                    <img src="../assets/avater.png" alt=""/>
                                </div>
                                <div class="details">
                                    <div class="name">Carles Vendas</div>
                                    <div class="status pending">pending</div>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="item-details">
                                <div class="img">
                                    <img src="../assets/avater.png" alt=""/>
                                </div>
                                <div class="details">
                                    <div class="name">Richard miad</div>
                                    <div class="status pending">pending</div>
                                </div>
                            </div>
                        </div>

                        <div class="item">
                            <div class="item-details">
                                <div class="img">
                                    <img src="../assets/avater.png" alt=""/>
                                </div>
                                <div class="details">
                                    <div class="name">stepine matthe</div>
                                    <div class="status pending">pending</div>
                                </div>
                            </div>
                        </div>
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
                            <!-- Ако е получил покана -->
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
                            <!-- Ако няма нито покана изпратена, нито получена -->
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

                    <!-- Introduction Section -->
                    <div class="card introduction-section">
                        <div class="card-header">
                            <h3>Introduction</h3>
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

                            @isset($user->userInformation->bio)
                                <div class="item introduction-item">
                                    <div class="item-details">
                                        <div class="img">
                                            <img src="{{asset('images/color-icon.png')}}" alt="Color Icon"/>
                                        </div>
                                        <div class="details">
                                            <div class="name">Favourite color:</div>
                                            <div
                                                class="info">{{$user->userInformation->bio ?? 'No bio available'}}</div>
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
@endsection
