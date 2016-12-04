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

        dump($this->request->get('url'));
        $code = $this->request->get('code');
        $access_token = $this->sinaAccessToken($code);
        dump($access_token);
        //这里可以获取剩余过期时间,如果过少可以重新获取授权???每次登陆会产生不一样的access_token吗
        $sina_uid = $access_token->uid;
        $sina_access_token = $access_token->access_token;

        $sina_user = $this->getSinaUser($sina_uid);

        //dump($sina_user);
        if(count($sina_user) === 0 ) {
           $sina_user = $this->model->create([
                'sina_uid' => $sina_uid,
                'sina_access_token' => $sina_access_token,
           ]);
        }else {
            $sina_user = $sina_user[0];
            $sina_user['sina_access_token'] = $sina_access_token;
             $sina_user->save();
        }
        //不安全 需要改善
        return redirect(env('URL')."?sina_access_token={$sina_access_token}&id={$sina_user['id']}");

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
        ];
        $response = \HttpClient::post($request);
        error_log(json_encode( $response->json()));
        return $response->json();
     }

     private function getSinaUser($sina_uid) {
        return  $user = $this->model->where('sina_uid',$sina_uid)
                                    ->get();
     }
}
