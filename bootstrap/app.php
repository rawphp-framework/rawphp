<?php 

use Respect\Validation\Validator as v;

session_start();

require __DIR__. '/../vendor/autoload.php';

//loading database settings
require __DIR__. '/../config/DatabaseConfig.php';


//using Twig
$container = $app->getContainer();



//load ORM 
require __DIR__. '/../config/ORMConfig.php';

//load View 
require __DIR__. '/../config/ViewConfig.php';

//load controllers
//You have to update the file for every new controller created 
require __DIR__. '/../config/ControllerConfig.php';

//load middlewares
//You have to update this file for every new middleware added to this project
require __DIR__. '/../config/MiddlewareConfig.php';



/**
* Load validation rules
*/
v::with('App\\Validation\\Rules\\');

//load routes
require __DIR__. '/../app/routes.php';
