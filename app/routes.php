<?php
 
 /*
$app->get('/', function($request, $response){
		//return a text
		//return 'home';
		
		//return a view
		return $this->view->render($response, 'home.twig');
	}); */
	
$app->get('/', 'HomeController:index')->setName('home');

$app->get('/auth/signup', 'AuthController:getSignup')->setName('auth.signup');
$app->post('/auth/signup', 'AuthController:postSignup');

$app->get('/auth/signin', 'AuthController:getSignin')->setName('auth.signin');
$app->post('/auth/signin', 'AuthController:postSignin');


$app->get('/auth/signout', 'AuthController:getSignout')->setName('auth.signout');
