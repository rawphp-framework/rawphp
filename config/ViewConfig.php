<?php


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
	
	//Add flash
	$view->getEnvironment()->addGlobal('flash', $container->flash);
	
	
	return $view;
	
	
};
