<?php

$root =  $_SERVER['DOCUMENT_ROOT'];
$app_root = $root.'/loan';
require $app_root."\config.php";


use Illuminate\Database\Capsule\Manager as Capsule;
Capsule::schema()->create('users', function ($table) {
   $table->increments('id');
   $table->string('name');
   $table->string('email')->unique();
   $table->string('password');
   $table->timestamps();
});
Capsule::schema()->create('posts', function ($table) {
   $table->increments('id');
   $table->string('title');
   $table->text('body');
   $table->integer('created_by')->unsigned();
   $table->timestamps();
});




?>