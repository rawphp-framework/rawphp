<?php

namespace App\Controllers;
use App\Controllers\Controller;
use App\Models\User;
use Respect\Validation\Validator as v; 

class UsersController extends Controller{
	
	/**
	* List all users
	* 
	* @return
	*/
	public function index($request, $response,  $args){
	    $users = User::all();
		return $this->view->render($response,'users/index.twig', ['users'=>$users]);
		
	}



	/**
	* Display sign in page
	* 
	* @return
	*/
	public function view($request, $response, $args){
	
	    $user = User::find( $args['id']);
		
		return $this->view->render($response,'users/view.twig', ['user'=>$user]);
		
	}


	
	/**
	* Display sign in page
	* 
	* @return
	*/
	public function edit($request, $response,  $args){
	
	    $user = User::find( $args['id']);

		//only admin and the person that created the post can edit or delete this profile.
			if(($this->auth->user()->id != $args['id']) AND ($this->auth->user()->role_id > 2) ){

				$this->flash->addMessage('error', 'You are not allowed to perform this action!'); 		
				return $this->view->render($response,'users/view.twig', ['id'=>$args['id']]);

			}

		if($request->isPost()){
						/**
				* validate input before submission
				* @var 
				* 
				*/ 
				$validation = $this->validator->validate($request, [
					'email' => v::noWhitespace()->notEmpty(),	
					'first_name' => v::notEmpty(),	
					'last_name' => v::notEmpty(),	
					'password' => v::notEmpty(),	
					'gender' => v::notEmpty(),	
				]);
				

				//redirect if validation fails
				if($validation->failed()){
					$this->flash->addMessage('error', 'Signup Failed!'); //You can also use error, info, warning
				
					return $response->withRedirect($this->router->pathFor('auth.signup')); 
				}


				 //update Data
            $user =  User::where('id', $args['id'])
                            ->update([
                                'email' => $request->getParam('email'),
                                'first_name' => $request->getParam('first_name'),
                                'last_name' => $request->getParam('last_name'),
                                'password' => $request->getParam('password'),
                                'gender' => $request->getParam('gender'),
                                'phone' => $request->getParam('phone'),
                                ]);
				
		}
		return $this->view->render($response,'users/edit.twig', ['user'=>$user]);
		
	}

/**
	* Delete a user
	* 
	* @return
	*/
	public function delete($request, $response,  $args){
			$user = User::find( $args['id']);
			
		//only owner and admin can delete 
		if(($this->auth->user()->id != $args['id']) AND ($this->auth->user()->role_id > 2) ){

				$this->flash->addMessage('error', 'You are not allowed to perform this action!'); 		
				return $this->view->render($response,'users/view.twig', ['id'=>$args['id']]);

			}
			
	
		if($user->delete()){
			$this->flash->addMessage('success', 'User Account Deleted Successfully');
			return $response->withRedirect($this->router->pathFor('home'));
		}

		
		
	}

}