<?php 

/**
* 
* Load containers
*/

//database
$container['db'] = function ($container) use ($capsule) {
	return $capsule;
}; 

//Add validator 
$container['validator'] = function($container){
	return new App\Validation\Validator;
};

$container['csrf'] = function ($container){
	return new \Slim\Csrf\Guard;
};


$container['flash'] = function ($container){
	return new \Slim\Flash\Messages;
};




/**
* Load Middlewares
*/
$app->add(new \App\Middlewares\ValidationErrorsMiddleware($container));
$app->add(new \App\Middlewares\OldInputMiddleware($container));
$app->add(new \App\Middlewares\CsrfViewMiddleware($container));
//$app->add(new \App\Middlewares\AuthMiddleware($container));
//turn on csrf
$app->add($container->csrf);