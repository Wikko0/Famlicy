<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Community;
use App\Models\Post;
use App\Models\User;
use App\Notifications\JoinCommunityNotification;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CommunityController extends Controller
{
    public function index(): View
    {
        return view('main.community');
    }

    public function communityPage($communityId): View
    {
        $community = Community::findOrFail($communityId);

            $posts = Post::with('user')
                ->where('type', $community->name)
                ->whereDate('created_at', '>=', Carbon::now()->subMonths(6))
                ->latest()
                ->get();

        return view('main.communityPage', compact('community', 'posts'));
    }

    public function createCommunity(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $community = Community::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        $community->addUser($user->id);

        return redirect()->route('community')->withSuccess('Your community has been created successfully!');
    }

    public function joinCommunity($communityId, $friendId): RedirectResponse
    {
        $user = Auth::user();
        $community = Community::findOrFail($communityId);

        if (!$community->members()->contains($user->id)) {
            return redirect()->back()->withErrors('You must be a member of the community to invite others');
        }

        $friend = User::findOrFail($friendId);

        if (in_array($friend->id, $community->users ?? [])) {
            return redirect()->back()->withErrors('This user is already a member');
        }

        if ($community->hasPendingInvitation($friend->id)) {
            return redirect()->back()->withErrors('This user already has a pending invitation');
        }

        $community->inviteUser($friend->id);
        $friend->notify(new JoinCommunityNotification(auth()->user(), $communityId));

        return redirect()->back()->withSuccess('Invitation sent to ' . $friend->name);
    }

    public function acceptInvitation($communityId): RedirectResponse
    {
        $user = Auth::user();
        $community = Community::findOrFail($communityId);


        $community->updateInvitationStatus($user->id, 'accepted');


        $community->addUser($user->id);

        return redirect()->back()->withSuccess('Invitation accepted');
    }
}
