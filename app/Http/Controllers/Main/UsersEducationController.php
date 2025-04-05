<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\UsersEducation;
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

    // Function for updating Primary Education
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
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp3,wav,ogg,mp4,mov,avi,wmv|max:51200',
            'location' => 'nullable|string',
            'from' => 'nullable|string',
        ]);

        $subjects = !empty($data['primary_subjects']) && !empty($data['primary_grades'])
            ? json_encode(array_combine($data['primary_subjects'], $data['primary_grades']))
            : null;

        UsersEducation::updateOrCreate(
            ['user_id' => Auth::id(), 'school' => 'Primary School'],
            [
                'name' => $data['primary_school'],
                'start_date' => "{$data['primary_start_year']}-{$data['primary_start_month']}-01",
                'end_date' => "{$data['primary_end_year']}-{$data['primary_end_month']}-01",
                'subject' => $subjects
            ]
        );

        // Create a post for primary education update
        Post::createPost([
            'content' => "I completed my primary education at {$data['primary_school']} from {$data['primary_start_month']}/{$data['primary_start_year']} to {$data['primary_end_month']}/{$data['primary_end_year']}.",
            'type' => 'Global',
            'file' => $request->file('file'),
            'location' => $data['location'],
            'from' => $data['from'] ?? Auth::id(),
        ]);

        return redirect()->back()->withSuccess('Primary education updated successfully!');
    }

    // Function for updating Secondary Education
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
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp3,wav,ogg,mp4,mov,avi,wmv|max:51200',
            'location' => 'nullable|string',
            'from' => 'nullable|string',
        ]);

        $subjects = !empty($data['secondary_subjects']) && !empty($data['secondary_grades'])
            ? json_encode(array_combine($data['secondary_subjects'], $data['secondary_grades']))
            : null;

        UsersEducation::updateOrCreate(
            ['user_id' => Auth::id(), 'school' => 'Secondary School'],
            [
                'name' => $data['secondary_school'],
                'start_date' => "{$data['secondary_start_year']}-{$data['secondary_start_month']}-01",
                'end_date' => "{$data['secondary_end_year']}-{$data['secondary_end_month']}-01",
                'subject' => $subjects
            ]
        );

        // Create a post for secondary education update
        Post::createPost([
            'content' => "I completed my secondary education at {$data['secondary_school']} from {$data['secondary_start_month']}/{$data['secondary_start_year']} to {$data['secondary_end_month']}/{$data['secondary_end_year']}.",
            'type' => 'Global',
            'file' => $request->file('file'),
            'location' => $data['location'],
            'from' => $data['from'] ?? Auth::id(),
        ]);

        return redirect()->back()->withSuccess('Secondary education updated successfully!');
    }

    // Function for updating College Education
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
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp3,wav,ogg,mp4,mov,avi,wmv|max:51200',
            'location' => 'nullable|string',
            'from' => 'nullable|string',
        ]);

        $subjects = !empty($data['college_subjects']) && !empty($data['college_grades'])
            ? json_encode(array_combine($data['college_subjects'], $data['college_grades']))
            : null;

        UsersEducation::updateOrCreate(
            ['user_id' => Auth::id(), 'school' => 'College'],
            [
                'name' => $data['college'],
                'start_date' => "{$data['college_start_year']}-{$data['college_start_month']}-01",
                'end_date' => "{$data['college_end_year']}-{$data['college_end_month']}-01",
                'subject' => $subjects
            ]
        );

        // Create a post for college education update
        Post::createPost([
            'content' => "I completed my college education at {$data['college']} from {$data['college_start_month']}/{$data['college_start_year']} to {$data['college_end_month']}/{$data['college_end_year']}.",
            'type' => 'Global',
            'file' => $request->file('file'),
            'location' => $data['location'],
            'from' => $data['from'] ?? Auth::id(),
        ]);

        return redirect()->back()->withSuccess('College education updated successfully!');
    }

    // Function for updating University Education
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
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp3,wav,ogg,mp4,mov,avi,wmv|max:51200',
            'location' => 'nullable|string',
            'from' => 'nullable|string',
        ]);

        $subjects = !empty($data['university_subjects']) && !empty($data['university_grades'])
            ? json_encode(array_combine($data['university_subjects'], $data['university_grades']))
            : null;

        UsersEducation::updateOrCreate(
            ['user_id' => Auth::id(), 'school' => 'University'],
            [
                'name' => $data['university'],
                'start_date' => "{$data['university_start_year']}-{$data['university_start_month']}-01",
                'end_date' => "{$data['university_end_year']}-{$data['university_end_month']}-01",
                'subject' => $subjects
            ]
        );

        // Create a post for university education update
        Post::createPost([
            'content' => "I completed my university education at {$data['university']} from {$data['university_start_month']}/{$data['university_start_year']} to {$data['university_end_month']}/{$data['university_end_year']}.",
            'type' => 'Global',
            'file' => $request->file('file'),
            'location' => $data['location'],
            'from' => $data['from'] ?? Auth::id(),
        ]);

        return redirect()->back()->withSuccess('University education updated successfully!');
    }
}
