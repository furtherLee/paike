<?php

class GroupController extends Controller{
  public function show($id){
    $group = new Group($id);
    
    $this->render("/Group/show.html", array(
					    'user' => $this->getUser(),
					    'title' => "小组: ".$group->getName(),
					    'group' => $group
					    ));
  }

  public function index(){
  }

  public function search(){
  }

  public function newGroup(){
    fAuthorization::requireLoggedIn();
    $group = new Group();
    $group->setName(fRequest::get("name"));
    $group->setLeader(fRequest::get("leader-id"));
    $group->setDesp(fRequest::get("desp"));
    $group->store();
    $member = new Member();
    $member->setUid($this->getUser()->getId());
    $member->setGid($group->getId());
    $member->store();
    $this->ajaxReturn(array('status' => 'OK'));
  }

  public function showNewGroup(){
    fAuthorization::requireLoggedIn();
    $this->render("Group/create", array(
					"title" => "新建小组",
					"user"=> $this->getUser()
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