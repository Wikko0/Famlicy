@extends('layouts.main')

@section('content')
    <!-- ~~~~~~~~~~~~~~~~ JOIN-US-SECTION ~~~~~~~~~~~~~~ -->

    <section class="join-us create-community">
        <div class="left-section">
            <img src="{{ asset('images/community.png') }}" alt="" class="background-image" />
            <div class="overlay-text">
                <div class="main-text">Welcome to Famlicy</div>
                <div class="sub-text">Treasure your thoughts & share them with those who care</div>
            </div>
            <div class="section-title">Create a Community That Values Every Memory</div>
        </div>




        <div class="right">
            @include('include/alert')
            <div class="user-profile">
                <div class="img">
                    <img src="{{asset('images/users/user-' . $user->id . '.jpg')}}" alt=""/>
                </div>
                <div class="user-info">
                    <div class="name">{{$user->name}}</div>
                </div>
            </div>

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
    </section>
@endsection
