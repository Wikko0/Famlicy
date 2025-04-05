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
use Illuminate\Support\Str;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;


class RegisterController extends Controller
{
    public function index(): View
    {
        return view('main.register');
    }

    public function indexSecond(): RedirectResponse | View
    {
        if (!session()->has('registration_data')) {
            return redirect()->route('register')->withErrors('Please complete the first step of registration.');
        }

        return view('main.registerSecond');
    }

    public function registerUser(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:5000',
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
            return redirect()->route('register')->withErrors('Session expired. Please, start the registration again.');
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

            Mail::to($user->email)->send(new WelcomeMail($user));

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
            'username' => 'required|string|min:3|max:25|regex:/^[a-z0-9._-]+$/i',
            'family_dob_day' => 'required|integer|between:1,31',
            'family_dob_month' => 'required|integer|between:1,12',
            'family_dob_year' => 'required|integer|digits:4',
            'family_transition_day' => 'required|integer|between:1,31',
            'family_transition_month' => 'required|integer|between:1,12',
            'family_transition_year' => 'required|integer|digits:4',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:5000',
            'relation' => 'nullable|string|exists:users,username',
            'alias' => 'nullable|string',
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
                'title', 'name', 'surname', 'username', 'family_dob_day', 'family_dob_month', 'family_dob_year',
                'family_transition_day', 'family_transition_month', 'family_transition_year', 'alias', 'relation'
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

        return view('main.familyRegisterSecond', compact('user', 'stepOneData'));
    }

    public function familyRegisterUser(Request $request, $username): RedirectResponse
    {
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

            $adminIds = [auth()->id()];


            $relationUsers = [];
            if (!empty($stepOneData['relation'])) {

                $relationUsernames = explode(',', $stepOneData['relation']);
                foreach ($relationUsernames as $username) {
                    $username = trim($username);
                    $relationUser = User::where('username', $username)->first();
                    if ($relationUser) {
                        $relationUsers[] = $relationUser;
                        $adminIds[] = $relationUser->id;
                    }
                }
            }


            $fullName = $stepOneData['name'] . ' ' . $stepOneData['surname'];
            $birthday = "{$stepOneData['family_dob_day']}/{$stepOneData['family_dob_month']}/{$stepOneData['family_dob_year']}";
            $died = "{$stepOneData['family_transition_day']}/{$stepOneData['family_transition_month']}/{$stepOneData['family_transition_year']}";


            $email = strtolower($stepOneData['username']) . '@noemail.com';
            $password = Str::random(12);


            $rawAlias = $stepOneData['alias'] ?? '';
            $aliasArray = array_filter(array_map('trim', explode(',', $rawAlias)));


            $user = User::create([
                'admin_id' => json_encode($adminIds),
                'title' => $stepOneData['title'],
                'name' => $fullName,
                'email' => $email,
                'password' => Hash::make($password),
                'username' => strtolower($stepOneData['username']),
                'phone' => auth()->user()->phone,
                'birthday' => $birthday,
                'died' => $died,
                'alias' => $aliasArray,
            ]);

             $currentUser = auth()->user();
            $transitioned = $currentUser->transitioned_id ?? [];
            $transitioned[] = $user->id;
            $currentUser->update(['transitioned_id' => $transitioned]);

           foreach ($relationUsers as $relationUser) {
                $relationTransitioned = $relationUser->transitioned_id ?? [];
                $relationTransitioned[] = $user->id;
                $relationUser->update(['transitioned_id' => $relationTransitioned]);

               $relationUser->following()->attach($user->id);
            }

            $currentUser->following()->attach($user->id);

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

           $communities = Community::whereJsonContains('users', intval($user->id))->get();
            foreach ($communities as $community) {
                $community->addUser($user->id);
            }

            Mail::to($user->email)->send(new WelcomeMail($user));

            session()->forget('step_one_data');

            return redirect()->route('welcome')->withSuccess('Your account has been created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('family.register', $username)->withErrors(['message' => 'An error occurred. Please, try again.'])->withInput();
        }
    }

}
