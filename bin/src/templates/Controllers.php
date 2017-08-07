<?php

namespace App\Controllers;
use App\Controllers\Controller;
use App\Models\User;
use Respect\Validation\Validator as v; 
use App\Models\Book;

class BooksController extends Controller{
	
	/**
	* List all books
	* 
	* @return
	*/
	public function index($request, $response,  $args){

        //find all books by the user with this ID
        if(isset($args['user_id'])){
            $books = Book::where('user_id',$args['user_id'] )->get();
             //get the user's details
	          $user = User::find($args['user_id']);

              return $this->view->render($response,'books/index.twig', ['books'=>$books, 'user'=>$user]);
        }else{
            $books = Book::all();
            return $this->view->render($response,'books/index.twig', ['books'=>$books]);
        }

	}



	/**
	* Display a book
	* 
	* @return
	*/
	public function view($request, $response, $args){
	
	    $book = Book::find( $args['id']);
		
		return $this->view->render($response,'books/view.twig', ['book'=>$book]);
		
	}


	
	/**
	* Create A New Book
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
		
			return $response->withRedirect($this->router->pathFor('books/add.twig')); 
		}
		
            $book = Book::create([
                'title' => $request->getParam('title'),
                'body' => $request->getParam('body'),
                'user_id' => $this->auth->user()->id,
            ]);

                $this->flash->addMessage('success', 'Book Added Successfully');
                //redirect to eg. books/view/8 
                return $response->withRedirect($this->router->pathFor('books.view', ['id'=>$book->id]));
           
        }
		return $this->view->render($response,'books/add.twig');
		
	}

    
	
	/**
	* Edit book
	* 
	* @return
	*/
	public function edit($request, $response,  $args){
	
              //find the book
            $book = Book::find( $args['id']);

			//only admin and the person that created the book can edit or delete it.
			if(($this->auth->user()->id != $book->user_id) OR ($this->auth->user()->role_id < 3) ){
                
			$this->flash->addMessage('error', 'You are not allowed to perform this action!'); 
		
			return $this->view->render($response,'books/edit.twig', ['book'=>$book]);

			}

        //if form was submitted
        if($request->isBook()){
        
         $validation = $this->validator->validate($request, [
                'title' => v::notEmpty(),	
                'body' => v::notEmpty(),	
            ]);
        //redirect if validation fails
		if($validation->failed()){
			$this->flash->addMessage('error', 'Validation Failed!'); 
		
			return $this->view->render($response,'books/edit.twig', ['book'=>$book]);
		}
		
            //save Data
            $book =  Book::where('id', $args['id'])
                            ->update([
                                'title' => $request->getParam('title'),
                                'body' => $request->getParam('body')
                                ]);
            
            if($book){
                $this->flash->addMessage('success', 'Book Updated Successfully');
                //redirect to eg. books/view/8 
                return $response->withRedirect($this->router->pathFor('books.view', ['id'=>$args['id']]));
            }
        }
        
	    
		return $this->view->render($response,'books/edit.twig', ['book'=>$book]);
		
	}


/**
	* Delete a book
	* 
	* @return
	*/
	public function delete($request, $response,  $args){
		$book = Book::find( $args['id']);
		if($user->delete()){
			$this->flash->addMessage('success', 'Book Deleted Successfully');
			return $response->withRedirect($this->router->pathFor('books.index'));
		}
	}

}