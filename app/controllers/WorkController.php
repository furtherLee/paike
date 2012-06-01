<?php
class WorkController extends Controller{
  public function create(){
    fAuthorization::requireLoggedIn();
    $work = new Work();
    $work->setGid(fRequest::get('gid'));
    $work->setDesp(fRequest::get('desp'));
    $work->setName(fRequest::get('name'));
    $work->setNum(fRequest::get('num'));
    $work->store();
    $this->ajaxReturn(array(
			    'status' => 'ok',
			    'html-code' => "<tr><th>".$work->getName()."</th><th>".$work->getDesp().'</th>'.
			    '<th>'.$work->getNum().'</th>'.
			    '<th><input type="hidden" value="0" name="work'.$work->getId().'"/>'.
			    '<input type="checkbox" value="1" name="work'.$work->getId().'"/>'.
			    '<th><a href="#" data="'.$work->getId().'" class="mng-delete">'.'删除</a></th>'."</tr>"
			    ));
  }
  public function assignMyself($gid){
    fAuthorization::requireLoggedIn();
    $user = $this->getUser();
    $group = new Group($gid);
    $allWorks = $group->genWorks();
    foreach($allWorks as $work){
      $value = fRequest::get("work".$work->getId());
      try{
	$worker = new Worker(array('uid' => $user->getId(), 'wid' => $work->getId()));
      }
      catch(fNotFoundException $e){
	$worker = new Worker();
      }
      if ($value == 1){
	$worker->setUid($user->getId());
	$worker->setWid($work->getId());
	$worker->store();
      }
      else{
	if($worker->exists())
	  $worker->delete();
      }
    }
    $this->ajaxReturn(array('status'=>'ok'));
  }

  public function delete($id){
    $work = new Work($id);
    $workers = fRecordSet::build('Worker',
				 array('wid=' => $id));

    foreach($workers as $worker){
      $worker->delete();
    }

    $work->delete();

    $this->ajaxReturn(array('status' => 'ok'));
  }

}
