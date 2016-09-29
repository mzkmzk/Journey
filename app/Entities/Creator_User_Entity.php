<?php

namespace App\Entities;
/**
 * Created by PhpStorm.
 * User: maizhikun
 * Date: 16/2/28
 * Time: 下午10:42
 */

use K_Laravel_Creator\Entities\Base_Entity;


class Creator_User_Entity extends Base_Entity{

    public static $entity = [
        "User" => "用户"
    ];

    public static $has_many = ['Creator_Activity'];

    public static function get_attribute(){
        $attribute = array();
        $attribute['wechat_id'] = parent::set_attribute("微信ID","string");
        $attribute['login_sum'] = parent::set_attribute("登陆次数","int");
        $attribute['visit_password'] = parent::set_attribute("访问密码","string");
        $attribute['sina_uid'] = parent::set_attribute("新浪id","string");
        $attribute['sina_access_token'] = parent::set_attribute("新浪密钥","string");
        return array_merge(parent::get_attribute(),$attribute);
    }

    
}