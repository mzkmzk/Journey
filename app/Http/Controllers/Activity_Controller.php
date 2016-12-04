<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Creator_Media_Controller;



class Activity_Controller extends Creator_Activity_Controller
{

     public function __construct(Request $request, $entity_name = ''){
        parent::__construct($request, $entity_name);
     }

     public function query() {
        //应该通过access_token判断有无权限 
        $sina_access_token = $this->removeAttribute($this->request,'sina_access_token');

        $this->request->merge([
                'creator_user_id' => $this->removeAttribute($this->request,'id')
            ]);

       
        if(!is_null($this->request->get('first_query_at'))) {
             parent::init_query();
            $this->query->where('created_at','<',$this->removeAttribute($this->request,'first_query_at'));
        }
        return parent::query();
     }

     public function insert(Creator_Media_Controller $creator_media_controller ){
        error_log(json_encode($this->request->all()));
        error_log(json_encode($this->request));
        date_default_timezone_set('Asia/Shanghai');
        //应该通过access_token判断有无权限 
        $sina_access_token = $this->removeAttribute($this->request,'sina_access_token');

        $result_activity = parent::insert([
                'text' => $this->removeAttribute($this->request,'text'),
                'creator_user_id' => $this->removeAttribute($this->request,'id')
            ]);
        $result_media = null;
        if($this->request->get('media') != null) {
            $result_media = $creator_media_controller->insert(
                    array_merge(
                        $this->request->get('media'),
                        $this->createAttributeArray('creator_activity_id',$result_activity['data'][0]['id'],count($this->request->get('media')['qiniu_key']))
                    )
                );
        }
        
        return [
            'error_code' => 0,
            'data' => [ 
                array_merge($result_activity['data'][0]['attributes'],['creator_media' => $result_media['data']])
             ]
        ];

     }
}
