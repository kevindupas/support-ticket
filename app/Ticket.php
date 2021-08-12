<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'ticket_id',
        'name',
        'email',
        'category',
        'subject',
        'status',
        'description',
        'attachments',
        'note',
    ];

    public function conversions()
    {
        return $this->hasMany('App\Conversion', 'ticket_id', 'id')->orderBy('id');
    }

    public function tcategory()
    {
        return $this->hasOne('App\Category', 'id', 'category');
    }
}
