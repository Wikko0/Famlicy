<?php

use App\Http\Controllers\Main\SeeMoreController;
use App\Http\Controllers\Main\WelcomeController;
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
use App\Http\Controllers\Main\UsersGoalsController;
use App\Http\Controllers\Main\UsersLifeController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

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
Route::get('/register/second', [RegisterController::class, 'indexSecond'])->name('register.second');
Route::post('/register/second', [RegisterController::class, 'registerUserSecond'])->name('register.form.second');


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'loginUser'])->name('login.form');
Route::get('/logout', [LoginController::class, 'logoutUser'])->name('logout');

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');;

Route::middleware('auth')->group(function () {
    Route::get('/{username}/register', [RegisterController::class, 'familyRegister'])->name('family.register');
    Route::post('/{username}/register', [RegisterController::class, 'familyRegisterStepOne'])->name('family.register.form');
    Route::get('/{username}/register/second', [RegisterController::class, 'familyRegisterStepTwo'])->name('family.register.second');
    Route::post('/{username}/register/second', [RegisterController::class, 'familyRegisterUser'])->name('family.register.form.second');


    Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome');
    Route::get('/information', [WelcomeController::class, 'index'])->name('information');

    Route::get('/user/{username}', [ProfileController::class, 'index'])->name('profile');
    Route::post('/follow/{user}', [ProfileController::class, 'follow'])->name('follow');
    Route::post('/unfollow/{user}', [ProfileController::class, 'unfollow'])->name('unfollow');
    Route::post('/user/{id}/update-profile-image', [ProfileController::class, 'updateProfileImage'])->name('user.updateProfileImage');

//    About Me
    Route::get('/user/{username}/aboutme', [UsersInformationController::class, 'aboutMe'])->name('user.aboutme');
    Route::post('/user/{username}/information/aboutme', [UsersInformationController::class, 'updateAboutMe'])->name('user.aboutme.update');

    //    My Interests
    Route::get('/user/{username}/myinterests', [UsersInformationController::class, 'myInterests'])->name('user.myinterests');
    Route::post('/user/{username}/myinterests/update', [UsersInformationController::class, 'updateMyInterests'])->name('user.myinterests.update');

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

//    Life Events
    Route::get('/user/{username}/life', [UsersLifeController::class, 'index'])->name('user.life');
    Route::post('/user/{username}/life/update', [UsersLifeController::class, 'updateInformation'])->name('user.life.update');

//    Goals Events
    Route::get('/user/{username}/goals', [UsersGoalsController::class, 'index'])->name('user.goals');
    Route::post('/user/{username}/goals/update', [UsersGoalsController::class, 'updateInformation'])->name('user.goals.update');

    //    See More
    Route::get('/aboutme/{username}', [SeeMoreController::class, 'aboutMe'])->name('seemore.aboutme');
    Route::get('/myinterests/{username}', [SeeMoreController::class, 'myInterests'])->name('seemore.myinterests');
    Route::get('/education/{username}', [SeeMoreController::class, 'education'])->name('seemore.education');
    Route::get('/employment/{username}', [SeeMoreController::class, 'employment'])->name('seemore.employment');
    Route::get('/life/{username}', [SeeMoreController::class, 'life'])->name('seemore.life');
    Route::get('/goals/{username}', [SeeMoreController::class, 'goals'])->name('seemore.goals');

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

    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/post/{username}/{type}/{content}', [PostController::class, 'show'])->name('posts.show');
    Route::delete('/post/{id}/delete', [PostController::class, 'destroy'])->name('posts.delete');
    Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('/post/{id}/edit/update', [PostController::class, 'update'])->name('posts.update');
    Route::post('/posts/{id}/like', [PostController::class, 'like'])->name('posts.like');
    Route::post('/posts/{id}/comment', [PostController::class, 'comment'])->name('posts.comment');
    Route::get('/posts/{post}/comment', [PostController::class, 'loadMore'])->name('posts.comment.load');

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


