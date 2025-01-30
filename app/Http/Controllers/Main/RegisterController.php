<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\User;
use App\Models\UsersInformation;
use App\Models\UsersLife;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;


class RegisterController extends Controller
{
    public function index(): View
    {
        return view('main.register');
    }

    public function registerUser(Request $request): RedirectResponse
    {

        $request->validate([
            'title' => 'required|string',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string',
            'username' => 'required|string|min:3|max:25|unique:users|regex:/^[a-z0-9._-]+$/i',
            'password' => 'required|string|min:8',
            'dob_day' => 'required',
            'dob_month' => 'required',
            'dob_year' => 'required',
            'family_name' => 'nullable|string',
            'family_surname' => 'nullable|string',
            'location' => 'nullable|string',
            'country' => 'nullable|string',
            'marital' => 'nullable|string',
            'religious' => 'nullable|string',
            'children' => 'nullable|string',
            'grandchildren' => 'nullable|string',
        ]);

        $fullName = $request->input('name') . ' ' . $request->input('surname');

        if ($request->input('family_name')) {
            $fullName = $request->input('family_name') . ' ' . $request->input('family_surname');
        }

        $birthday = $request->input('dob_day') . '/' . $request->input('dob_month') . '/' . $request->input('dob_year');

        if ($request->input('family_dob_day')) {
            $birthday = $request->input('family_dob_day') . '/' . $request->input('family_dob_month') . '/' . $request->input('family_dob_year');
        }

        $died = null;

        if ($request->input('family_transition_day')) {
            $died = $request->input('family_transition_day') . '/' . $request->input('family_transition_month') . '/' . $request->input('family_transition_year');
        }

        $photoPath = null;

        $user = User::create([
            'name' => $fullName,
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'title' => $request->input('title'),
            'username' => strtolower($request->input('username')),
            'phone' => $request->input('phone'),
            'photo' => $photoPath,
            'birthday' => $birthday,
            'died' => $died,
        ]);


        if ($request->hasFile('photo')) {

            $photo = $request->file('photo');

            $photoPath = $photo->storeAs(
                '/images/users',
                'user-' . $user->id . '.jpg',
                ['disk' => 'public_uploads']
            );

            $photo = Image::make(public_path("{$photoPath}"));
            $photo->save();
        } else {

            $defaultAvatarPath = 'images/default-avatar.png';
            $photoPath = 'images/users/user-' . $user->id . '.jpg';


            copy(public_path($defaultAvatarPath), public_path($photoPath));
        }

        $user->update(['photo' => $photoPath]);

        $userInformation = new UsersInformation();
        $userInformation->user_id = $user->id;
        $userInformation->location = $request->input('location');
        $userInformation->country = $request->input('country');
        $userInformation->marital = $request->input('marital');
        $userInformation->religious = $request->input('religious');
        $userInformation->children = $request->input('children');
        $userInformation->grandchildren = $request->input('grandchildren');
        $userInformation->save();

        // Mail::to($user->email)->send(new WelcomeMail($user));

        Auth::login($user);

        return redirect()->route('welcome')->withSuccess('Your account has been created successfully!');
    }

}
