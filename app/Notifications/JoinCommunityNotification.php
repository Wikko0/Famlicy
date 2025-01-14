<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JoinCommunityNotification extends Notification
{
    protected $sender;
    protected $community;

    public function __construct(User $sender, $community)
    {
        $this->sender = $sender;
        $this->community = $community;
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
            'message' => "{$this->sender->name} has sent an invitation to join the community.",
            'action_url' => route('community.page', ['communityId' => $this->community]),
        ];
    }
}
