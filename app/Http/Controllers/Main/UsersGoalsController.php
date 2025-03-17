<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UsersGoals;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

        return redirect()->back()->withSuccess('Goals updated successfully!');
    }
}
