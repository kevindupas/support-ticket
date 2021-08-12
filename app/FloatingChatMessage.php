<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FloatingChatMessage extends Model
{
    protected $fillable = [
        'from',
        'to',
        'message',
        'is_read',
    ];

    public function from_user()
    {
        return $this->hasOne('App\FloatingChatUser', 'id', 'from');
    }
}
