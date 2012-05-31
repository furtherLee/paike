<?php
class Work extends fActiveRecord{
  protected function configure(){
  }

  public function userCanDo($uid){
    try{
      $worker = new Worker(array('uid' => $uid, 'wid' => $this->getId()));
      return true;
    }
    catch(fNotFoundException $e){
      return false;
    }
  }

  public function checkMe($uid){
    if ($this->userCanDo($uid))
      return 'checked';
    else return '';
  }

}