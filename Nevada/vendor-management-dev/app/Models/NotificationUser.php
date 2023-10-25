<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class NotificationUser extends Model
{
    protected $table = 'notification_user';

    public $timestamps = false;

    protected $fillable = [
        'notification_id',
        'user_id',
        'is_readed',
    ];

    public function notification(): HasOne
    {
        return $this->hasOne(Notification::class, 'id', 'notification_id');
    }
}
