<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Community;
use App\Models\ProfileClick;
use App\Models\User;
use App\Notifications\FriendAcceptNotification;
use App\Notifications\FriendDeclineNotification;
use App\Notifications\FriendRequestNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function index($username): View
    {
        $user = User::where('username', $username)->firstOrFail();
        $communities = Community::whereJsonContains('users', $user->id)->get();
        $friends = $user->friends();
        $pendingFriend = $user->pendingFriend;
        if (auth()->id() !== $user->id) {
            ProfileClick::create([
                'user_id' => auth()->id(),
                'profile_id' => $user->id,
            ]);
        }

        $clickCount = ProfileClick::where('profile_id', $user->id)->count();
        return view('main.profile', compact('user', 'friends', 'communities', 'pendingFriend', 'clickCount'));
    }

    public function follow(User $user): RedirectResponse
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

    public function unfollow(User $user): RedirectResponse
    {

        if ($user->id == auth()->id()) {
            return back()->withErrors('You can\'t stop following yourself!');
        }


        auth()->user()->following()->detach($user->id);

        return back()->withSuccess('Stop following ' . $user->name);
    }

    public function sendRequest(User $user): RedirectResponse
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

    public function acceptRequest(User $user): RedirectResponse
    {
        if (!auth()->user()->hasReceivedRequest($user)) {
            return back()->withErrors('There is no friend request from this user!');
        }


        auth()->user()->receivedFriendRequests()->updateExistingPivot($user->id, [
            'status' => 'friends',
            'status_friend' => null,
            ]);
        $user->sentFriendRequests()->updateExistingPivot(auth()->user()->id, [
            'status' => 'friends',
            'status_friend' => null,
        ]);

        $user->notify(new FriendAcceptNotification(auth()->user()));

        return back()->withSuccess('Friend request approved!');
    }


    public function declineRequest(User $user): RedirectResponse
    {
        if (!auth()->user()->hasReceivedRequest($user)) {
            return back()->withErrors('There is no friend request from this user!');
        }


        auth()->user()->receivedFriendRequests()->detach($user->id);
        $user->sentFriendRequests()->detach(auth()->user()->id);
        $user->notify(new FriendDeclineNotification(auth()->user()));

        return back()->withSuccess('Friend request declined!');
    }

    public function removeFriend(User $user): RedirectResponse
    {

        if (!auth()->user()->isFriendWith($user)) {
            return back()->withErrors('You are not friends with this user!');
        }


        DB::table('friendships')
            ->where(function ($query) use ($user) {
                $query->where('user_id', auth()->user()->id)
                    ->where('friend_id', $user->id);
            })
            ->orWhere(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->where('friend_id', auth()->user()->id);
            })
            ->delete();

        return back()->withSuccess('The friendship was removed!');
    }

    public function updateProfileImage(Request $request, $id): RedirectResponse
    {
        $user = User::where('id', $id)->firstOrFail();

        if (Auth::user()->id != $id && !in_array(Auth::user()->id, json_decode($user->admin_id ?? '[]'))) {
            return redirect()->back()->withErrors('Unauthorized action.');
        }

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = '/images/users/user-' . $user->id . '.jpg';

            $image->storeAs('/images/users', 'user-' . $user->id . '.jpg', ['disk' => 'public_uploads']);


            $resizedImage = Image::make(public_path("{$imagePath}"));
            $resizedImage->save();

            return redirect()->back()->withSuccess('Profile image updated successfully.');
        }

        return redirect()->back()->withErrors('Failed to upload image.');
    }
}
