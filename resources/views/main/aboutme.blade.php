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
                        'country' => 'Country of Residence',
                        'marital' => 'Martial Status',
                        'religious' => 'Religious Status',
                        'children' => 'Do you have children?',
                        'grandchildren' => 'Do you have children?',
                        'instagram' => 'Instagram'
                    ] as $key => $label)
                        <div class="item">
                            <form method="POST" action="{{ route('user.aboutme.update', ['username' => $user->username]) }}">
                                @csrf
                                <div class="name">{{ $label }}</div>
                                <div class="input-box">
                                    <input
                                        type="text"
                                        name="value"
                                        value="{{ $user->userInformation && $user->userInformation->{$key} ? $user->userInformation->{$key} : '' }}"
                                        placeholder="Enter your {{ strtolower($label) }}"
                                    >
                                    <input type="hidden" name="key" value="{{ $key }}">
                                    <button type="submit" class="add-btn">{{ $user->userInformation && $user->userInformation->{$key} ? 'Update' : 'Add' }}</button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
