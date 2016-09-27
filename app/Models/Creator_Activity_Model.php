<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use K_Laravel_Creator\Models\Base_Model;

class Creator_Activity_Model extends Base_Model
{
    protected $table = 'Creator_Activity';

    public $appends = ['patient_name'];
    //问题 模板生成时没有Models和id搞反了 
    public function creator_media(){
        return $this->hasMany('App\Models\Creator_Media_Model','creator_activity_id','id');
    }

        public function getPatientNameAttribute(){
        if($this->creator_media !=null){
            return '11111' ;
        }else {
            return "";
        }
    }


}
