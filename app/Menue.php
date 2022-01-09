<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menue extends Model
{
    //
    protected $table = "menues";

    public function has_food()
    {
        return $this->hasOne(Food::class, 'id', 'food_id');
    }
}
