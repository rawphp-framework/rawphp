<?php 

namespace App\Middlewares;

class GuestMiddleware extends Middleware{
	
	/**
	* Get the CSRF token, pass it to the view then move unto the next middleware
	* this can be access from the view with {{ csrf.field | raw }}
	* @return $response
	*/
	public function __invoke($request, $response, $next){
		
		if($this->container->auth->check()){
			
			//redirect them to login page
			return $response->withRedirect($this->container->router->pathFor('home'));
		} 
		 //this can be access from the view with {{ csrf.field | raw }}
		 
		 
		//the below must be done in all middlewares
		$response = $next($request, $response);
		
		return $response;
	}
}