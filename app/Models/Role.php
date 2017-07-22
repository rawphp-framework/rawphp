<?php 


namespace App\Models;

 
/**
* Extend eloquent model class 
* read more https://laravel.com/docs/5.1/eloquent
*/
use Illuminate\Database\Eloquent\Model;
/**
* To enable CakePHP's ORM, uncomment the line below
* Read more => https://book.cakephp.org/3.0/en/orm.html 
*/

//use Cake\ORM\TableRegistry; 


class Role extends Model
{
	
	//optional: define table name if different from 'roles'
	protected $table = 'roles'; 
	
	// timpestaps have to be set to false because roles table does not have created_at and updated at
	//if this is not done, laravel will throw an error similar to this: Unknown column 'updated_at'
	public $timestamps = false;
	protected $fillable = [
		'id',
		'name',
		'description',
	];

// Every role has many users
	public function user(){
		return $this->hasMany('App\Models\User');
	}
	
	
}