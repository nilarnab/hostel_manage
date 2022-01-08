<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
    protected $table = 'users';

    public function userrole()
    {
        return $this->hasOne(role::class, 'id', 'role');
    }

    public function hosteler_room()
    {
        return $this->hasMany(Room::class, 'taken_by', 'id');
    }
}
