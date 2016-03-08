<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Model extends Model
{
    protected $table = 'User';

    public function activity(){
        return $this->hasMany('App\Activity_Model','activity_id','id');
    }


}
