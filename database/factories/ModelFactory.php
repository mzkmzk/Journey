<?php

$factory->define(App\User_Model::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->randomElement(get_all_id(new id_Model())),
'created_at' => $faker->dateTime(),
'updated_at' => $faker->dateTime(),
'deleted_at' => $faker->dateTime(),
'wechat_id' => $faker->text(30),
'login_sum' => $faker->numberBetween(),
'visit_password' => $faker->text(30),

    ];
});


$factory->define(App\Activity_Model::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->randomElement(get_all_id(new id_Model())),
'created_at' => $faker->dateTime(),
'updated_at' => $faker->dateTime(),
'deleted_at' => $faker->dateTime(),
'activity_at' => $faker->dateTime(),
'text' => $faker->text(30),
'place' => $faker->text(30),
'user_id' => $faker->randomElement(get_all_id(new User_Model())),

    ];
});


$factory->define(App\Media_Model::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->randomElement(get_all_id(new id_Model())),
'created_at' => $faker->dateTime(),
'updated_at' => $faker->dateTime(),
'deleted_at' => $faker->dateTime(),
'activity_id' => $faker->randomElement(get_all_id(new Activity_Model())),
'url' => $faker->imageUrl(640,480),
'type' => $faker->numberBetween(),

    ];
});


