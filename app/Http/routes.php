<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'v1/{Entity_Controller}'], function (){
    /*Route::group(['prefix'=>'query'],function($Entiry_Controller){
        Route::get("",function($Entiry_Controller){
            return $Entiry_Controller;
        });
    });*/
    //Route::get('query',"$@query");
    Route::get('query',function($Entity_Controller,\Illuminate\Http\Request $request){
        $controller_string = "App\\Http\\Controllers\\" . $Entity_Controller;
        $controller = new $controller_string($request);
        dump($controller);
        return $controller->query();
    });

});
