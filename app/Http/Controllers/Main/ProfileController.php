<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index($username): View
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('main.profile', compact('user'));
    }
}
