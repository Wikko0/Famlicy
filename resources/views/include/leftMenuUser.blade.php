<div class="aside-left">
    <div class="user-profile">
        <div class="img">
            <img src="{{asset('images/users/user-' . Auth::user()->id . '.jpg')}}" alt="" />
        </div>
        <div class="user-info">
            <div class="name">{{Auth::user()->name}}</div>
        </div>
    </div>

    <div class="add-items">
        <a href="{{route('user.information', Auth::user()->username)}}" class="item ">
            <div class="title">My Information</div>
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

    </div>
    @include('ads.ad-container-300')
</div>
