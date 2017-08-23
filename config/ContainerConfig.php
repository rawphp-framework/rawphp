<?php 

/**
* 
* Load container settings
* The middlewares for these container configurations are defined in config/MiddlewareConfig.php
*/

//database
$container['laraveldb'] = function ($container) use ($capsule) {
	//In your controller, you should have $this->cakedb->table('users')->find(1);
	return $capsule;
}; 

$container['cakedb'] = function ($container) use ($capsule) {
	
	//in your controller, you can now do $this->cakedb->table('users')->find(1);
	return $capsule;
}; 

//Add validator 
$container['validator'] = function($container){
	return new App\Validation\Validator;
};

$container['csrf'] = function ($container){
	//return new \Slim\Csrf\Guard;
	
	$guard = new \Slim\Csrf\Guard();
    $guard->setFailureCallable(function ($request, $response, $next) {
        $request = $request->withAttribute("csrf_status", true); //set to false if you dont want persistent tokens
        return $next($request, $response);
    });
    return $guard;
};


$container['flash'] = function ($container){
	return new \Slim\Flash\Messages;
};

$container['upload_directory'] = __DIR__. '/uploads';

