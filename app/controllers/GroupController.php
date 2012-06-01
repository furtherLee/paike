<?php

class GroupController extends Controller{
  public function show($id){
    $group = new Group($id);
    $group->loadMembers();
    $user = $this->getUser();
    $group->genWorks();
    $this->render("/Group/show", array(
				       'leader' => $group->genLeader(),
				       'user' => $user,
				       'title' => "小组: ".$group->getName(),
				       'group' => $group,
				       'isLeader' => $user->getId() == $group->getLeader(),
				       'isMember' => $group->isMember($user->getId()),
				       'members' => $group->genMembers(),
				       'works' => $group->genWorks(),
				       'schedules' => $group->genSchedules()
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
    $group->setPhoto(fRequest::get("photo"));
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
    $user = $this->getUser();
    try{
      $member = new Member(array('uid' => $user->getId(), 'gid' => $id));
    }
    catch(fNotFoundException $e){
      $member = new Member();
    }
    $member->setUid($user->getId());
    $member->setGid($id);
    $member->store();
  }
  
  public function genSchedule($id){
    fAuthorization::requireLoggedIn();
    $group = new Group($id);
    $works = $group->genMetaWorks();
    $assign = array();
    foreach($works as $work){
      $assian[$work['id']] = array();
      $str = fRequest::get($work['id']+"");
      $str = trim($str);
      $members = preg_split("/ /", $str);
      if(count($members) == 0 || $str=="")
	$assign[$work['id']] = array();
      else{
	$assign[$work['id']] = $members;
      }
    }
    
    $schedule = $this->createSchedule($assign, $id);
    
    $this->ajaxReturn(array('result' => $assign, 'scheduleID' => $schedule->getId(), 'status' => 'ok'));
  }

  private function createSchedule($map, $gid){
    $schedule = new Schedule();
    $schedule->setGid($gid);
    $schedule->setName(fRequest::get('schedule-name'));
    $schedule->store();
    foreach($map as $key => $value)
      foreach($value as $user){
	$assign = new Assign();
	$assign->setSid($schedule->getId());
	$assign->setWid($key);
	$assign->setUid($user);
	$assign->store();
      }
    return $schedule;
  }

  public function retriveMetaInfo($id){
    $group = new Group($id);
    $works = $group->genMetaWorks();
    $members = $group->genMetaMembers();
    $map = $group->genMap();
    $this->ajaxReturn(array(
			    'works' => $works,
			    'members' => $members,
			    'map' => $map
			    ));
  }

}