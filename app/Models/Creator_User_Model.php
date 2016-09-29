<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use K_Laravel_Creator\Models\Base_Model;

class Creator_User_Model extends Base_Model
{
    protected $table = 'Creator_User';

    public function creator_activity(){
        return $this->hasMany('App\Models\Creator_Activity_Model','creator_user_id','id');
    }
    //有问题,如果有多个属性的话
     public $appends = ['patient_name'];

      public function getPatientNameAttribute(){
        if($this->creator_activity !=null){
            return '11111' ;
        }else {
            return "";
        }
    }


}
