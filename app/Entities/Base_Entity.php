<?php
/**
 * Created by PhpStorm.
 * User: maizhikun
 * Date: 16/2/28
 * Time: 下午10:45
 */
namespace App\Entities;

class Base_Entity{

    private $base_attribute = array();

    public $attribute = array();

    public function get_base_attribute(){
        $this->base_attribute['id'] = $this->set_attribute("序号","id");
        $this->base_attribute['created_at'] = $this->set_attribute("创建时间","date_time");
        $this->base_attribute['updated_at'] = $this->set_attribute("修改时间","date_time");
        $this->base_attribute['deleted_at'] = $this->set_attribute("删除时间","date_time");
        return $this->base_attribute ;
    }

    /**
     * @param $front 前端显示字段名
     * @param $type 字段类型 "id" , "string" , "date_time" "url","int"
     * @param $option 选项
     * @param $length 字段长度
     * @return array
     */
    public static function  set_attribute($front , $type , $option = [] ,$length = 255){
        return $attribute = [
            "front" => $front,
            "type" => $type,
            "option" => $option,
            "length" => $length,
        ];
    }

}