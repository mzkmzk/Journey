<?php

namespace App\Entities;
/**
 * Created by PhpStorm.
 * User: maizhikun
 * Date: 16/2/28
 * Time: 下午10:42
 */

use K_Laravel_Creator\Entities\Base_Entity;

class Creator_Media_Entity extends Base_Entity{

    public static $entity = [
        "Media" => "媒体"
    ];

    public static function get_attribute(){
        $attribute =array();
        $attribute['creator_activity_id'] = parent::set_attribute("活动ID","id");
        $attribute['url'] = parent::set_attribute("链接的url","url");
        $attribute['type'] = parent::set_attribute("类型","int"); // 1图片
        $attribute['qiniu_key'] = parent::set_attribute("七牛key",'string'); 
        return array_merge(parent::get_attribute(),$attribute);
    }

    
}