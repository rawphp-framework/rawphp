<?php 

//container to return load controllers
/**
* 
* You have to list every new controller here
* 
*/
$container['HomeController'] = function($container){
	
	return new \App\Controllers\HomeController($container);
};

$container['AuthController'] = function($container){
	
	return new \App\Controllers\Auth\AuthController($container);
};

$container['PasswordController'] = function($container){
	
	return new \App\Controllers\Auth\PasswordController($container);
};