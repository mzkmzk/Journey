<?php

Route::get('/', function () {
    $abc = [];
	echo $abc['1234'];
	//return view('welcome');
});


Route::any('/get_token','QiNiu_Controller@get_token');


