<?php

namespace App\Controllers;
use App\Controllers\Controller;
use App\Models\User;
use Respect\Validation\Validator as v; 
use App\Models\Role;

class RolesController extends Controller{
	
	/**
	* List all roles
	* 
	* @return
	*/
	public function index($request, $response,  $args){

       
            $roles = Role::all();
            return $this->view->render($response,'roles/index.twig', ['roles'=>$roles]);
       

	}



	/**
	* Display roles
	* 
	* @return
	*/
	public function view($request, $response, $args){
	
	     
	    $role = Role::find( $args['id']);
	    //find all users in this role
		$users =  User::where('role_id' , $args['id'])->get();
		return $this->view->render($response,'roles/view.twig', ['role'=>$role, 'users'=> $users ]);
		
	}


	
	/**
	* Add Role
	* 
	* @return
	*/
	public function add($request, $response){
	
	if($this->auth->user()->role_id > 2 ){
                
			$this->flash->addMessage('error', 'You are not allowed to perform this action!'); 
		
			return $this->view->render($response,'/');

			}
			
        if($request->isPost()){

            /**
            * validate input before submission
            * @var 
            * 
            */ 
            $validation = $this->validator->validate($request, [
                'name' => v::notEmpty(),	
            ]);

            $role = Role::create([
                'name' => $request->getParam('name'),
                 'description' => $request->getParam('description'),
            ]);

                $this->flash->addMessage('success', 'Role Added Successfully');
                //redirect to eg. roles/view/8 
                return $response->withRedirect($this->router->pathFor('roles.view', ['id'=>$role->id]));
           
        }


		return $this->view->render($response,'roles/add.twig');
		
	}

    
	
	/**
	* Edit Role
	* 
	* @return
	*/
	public function edit($request, $response,  $args){
	
	
		$role = Role::find( $args['id']);

        //if form was submitted
        if($request->isPost()){

			  /**
            * validate input before submission
            * @var 
            * 
            */ 
            $validation = $this->validator->validate($request, [
                'name' => v::notEmpty(),	
            ]);


		//redirect if validation fails
		if($validation->failed()){
			$this->flash->addMessage('error', 'Validation Failed!'); 
		
			return $this->view->render($response,'roles/edit.twig', ['role'=>$role]);
		}
		
            //save Data
            $role =  Role::where('id', $args['id'])
                            ->update([
                                'name' => $request->getParam('name'),
                                'description' => $request->getParam('description'),
                                ]);
            
            if($role){
                $this->flash->addMessage('success', 'Role Updated Successfully');
                //redirect to eg. roles/view/8 
                return $response->withRedirect($this->router->pathFor('roles.view', ['id'=>$args['id']]));
            }
        }
        
		return $this->view->render($response,'roles/edit.twig', ['role'=>$role]);
		
	}


/**
	* Delete a role
	* 
	* @return
	*/
	public function delete($request, $response,  $args){
		$user = Role::find( $args['id']);
		//only admin can delete
		if($this->auth->user()->role_id > 2 ){
                
			$this->flash->addMessage('error', 'You are not allowed to perform this action!'); 
		
			return $this->view->render($response,'/');

			}
			
			
		if($user->delete()){
			$this->flash->addMessage('success', 'Role Deleted Successfully');
			return $response->withRedirect($this->router->pathFor('roles.index'));
		}

		
		
	}

}