<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use K_Laravel_Creator\Models\Base_Model;

class Creator_Activity_Model extends Base_Model
{
    protected $table = 'Creator_Activity';

    public function creator_media(){
        return $this->hasMany('App\Creator_Media_Model','creator_media_id','id');
    }


}
