<?php 

//use the src/config/DatabaseConfig.php file in

//load laravel eloquent
$capsule = new \Illuminate\Database\Capsule\Manager;
//add new database connection 
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();


/**
* Enable CakePHP ORM
* Uncomment the below to start using CakePHP ORM
* 
*/

/*
//load  cakephp ORM
$capsule = new Cake\Datasource\ConnectionManager;

$capsule->setConfig('default', $container['settings']['cakeDB']);

*/