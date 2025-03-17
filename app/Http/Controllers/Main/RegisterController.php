<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\Community;
use App\Models\User;
use App\Models\UsersInformation;
use App\Models\UsersLife;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;


class RegisterController extends Controller
{
    public function index(): View
    {
        return view('main.register');
    }

    public function indexSecond(): View
    {
        if (!session()->has('registration_data')) {
            return redirect()->route('main.register')->withErrors('Please complete the first step of registration.');
        }

        return view('main.registerSecond');
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
            'username' => 'required|string|min:3|max:25|regex:/^[a-z0-9._-]+$/i',
            'password' => 'required|string|min:8',
            'dob_day' => 'required',
            'dob_month' => 'required',
            'dob_year' => 'required',
            'family_name' => 'nullable|string',
            'family_surname' => 'nullable|string',
        ]);

        $photoPath = null;

        if ($request->hasFile('photo')) {
            $filename = uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();
            $tempPhotoPath = 'images/temp/' . $filename;
            $request->file('photo')->move(public_path('images/temp'), $filename);

            $photoPath = $tempPhotoPath;
        }

        session([
            'registration_data' => array_merge(
                $request->only([
                    'title', 'name', 'surname', 'email', 'phone', 'username', 'password',
                    'dob_day', 'dob_month', 'dob_year', 'family_name', 'family_surname'
                ]),
                ['photo' => $photoPath]
            )
        ]);

        return redirect()->route('register.second');
    }

    public function registerUserSecond(Request $request): RedirectResponse
    {
        $registrationData = session('registration_data');

        if (!$registrationData) {
            return redirect()->route('main.register')->withErrors('Session expired. Please, start the registration again.');
        }

        $request->validate([
            'location' => 'nullable|string',
            'country' => 'nullable|string',
            'marital' => 'nullable|string',
            'religious' => 'nullable|string',
            'children' => 'nullable|string',
            'grandchildren' => 'nullable|string',
        ]);

        $fullData = array_merge($registrationData, $request->only([
            'location', 'country', 'marital', 'religious', 'children', 'grandchildren'
        ]));

        try {
            $fullName = $fullData['name'] . ' ' . $fullData['surname'];

            if ($fullData['family_name']) {
                $fullName = $fullData['family_name'] . ' ' . $fullData['family_surname'];
            }

            $birthday = $fullData['dob_day'] . '/' . $fullData['dob_month'] . '/' . $fullData['dob_year'];

            $user = User::create([
                'name' => $fullName,
                'email' => $fullData['email'],
                'password' => Hash::make($fullData['password']),
                'title' => $fullData['title'],
                'username' => strtolower($fullData['username']),
                'phone' => $fullData['phone'],
                'birthday' => $birthday,
            ]);

            $photoPath = 'images/default-avatar.png';

            if (!empty($fullData['photo'])) {
                $tempPhotoPath = public_path($fullData['photo']);
                $newPhotoPath = public_path("images/users/user-{$user->id}.jpg");

                if (File::exists($tempPhotoPath)) {
                    rename($tempPhotoPath, $newPhotoPath);

                    $photo = Image::make($newPhotoPath);
                    $photo->resize(300, 300)->save();

                    $photoPath = "images/users/user-{$user->id}.jpg";
                }
            } else {
                File::copy(public_path('images/default-avatar.png'), public_path("images/users/user-{$user->id}.jpg"));
                $photoPath = "images/users/user-{$user->id}.jpg";

            }


            $user->update(['photo' => $photoPath]);

            $userInformation = new UsersInformation();
            $userInformation->user_id = $user->id;
            $userInformation->location = $fullData['location'];
            $userInformation->country = $fullData['country'];
            $userInformation->marital = $fullData['marital'];
            $userInformation->religious = $fullData['religious'];
            $userInformation->children = $fullData['children'];
            $userInformation->grandchildren = $fullData['grandchildren'];
            $userInformation->save();

            $communities = [
                'Vocational circle' => 'Vocational circle',
                'Educational circle' => 'Educational circle',
                'Financial circle' => 'Financial circle',
                'Spiritual circle' => 'Spiritual circle',
                'Related circle' => 'Related circle',
                'Family circle' => 'Family circle',
                'Inner Family circle' => 'Inner Family circle',
            ];

            foreach ($communities as $name => $description) {
                $community = Community::create([
                    'name' => $name,
                    'description' => $description,
                ]);

                $community->addUser($user->id);
            }

            Auth::login($user);

            session()->forget('registration_data');

            return redirect()->route('welcome')->withSuccess('Your account has been created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('register')->withErrors(['message' => 'An error occurred. Please, try again.'])->withInput();
        }
    }

    public function familyRegister($username): View
    {
        $user = User::where('username', $username)->firstOrFail();
        if (auth()->user()->username !== $user->username) {
            abort(403, 'You are not allowed to edit this profile.');
        }
        return view('main.familyRegister', compact('user'));
    }

    public function familyRegisterStepOne(Request $request, $username): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string',
            'username' => 'required|string|min:3|max:25|regex:/^[a-z0-9._-]+$/i',
            'password' => 'required|string|min:8',
            'family_dob_day' => 'required|integer|between:1,31',
            'family_dob_month' => 'required|integer|between:1,12',
            'family_dob_year' => 'required|integer|digits:4',
            'family_transition_day' => 'required|integer|between:1,31',
            'family_transition_month' => 'required|integer|between:1,12',
            'family_transition_year' => 'required|integer|digits:4',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photoPath = null;

        if ($request->hasFile('photo')) {
            $filename = uniqid() . '.' . $request->file('photo')->getClientOriginalExtension();
            $tempPhotoPath = 'images/temp/' . $filename;
            $request->file('photo')->move(public_path('images/temp'), $filename);

            $photoPath = $tempPhotoPath;
        }

        session([
            'step_one_data' => array_merge($request->only([
                'title', 'name', 'surname', 'email', 'phone', 'username', 'password', 'family_dob_day', 'family_dob_month', 'family_dob_year',
                'family_transition_day', 'family_transition_month', 'family_transition_year'
            ]), ['photo' => $photoPath])
        ]);

        return redirect()->route('family.register.second', ['username' => $username]);
    }
    public function familyRegisterStepTwo($username): View
    {

        $user = User::where('username', $username)->firstOrFail();
        if (auth()->user()->username !== $user->username) {
            abort(403, 'You are not allowed to edit this profile.');
        }
        $stepOneData = session('step_one_data', []);

        if (empty($stepOneData)) {
            return redirect()->route('family.register', ['username' => $username])
                ->withErrors('Please complete step 1 first.');
        }

        // Връщаме изгледа с данни за потребителя и сесията за стъпка 1
        return view('main.familyRegisterSecond', compact('user', 'stepOneData'));
    }

    public function familyRegisterUser(Request $request, $username): RedirectResponse
    {
        $userId = User::where('username', $username)->first();
        $stepOneData = session('step_one_data');

        if (!$stepOneData) {
            return redirect()->route('family.register', ['username' => $username])->withErrors('Please complete step 1 first.');
        }

        $request->validate([
            'location' => 'nullable|string',
            'country' => 'nullable|string',
            'marital' => 'nullable|string',
            'religious' => 'nullable|string',
            'children' => 'nullable|string',
            'grandchildren' => 'nullable|string',
        ]);

        try {

        $fullName = $stepOneData['name'] . ' ' . $stepOneData['surname'];
        $birthday = "{$stepOneData['family_dob_day']}/{$stepOneData['family_dob_month']}/{$stepOneData['family_dob_year']}";
        $died = "{$stepOneData['family_transition_day']}/{$stepOneData['family_transition_month']}/{$stepOneData['family_transition_year']}";

        $user = User::create([
            'title' => $stepOneData['title'],
            'name' => $fullName,
            'email' => $stepOneData['email'],
            'password' => Hash::make($stepOneData['password']),
            'username' => strtolower($stepOneData['username']),
            'phone' => $stepOneData['phone'],
            'birthday' => $birthday,
            'died' => $died,
        ]);

        $photoPath = 'images/default-avatar.png';

        if (!empty($stepOneData['photo'])) {
            $tempPhotoPath = public_path($stepOneData['photo']);
            $newPhotoPath = public_path("images/users/user-{$user->id}.jpg");

            if (File::exists($tempPhotoPath)) {
                rename($tempPhotoPath, $newPhotoPath);

                $photo = Image::make($newPhotoPath);
                $photo->resize(300, 300)->save();

                $photoPath = "images/users/user-{$user->id}.jpg";
            }
        } else {
            File::copy(public_path('images/default-avatar.png'), public_path("images/users/user-{$user->id}.jpg"));
            $photoPath = "images/users/user-{$user->id}.jpg";
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

        $communities = Community::whereJsonContains('users', intval($userId->id))->get();
        foreach ($communities as $community) {
            $community->addUser($user->id);
        }

//        Mail::to($user->email)->send(new WelcomeMail($user));

        session()->forget('step_one_data');

            return redirect()->route('welcome')->withSuccess('Your account has been created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('family.register', $username)->withErrors(['message' => 'An error occurred. Please, try again.'])->withInput();
        }
    }
}
