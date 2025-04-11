<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\UsersLife;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UsersLifeController extends Controller
{
    public function index(Request $request, $username): View
    {
        $user = User::where('username', $username)->firstOrFail();

        if (auth()->user()->username !== $user->username) {
            abort(403, 'You are not allowed to edit this profile.');
        }

        if ($request->has('preset')) {
            session(['preset_life_event' => $request->input('preset')]);
        }

        return view('main.life', compact('user'));
    }

    public function updateInformation(Request $request, $username): RedirectResponse
    {
        $user = User::where('username', $username)->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'start_month' => 'nullable|string',
            'start_year' => 'nullable|string',
            'end_month' => 'nullable|string',
            'end_year' => 'nullable|string',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp3,wav,ogg,mp4,mov,avi,wmv|max:51200',
            'location' => 'nullable|string',
            'from' => 'nullable|string',
        ]);

        $lifeEvent = new UsersLife();
        $lifeEvent->user_id = $user->id;
        $lifeEvent->name = $validated['name'];
        $lifeEvent->type = $validated['type'];
        if (!empty($validated['start_year']) && !empty($validated['start_month'])) {
            $lifeEvent->start_date = $validated['start_year'] . '-' . $validated['start_month'];
        }
        if (!empty($validated['end_year']) && !empty($validated['end_month'])) {
            $lifeEvent->end_date = $validated['end_year'] . '-' . $validated['end_month'];
        }

        $lifeEvent->description = $validated['description'] ?? null;
        $lifeEvent->save();

        // Create a post for primary education update
        Post::createPost([
            'content' => "I added a life event: {$validated['type']} - {$validated['name']}" .
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


        return redirect()->back()->withSuccess('Life event updated successfully!');
    }
}
