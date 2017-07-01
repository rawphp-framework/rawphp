<?php 


namespace Respect\Validation\Exceptions\ValidationException;

class MatchesPasswordException extends ValidationException{
	
	public static $defaultTemplates => [
		self::MODE_DEFAULT = [
			self::STANDARD => 'Password does not match your current passwod.',
		];
	];
}