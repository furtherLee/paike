<?php
$app = new Slim();

$app->get('/', function(){
    $controller = new UserController();
    $controller->showHomePage();
  });

$app->get('/account/login/', function(){
    $controller = new UserController();
    $controller->showLoginPage();
  });

$app->post('/account/login/', function(){
    $controller = new UserController();
    $controller->login();
  });

$app->get('/account/register/', function(){
    $controller = new UserController();
    $controller->showRegisterPage();
  });

$app->post('/account/register/', function(){
    $controller = new UserController();
    $controller->register();
  });

$app->post('/account/logout/', function(){
    $controller = new UserController();
    $controller->logout();
  });

$app->get('/account/logout/', function(){
    $controller = new UserController();
    $controller->logout();
  });

$app->post('/account/:id/edit/', function($id){
    $controller = new UserController();
    $controller->edit($id);
    echo "edit a profile";
  });

$app->get('/group/:id/', function($id){
    $controller = new GroupController();
    $controller->show($id);
  });

$app->get('/group/', function(){
    $controller = new GroupController();
    $controller->showNewGroup();
  });

$app->post('/group/', function(){
    $controller = new GroupController();
    $controller->newGroup();
    echo "new group";
  });

$app->post('/group/:id/edit/', function($id){
    $controller = new GroupController();
    $controller->edit($id);
    echo "edit a group profile";
  });

$app->post('/group/:id/delete/', function($id){
    $controller = new GroupController();
    $controller->delete($id);
  });

$app->post('/group/:id/join/', function($id){
    $controller = new GroupController();
    $controller->join($id);
  });

$app->get('/group/:id/metainfo/', function($id){
    $controller = new GroupController();
    $controller->retriveMetaInfo($id);
  });

$app->post('/work/', function(){
    $controller = new WorkController();
    $controller->create();
  });

$app->post('/workers_assign/:gid/', function($gid){
    $controller = new WorkController();
    $controller->assignMyself($gid);
  });

$app->get('/schedule/:id/', function($id){
    $controller = new ScheduleController();
    $controller->showSchedule($id);
  });

$app->post('/group/:id/schedule/', function($id){
    $controller = new GroupController();
    $controller->genSchedule($id);
  }); 

$app->get('/search/', function(){
    $controller = new GroupController();
    $controller->search();
  });

$app->run();
