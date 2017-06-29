<?php 

use Respect\Validation\Validator as v;

session_start();

require __DIR__. '/../vendor/autoload.php';

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


//using Twig
$container = $app->getContainer();


//load eloquent
$capsule = new \Illuminate\Database\Capsule\Manager;
//add new database connection 
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use ($capsule) {
	return $capsule;
};

//load view
$container['view'] = function($container){
	
	$view = new \Slim\Views\Twig(__DIR__. '/../resources/views', [
		'cache' => false,
	]);
	
	//load Auth 
	$container['auth'] = function ($container){
		return new \App\Auth\Auth;
	};

	//add extension to help generate url to different views
	$view->addExtension(new \Slim\Views\TwigExtension(
		//router helps generate links within views
		
		$container->router,
		//get the current url
		$container->request->getUri()
	));
	
	/**
	* 
	* Pass the auth to the view
	* 
	*/
	$view->getEnvironment()->addGlobal('auth',[
	'check' => $container->auth->check(),
	'user' => $container->auth->user(),
	]);
	
	$view->getEnvironment()->addGlobal('flash', $container->flash);
	
	
	return $view;
	
	
};

//Add validator 
$container['validator'] = function($container){
	return new App\Validation\Validator;
};



//container to return our controllers
$container['HomeController'] = function($container){
	
	return new \App\Controllers\HomeController($container);
};

$container['AuthController'] = function($container){
	
	return new \App\Controllers\Auth\AuthController($container);
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
//turn on csrf
$app->add($container->csrf);

/**
* Load validation rules
*/
v::with('App\\Validation\\Rules\\');

//loading routes
require __DIR__. '/../app/routes.php';
