<?php
$app = new Slim();

$app->get('/', function(){
    echo "homepage";
  });

$app->get('/login/', function(){
    $controller = new UserController();
    $controller->showLoginPage();
  });

$app->get('/register/', function(){
    $controller = new UserController();
    $controller->showRegisterPage();
  });

$app->run();
