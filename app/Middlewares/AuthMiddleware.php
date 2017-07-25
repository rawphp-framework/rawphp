<?php 

namespace App\Middlewares;

class AuthMiddleware extends Middleware{
	
	/**
	* Check if user is logged and redirect appropriately
	* @param Request $request
	* @param Response $response
	* @param next $next
	* 
	* @return
	*/
	public function __invoke($request, $response, $next){
		
		if(!$this->container->auth->check()){
			$this->container->flash->addMessage('error', 'You have to be logged in to continue');
			
			//redirect user to login page
			return $response->withRedirect($this->container->router->pathFor('auth.signin'));
		} 
		 
		 
		//the below must be done in all middlewares
		$response = $next($request, $response);
		
		return $response;
	}
}