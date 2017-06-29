<?php 


namespace App\Models;

//extend eloquent model class 
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	
	//optional: define table name if different from 'users'
	protected $table = 'users';
	
	protected $fillable = [
		'first_name',
		'last_name',
		'email',
		'password'
	];
	
}