<?php 

//load laravel eloquent
$capsule = new \Illuminate\Database\Capsule\Manager;
//add new database connection 
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();


//load  cakephp ORM
//