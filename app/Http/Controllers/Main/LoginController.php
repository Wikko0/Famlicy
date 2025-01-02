<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function index(): View
    {
        return view('main.login');
    }
}
