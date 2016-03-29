<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'v1/{Entity_Controller}'], function (){
    //
    Route::get('query',function($Entity_Controller,\Illuminate\Http\Request $request){
        $controller_string = "App\\Http\\Controllers\\" . $Entity_Controller;
        $controller = new $controller_string($request);
        return $controller->query();
    });

});
