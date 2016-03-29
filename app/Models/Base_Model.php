<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Base_Model extends Model implements Jsonable{

    use SoftDeletes;



}

