<?php
 
 //always import middlewares you wish to use
use App\Middlewares\AuthMiddleware;
use App\Middlewares\GuestMiddleware;
 
 /*
$app->get('/', function($request, $response){
		//return a text
		//return 'home';
		
		//return a view
		return $this->view->render($response, 'home.twig');
	}); */
	
	
$app->get('/', 'HomeController:index')->setName('home');

$app->group('', function ()  use ($app) {
$app->get('/auth/signup', 'AuthController:getSignup')->setName('auth.signup');
$app->post('/auth/signup', 'AuthController:postSignup');

$app->get('/auth/signin', 'AuthController:getSignin')->setName('auth.signin');
$app->post('/auth/signin', 'AuthController:postSignin');

$app->get('/auth/password/forgot', 'AuthController:forgotPassword')->setName('auth.password.forgot');
$app->post('/auth/password/forgot', 'AuthController:forgotPassword');

})->add(new GuestMiddleware($container));


$app->group('', function ()  use ($app) {
	
$app->get('/auth/password/change', 'AuthController:getChangePassword')->setName('auth.password.change');
$app->post('/auth/password/change', 'AuthController:postChangePassword');


$app->get('/auth/signout', 'AuthController:getSignout')->setName('auth.signout');

})->add(new AuthMiddleware($container));
