<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Model extends Model
{
    protected $table = 'User';

    public function dummy_has_many(){
        return $this->hasMany('App\Dump_Has_Many_entity_Model','dummy_has_many_entity_id','id');
    }

    public function dummy_belong_to(){
        return $this->belongsTo('App\Dump_Belong_To_Model','dump_belong_to_entity_id','id');
    }
}
