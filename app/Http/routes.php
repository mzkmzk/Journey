<?php

Route::get('/', function () {
    //$abc = [];
	//echo $abc['12345'];
	return view('welcome');
});

Route::get('/php_info', function () {
    //$abc = [];
    //echo $abc['12345'];
    phpinfo();
});

Route::any('/get_token','QiNiu_Controller@get_token');


