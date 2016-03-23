<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class Base_Controller extends Controller{

    protected $request;

    public function __construct(Request $request){
        //parent::__construct();
        $this->request;
    }
    //继承的Controller,必须在构造方法中,注入相对应的实体Model
    protected  $model = null;

    public function query(){
        return "1321";
        //dump($request->session()->get('login_user_info'));

        //搜索名字,返回的$request 会带有`IDs`,表明符合病人名字匹配的当前实体ID.
        //能根据病人名字搜索到的实体Model,都会有`get_IDs_by_patientName`方法,进行逐级递归查找
        if(isset($request['patient_name'])){
            $request = $this->model->get_IDs_by_patientName($request);
        }

        $model =  $this->model->select_withTrashed($request);

        if(isset($request['IDs'])){
            $model = $model->whereIn('id',$request['IDs']);
        }
        //error_log(get_called_class());

        //获取实体属性,对where查询进行过滤非本实体的属性.
        $attribute_one = get_model_attribute($this->model);
        //dump($attribute_one);
        foreach($request->all() as $key => $value){
            if (array_key_exists($key,$attribute_one) ==true){
                $model = $model->where($key,$value);
            }
        }

         $page_num = null;
        if($request['page_size'] !=null){
            $page_num = $request['page_size'];
        }else {
            $page_num = 20;
        }

        $model = $model->orderBy("updated_at","desc")
            ->Paginate($page_num)
            ->toJson();

       return $model;
    }


    protected function insert(Request $request){

        $result_data = array();

        $attribute_one = get_model_attribute($this->model);

        $request_all = $request->all();

        $array_length = object_all_array($request_all);

        //单个增加和 else批量增加处理
        if($array_length == 0){
            foreach($request->all() as $key => $value){
                if (array_key_exists($key,$attribute_one) ==true){
                    $this->model[$key] = $value;
                }
            }
            $result["result"] = $this->model->save();
        }else {
            //对于批量增加,每个属性都是一个数组
            for($index =0;$index<$array_length;$index++){
                $attribute = array();
                foreach($request_all as $key => $value){
                    if (array_key_exists($key,$attribute_one) ==true){
                        $this->model[$key] = $value[$index];
                        $attribute[$key] = $value[$index];
                    }
                }

                $create_model = $this->model->create($attribute);
                array_push($result_data,$create_model);

                $result["result"] = !is_null($create_model);
            }
        }
        $result['data'] = $result_data;
        return $result;
    }

    public function update(Request $request){
        //根据id,找到相应实体
        $this->model = $this->model->find($request->get('id'));
        //获取实体的属性,用来过滤非实体属性的更新
        $attribute_one = get_model_attribute($this->model);
        foreach($request->all() as $key => $value){
            if (array_key_exists($key,$attribute_one) ==true){
                $this->model[$key] = $value;
            }
        }
        $result["result"] = $this->model->save();
        return $result;
    }

    public function delete(Request $request){
        $result["result"] = $this->model
            ->where("id",$request->get("id"))
            ->delete();
        return $result;
    }

    public function restore(Request $request){
        $result["result"] = $this->model->withTrashed()
            ->where("id",$request->get("id"))
            ->restore();
        return $result;
    }



}