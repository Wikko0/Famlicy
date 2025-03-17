<div class="aside-left">
    <div class="user-profile">
        <div class="img">
            <img src="{{asset('images/users/user-' . Auth::user()->id . '.jpg')}}" alt="" />
        </div>
        <div class="user-info">
            <div class="name">{{Auth::user()->name}}</div>
        </div>
        <div class="menu-toggle">
            <div class="arrow-container">
                <span class="arrow"></span>
            </div>
        </div>

    </div>


    <div class="add-items add-items-mobile">
        <a href="{{route('home')}}" class="item ">
            <div class="title">All</div>
            <button class="add-btn">Visit</button>
        </a>
        @if(isset($userCommunities))
            @foreach ($userCommunities as $community)
                <a href="{{ route('community.page', ['communityId' => $community->id]) }}" class="item">
                    <div class="title">{{ $community->name }}</div>
                    <button class="add-btn">Visit</button>
                </a>
            @endforeach
        @endif
    </div>

    @include('ads.ad-container-300')
</div>

