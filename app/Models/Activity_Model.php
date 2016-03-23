<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity_Model extends Model
{
    protected $table = 'Activity';

    public function media(){
        return $this->hasMany('App\Media_Model','media_id','id');
    }


}
