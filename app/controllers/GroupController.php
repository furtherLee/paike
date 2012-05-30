<?php

class GroupController extends Controller{
  public function show($id){
    $group = new Group($id);
    $group->loadMembers();
    $user = $this->getUser();
    $this->render("/Group/show", array(
					    'user' => $user,
					    'title' => "小组: ".$group->getName(),
					    'group' => $group,
					    'isLeader' => $user->getId() == $group->getLeader(),
					    'isMember' => $group->isMember($user->getId()),
					    'members' => $group->genMetaMembers(),
					    'works' => $group->genWorks()
					    ));
  }

  public function index(){
  }

  public function search(){
    $user = $this->getUser();
    $key = fRequest::get("search-key");
    $groups = fRecordSet::build(
				'Group',
				array("name~" => $key)
				);
    $this->render("/Group/search", array(
					 'title' => "搜索结果",
					 'user' => $user,
					 'groups' => $groups
					 ));
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