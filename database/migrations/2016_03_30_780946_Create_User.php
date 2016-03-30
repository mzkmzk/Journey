<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUser extends Migration
{

    public function up()
    {
        Schema::create('User', function (Blueprint $table) {
            $table->increments('id');

$table->dateTime('created_at');

$table->dateTime('updated_at');

$table->dateTime('deleted_at');

$table->string('wechat_id','255');

$table->integer('login_sum');

$table->string('visit_password','255');


        });
    }

    public function down()
    {
        Schema::drop('User');
    }
}