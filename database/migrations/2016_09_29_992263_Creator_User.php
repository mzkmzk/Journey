<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatorUser extends Migration
{

    public function up()
    {
        Schema::table('Creator_User', function (Blueprint $table) {
            $table->string('sina_uid','255');


        });
    }

    public function down()
    {
        Schema::drop('Creator_User');
    }
}
