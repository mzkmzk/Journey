<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatorMedia extends Migration
{

    public function up()
    {
        Schema::table('Creator_Media', function (Blueprint $table) {
            $table->unsignedInteger('creator_activity_id');


        });
    }

    public function down()
    {
        Schema::drop('Creator_Media');
    }
}
