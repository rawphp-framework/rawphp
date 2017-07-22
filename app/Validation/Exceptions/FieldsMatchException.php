<?php 


namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class FieldsMatchException extends ValidationException{
	
	public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'The two fields need to match' 
        ]
    ];
}