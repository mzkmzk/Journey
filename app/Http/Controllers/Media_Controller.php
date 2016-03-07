<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Base_Controller;

class Media_Controller extends Base_Controller
{
     public function __construct(){
        $this->model =new Media_Model();
     }
}
