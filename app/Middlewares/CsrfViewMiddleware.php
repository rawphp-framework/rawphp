<?php 

namespace App\Middlewares;

class CsrfViewMiddleware extends Middleware{
	
	/**
	* Get the CSRF token, pass it to the view then move unto the next middleware
	* this can be access from the view with {{ csrf.field | raw }}
	* @return $response
	*/
	public function __invoke($request, $response, $next){
		
		 $this->container->view->getEnvironment()->addGlobal('csrf',[
		 'field' => '
		 		<input type="hidden" name="'.$this->container->csrf->getTokenNameKey().'"
		 		value ="'.$this->container->csrf->getTokenName().'">
		 		<input type="hidden" name="'.$this->container->csrf->getTokenValueKey().'" value="'.$this->container->csrf->getTokenValue().'">
		 ',
		 ]);
		 
		 //this can be access from the view with {{ csrf.field | raw }}
		 
		 
		//the below must be done in all middlewares
		$response = $next($request, $response);
		
		return $response;
	}
}