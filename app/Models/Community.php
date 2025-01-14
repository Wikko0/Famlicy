<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'users', 'invitations'];

    protected $casts = [
        'users' => 'array',
        'invitations' => 'array',
    ];

    public function addUser($userId)
    {
        $users = $this->users ?? [];
        $users[] = $userId;
        $this->users = $users;
        $this->save();
    }

    public function members()
    {
        return User::whereIn('id', $this->users ?? [])->get();
    }

    public function hasPendingInvitation($userId)
    {
        $invitations = $this->invitations ?? [];
        foreach ($invitations as $invitation) {
            if ($invitation['user_id'] == $userId && $invitation['status'] === 'pending') {
                return true;
            }
        }
        return false;
    }

    public function inviteUser($userId)
    {
        $invitations = $this->invitations ?? [];
        $invitations[] = ['user_id' => $userId, 'status' => 'pending'];
        $this->invitations = $invitations;
        $this->save();
    }

    public function updateInvitationStatus($userId, $status)
    {
        $invitations = $this->invitations ?? [];
        foreach ($invitations as &$invitation) {
            if ($invitation['user_id'] == $userId) {
                $invitation['status'] = $status;
                break;
            }
        }
        $this->invitations = $invitations;
        $this->save();
    }

    public function isUserMember($userId)
    {
        return in_array($userId, $this->users ?? []);
    }
    public function isNotUserMember($userId)
    {

        return !in_array($userId, $this->users ?? []);
    }
}
