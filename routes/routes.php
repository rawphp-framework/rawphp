<?php
 
 //always import middlewares you wish to use
use App\Middlewares\AuthMiddleware;
use App\Middlewares\GuestMiddleware;
use App\Controllers;
 /*
$app->get('/', function($request, $response){
		//return a text
		//return 'home';
		
		//return a view
		return $this->view->render($response, 'home.twig');
	}); */
	

//home page
$app->get('/', 'HomeController:index')->setName('home');
//about page
$app->get('/about', 'HomeController:about' )->setName('about');




//GuestMiddleware group
$app->group('', function ()  use ($app) {
$app->get('/auth/signup', 'AuthController:getSignup')->setName('auth.signup');
$app->post('/auth/signup', 'AuthController:postSignup');

//Handle POST and GET requests for signin, instead of doing it seperately as above
$app->map(['POST','GET'], '/auth/signin', 'AuthController:signin')->setName('auth.signin');

$app->map(['POST','GET'],'/auth/password/forgot', 'AuthController:forgotPassword')->setName('auth.password.forgot');

})->add(new GuestMiddleware($container));




//AuthMiddleware group
$app->group('', function ()  use ($app) {

//change password
$app->map(['POST', 'GET'], '/auth/password/change', 'PasswordController:changePassword')->setName('auth.password.change');

$app->map(['POST', 'GET'], '/auth/password/reset', 'PasswordController:resetPassword')->setName('auth.password.reset');

$app->get('/auth/signout', 'AuthController:getSignout')->setName('auth.signout');


//roles
$app->get('/roles/view/{id}', 'RolesController:view')->setName('roles.view');
$app->get('/roles/index', 'RolesController:index')->setName('roles.index');
$app->map(['POST', 'GET'],'/roles/add', 'RolesController:add')->setName('roles.add');
$app->map(['POST', 'GET'],'/roles/edit/{id}', 'RolesController:edit')->setName('roles.edit');
$app->get('/roles/delete/{id}', 'RolesController:delete')->setName('roles.delete');

//users
$app->get('/users/view/{id}', 'UsersController:view')->setName('users.view');
$app->get('/users/index', 'UsersController:index')->setName('users.index');
$app->map(['POST', 'GET'],'/users/edit/{id}', 'UsersController:edit')->setName('users.edit');
$app->get('/users/delete/{id}', 'UsersController:delete')->setName('users.delete');


//post routes
$app->get('/posts/index[/{user_id}]', 'PostsController:index')->setName('posts.index'); //Optional user_id parameter
$app->map(['POST', 'GET'], '/posts/add/', 'PostsController:add')->setName('posts.add');
$app->map(['POST', 'GET'], '/posts/edit/{id}', 'PostsController:edit')->setName('posts.edit');
$app->get('/posts/view/{id}', 'PostsController:view')->setName('posts.view');
$app->get('/posts/delete/{id}', 'PostsController:delete')->setName('posts.delete');




})->add(new AuthMiddleware($container));
