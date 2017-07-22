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


class Post extends Model
{
	
	//optional: define table name if different from 'posts'
	protected $table = 'posts';
	
	protected $fillable = [
		'id',
		'title',
		'body',
		'user_id',
	];

	/**
	* Every post belongs to a user. 
	* That is, every post has a user_id column which refers to the id of the user
	* So let's define the relationship below
	*/
	public function user(){
		return $this->belongsTo('App\Models\User');
	}

	
	
	
	
}