<?php

namespace App\Providers;

use App\Models\Community;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CommunityProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $user = Auth::user();

            if ($user) {
                $communities = Community::whereJsonContains('users', $user->id)->get();
                $view->with('userCommunities', $communities);
            }
        });
    }
}
