<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use App\Models\User;

class FriendRequestNotification extends Notification
{
    protected $sender;

    public function __construct(User $sender)
    {
        $this->sender = $sender;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'sender_id' => $this->sender->id,
            'sender_name' => $this->sender->name,
            'message' => "{$this->sender->name} send a friend request.",
            'action_url' => route('profile', ['username' => $this->sender->username]),
        ];
    }
}
