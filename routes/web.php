<?php

use App\Http\Controllers\Main\CommunityController;
use App\Http\Controllers\Main\NotificationController;
use App\Http\Controllers\Main\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main\HomeController;
use App\Http\Controllers\Main\RegisterController;
use App\Http\Controllers\Main\LoginController;
use App\Http\Controllers\Main\ProfileController;
use App\Http\Controllers\Main\UsersInformationController;
use App\Http\Controllers\Main\UsersEducationController;
use App\Http\Controllers\Main\UsersEmploymentController;

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

//    Information
    Route::get('/user/{username}/information', [UsersInformationController::class, 'index'])->name('user.information');
    Route::post('/user/{username}/information/update', [UsersInformationController::class, 'updateInformation'])->name('user.information.update');

//    Education
    Route::get('/user/{username}/education', [UsersEducationController::class, 'index'])->name('user.education');
    Route::post('/user/education/primary', [UsersEducationController::class, 'updatePrimary'])->name('user.education.primary');
    Route::post('/user/education/secondary', [UsersEducationController::class, 'updateSecondary'])->name('user.education.secondary');
    Route::post('/user/education/college', [UsersEducationController::class, 'updateCollege'])->name('user.education.college');
    Route::post('/user/education/university', [UsersEducationController::class, 'updateUniversity'])->name('user.education.university');

//    Employment
    Route::get('/user/{username}/employment', [UsersEmploymentController::class, 'index'])->name('user.employment');
    Route::post('/user/{username}/employment/update', [UsersEmploymentController::class, 'updateInformation'])->name('user.employment.update');
    Route::delete('/user/employment/{id}/delete', [UsersEmploymentController::class, 'destroy'])->name('user.employment.delete');

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

    Route::post('/posts/{contentType}', [PostController::class, 'store'])->name('posts.store');
    Route::get('/post/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/posts/{id}/like', [PostController::class, 'like'])->name('posts.like');
    Route::post('/posts/{id}/comment', [PostController::class, 'comment'])->name('posts.comment');

    Route::get('/posts/{post}/likes', function (\App\Models\Post $post) {
        return response()->json([
            'items' => $post->likes()->with('user')->get()->map(function ($like) {
                return [
                    'user_id' => $like->user->id,
                    'user_name' => $like->user->name,
                ];
            })
        ]);
    });

    Route::get('/posts/{post}/comments', function (\App\Models\Post $post) {
        return response()->json([
            'items' => $post->comments()->with('user')->get()->map(function ($comment) {
                return [
                    'user_id' => $comment->user->id,
                    'user_name' => $comment->user->name,
                    'content' => $comment->content,
                    'created_at' => $comment->created_at->diffForHumans(),
                ];
            })
        ]);
    });
});


