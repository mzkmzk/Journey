<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use K_Laravel_Creator\Models\Base_Model;

class Creator_Activity_Model extends Base_Model
{
    protected $table = 'Creator_Activity';

    public function creator_media(){
        return $this->hasMany('App\Models\Creator_Media_Model','creator_activity_id','id');
    }
    //有问题,如果有多个属性的话
     public $appends = ['patient_name'];

      public function getPatientNameAttribute(){
        if($this->creator_media !=null){
            return '11111' ;
        }else {
            return "";
        }
    }


}
