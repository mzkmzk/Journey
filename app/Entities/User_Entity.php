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

    public $has_many = ['activity'];

    public function get_attribute(){
        $this->attribute['wechat_id'] = parent::set_attribute("微信ID","string");
        $this->attribute['login_sum'] = parent::set_attribute("登陆次数","int");
        $this->attribute['visit_password'] = parent::set_attribute("访问密码","string");
        return array_merge(parent::get_base_attribute(),$this->attribute);
    }

    
}