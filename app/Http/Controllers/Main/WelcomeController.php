<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    public function index(): View
    {
        $user = User::where('username', Auth::user()->username)->firstOrFail();
        return view('main.welcome', compact('user'));
    }
}
