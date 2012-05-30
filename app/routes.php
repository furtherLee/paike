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

$app->post('/group/:id/del/', function($id){
    $controller = new GroupController();
    $controller->delete($id);
    echo "delete a group";
  });

$app->post('/group/:id/join/', function($id){
    $controller = new GroupController();
    $controller->join($id);
    echo "join a group";
  });

$app->get('/group/:id/schedule/', function($id){
    $controller = new GroupController();
    $controller->genSchedule($id);
    echo "generate a schedule";
  });

$app->post('/schedule/:uid/:jid/', function($uid, $jid){
    $controller = new JobController();
    $controller->addRel($uid, $jid);
    echo "edit a schedule for $uid on the job $sid";
  });



$app->get('/schedule/:id/', function($id){
    $controller = new ScheduleController();
    $controller->showSchedule($id);
  });

$app->get('/search/', function(){
    $controller = new GroupController();
    $controller->search();
  });

$app->run();
