<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Qiniu\Auth;

class QiNiu_Controller extends Controller
{
    public function get_token() {
      $bucket = 'journey';
      $accessKey = '7SXiYZNWBQyXvS8eRg0PFNMlcRIxS9xQ2NaunjXn';
      $secretKey = 'trgyS9ecNNBIogkKsOkipGQEe9TMYPNErSdDdKfO';
      $auth = new Auth($accessKey, $secretKey);

      $upToken = $auth->uploadToken($bucket);

      //echo  $upToken;
      return response()->json(["uptoken" => $upToken]);
    }
}
