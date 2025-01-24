<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersEducation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'start_date',
        'end_date',
        'subject'
    ];

    protected $casts = [
        'subject' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
