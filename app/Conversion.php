<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversion extends Model
{
    protected $fillable = [
        'ticket_id','description', 'attachments', 'sender'
    ];

    public function replyBy(){
        if($this->sender=='user'){
            return $this->ticket;
        }
        else{
            return $this->hasOne('App\User','id','sender')->first();
        }
    }

    public function ticket(){
        return $this->hasOne('App\Ticket','id','ticket_id');
    }
}
