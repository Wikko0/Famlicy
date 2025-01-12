@extends('layouts.main')

@section('content')
    <div class="my-favourites">
        <div class="header-img">
            <img src="{{ asset('images/join-us.png') }}" alt="Header" />
            <div class="title">Create a Community That Values Every Memory</div>
        </div>
        @include('include/alert')
        <div class="favourite-sec">
            <div class="container">
                <div class="favourite-items">
                    @foreach ([
                        'location' => 'Location',
                        'instagram' => 'Instagram',
                        'color' => 'Favourite color',
                        'animal' => 'Favourite animal',
                        'hobby' => 'Favourite hobby',
                        'fruit' => 'Favourite fruit',
                        'cuisine' => 'Favourite cuisine',
                        'drink' => 'Favourite drink',
                        'dessert' => 'Favourite dessert',
                        'book' => 'Favourite book',
                        'author' => 'Favourite author',
                        'music' => 'Favourite music genre',
                        'artist' => 'Favourite musical artist',
                        'film' => 'Favourite film',
                        'actor' => 'Favourite actor',
                        'sport' => 'Favourite sport'
                    ] as $key => $label)
                        <div class="item">
                            <form method="POST" action="{{ route('user.information.update', ['username' => $user->username]) }}">
                                @csrf
                                <div class="name">{{ $label }}</div>
                                <div class="input-box">
                                    <input
                                        type="text"
                                        name="value"
                                        value="{{ $user->userInformation->{$key} ?? '' }}"
                                        placeholder="Enter your {{ strtolower($label) }}"
                                        >
                                    <input type="hidden" name="key" value="{{ $key }}">
                                    <button type="submit" class="add-btn">{{ $user->userInformation->{$key} ? 'Update' : 'Add' }}</button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
