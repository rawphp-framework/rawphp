<?php

namespace App\Controllers\Auth;
use App\Controllers\Controller;
use App\Models\User;
use Respect\Validation\Validator as v; 

/**
* Handle change of password 
*/
class PasswordController extends Controller{
	
	
	
	/**
	* 
	* Change Password
	* First confirm that old password matches password in database
	* 
	* @return
	*/
	public function changePassword($request , $response){
			

			if($request->isPost()){
					/**
						* validate input before submission
						* @var 
						* 
						*/ 
						$validation = $this->validator->validate($request, [	
							'old_password' => v::notEmpty()->matchesPassword($this->auth->user()->password),	//from the custom validation rule defined in App\Validation\Rules and Exception
							'new_password1' => v::notEmpty()->fieldsMatch($request->getParam('new_password2'), $request->getParam('new_password1')),	
							'new_password2' => v::notEmpty(),
						]);
						
						//redirect if validation fails
						if($validation->failed()){
							$this->flash->addMessage('error', 'Password Change Attempt Failed'); //You can also use error, info, warning
						
							return $response->withRedirect($this->router->pathFor('auth.password.change')); 
						}

						$this->auth->user()->setPassword($request->getParam('new_password1'));
					
						$this->flash->addMessage('success', 'Password change successful');
						
						
						return $response->withRedirect($this->router->pathFor('home'));
		
			}
	
		return $this->view->render($response, 'auth/password/change.twig');	
	
	}

	/**
	* Method to reset password for users who are logged out
	*/
	public function resetPassword(){
		// There are many ways to do this, but the way we will use here is
		// 1. Generate Random Password
		// 2. Encrypt it and update the database
		// 2. Send email containing the new password to the user
	}
}