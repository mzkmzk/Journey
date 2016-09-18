<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatorMedia extends Migration
{

    public function up()
    {
        Schema::create('Creator_Media', function (Blueprint $table) {
            $table->increments('id');

$table->dateTime('created_at');

$table->dateTime('updated_at');

$table->dateTime('deleted_at');

$table->unsignedInteger('activity_id');

$table->string('url','255');

$table->integer('type');


        });
    }

    public function down()
    {
        Schema::drop('Creator_Media');
    }
}
