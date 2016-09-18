<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatorActivity extends Migration
{

    public function up()
    {
        Schema::table('Creator_Activity', function (Blueprint $table) {
            $table->unsignedInteger('creator_user_id');


        });
    }

    public function down()
    {
        Schema::drop('Creator_Activity');
    }
}
