@extends('layouts.main')
@section('content')
    <section class="welcome-section">
        <div class="container">
            @include('include.leftMenu')

            <div class="main">
                @include('include.alert')

                <div class="community-info">
                    <h1 class="community-name">{{ $community->name }}</h1>
                    <p class="community-description">{{ $community->description }}</p>
                    @if($community->hasPendingInvitation(Auth::user()->id))
                        <form action="{{ route('community.accept', ['communityId' => $community->id]) }}" method="POST">
                            @csrf

                            <button type="submit" class="invite-btn accept">
                            <span><i class="ri-user-add-line"></i></span> Accept Request
                            </button>
                        </form>
                    @endif
                </div>
                @if($community->isUserMember(Auth::user()->id))

                    @include('include.shareMemory')

                    @include('include.posts')
                @endif
            </div>
            @include('include.invite')
        </div>
    </section>
@endsection
