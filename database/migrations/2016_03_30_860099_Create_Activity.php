<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivity extends Migration
{

    public function up()
    {
        Schema::create('Activity', function (Blueprint $table) {
            $table->increments('id');

$table->dateTime('created_at');

$table->dateTime('updated_at');

$table->dateTime('deleted_at');

$table->dateTime('activity_at');

$table->string('text','20000');

$table->string('place','255');

$table->unsignedInteger('user_id');


        });
    }

    public function down()
    {
        Schema::drop('Activity');
    }
}
