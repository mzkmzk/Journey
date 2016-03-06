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
        "User" => "用户"
    ];

    private $attribute = array();

    public function get_attribute(){
        $this->attribute['user_name'] = parent::set_attribute("用户名","string");
        $this->attribute['password'] = parent::set_attribute("密码","string");
        return array_merge(parent::get_base_attribute(),$this->attribute);
    }

    
}