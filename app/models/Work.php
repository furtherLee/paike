<?php
class Work extends fActiveRecord{
  protected function configure(){
  }
  public function checkMe($uid){
    $check = fRecordSet::build('Worker',
		      array('uid=' => $uid,
			    'wid=' => $this->getId()));
    if ($check->count() != 0)
      return 'checked';
    else return '';
  }
}