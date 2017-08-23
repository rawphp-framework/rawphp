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
		 
		 if (false === $request->getAttribute('csrf_status')) {
    			
					// successfully passed CSRF check

				// display suitable error here
				 $route = $request->getAttribute('route');

					// return NotFound for non existent route
					if (empty($route->getName())) {
						//throw new NotFoundException($request, $response);
						return $response->write("CSRF error: return to the previous page, refresh it, then retry"); 
						
					}

					$name = $route->getName();
					$groups = $route->getGroups();
					$methods = $route->getMethods();
					$arguments = $route->getArguments();

					
			return $response->withRedirect($this->container->router->pathFor($name));


			
			} else {
			
			}
		 
		//the below must be done in all middlewares
		$response = $next($request, $response);
		
		return $response;
	}
}