<?php

namespace App\Controllers;
use Slim\Views\Twig as View;
use App\Models\User;

class HomeController extends Controller{
	

	public function index($request, $response){
		/**
	* Get a request
	* var_dump($request->getParam('name'));
	*/
	
	/**
	* 
	* 
If you have errors with var_dump($user); remember to uncomment this line in your php.ini file: 
extension=php_pdo_mysql.dll
	* 
	*/
	//$user = $this->db->table('users')->find(1);
	
	
	return $this->view->render($response,'home.twig');
	}
	
}