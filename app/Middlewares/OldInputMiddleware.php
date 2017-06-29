<?php 

namespace App\Middlewares;

class OldInputMiddleware extends Middleware{
	
	/**
	* Get the old input details, pass it to the view then move unto the next middleware
	* 
	* @return
	*/
	public function __invoke($request, $response, $next){
		if (isset($_SESSION['old'])) {
			$this->container->view->getEnvironment()->addGlobal('old', $_SESSION['old']);
			
		}
		
		$_SESSION['old'] = $request->getParams();
		
		$response = $next($request, $response);
		
		return $response;
	}
}