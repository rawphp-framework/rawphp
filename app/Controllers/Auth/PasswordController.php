<?php

namespace App\Controllers\Auth;
use App\Controllers\Controller;
use App\Models\User;
use Respect\Validation\Validator as v; 

/**
* Handle change of password 
*/
class PasswordController extends Controller{
	
	public function getChangePassword($request , $response){
		
		return $this->view->render($response, 'auth/password/change.twig');	
	}
	
	/**
	* 
	* Change Password
	* First confirm that old password matches password in database
	* 
	* @return
	*/
	public function postChangePassword(($request , $response){
			
		/**
		* validate input before submission
		* @var 
		* 
		*/ 
		$validation = $this->validator->validate($request, [	
			'old_password' => v::notEmpty()->matchesPassword($this->auth->user()->password),	//from the custom validation rule defined in App\Validation\Rules and Exception
			'password' => v::notEmpty(),	
		]);
		
		//redirect if validation fails
		if($validation->failed()){
			$this->flash->addMessage('error', 'Password Change Attempt Failed'); //You can also use error, info, warning
		
			return $response->withRedirect($this->router->pathFor('auth.password.change')); 
		}
		
		
		$this->auth->user()->setPassword($request->getParam('password'));
	
		$this->flash->addMessage('success', 'Password change successful'); //You can also use error, info, warning
		
		
		
		
		return $response->withRedirect($this->router->pathFor('home'));
		
	
	}
}