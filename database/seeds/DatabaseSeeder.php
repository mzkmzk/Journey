<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        Model::unguard();
        factory(App\Models\User_Model::class, 1)->create();

factory(App\Models\User_Model::class, 1)->create();

factory(App\Models\Activity_Model::class, 1)->create();

factory(App\Models\Media_Model::class, 1)->create();

//
        Model::reguard();
    }

}
