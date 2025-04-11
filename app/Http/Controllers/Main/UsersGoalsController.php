<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\UsersGoals;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UsersGoalsController extends Controller
{
    public function index($username): View
    {
        $user = User::where('username', $username)->firstOrFail();

        if (auth()->user()->username !== $user->username) {
            abort(403, 'You are not allowed to edit this profile.');
        }

        return view('main.goals', compact('user'));
    }

    public function updateInformation(Request $request, $username): RedirectResponse
    {
        $user = User::where('username', $username)->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_month' => 'nullable|string',
            'start_year' => 'nullable|string',
            'end_month' => 'nullable|string',
            'end_year' => 'nullable|string',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp3,wav,ogg,mp4,mov,avi,wmv|max:51200',
            'location' => 'nullable|string',
            'from' => 'nullable|string',
        ]);

        $lifeEvent = new UsersGoals();
        $lifeEvent->user_id = $user->id;
        $lifeEvent->name = $validated['name'];

        if (!empty($validated['start_year']) && !empty($validated['start_month'])) {
            $lifeEvent->start_date = $validated['start_year'] . '-' . $validated['start_month'];
        }
        if (!empty($validated['end_year']) && !empty($validated['end_month'])) {
            $lifeEvent->end_date = $validated['end_year'] . '-' . $validated['end_month'];
        }

        $lifeEvent->description = $validated['description'] ?? null;
        $lifeEvent->save();

        // Create a post for the life event update
        Post::createPost([
            'content' => "I added a life event: {$validated['name']}" .
                (!empty($validated['start_month']) && !empty($validated['start_year'])
                    ? " starting from {$validated['start_month']}/{$validated['start_year']}"
                    : "") .
                (!empty($validated['end_month']) && !empty($validated['end_year'])
                    ? " to {$validated['end_month']}/{$validated['end_year']}"
                    : "") .
                (!empty($validated['description'])
                    ? ". Description: {$validated['description']}"
                    : "") .
                ".",
            'type' => 'Global',
            'file' => $request->file('file'),
            'location' => $request->input('location'),
            'from' => $request->input('from') ?? Auth::id(),
        ]);

        return redirect()->back()->withSuccess('Goals updated successfully!');
    }
}
