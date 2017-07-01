<?php 

/**
* 
* Database settings
* 
*/
$app = new \Slim\App([
	'settings' => [
		'displayErrorDetails' => true,
	//Database definition
	'db' => [
		'driver' => 'mysql',
		'host'=> 'localhost',
		'database' => 'raw-php',
		'username' => 'root',
		'password' => 'basket',
		'charset' => 'utf8',
		'collation' => 'utf8_unicode_ci',
		'prefix' => '',
	]
  ]
]);
