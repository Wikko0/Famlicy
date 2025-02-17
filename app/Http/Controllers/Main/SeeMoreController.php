<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Community;
use App\Models\ProfileClick;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SeeMoreController extends Controller
{
    public function aboutMe($username): View
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
        return view('seemore.aboutme', compact('user', 'friends', 'communities', 'pendingFriend', 'clickCount'));
    }

    public function myInterests($username): View
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
        return view('seemore.myinterests', compact('user', 'friends', 'communities', 'pendingFriend', 'clickCount'));
    }

    public function education($username): View
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
        return view('seemore.education', compact('user', 'friends', 'communities', 'pendingFriend', 'clickCount'));
    }

    public function employment($username): View
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
        return view('seemore.employment', compact('user', 'friends', 'communities', 'pendingFriend', 'clickCount'));
    }

    public function life($username): View
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
        return view('seemore.life', compact('user', 'friends', 'communities', 'pendingFriend', 'clickCount'));
    }

    public function goals($username): View
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
        return view('seemore.goals', compact('user', 'friends', 'communities', 'pendingFriend', 'clickCount'));
    }
}
