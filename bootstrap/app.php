<?php 
use Respect\Validation\Validator as v;
use Slim\Http\Request; 
use Slim\Http\Response; 
use Slim\Http\UploadedFile;

session_start();

require_once __DIR__. '/../vendor/autoload.php';

//loading database settings
require_once __DIR__. '/../config/DatabaseConfig.php';


//using Twig
$container = $app->getContainer();



//load ORM 
require_once __DIR__. '/../config/ORMConfig.php';

//load View 
require_once __DIR__. '/../config/ViewConfig.php';

//load controllers
//You have to update the file for every new controller created 
require_once __DIR__. '/../config/ControllerConfig.php';

//load container settings
//That is where you define short hands for your middlerwares
require_once __DIR__. '/../config/ContainerConfig.php';

//load middlewares
//You have to update this file for every new middleware added to this project
require __DIR__. '/../config/MiddlewareConfig.php';



/**
* Load validation rules
*/
v::with('App\\Validation\\Rules\\');

//load routes
require __DIR__. '/../routes/routes.php';
