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


                        </div>
                        <div class="edit-info-btn">
                            <a href="{{route('seemore.aboutme', $user->username)}}">
                                <button class="btn-invite">See More</button>
                            </a>
                            <a href="{{route('user.aboutme', $user->username)}}">
                                <button class="btn-invite">Edit Information</button>
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
                            @isset($user->userEducation)
                            <div class="card-body">
                                @foreach ($user->userEducation->take(4) as $education)

                                        <div class="item introduction-item">
                                            <div class="item-details">
                                                <div class="img">
                                                    <img src="{{ asset('images/' . strtolower(str_replace(' ', '-', $education->school)) . '-icon.png') }}" alt="{{ $education->school }} Icon"/>
                                                </div>
                                                <div class="details">
                                                    <div class="name">{{ $education->school }}: {{$education->name}}</div>
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
                                @endforeach
                            </div>
                            @endisset
                            <div class="edit-info-btn">
                                <a href="{{route('seemore.education', $user->username)}}">
                                    <button class="btn-invite">See More</button>
                                </a>
                                <a href="{{ route('user.education', $user->username) }}">
                                    <button class="btn-invite">Edit Information</button>
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
                            @isset($user->userEmployment)
                            <div class="card-body">
                                @foreach($user->userEmployment->take(4) as $employment)
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
                                <a href="{{route('seemore.employment', $user->username)}}">
                                    <button class="btn-invite">See More</button>
                                </a>
                                <a href="{{ route('user.employment', $user->username) }}">
                                    <button class="btn-invite btn btn-primary">Edit Information</button>
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
                        @isset($user->userLife)
                            <div class="card-body">
                                @foreach($user->userLife->take(4) as $life)
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
                                                @if($life->start_date)
                                                <div class="info">
                                                    <strong>Start Date:</strong> {{ \Carbon\Carbon::parse($life->start_date)->format('d-m-Y') ?? 'Not specified' }}
                                                </div>
                                                @endif
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
                            <a href="{{route('seemore.life', $user->username)}}">
                                <button class="btn-invite">See More</button>
                            </a>
                            <a href="{{ route('user.life', $user->username) }}">
                                <button class="btn-invite btn btn-primary">Edit Life Information</button>
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
                        @isset($user->userGoals)
                            <div class="card-body">
                                @foreach($user->userGoals->take(4) as $goals)
                                    <div class="item introduction-item mb-3">
                                        <div class="item-details">
                                            <div class="img">
                                                <img src="{{ asset('images/goals-icon.png') }}" alt="Goals Icon"/>
                                            </div>
                                            <div class="details">
                                                <div class="info">
                                                    <strong>Goal:</strong> {{ $goals->name ?? 'Not specified' }}
                                                </div>
                                                @if($goals->start_date)
                                                <div class="info">
                                                    <strong>Start Date:</strong> {{ \Carbon\Carbon::parse($goals->start_date)->format('d-m-Y') ?? 'Not specified' }}
                                                </div>
                                                @endif
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
                            <a href="{{route('seemore.goals', $user->username)}}">
                                <button class="btn-invite">See More</button>
                            </a>
                            <a href="{{ route('user.goals', $user->username) }}">
                                <button class="btn-invite btn btn-primary">Edit Goals & ambitions</button>
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

                        </div>
                        <div class="edit-info-btn">
                            <a href="{{route('seemore.myinterests', $user->username)}}">
                                <button class="btn-invite">See More</button>
                            </a>
                            <a href="{{route('user.myinterests', $user->username)}}">
                                <button class="btn-invite">Edit Information</button>
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


                                </div>
                                <div class="edit-info-btn">
                                    <a href="{{route('seemore.aboutme', $user->username)}}">
                                        <button class="btn-invite">See More</button>
                                    </a>
                                    <a href="{{route('user.aboutme', $user->username)}}">
                                        <button class="btn-invite">Edit Information</button>
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
                                @isset($user->userEducation)
                                    <div class="card-body">
                                        @foreach ($user->userEducation->take(4) as $education)

                                            <div class="item introduction-item">
                                                <div class="item-details">
                                                    <div class="img">
                                                        <img src="{{ asset('images/' . strtolower(str_replace(' ', '-', $education->school)) . '-icon.png') }}" alt="{{ $education->school }} Icon"/>
                                                    </div>
                                                    <div class="details">
                                                        <div class="name">{{ $education->school }}: {{$education->name}}</div>
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
                                        @endforeach
                                    </div>
                                @endisset
                                <div class="edit-info-btn">
                                    <a href="{{route('seemore.education', $user->username)}}">
                                        <button class="btn-invite">See More</button>
                                    </a>
                                    <a href="{{ route('user.education', $user->username) }}">
                                        <button class="btn-invite">Edit Information</button>
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
                                @isset($user->userEmployment)
                                    <div class="card-body">
                                        @foreach($user->userEmployment->take(4) as $employment)
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
                                    <a href="{{route('seemore.employment', $user->username)}}">
                                        <button class="btn-invite">See More</button>
                                    </a>
                                    <a href="{{ route('user.employment', $user->username) }}">
                                        <button class="btn-invite btn btn-primary">Edit Information</button>
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
                                @isset($user->userLife)
                                    <div class="card-body">
                                        @foreach($user->userLife->take(4) as $life)
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
                                                        @if($life->start_date)
                                                            <div class="info">
                                                                <strong>Start Date:</strong> {{ \Carbon\Carbon::parse($life->start_date)->format('d-m-Y') ?? 'Not specified' }}
                                                            </div>
                                                        @endif
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
                                    <a href="{{route('seemore.life', $user->username)}}">
                                        <button class="btn-invite">See More</button>
                                    </a>
                                    <a href="{{ route('user.life', $user->username) }}">
                                        <button class="btn-invite btn btn-primary">Edit Life Information</button>
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
                                @isset($user->userGoals)
                                    <div class="card-body">
                                        @foreach($user->userGoals->take(4) as $goals)
                                            <div class="item introduction-item mb-3">
                                                <div class="item-details">
                                                    <div class="img">
                                                        <img src="{{ asset('images/goals-icon.png') }}" alt="Goals Icon"/>
                                                    </div>
                                                    <div class="details">
                                                        <div class="info">
                                                            <strong>Goal:</strong> {{ $goals->name ?? 'Not specified' }}
                                                        </div>
                                                        @if($goals->start_date)
                                                            <div class="info">
                                                                <strong>Start Date:</strong> {{ \Carbon\Carbon::parse($goals->start_date)->format('d-m-Y') ?? 'Not specified' }}
                                                            </div>
                                                        @endif
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
                                    <a href="{{route('seemore.goals', $user->username)}}">
                                        <button class="btn-invite">See More</button>
                                    </a>
                                    <a href="{{ route('user.goals', $user->username) }}">
                                        <button class="btn-invite btn btn-primary">Edit Goals & ambitions</button>
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

                                </div>
                                <div class="edit-info-btn">
                                    <a href="{{route('seemore.myinterests', $user->username)}}">
                                        <button class="btn-invite">See More</button>
                                    </a>
                                    <a href="{{route('user.myinterests', $user->username)}}">
                                        <button class="btn-invite">Edit Information</button>
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
                    <div class="row">
                        <div class="col-md-6">
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


                        </div>
                        <div class="edit-info-btn">
                            <a href="{{route('seemore.aboutme', $user->username)}}">
                                <button class="btn-invite">See More</button>
                            </a>
                        </div>
                    </div>
                        </div>
                    <!-- Education Section -->

                    @if($user->userEducation->isNotEmpty())
                            <div class="col-md-6">
                        <div class="card introduction-section">
                            <div class="card-header">
                                <h3>Education</h3>
                            </div>
                            <div class="card-body">
                                @foreach ($user->userEducation->take(4) as $education)

                                    <div class="item introduction-item">
                                        <div class="item-details">
                                            <div class="img">
                                                <img src="{{ asset('images/' . strtolower(str_replace(' ', '-', $education->school)) . '-icon.png') }}" alt="{{ $education->school }} Icon"/>
                                            </div>
                                            <div class="details">
                                                <div class="name">{{ $education->school }}: {{$education->name}}</div>
                                                <div class="info">
                                                    Start Date: {{ \Carbon\Carbon::parse($education->start_date)->format('d-m-Y') ?? 'Not specified'}}
                                                </div>
                                                <div class="info">
                                                    End Date: {{ \Carbon\Carbon::parse($education->end_date)->format('d-m-Y') ?? 'Not specified'}}
                                                </div>

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
                                @endforeach
                            </div>

                            <div class="edit-info-btn">
                                <a href="{{route('seemore.education', $user->username)}}">
                                    <button class="btn-invite">See More</button>
                                </a>
                            </div>
                        </div>
                            </div>
                    @endif


                    <!-- Employment Section -->

                    @if($user->userEmployment->isNotEmpty())
                            <div class="col-md-6">
                        <div class="card introduction-section">
                            <div class="card-header">
                                <h3>Employment History</h3>
                            </div>
                            <div class="card-body">
                                @foreach($user->userEmployment->take(4) as $employment)
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
                            <div class="edit-info-btn">
                                <a href="{{route('seemore.education', $user->username)}}">
                                    <button class="btn-invite">See More</button>
                                </a>
                            </div>
                        </div>
                            </div>
                    @endif

                    <!-- Life Section -->

                    @if($user->userLife->isNotEmpty())
                            <div class="col-md-6">
                    <div class="card introduction-section">
                        <div class="card-header">
                            <h3>Life events & accomplishments</h3>
                        </div>

                            <div class="card-body">
                                @foreach($user->userLife->take(4) as $life)
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
                        <div class="edit-info-btn">
                            <a href="{{route('seemore.life', $user->username)}}">
                                <button class="btn-invite">See More</button>
                            </a>
                        </div>
                    </div>
                            </div>
                    @endif

                    <!-- Goals Section -->

                    @if($user->userGoals->isNotEmpty())
                            <div class="col-md-6">
                        <div class="card introduction-section">
                            <div class="card-header">
                                <h3>Goals & ambitions</h3>
                            </div>

                            <div class="card-body">
                                @foreach($user->userGoals->take(4) as $goals)
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
                            <div class="edit-info-btn">
                                <a href="{{route('seemore.goals', $user->username)}}">
                                    <button class="btn-invite">See More</button>
                                </a>
                            </div>
                        </div>
                            </div>
                    @endif

                    <!-- My interests & favourites Section -->
                        <div class="col-md-6">
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

                        </div>
                        <div class="edit-info-btn">
                            <a href="{{route('seemore.myinterests', $user->username)}}">
                                <button class="btn-invite">See More</button>
                            </a>
                        </div>
                    </div>
                        </div>
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
