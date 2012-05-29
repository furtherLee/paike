<?php

class GroupController extends Controller{
  public function show($id){
  }

  public function index(){
  }

  public function search(){
  }

  public function newGroup(){
  }

  public function showNewGroup(){
    fAthorization::requireLoggedIn();
    $this->render("Group/create", array(
			    "title" => "新建小组"
			    ));
  }

  public function edit($id){
  }

  public function delete($id){
  }

  public function join($id){
  }
  
  public function genSchedule($id){
  }

}