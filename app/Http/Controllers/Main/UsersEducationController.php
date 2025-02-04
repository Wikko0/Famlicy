<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UsersEducation;
use App\Models\UsersInformation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UsersEducationController extends Controller
{
    public function index($username): View
    {
        $user = User::where('username', $username)->firstOrFail();

        if (auth()->user()->username !== $user->username) {
            abort(403, 'You are not allowed to edit this profile.');
        }

        return view('main.education', compact('user'));
    }


    public function updatePrimary(Request $request)
    {
        $data = $request->validate([
            'primary_school' => 'required|string',
            'primary_start_month' => 'required|date_format:m',
            'primary_start_year' => 'required|date_format:Y',
            'primary_end_month' => 'required|date_format:m',
            'primary_end_year' => 'required|date_format:Y',
            'primary_subjects' => 'nullable|array',
            'primary_subjects.*' => 'nullable|string',
            'primary_grades' => 'nullable|array',
            'primary_grades.*' => 'nullable|string',
        ]);


        if (!empty($data['primary_subjects']) && !empty($data['primary_grades'])) {
            $subjects = json_encode(array_combine($data['primary_subjects'], $data['primary_grades']));
        } else {
            $subjects = null;
        }

        UsersEducation::updateOrCreate(
            ['user_id' => Auth::id(), 'school' => 'Primary School'],
            [
                'name' => $request->input('primary_school'),
                'start_date' => "{$data['primary_start_year']}-{$data['primary_start_month']}-01",
                'end_date' => "{$data['primary_end_year']}-{$data['primary_end_month']}-01",
                'subject' => $subjects
            ]
        );

        return redirect()->back()->withSuccess('Primary education updated successfully!');
    }

    public function updateSecondary(Request $request)
    {
        $data = $request->validate([
            'secondary_school' => 'required|string',
            'secondary_start_month' => 'required|date_format:m',
            'secondary_start_year' => 'required|date_format:Y',
            'secondary_end_month' => 'required|date_format:m',
            'secondary_end_year' => 'required|date_format:Y',
            'secondary_subjects' => 'nullable|array',
            'secondary_subjects.*' => 'nullable|string',
            'secondary_grades' => 'nullable|array',
            'secondary_grades.*' => 'nullable|string',
        ]);

        $subjects = (!empty($data['secondary_subjects']) && !empty($data['secondary_grades']))
            ? json_encode(array_combine($data['secondary_subjects'], $data['secondary_grades']))
            : null;

        UsersEducation::updateOrCreate(
            ['user_id' => Auth::id(), 'school' => 'Secondary School'],
            [
                'name' => $request->input('secondary_school'),
                'start_date' => "{$data['secondary_start_year']}-{$data['secondary_start_month']}-01",
                'end_date' => "{$data['secondary_end_year']}-{$data['secondary_end_month']}-01",
                'subject' => $subjects
            ]
        );

        return redirect()->back()->withSuccess('Secondary education updated successfully!');
    }

    public function updateCollege(Request $request)
    {
        $data = $request->validate([
            'college' => 'required|string',
            'college_start_month' => 'required|date_format:m',
            'college_start_year' => 'required|date_format:Y',
            'college_end_month' => 'required|date_format:m',
            'college_end_year' => 'required|date_format:Y',
            'college_subjects' => 'nullable|array',
            'college_subjects.*' => 'nullable|string',
            'college_grades' => 'nullable|array',
            'college_grades.*' => 'nullable|string',
        ]);

        $subjects = (!empty($data['college_subjects']) && !empty($data['college_grades']))
            ? json_encode(array_combine($data['college_subjects'], $data['college_grades']))
            : null;

        UsersEducation::updateOrCreate(
            ['user_id' => Auth::id(), 'school' => 'College'],
            [
                'name' => $request->input('college'),
                'start_date' => "{$data['college_start_year']}-{$data['college_start_month']}-01",
                'end_date' => "{$data['college_end_year']}-{$data['college_end_month']}-01",
                'subject' => $subjects
            ]
        );

        return redirect()->back()->withSuccess('College education updated successfully!');
    }

    public function updateUniversity(Request $request)
    {
        $data = $request->validate([
            'university' => 'required|string',
            'university_start_month' => 'required|date_format:m',
            'university_start_year' => 'required|date_format:Y',
            'university_end_month' => 'required|date_format:m',
            'university_end_year' => 'required|date_format:Y',
            'university_subjects' => 'nullable|array',
            'university_subjects.*' => 'nullable|string',
            'university_grades' => 'nullable|array',
            'university_grades.*' => 'nullable|string',
        ]);

        $subjects = (!empty($data['university_subjects']) && !empty($data['university_grades']))
            ? json_encode(array_combine($data['university_subjects'], $data['university_grades']))
            : null;

        UsersEducation::updateOrCreate(
            ['user_id' => Auth::id(), 'school' => 'University'],
            [
                'name' => $request->input('university'),
                'start_date' => "{$data['university_start_year']}-{$data['university_start_month']}-01",
                'end_date' => "{$data['university_end_year']}-{$data['university_end_month']}-01",
                'subject' => $subjects
            ]
        );

        return redirect()->back()->withSuccess('University education updated successfully!');
    }


}
