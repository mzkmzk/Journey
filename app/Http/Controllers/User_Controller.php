<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Base_Controller;

class User_Controller extends Base_Controller
{
     public function __construct(){
        $this->model =new User_Model();
     }
}
