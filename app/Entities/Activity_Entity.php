<?php

namespace App\Entities;
/**
 * Created by PhpStorm.
 * User: maizhikun
 * Date: 16/2/28
 * Time: 下午10:42
 */
class Activity_Entity extends Base_Entity{

    public static $entity = [
        "Activity" => "活动"
    ];

    public static $has_many = ['media'];

    public static function get_attribute(){
        $attribute = array();
        $attribute['activity_at'] = parent::set_attribute("活动时间","date_time");
        $attribute['text'] = parent::set_attribute("文字","string",[],20000);
        $attribute['place'] = parent::set_attribute("地点","string");
        $attribute['user_id'] = parent::set_attribute("用户","id");
        return array_merge(parent::get_attribute(),$attribute);
    }

    
}