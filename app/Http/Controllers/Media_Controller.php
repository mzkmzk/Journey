<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Base_Controller;
use App\Models\Media_Model;

class Media_Controller extends Base_Controller
{

     public function __construct(Request $request){
        parent::__construct($request);
        $this->model =new Media_Model();
     }
}
