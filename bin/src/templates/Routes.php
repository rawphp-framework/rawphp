<?php 
//samples routes
$app->get('/samples/index', 'SamplesController:index')->setName('samples.index'); //Optional user_id parameter
$app->map(['POST', 'GET'], '/samples/add/', 'SamplesController:add')->setName('samples.add');
$app->map(['POST', 'GET'], '/samples/edit/{id}', 'SamplesController:edit')->setName('samples.edit');
$app->get('/samples/view/{id}', 'SamplesController:view')->setName('samples.view');
$app->get('/samples/delete/{id}', 'SamplesController:delete')->setName('samples.delete');

