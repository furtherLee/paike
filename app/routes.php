<?php
$app = new Slim();

$app->get('/', function(){
    $controller = new JokeController();
    $controller->index();
  });

$app->get('/jokes', function(){
    $controller = new JokeController();
    $controller->index();
  });

$app->get('/joke/:id', function($id){
    $controller = new JokeController();
    $controller->show($id);
  });

$app->post('/jokes', function(){
    $controller = new JokeController();
    $controller->create();
  });

$app->post('/joke/:id/up', function($id){
    $controller = new JokeController();
    $controller->up($id);
  });

$app->post('/joke/:id/down', function($id){
    $controller = new JokeController();
    $controller->down($id);
  });

$app->run();
