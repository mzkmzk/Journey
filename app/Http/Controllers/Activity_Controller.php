<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Base_Controller;
use App\Models\Activity_Model;

class Activity_Controller extends Base_Controller
{

     public function __construct(Request $request){
        parent::__construct($request);
        $this->model =new Activity_Model();
     }
}
