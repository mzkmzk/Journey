<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Base_Controller;
use App\Models\User_Model;

class User_Controller extends Base_Controller
{

     public function __construct(Request $request){
        parent::__construct($request);
        $this->model =new User_Model();
     }
}
