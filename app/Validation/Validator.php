<?php

namespace App\Validation;
use Respect\Validation\Validator as Respect;
use Respect\Validation\Exceptions\NestedValidationException; 

/**
* This Package from Respect/Validation on Github
* Installed with composer require respect/validation
* @url https://github.com/Respect/Validation
*/

class Validator
{
	public function validate($request, array $rules){
		
		foreach($rules as $field => $rule){
			try{
				$rule->setName(ucfirst($field))->assert($request->getParam($field));
			}catch(NestedValidationException $e){
				$this->errors[$field] = $e->getMessages();
			}
		}
		
		/**
		* 
		* Put the errors in session
		* Then retrive it from App\Middleware\ValidationErrorsMiddleware.php and attach it to the view
		*/ 
		$_SESSION['errors'] = $this->errors;
		return $this;
	}
	
	/**
	* Check if validation failed
	*/
	public function failed(){
		return !empty($this->errors);
	}
	
	
	
}