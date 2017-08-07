<?php

namespace App\Controllers;
use App\Controllers\Controller;
use App\Models\User;
use Respect\Validation\Validator as v; 
use App\Models\Post;

class PostsController extends Controller{
	
	/**
	* List all users
	* 
	* @return
	*/
	public function index($request, $response,  $args){

        //find all posts
        if(isset($args['user_id'])){
            $posts = Post::where('user_id',$args['user_id'] )->get();
             //get the user's details
	          $user = User::find($args['user_id']);

              return $this->view->render($response,'posts/index.twig', ['posts'=>$posts, 'user'=>$user]);
        }else{
            $posts = Post::all();
            return $this->view->render($response,'posts/index.twig', ['posts'=>$posts]);
        }

	}



	/**
	* Display a post
	* 
	* @return
	*/
	public function view($request, $response, $args){
	
	    $post = Post::find( $args['id']);
		
		return $this->view->render($response,'posts/view.twig', ['post'=>$post]);
		
	}


	
	/**
	* Create A New Post
	* 
	* @return
	*/
	public function add($request, $response,  $args){
	
        if($request->isPost()){
           
            /**
            * validate input before submission
            * @var 
            * 
            */ 
            $validation = $this->validator->validate($request, [
                'title' => v::notEmpty(),	
                'body' => v::notEmpty(),	
            ]);


		//redirect if validation fails
		if($validation->failed()){
			$this->flash->addMessage('error', 'Validation Failed!'); 
		
			return $response->withRedirect($this->router->pathFor('posts/add.twig')); 
		}
		
            $post = Post::create([
                'title' => $request->getParam('title'),
                'body' => $request->getParam('body'),
                'user_id' => $this->auth->user()->id,
            ]);

                $this->flash->addMessage('success', 'Post Added Successfully');
                //redirect to eg. posts/view/8 
                return $response->withRedirect($this->router->pathFor('posts.view', ['id'=>$post->id]));
           
        }
		return $this->view->render($response,'posts/add.twig');
		
	}

    
	
	/**
	* Edit post
	* 
	* @return
	*/
	public function edit($request, $response,  $args){
	
              //find the post
            $post = Post::find( $args['id']);

			//only admin and the person that created the post can edit or delete it.
			if(($this->auth->user()->id != $post->user_id) AND ($this->auth->user()->role_id > 2 ) ){
                
			$this->flash->addMessage('error', 'You are not allowed to perform this action!'); 
		
			return $this->view->render($response,'posts/edit.twig', ['post'=>$post]);

			}

        //if form was submitted
        if($request->isPost()){
        
         $validation = $this->validator->validate($request, [
                'title' => v::notEmpty(),	
                'body' => v::notEmpty(),	
            ]);
        //redirect if validation fails
		if($validation->failed()){
			$this->flash->addMessage('error', 'Validation Failed!'); 
		
			return $this->view->render($response,'posts/edit.twig', ['post'=>$post]);
		}
		
            //save Data
            $post =  Post::where('id', $args['id'])
                            ->update([
                                'title' => $request->getParam('title'),
                                'body' => $request->getParam('body')
                                ]);
            
            if($post){
                $this->flash->addMessage('success', 'Post Updated Successfully');
                //redirect to eg. posts/view/8 
                return $response->withRedirect($this->router->pathFor('posts.view', ['id'=>$args['id']]));
            }
        }
        
	    
		return $this->view->render($response,'posts/edit.twig', ['post'=>$post]);
		
	}


/**
	* Delete a post
	* 
	* @return
	*/
	public function delete($request, $response,  $args){
		$user = Post::find( $args['id']);
		
		//only owner and admin can delete
		if(($this->auth->user()->id != $post->user_id) AND ($this->auth->user()->role_id > 2 ) ){
                
			$this->flash->addMessage('error', 'You are not allowed to perform this action!'); 
		
			return $this->view->render($response,'posts/view.twig', ['post'=>$post]);

			}
			
			
		if($user->delete()){
			$this->flash->addMessage('success', 'Post Deleted Successfully');
			return $response->withRedirect($this->router->pathFor('posts.index', ['user_id'=>$this->auth->user()->id]));
		}
	}

}