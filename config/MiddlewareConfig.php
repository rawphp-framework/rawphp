<?php 


/**
* Load Middlewares
* if you want a short hand name for any of the middlewares, define it in config/ContainerConfig.php
*/
$app->add(new \App\Middlewares\ValidationErrorsMiddleware($container));
$app->add(new \App\Middlewares\OldInputMiddleware($container));
$app->add(new \App\Middlewares\CsrfViewMiddleware($container));
//$app->add(new \App\Middlewares\AuthMiddleware($container));
//turn on csrf
$app->add($container->csrf);

