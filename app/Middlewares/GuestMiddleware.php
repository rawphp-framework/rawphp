<?php 

namespace App\Middlewares;

class GuestMiddleware extends Middleware{
	
	/**
	* If user is already logged in, they cant see pages protected by this middleware
	* @return $response
	*/
	public function __invoke($request, $response, $next){
		
		if($this->container->auth->check()){
			
			//redirect them to home page
			return $response->withRedirect($this->container->router->pathFor('home'));
		} 
		 
		//the below must be done in all middlewares
		$response = $next($request, $response);
		
		return $response;
	}
}