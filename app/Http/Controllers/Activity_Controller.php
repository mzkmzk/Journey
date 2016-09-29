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

     public function query( ) {

     }

     public function insert(Creator_Media_Controller $creator_media_controller ){
        date_default_timezone_set('Asia/Shanghai');
        $result_activity = parent::insert($this->removeAttribute($this->request,'text'));
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
