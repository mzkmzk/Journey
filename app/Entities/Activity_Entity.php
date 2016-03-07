<?php

namespace App\Entities;
/**
 * Created by PhpStorm.
 * User: maizhikun
 * Date: 16/2/28
 * Time: 下午10:42
 */
class User_Entity extends Base_Entity{

    public $entity = [
        "Activity" => "活动"
    ];

    private $attribute = array();

    public $has_many = ['media'];

    public function get_attribute(){
        $this->attribute['activity_at'] = parent::set_attribute("活动时间","date_time");
        $this->attribute['text'] = parent::set_attribute("文字","string",[],20000);
        $this->attribute['place'] = parent::set_attribute("地点","string");
        $this->attribute['user_id'] = parent::set_attribute("用户","id");
        return array_merge(parent::get_base_attribute(),$this->attribute);
    }

    
}