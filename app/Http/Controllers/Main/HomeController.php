<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        if ($user) {
            $posts = Post::with('user')
                ->where('user_id', $user->id)
                ->orWhere(function ($query) use ($user) {
                    $query->whereIn('user_id', $user->friends()->pluck('id'))
                        ->where('type', 'Global');
                })
                ->orWhere(function ($query) use ($user) {
                    $query->whereIn('user_id', $user->following->pluck('id'))
                        ->where('type', 'Global');
                })
                ->orWhere(function ($query) use ($user) {
                    $communityIds = DB::table('communities')
                        ->whereJsonContains('users', $user->id)
                        ->pluck('name');

                    $query->whereIn('type', $communityIds);
                })
                ->whereDate('created_at', '>=', Carbon::now()->subMonths(6))
                ->latest()
                ->get();
        } else {
            $posts = null;
        }

        return view('main.home', compact('posts'));
    }
}
