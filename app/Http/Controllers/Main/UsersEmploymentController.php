<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\UsersEmployment;
use App\Models\UsersInformation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UsersEmploymentController extends Controller
{
    public function index($username): View
    {
        $user = User::where('username', $username)->firstOrFail();

        if (auth()->user()->username !== $user->username) {
            abort(403, 'You are not allowed to edit this profile.');
        }
        $employments = $user->userEmployment;

        return view('main.employment', compact('user', 'employments'));
    }

    public function updateInformation(Request $request, $username): RedirectResponse
    {
        $user = User::where('username', $username)->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'start_month' => 'required|string',
            'start_year' => 'required|string',
            'end_month' => 'nullable|string',
            'end_year' => 'nullable|string',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp3,wav,ogg,mp4,mov,avi,wmv|max:51200',
            'location' => 'nullable|string',
            'from' => 'nullable|string',
        ]);

        $employment = new UsersEmployment();
        $employment->user_id = $user->id;
        $employment->name = $validated['name'];
        $employment->title = $validated['title'];
        $employment->start_date = $validated['start_year'] . '-' . $validated['start_month'];

        if ($validated['end_year'] && $validated['end_month']) {
            $employment->end_date = $validated['end_year'] . '-' . $validated['end_month'];
        }

        $employment->description = $validated['description'] ?? null;
        $employment->save();

        // Create a post for primary education update
        Post::createPost([
            'content' => "I started working at {$validated['name']} as a {$validated['title']} from {$validated['start_month']}/{$validated['start_year']}" .
                (isset($validated['end_month'], $validated['end_year']) ? " to {$validated['end_month']}/{$validated['end_year']}" : "") . ".",
            'type' => 'Global',
            'file' => $request->file('file'),
            'location' => $request->input('location'),
            'from' => $request->input('from') ?? Auth::id(),
        ]);
        return redirect()->back()->withSuccess('Employment information updated successfully!');
    }

    public function destroy($id): RedirectResponse
    {
        $employment = UsersEmployment::findOrFail($id);

        if (auth()->user()->id !== $employment->user_id) {
            abort(403, 'You are not allowed to delete this employment.');
        }

        $employment->delete();

        return redirect()->back()->withSuccess('Employment record deleted successfully!');
    }
}
