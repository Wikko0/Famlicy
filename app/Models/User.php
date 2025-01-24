<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'title',
        'username',
        'phone',
        'photo',
        'birthday',
        'died',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userInformation()
    {
        return $this->hasOne(UsersInformation::class);
    }

    public function userEducation()
    {
        return $this->hasOne(UsersEducation::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id');
    }

    public function isFollowing(User $user)
    {
        return $this->following()->where('following_id', $user->id)->exists();
    }

    public function friends()
    {

        $friendIds = DB::table('friendships')
            ->where(function ($query) {
                $query->where('user_id', $this->id)
                    ->orWhere('friend_id', $this->id);
            })
            ->where('status', 'friends')
            ->get()
            ->map(function ($friendship) {
                return $friendship->user_id == $this->id ? $friendship->friend_id : $friendship->user_id;
            });

        return self::whereIn('id', $friendIds)->get();
    }

    public function communities()
    {
        return $this->belongsToMany(Community::class, 'community_user', 'user_id', 'community_id');
    }

    public function sentFriendRequests()
    {
        return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id')->wherePivot('status', 'invite');
    }


    public function receivedFriendRequests()
    {
        return $this->belongsToMany(User::class, 'friendships', 'friend_id', 'user_id')->wherePivot('status_friend', 'pending');
    }

    public function pendingFriend()
    {
        return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id')->wherePivot('status_friend', 'pending');
    }

    public function isFriendWith(User $user)
    {
        return \DB::table('friendships')
            ->where(function ($query) use ($user) {
                $query->where('user_id', $this->id)
                    ->where('friend_id', $user->id)
                    ->where('status', 'friends');
            })
            ->orWhere(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->where('friend_id', $this->id)
                    ->where('status', 'friends');
            })
            ->exists();
    }


    public function hasSentRequest(User $user)
    {
        return $this->sentFriendRequests()->where('friend_id', $user->id)->exists();
    }


    public function hasReceivedRequest(User $user)
    {
        return $this->receivedFriendRequests()->where('user_id', $user->id)->exists();
    }

    public function markAllNotificationsAsRead()
    {
        $this->unreadNotifications->markAsRead();
    }

    public function markNotificationAsRead($notificationId)
    {
        $notification = $this->notifications()->find($notificationId);
        if ($notification) {
            $notification->markAsRead();
        }
    }
}
