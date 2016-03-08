<?php

namespace App\Entities;
/**
 * Created by PhpStorm.
 * User: maizhikun
 * Date: 16/2/28
 * Time: 下午10:42
 */
class Media_Entity extends Base_Entity{

    public static $entity = [
        "Media" => "媒体"
    ];

    public static function get_attribute(){
        $attribute =array();
        $attribute['activity_id'] = parent::set_attribute("活动ID","id");
        $attribute['url'] = parent::set_attribute("链接的url","url");
        $attribute['type'] = parent::set_attribute("类型","int");
        return array_merge(parent::get_attribute(),$attribute);
    }

    
}