<?php

Route::get('/', function () {
	return view('welcome');
});


Route::any('/get_token','QiNiu_Controller@get_token');


