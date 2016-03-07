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
        "Media" => "媒体"
    ];

    private $attribute = array();

    public function get_attribute(){
        $this->attribute['activity_id'] = parent::set_attribute("活动ID","id");
        $this->attribute['url'] = parent::set_attribute("链接的url","url");
        $this->attribute['type'] = parent::set_attribute("类型","int");
        return array_merge(parent::get_base_attribute(),$this->attribute);
    }

    
}