<?php

namespace App\Models;

class User_Model extends Base_Model
{
    protected $table = 'User';

    public function activity(){
        return $this->hasMany('App\Activity_Model','activity_id','id');
    }


}
