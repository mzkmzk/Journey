<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use K_Laravel_Creator\Http\Controllers\Base_Controller;
use App\Models\Creator_User_Model;

class Creator_User_Controller extends Base_Controller
{

     public function __construct(Request $request, $entity_name = ''){
        parent::__construct($request, $entity_name);
        $this->model =new Creator_User_Model();
     }
}
