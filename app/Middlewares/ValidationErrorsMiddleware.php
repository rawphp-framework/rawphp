<?php 

namespace App\Middlewares;

class ValidationErrorsMiddleware extends Middleware{
	
	/**
	* Get the validation errors, pass it to the view then move unto the next middleware
	* 
	* @return $response
	*/
	public function __invoke($request, $response, $next){
		if (isset($_SESSION['errors'])) {
			$this->container->view->getEnvironment()->addGlobal('errors', $_SESSION['errors']);
			
		}
		
		unset($_SESSION['errors']);
		
		//the below must be done in all middlewares
		$response = $next($request, $response);
		
		return $response;
	}
}