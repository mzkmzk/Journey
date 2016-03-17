<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create_Media extends Migration
{

    public function up()
    {
        Schema::create('Media', function (Blueprint $table) {
            $table->unsignedInteger('id');

$table->dateTime('created_at');

$table->dateTime('updated_at');

$table->dateTime('deleted_at');

$table->unsignedInteger('activity_id');


        });
    }

    public function down()
    {
        Schema::drop('Media');
    }
}
