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
    public function index(Request $request): View
    {

        $user = auth()->user();

        $sortBy = $request->input('sortBy');
        $contentType = $request->input('contentType');

        if ($user) {
            $posts = Post::with('user')
                ->where(function($query) use ($user, $contentType) {
                    $query->where('user_id', $user->id)
                        ->where('type', $contentType ?? 'Global');
                })
                ->orWhere(function ($query) use ($user, $contentType) {
                    $query->whereIn('user_id', $user->friends()->pluck('id'))
                        ->where('type', $contentType ?? 'Global');
                })
                ->orWhere(function ($query) use ($user, $contentType) {
                    $query->whereIn('user_id', $user->following->pluck('id'))
                        ->where('type', $contentType ?? 'Global');
                })
                ->when(!$contentType, function ($query) use ($user) {
                    $communityIds = DB::table('communities')
                        ->whereJsonContains('users', $user->id)
                        ->pluck('name');

                    $query->orWhereIn('type', $communityIds);
                })
                ->whereDate('created_at', '>=', Carbon::now()->subMonths(6))
                ->when($sortBy, function ($query, $sortBy) {
                    if ($sortBy === 'oldest') {
                        $query->oldest('created_at');
                    } else {

                        $query->latest('created_at');
                    }
                }, function ($query) {

                    $query->latest('created_at');
                })
                ->paginate(10);
        } else {
            $posts = null;
        }

        return view('main.home', compact('posts'));
    }
}
