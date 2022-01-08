<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //
    protected $table = 'rooms';

    public function room_condition()
    {
        return $this->hasOne(status::class, 'id', 'status');
    }

    public function has_user()
    {
        return $this->hasOne(Member::class, 'id', 'taken_by');
    }

}
