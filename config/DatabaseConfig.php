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
		'driver'   => env('DB_CONNECTION', 'mysql'),
		'host'     => env('DB_HOST', 'localhost'),
		'database' => env('DB_Name', 'raw-php'),
		'username' => env('DB_USERNAME', 'root'),
		'password' => env('DB_PASSWORD', 'secret'),
		'charset'  => 'utf8',
		'collation' => 'utf8_unicode_ci',
		'prefix' => '',
	],
	'cakeDB' => [
		'className' => 'Cake\Database\Connection',
		'driver' => 'Cake\Database\Driver\Mysql',
		'database' => env('DB_Name', 'raw-php'),
		'username' => env('DB_USERNAME', 'root'),
		'password' => env('DB_PASSWORD', 'secret'),
		'cacheMetadata' => false // If set to `true` you need to install the optional "cakephp/cache" package.

	]
  ]
]);


