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

$container['UsersController'] = function($container){
	return new \App\Controllers\UsersController($container);
};

$container['PostsController'] = function($container){
	return new \App\Controllers\PostsController($container);
};
$container['RolesController'] = function($container){
	return new \App\Controllers\RolesController($container);
};


 
$container['TestsController.'] = function($container){
	return new \App\Controllers\TestsController.($container);
};