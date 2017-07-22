<?php

namespace App\Validation\Rules;

use App\Models\User;
use Respect\Validation\Rules\AbstractRule;

/**
* Checks if the two fields match
*
*/
class FieldsMatch extends AbstractRule{
	
	protected $field2;
    public function __construct($field2){
		$this->field2 = $field2;
	}
	
	
	public function validate($input){
		return ($input === $this->field2 );
	}
}