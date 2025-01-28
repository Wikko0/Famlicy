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
                            <button type="submit" class="friends-btn">
                                <span><i class="ri-home-2-fill"></i></span> Profile Clicks {{$clickCount}}
                            </button>
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

                    <!-- Education Section -->

                    <div class="card introduction-section">
                            <div class="card-header">
                                <h3>Education</h3>
                            </div>
                            @isset($user->userEducation)
                            <div class="card-body">
                                @foreach (['Primary School', 'Secondary School', 'College', 'University'] as $educationLevel)
                                    @php
                                        $education = $user->userEducation->where('name', $educationLevel)->first();
                                    @endphp

                                    @if($education)
                                        <div class="item introduction-item">
                                            <div class="item-details">
                                                <div class="img">
                                                    <img src="{{ asset('images/' . strtolower(str_replace(' ', '-', $educationLevel)) . '-icon.png') }}" alt="{{ $educationLevel }} Icon"/>
                                                </div>
                                                <div class="details">
                                                    <div class="name">{{ $educationLevel }}:</div>
                                                    <div class="info">
                                                        Start Date: {{ \Carbon\Carbon::parse($education->start_date)->format('d-m-Y') ?? 'Not specified'}}
                                                    </div>
                                                    <div class="info">
                                                        End Date: {{ \Carbon\Carbon::parse($education->end_date)->format('d-m-Y') ?? 'Not specified'}}
                                                    </div>

                                                    {{-- Проверка дали има предмети и ако не са празни --}}
                                                    @if($education->subject && $education->subject != "{\"\":null}")
                                                        <div class="info">
                                                            Subjects and Grades:
                                                            @php
                                                                $subjectsAndGrades = json_decode($education->subject, true);
                                                            @endphp
                                                            <ul>
                                                                @foreach($subjectsAndGrades as $subject => $grade)
                                                                    @if($subject && $grade)
                                                                        <li>{{ $subject }}: {{ $grade }}</li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            @endisset
                            <div class="edit-info-btn">
                                <a href="{{ route('user.education', $user->username) }}">
                                    <button class="btn-invite">Edit Information</button>
                                </a>
                            </div>
                        </div>



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

                    <!-- Life Section -->

                    <div class="card introduction-section">
                        <div class="card-header">
                            <h3>Life events & accomplishments</h3>
                        </div>
                        @isset($user->userLife)
                            <div class="card-body">
                                @foreach($user->userLife as $life)
                                    <div class="item introduction-item mb-3">
                                        <div class="item-details">
                                            <div class="img">
                                                <img src="{{ asset('images/life-event-icon.png') }}" alt="Life Event Icon"/>
                                            </div>
                                            <div class="details">
                                                <div class="name">{{ $life->name }}</div>
                                                <div class="info">
                                                    <strong>Type:</strong> {{ $life->type ?? 'Not specified' }}
                                                </div>
                                                <div class="info">
                                                    <strong>Start Date:</strong> {{ \Carbon\Carbon::parse($life->start_date)->format('d-m-Y') ?? 'Not specified' }}
                                                </div>
                                                @if($life->end_date)
                                                    <div class="info">
                                                        <strong>End Date:</strong> {{ \Carbon\Carbon::parse($life->end_date)->format('d-m-Y') }}
                                                    </div>
                                                @endif
                                                <div class="info">
                                                    <strong>Description:</strong> {{ $life->description ?? 'Not specified' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endisset

                        <div class="edit-info-btn">
                            <a href="{{ route('user.life', $user->username) }}">
                                <button class="btn-invite btn btn-primary">Edit Life Information</button>
                            </a>
                        </div>
                    </div>


                    <!-- Goals Section -->

                    <div class="card introduction-section">
                        <div class="card-header">
                            <h3>Goals & ambitions</h3>
                        </div>
                        @isset($user->userGoals)
                            <div class="card-body">
                                @foreach($user->userGoals as $goals)
                                    <div class="item introduction-item mb-3">
                                        <div class="item-details">
                                            <div class="img">
                                                <img src="{{ asset('images/goals-icon.png') }}" alt="Goals Icon"/>
                                            </div>
                                            <div class="details">
                                                <div class="info">
                                                    <strong>Goal:</strong> {{ $goals->name ?? 'Not specified' }}
                                                </div>
                                                <div class="info">
                                                    <strong>Start Date:</strong> {{ \Carbon\Carbon::parse($goals->start_date)->format('d-m-Y') ?? 'Not specified' }}
                                                </div>
                                                @if($goals->end_date)
                                                    <div class="info">
                                                        <strong>End Date:</strong> {{ \Carbon\Carbon::parse($goals->end_date)->format('d-m-Y') }}
                                                    </div>
                                                @endif
                                                <div class="info">
                                                    <strong>Description:</strong> {{ $goals->description ?? 'Not specified' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endisset

                        <div class="edit-info-btn">
                            <a href="{{ route('user.goals', $user->username) }}">
                                <button class="btn-invite btn btn-primary">Edit Goals & ambitions</button>
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

                    <!-- Education Section -->
                    @isset($user->userEducation)
                        <div class="card introduction-section">
                            <div class="card-header">
                                <h3>Education</h3>
                            </div>
                            <div class="card-body">
                                @foreach (['Primary School', 'Secondary School', 'College', 'University'] as $educationLevel)
                                    @php
                                        $education = $user->userEducation->where('name', $educationLevel)->first();
                                    @endphp

                                    @if($education)
                                        <div class="item introduction-item">
                                            <div class="item-details">
                                                <div class="img">
                                                    <img src="{{ asset('images/' . strtolower(str_replace(' ', '-', $educationLevel)) . '-icon.png') }}" alt="{{ $educationLevel }} Icon"/>
                                                </div>
                                                <div class="details">
                                                    <div class="name">{{ $educationLevel }}:</div>
                                                    <div class="info">
                                                        Start Date: {{ \Carbon\Carbon::parse($education->start_date)->format('d-m-Y') ?? 'Not specified'}}
                                                    </div>
                                                    <div class="info">
                                                        End Date: {{ \Carbon\Carbon::parse($education->end_date)->format('d-m-Y') ?? 'Not specified'}}
                                                    </div>

                                                    {{-- Проверка дали има предмети и ако не са празни --}}
                                                    @if($education->subject && $education->subject != "{\"\":null}")
                                                        <div class="info">
                                                            Subjects and Grades:
                                                            @php
                                                                $subjectsAndGrades = json_decode($education->subject, true);
                                                            @endphp
                                                            <ul>
                                                                @foreach($subjectsAndGrades as $subject => $grade)
                                                                    @if($subject && $grade)
                                                                        <li>{{ $subject }}: {{ $grade }}</li>
                                                                    @endif
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <div class="edit-info-btn">
                                <a href="{{ route('user.education', $user->username) }}">
                                    <button class="btn-invite">Edit Information</button>
                                </a>
                            </div>
                        </div>
                    @endisset


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

                    <!-- Life Section -->
                    @if($user->userLife->isNotEmpty())
                    <div class="card introduction-section">
                        <div class="card-header">
                            <h3>Life events & accomplishments</h3>
                        </div>

                            <div class="card-body">
                                @foreach($user->userLife as $life)
                                    <div class="item introduction-item mb-3">
                                        <div class="item-details">
                                            <div class="img">
                                                <img src="{{ asset('images/life-event-icon.png') }}" alt="Life Event Icon"/>
                                            </div>
                                            <div class="details">
                                                <div class="name">{{ $life->name }}</div>
                                                <div class="info">
                                                    <strong>Type:</strong> {{ $life->type ?? 'Not specified' }}
                                                </div>
                                                <div class="info">
                                                    <strong>Start Date:</strong> {{ \Carbon\Carbon::parse($life->start_date)->format('d-m-Y') ?? 'Not specified' }}
                                                </div>
                                                @if($life->end_date)
                                                    <div class="info">
                                                        <strong>End Date:</strong> {{ \Carbon\Carbon::parse($life->end_date)->format('d-m-Y') }}
                                                    </div>
                                                @endif
                                                <div class="info">
                                                    <strong>Description:</strong> {{ $life->description ?? 'Not specified' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                    </div>
                    @endif

                    <!-- Goals Section -->
                    @if($user->userGoals->isNotEmpty())
                        <div class="card introduction-section">
                            <div class="card-header">
                                <h3>Goals & ambitions</h3>
                            </div>

                            <div class="card-body">
                                @foreach($user->userGoals as $goals)
                                    <div class="item introduction-item mb-3">
                                        <div class="item-details">
                                            <div class="img">
                                                <img src="{{ asset('images/goals-icon.png') }}" alt="Goals Icon"/>
                                            </div>
                                            <div class="details">
                                                <div class="info">
                                                    <strong>Goal:</strong> {{ $goals->name ?? 'Not specified' }}
                                                </div>
                                                <div class="info">
                                                    <strong>Start Date:</strong> {{ \Carbon\Carbon::parse($goals->start_date)->format('d-m-Y') ?? 'Not specified' }}
                                                </div>
                                                @if($goals->end_date)
                                                    <div class="info">
                                                        <strong>End Date:</strong> {{ \Carbon\Carbon::parse($goals->end_date)->format('d-m-Y') }}
                                                    </div>
                                                @endif
                                                <div class="info">
                                                    <strong>Description:</strong> {{ $goals->description ?? 'Not specified' }}
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
@endsection
