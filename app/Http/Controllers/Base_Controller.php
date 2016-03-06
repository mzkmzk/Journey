<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class Base_Controller extends Controller{

    //继承的Controller,必须在构造方法中,注入相对应的实体Model
    protected  $model = null;

    public function base_query(Request $request){
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


    protected function base_insert(Request $request){

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

    public function base_update(Request $request){
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

    public function base_delete(Request $request){
        $result["result"] = $this->model
            ->where("id",$request->get("id"))
            ->delete();
        return $result;
    }

    public function base_restore(Request $request){
        $result["result"] = $this->model->withTrashed()
            ->where("id",$request->get("id"))
            ->restore();
        return $result;
    }

    //默认执行的query
    protected function query(Request $request){
        return $this->base_query($request);
    }

    //默认执行的insert
    protected function insert(Request $request){
        return json_encode($this->base_insert($request));
    }

    //默认执行的update
    public function update(Request $request){
        return json_encode($this->base_update($request));
    }

    //默认执行的delete
    public function delete(Request $request){
        return json_encode($this->base_delete($request));
    }

    //默认执行的restore
    public function restore(Request $request){
        return json_encode($this->base_restore($request));
    }


    /*protected function get_patient(LengthAwarePaginator $paginator){
        $result = $paginator->getCollection();
        for($index =0 ;$index <  $result->count(); $index++){
            $result->get($index)["patient"] =  $result->get($index)->sample->patient;
        }

        $model['data'] = $result;
        $model['total']  = $paginator->total();
        $model['current_page'] = $paginator->currentPage();
        $model['last_page'] = $paginator->lastPage();
        return $model;
    }

    protected function get_patient_DNA(LengthAwarePaginator $paginator){
        $result = $paginator->getCollection();
        for($index =0 ;$index <  $result->count(); $index++){
            if (count( explode("BC",$result->get($index)->ready_sample_code))>1){
                $result->get($index)["patient"] =  $result->get($index)->blood_cell->sample->patient;
            }else if (count( explode("BP",$result->get($index)->ready_sample_code))>1){
                $result->get($index)["patient"] =  $result->get($index)->blood_plasma->sample->patient;
            }
        }

        $model['data'] = $result;
        $model['total']  = $paginator->total();
        $model['current_page'] = $paginator->currentPage();
        $model['last_page'] = $paginator->lastPage();
        return $model;
    }

    protected function get_patient_library(LengthAwarePaginator $paginator){

        $result = $paginator->getCollection();
        for($index =0 ;$index <  $result->count(); $index++){
            //error_log($result->get($index).json_encode(explode("BC",$result->get($index)->sample_dna_id)));
            error_log(json_encode($result[$index]));
            //$result_dna[$index] = $result->get($index)->DNA;
            if (count( explode("GD",$result[$index]->sample_dna_id))>1){
                $result->get($index)["patient"] =  $result->get($index)->DNA->blood_cell->sample->patient;
            }else if (count( explode("CFD",$result->get($index)->sample_dna_id))>1){
                $result->get($index)["patient"] =  $result->get($index)->DNA->blood_plasma->sample->patient;
            }
        }

        $model['data'] = $result;
        $model['total']  = $paginator->total();
        $model['current_page'] = $paginator->currentPage();
        $model['last_page'] = $paginator->lastPage();
        return $model;
    }

    protected function get_patient_seq_run(LengthAwarePaginator $paginator){
        $result = $paginator->getCollection();
        $count = $result->count();
        $n = 0;
        for($index =0 ;$index <  $count; $index++){
            error_log(json_encode($result[$index]));
            $library_id_all = array_filter(explode(",",$result->get($index)['sample_dna_library_id']));//二维数组，每个元素（一维数组）是相应上机的文库code集合
            $library_volume_all = array_filter(explode(",",$result->get($index)['sample_dna_library_volume']));//二维数组，每个元素（一维数组）是相应上机的文库code集合
            $library_volume_unit_all = array_filter(explode(",",$result->get($index)['sample_dna_library_volume_unit']));//二维数组，每个元素（一维数组）是相应上机的文库code集合

            $result->get($index)['sample_dan_library_id'] = $library_id_all[0];
            $result_tmp[$n] = $result->get($index);
            $result[$index] =  $result->get($index)->library;


            if (count( explode("GD",$result[$index]->sample_dna_id))>1){
                $result_tmp[$n]["patient"] =  $result->get($index)->DNA->blood_cell->sample->patient;
            }else if (count( explode("CFD",$result->get($index)->sample_dna_id))>1){
                $result_tmp[$n]["patient"] =  $result->get($index)->DNA->blood_plasma->sample->patient;
            }

            $n++;
            if(!empty($library_id_all[0])){
                $result_tmp[$n++] = $library_id_all;
                $result_tmp[$n++] = $library_volume_all;
                $result_tmp[$n++] = $library_volume_unit_all;
            }


            //$result[$index] = $result->get($index)->DNA;

        }

        $model['data'] = $result_tmp;
        $model['total']  = $paginator->total();
        $model['current_page'] = $paginator->currentPage();
        $model['last_page'] = $paginator->lastPage();
        return $model;
    }

    protected function get_patient_raw_data(LengthAwarePaginator $paginator){
        $result = $paginator->getCollection();
        $count = $result->count();
        $n = 0;
        for($index =0 ;$index <  $count; $index++){
            $result_tmp[$index] = $result->get($index)->seq_run;
            //error_log($result->get($index).json_encode(explode("BC",$result->get($index)->sample_dna_id)));
            error_log(json_encode($result[$index]));
            $library_id_all = array_filter(explode(",",$result_tmp[$index]['sample_dna_library_id']));//二维数组，每个元素（一维数组）是相应上机的文库code集合
            $library_volume_all = array_filter(explode(",",$result_tmp[$index]['sample_dna_library_volume']));//二维数组，每个元素（一维数组）是相应上机的文库code集合
            $library_volume_unit_all = array_filter(explode(",",$result_tmp[$index]['sample_dna_library_volume_unit']));//二维数组，每个元素（一维数组）是相应上机的文库code集合
            //error_log(print_r($library_id_all));

            $result_tmp[$index]['sample_dan_library_id'] = $library_id_all[0];
            $result_tmp[$n] =  $result_tmp[$index];
            $result_tmp[$index] =  $result_tmp[$index]->library;

            error_log(json_encode($result_tmp[$index]));
            if (count( explode("GD",$result_tmp[$index]->sample_dna_id))>1){
                $result[$index]["patient"] =   $result_tmp[$index]->DNA->blood_cell->sample->patient;
            }else if (count( explode("CFD",$result_tmp[$index]->sample_dna_id))>1){
                $result[$index]["patient"] =   $result_tmp[$index]->DNA->blood_plasma->sample->patient;
            }

            $n++;
            if(!empty($library_id_all[0])){
                $result_tmp[$n++] = $library_id_all;
                $result_tmp[$n++] = $library_volume_all;
                $result_tmp[$n++] = $library_volume_unit_all;
            }
            //$result[$index] = $result->get($index)->DNA;

        }

        $model['data'] = $result;
        $model['total']  = $paginator->total();
        $model['current_page'] = $paginator->currentPage();
        $model['last_page'] = $paginator->lastPage();
        return $model;
    }*/

}