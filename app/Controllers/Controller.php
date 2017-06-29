<?php 

namespace App\Controllers;

class Controller{
	
	protected $container;
	
	public function __construct($container){
		
		$this->container = $container;
	}
	
	
	
	public function __get($property){
		//this method makes it easy to do $this->view instead of $this->container->view
		if($this->container->{$property}){
			return $this->container->{$property};
		}
	}
}