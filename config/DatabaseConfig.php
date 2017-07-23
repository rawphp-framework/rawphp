<?php 

/**
* 
* Database settings
* This file will be renamed to SettingsConfig.php in subsequent versions
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
	],
	'cakeDB' => [
		'className' => 'Cake\Database\Connection',
		'driver' => 'Cake\Database\Driver\Mysql',
		'database' => 'raw-php',
		'username' => 'root',
		'password' => 'basket',
		'cacheMetadata' => false // If set to `true` you need to install the optional "cakephp/cache" package.

	]
  ]
]);


