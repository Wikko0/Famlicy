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
    @if(!$user->died)
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
