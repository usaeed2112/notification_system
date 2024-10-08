<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{
    use HasFactory;


    /**
     * The users that are subscribed to this notification type.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_notifications');
    }
}
