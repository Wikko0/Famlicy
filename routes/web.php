<?php

use App\Http\Controllers\Main\CommunityController;
use App\Http\Controllers\Main\NotificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main\HomeController;
use App\Http\Controllers\Main\RegisterController;
use App\Http\Controllers\Main\LoginController;
use App\Http\Controllers\Main\ProfileController;
use App\Http\Controllers\Main\UsersInformationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------------------------------------------
| Main Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'registerUser'])->name('register.form');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'loginUser'])->name('login.form');
Route::get('/logout', [LoginController::class, 'logoutUser'])->name('logout');


Route::middleware('auth')->group(function () {

    Route::get('/user/{username}', [ProfileController::class, 'index'])->name('profile');
    Route::post('/follow/{user}', [ProfileController::class, 'follow'])->name('follow');
    Route::post('/unfollow/{user}', [ProfileController::class, 'unfollow'])->name('unfollow');

    Route::get('/user/{username}/information', [UsersInformationController::class, 'index'])->name('user.information');
    Route::post('/user/{username}/information/update', [UsersInformationController::class, 'updateInformation'])->name('user.information.update');

    Route::post('/send-request/{user}', [ProfileController::class, 'sendRequest'])->name('sendRequest');

    Route::post('/accept-request/{user}', [ProfileController::class, 'acceptRequest'])->name('acceptRequest');

    Route::post('/decline-request/{user}', [ProfileController::class, 'declineRequest'])->name('declineRequest');

    Route::post('/remove-friend/{user}', [ProfileController::class, 'removeFriend'])->name('removeFriend');

    Route::get('notifications/{notificationId}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');

    Route::get('/community', [CommunityController::class, 'index'])->name('community');
    Route::post('/community/create', [CommunityController::class, 'createCommunity'])->name('community.create');
    Route::post('/community/{communityId}/invite/{friendId}', [CommunityController::class, 'joinCommunity'])->name('community.join');
    Route::post('/community/{communityId}/accept', [CommunityController::class, 'acceptInvitation'])->name('community.accept');

    Route::get('/community/{communityId}', [CommunityController::class, 'communityPage'])->name('community.page');
});


