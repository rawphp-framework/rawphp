<?php

namespace App\Controllers\Auth;
use App\Controllers\Controller;
use App\Models\User;
use Respect\Validation\Validator as v; 

class AuthController extends Controller{
	
	/**
	* Sign user out
	* 
	* 
	*/
	public function getSignout(){
		
		$this->auth->logout();
		$this->flash->addMessage('success', 'Logout successful'); //You can also use error, info, warning
		
		return $response->withRedirect($this->router->pathFor('auth.signin'));
	
	}
	
	/**
	* Display sign in page
	* 
	* @return
	*/
	public function getSignin($request , $response){
	
	return $this->view->render($response,'auth/signin.twig');
	}
	
	/**
	* Display sign in page
	* 
	* @return
	*/
	public function postSignin($request, $response){
		
		$auth = $this->auth->attempt(
			$request->getParam('email'),
			$request->getParam('password')
		);
		
		if(!$auth){
			$this->flash->addMessage('error', 'Login Failed!'); //You can also use error, info, warning
		
			return $response->withRedirect($this->router->pathFor('auth.signin'));
		};
		
		$this->flash->addMessage('success', 'Logiin successful!'); //You can also use error, info, warning
		
		return $response->withRedirect($this->router->pathFor('home'));
	}
	
	/**
	* Render Signin view
	* @param get $request
	* 
	* 
	* @return
	*/
	public function getSignup($request , $response){
	
	return $this->view->render($response,'auth/signup.twig');
	}
	
	/**
	* Sign this user up
	* @param post $request items to be saved in databse
	* 
	* @return
	*/
	
	public function postSignup($request , $response){
		
		/**
		* validate input before submission
		* @var 
		* 
		*/ 
		$validation = $this->validator->validate($request, [
			'email' => v::noWhitespace()->notEmpty(),	
			'first_name' => v::notEmpty()->alpha(),	
			'last_name' => v::notEmpty()->alpha(),	
			'password' => v::notEmpty(),	
		]);
		
		//redirect if validation fails
		if($validation->failed()){
			$this->flash->addMessage('error', 'Signup Failed'); //You can also use error, info, warning
		
			return $response->withRedirect($this->router->pathFor('auth.signup')); 
		}
		
		
		$user = User::create([
			'first_name' => $request->getParam('first_name'),
			'last_name' => $request->getParam('last_name'),
			'email' => $request->getParam('email'),
			//harsh password with PHPs inbuilt password harsher
			'password' => password_hash($request->getParam('email'), PASSWORD_DEFAULT) //PASSWORD_BCRYPT is also available
		]);
		
		$this->flash->addMessage('success', 'Signup successful'); //You can also use error, info, warning
		
		
		//sign user in after they've signed up
		$this->auth->attempt($request->getParam('email'), $request->getParam('password')); //using $user->password will not work because the password is already hashed.
		
		return $response->withRedirect($this->router->pathFor('home'));
		
	}
}