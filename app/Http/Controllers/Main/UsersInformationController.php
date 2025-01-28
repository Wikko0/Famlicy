<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UsersInformation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UsersInformationController extends Controller
{
    public function index($username): View
    {
        $user = User::where('username', $username)->firstOrFail();

        if (auth()->user()->username !== $user->username) {
            abort(403, 'You are not allowed to edit this profile.');
        }

        return view('main.information', compact('user'));
    }

    public function updateInformation(Request $request, $username): RedirectResponse
    {
        $user = User::where('username', $username)->firstOrFail();


        $validated = $request->validate([
            'key' => 'required|string|in:location,country,marital,religious,children,grandchildren,instagram,color,animal,hobby,fruit,cuisine,drink,dessert,book,author,music,artist,film,actor,sport',
            'value' => 'nullable|string|max:255',
        ]);


        $userInformation = $user->userInformation ?? new UsersInformation(['user_id' => $user->id]);
        $userInformation->{$validated['key']} = $validated['value'];
        $userInformation->save();

        return redirect()->back()->withSuccess(ucfirst($validated['key']) . ' updated successfully!');
    }
}
