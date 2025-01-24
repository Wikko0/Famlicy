<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UsersEmployment;
use App\Models\UsersInformation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
