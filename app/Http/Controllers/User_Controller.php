<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use Vinelab\Http\Client as HttpClient;

class User_Controller extends Creator_User_Controller
{

     public function __construct(Request $request, $entity_name = ''){
        parent::__construct($request, $entity_name);
     }

     public function sinaLogin() {
        $code = $this->request->get('code');
        $access_token = $this->sinaAccessToken($code);

        //这里可以获取剩余过期时间,如果过少可以重新获取授权???每次登陆会产生不一样的access_token吗
        $sina_uid = $access_token['uid'];
        $sina_user = $this->getSinaUser($sina_uid);



     }

     private function sinaAccessToken($code) {
         $request = [
            'url' => 'https://api.weibo.com/oauth2/access_token',
            'headers' => [
                'Content-Type: application/x-www-form-urlencoded',
                'Cache-Control: no-cache',
                'Postman-Token: 70423b62-3ab5-0e60-05e6-9584df92a36f'
            ],
            'version' => 1.1,
            'content' =>  http_build_query([
                'client_id' => env('SINA_CLIENT_ID'),
                'client_secret' => env('SINA_CLIENT_SECRET'),
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => env('URL')
            ]),
        ]
        $response = \HttpClient::post($request);
        error_log($response->json());
        return $response->json();
     }

     private function getSinaUser($sina_uid) {
        return  $user = $this->model->where('sina_uid',$sina_uid)
                                    ->get();
     }
}
