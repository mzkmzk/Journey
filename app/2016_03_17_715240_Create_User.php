<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create_User extends Migration
{

    public function up()
    {
        Schema::create('User', function (Blueprint $table) {
            $table->unsignedInteger('id');

$table->dateTime('created_at');

$table->dateTime('updated_at');

$table->dateTime('deleted_at');

$table->string('wechat_id','255');

$table->string('visit_password','255');


        });
    }

    public function down()
    {
        Schema::drop('User');
    }
}
