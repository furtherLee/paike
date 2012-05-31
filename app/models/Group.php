<?php
class Group extends fActiveRecord{

  var $members;
  var $works;

  protected function configure(){
    fORMRelated::overrideRelatedRecordName($this, 'User', 'Member', 'members');
  }

  public function genLeader(){
    return new User($this->getLeader());
  }

  public function loadWorks(){
    if (isset($this->works))
      return;
    $this->works = fRecordSet::build(
			     'Work',
			     array("gid=" => $this->getId())
			     );
  }

  public function genWorks(){
    if(!isset($this->works))
      $this->loadWorks();
    return $this->works;
  }

  public function genMetaWorks(){
    if(!isset($this->works))
      $this->loadWorks();
    $ret = array();
    foreach($this->works as $work)
      $ret[] = array('id' => $work->getId(),
		     'name' => $work->getName());
    return $ret;
  }

  public function loadMembers(){
    if(isset($this->members))
      return;
    $this->members = fRecordSet::build(
					'User',
					array("groups{members}.id=" => $this->getId())
					);
  }

  public function genMetaMembers(){
    $ret = array();
    if(!isset($this->members))
      $this->loadMembers();
    foreach($this->members as $mem)
      $ret[] = array('id' => $mem->getId(),
		     'name' => $mem->getName());
    return $ret;
  }

  public function isMember($id){
    if(!isset($this->members))
      $this->loadMembers();
    foreach($this->members as $mem)
      if($id == $mem->getId())
	return true;
    return false;
  }

  public function genMap(){
    $this->loadWorks();
    $this->loadMembers();
    $ret = array();
    foreach($this->members as $member){
      $ret[$member->getId()] = array();
      foreach($this->works as $work){
	$ret[$member->getId()][$work->getId()] = $work->userCanDo($member->getId());
      }
    }
    return $ret;
  }
}
