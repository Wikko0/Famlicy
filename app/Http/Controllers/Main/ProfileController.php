<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\FriendAcceptNotification;
use App\Notifications\FriendDeclineNotification;
use App\Notifications\FriendRequestNotification;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index($username): View
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('main.profile', compact('user'));
    }

    public function follow(User $user)
    {
        if ($user->id == auth()->id()) {
            return back()->withErrors('You can\'t follow yourself!');
        }

        if (auth()->user()->isFollowing($user)) {
            return back()->withErrors('You are already following this user!');
        }

        auth()->user()->following()->attach($user->id);

        return back()->withSuccess('You started following ' . $user->name);
    }

    public function unfollow(User $user)
    {

        if ($user->id == auth()->id()) {
            return back()->withErrors('You can\'t stop following yourself!');
        }


        auth()->user()->following()->detach($user->id);

        return back()->withSuccess('Stop following ' . $user->name);
    }

    public function sendRequest(User $user)
    {
        if (auth()->user()->id == $user->id) {
            return back()->withErrors('You can\'t send an invitation to yourself!');
        }

        if (auth()->user()->hasSentRequest($user) || auth()->user()->isFriendWith($user)) {
            return back()->withErrors('You have already sent an invitation or are friends!');
        }

        auth()->user()->sentFriendRequests()->attach($user->id, [
            'status' => 'invite',
            'status_friend' => 'pending',
        ]);
        $user->notify(new FriendRequestNotification(auth()->user()));

        return back()->withSuccess('Friend request sent!');
    }

    public function acceptRequest(User $user)
    {
        if (!auth()->user()->hasReceivedRequest($user)) {
            return back()->with('error', 'There is no friend request from this user!');
        }

        // Променяме статуса на поканата на "приятели"
        auth()->user()->receivedFriendRequests()->updateExistingPivot($user->id, [
            'status' => 'friends',
            'status_friend' => null,
            ]);
        $user->sentFriendRequests()->updateExistingPivot(auth()->user()->id, [
            'status' => 'friends',
            'status_friend' => null,
        ]);

        $user->notify(new FriendAcceptNotification(auth()->user()));

        return back()->with('success', 'Friend request approved!');
    }

// Отхвърляне на покана за приятелство
    public function declineRequest(User $user)
    {
        if (!auth()->user()->hasReceivedRequest($user)) {
            return back()->with('error', 'There is no friend request from this user!');
        }

        // Отказваме поканата
        auth()->user()->receivedFriendRequests()->detach($user->id);
        $user->sentFriendRequests()->detach(auth()->user()->id);
        $user->notify(new FriendDeclineNotification(auth()->user()));

        return back()->with('success', 'Friend request declined!');
    }

    public function removeFriend(User $user)
    {
        if (!auth()->user()->isFriendWith($user)) {
            return back()->withErrors('You are not friends with this user!');
        }

        auth()->user()->friends()->detach($user->id);
        $user->friends()->detach(auth()->user()->id);

        return back()->withSuccess('The friendship was removed!');
    }
}
