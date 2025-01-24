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

    </div>
</div>
