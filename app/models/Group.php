<?php
class Group extends fActiveRecord{

  var $members;

  protected function configure(){
    fORMRelated::overrideRelatedRecordName($this, 'User', 'Member', 'members');
  }

  public function genWorks(){
    $ret = fRecordSet::build(
			     'Work',
			     array("gid=" => $this->getId())
			     );
    return $ret;
  }

  public function loadMembers(){
    $this->members = fRecordSet::build(
					'User',
					array("groups{members}.id=" => $this->getId())
					);
  }

  public function genMetaMembers(){
    $ret = array();
    if(!isset($this->members))
      loadMembers();
    foreach($this->members as $mem)
      $ret[] = array('id' => $mem->getId(),
		     'name' => $mem->getName());
    return $ret;
  }

  public function isMember($id){
    if(!isset($this->members))
      loadMembers();
    foreach($this->members as $mem)
      if($id == $mem->getId())
	return true;
    return false;
  }
}