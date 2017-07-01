<?php 

namespace App\Auth;
use App\Models\User;


class Auth{
	
	public function user(){
		
		if(isset($_SESSION['user'])){
			return User::find($_SESSION['user']);
		}
		return false;
	}
	/**
	* Check if user is signed in
	* 
	* @return
	*/
	public function check(){
		
		return isset($_SESSION['user']); //this will return true or false depending on if user is signed in or not
	}
	/**
	* Attempt to sign the user in by first checking if the user exists
	* Then check if the plain text password supplied matches the hashed password
	* @param string $email
	* @param string $password
	* 
	* @return
	*/
	public function attempt($email, $password){
		$user = User::where('email', $email)->first();
		
		if(!$user){
			return false;
		}
		
		if(password_verify($password, $user->password)){
			$_SESSION['user'] = $user->id; //or $user->id
			return true;
		}
		
		return false;
	}
	
	/**
	* Log User Out by deleting session
	*/
	public function logout(){
		unset($_SESSION['user']);
	}
	
}