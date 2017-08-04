<?php

namespace Make;

class Make{

	/**
	 * Receives a string name of a controller and creates the file
	 *
	 * @param string $controllerName
	 * @return string string
	 */
	public static function makeController( $controllerName ){
		//controller name must be camelcased and plural
		//model file name must be CamelCased and singular eg. Book 
		
				//model file name must be CamelCased and singular eg. Book 
		
		//get a sample copy of the text to be written to the controller config 
		$controllerFile = file_get_contents (__DIR__ .'/templates/Controllers.php');
		
		$controllerTemplate = __DIR__ . '/../../app/Controllers/'.$controllerName.'.php';
		$handle = fopen($controllerTemplate,"x+") or die('Cannot open file:  '.$controllerTemplate); 
		
		
		
		if($controllerFile){
				$writeToFile = fwrite($handle, $controllerFile);
		        
		        
				if($writeToFile){
					fclose($handle);
					
					//update Controller Config
					//get a sample copy of the text to be written to the controller config 
		$controllerConfigTemplate = file_get_contents (__DIR__ .'/templates/ControllerConfig.php');
		 $controllerConfigTemplate = str_replace('SamplesController',$controllerName, $controllerConfigTemplate);
		 $controllerConfigTemplate = str_replace('<?php','', $controllerConfigTemplate);
		 
		       $controllerConfigFile = __DIR__ . '/../../config/ControllerConfig.php';
		      
				$controllerConfigHandle = fopen($controllerConfigFile,"a") or die('Cannot open file:  '.$controllerConfigFile); 
		
				fwrite($controllerConfigHandle, "\n". $controllerConfigTemplate);
				fclose($controllerConfigHandle);


//update routes file
					//get a sample copy of the text to be written to the file config 
		$routesTemplate = file_get_contents (__DIR__ .'/templates/Routes.php');
		 $routesTemplate = str_replace('SamplesController',$controllerName, $routesTemplate);
		 
		 //remove the Controller in the controller name 
		 //so SamplesController becomes Samples
		 $databaseTableName = str_replace("Controller", "", $controllerName);
		 //convert to lower case 
		 $databaseTableName = strtolower($databaseTableName);
		 
		 //replace all occurences of samples 
		 $routesTemplate = str_replace('samples',$databaseTableName, $routesTemplate);
		 
		 
		 //remove the <?php opening tag in the template file 
		 $routesTemplate = str_replace('<?php','', $routesTemplate);
		 
		 //find the routes file
		       $routesFile = __DIR__ . '/../../routes/routes.php';
		      
				$routesHandle = fopen($routesFile,"a") or die('Cannot open file:  '.$routesFile); 
		
		//append to it
				fwrite($routesHandle, "\n". $routesTemplate);
				fclose($routesHandle);



					
					return true;
				}
				
		}
		
		return false;	
	}
	
	/**
	* Makes four views namely add,edit,view,index
	* @param undefined $viewName
	* 
	* @return
	*/
	public static function makeView( $viewName ){
		
		//we just need to copy the view template to the resources/views/ folder
		$src = __DIR__ .'/templates/views';  // source folder 
		mkdir(__DIR__ . '/../../resources/views/'.$viewName); //create the folder first
		$dest = __DIR__ . '/../../resources/views/'.$viewName;   // destination folder        

		copy($src.'/add.twig', $dest.'/add.twig'); //copy all file 
		copy($src.'/edit.twig', $dest.'/edit.twig'); //copy all file 
		copy($src.'/view.twig', $dest.'/view.twig'); //copy all file 
		$copyViews = copy($src.'/index.twig', $dest.'/index.twig'); //copy all file 
		if($copyViews){
			return true;
			}
			
		return false;
	}
	
	/**
	* Makes a single model file
	* @param undefined $ModelName
	* 
	* @return
	*/
	public static function makeModel( $modelName ){
		//model file name must be CamelCased and singular eg. Book 
		
		//get a sample copy of the model 
		$modelFile = file_get_contents (__DIR__ .'/templates/Models.php');
		
		$my_file = __DIR__ . '/../../app/Models/'.$modelName.'.php';
		$handle = fopen($my_file,"x+") or die('Cannot open file:  '.$my_file); 
		
		
		
		if($modelFile){
				$writeToFile = fwrite($handle, $modelFile);
		
				if($writeToFile){
					clearstatcache(); //flush the file cache
					fclose($handle);
					return true;
				}
				
		}
		
		return false;
		
	}
	


}
