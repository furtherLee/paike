<?php
class WorkController extends Controller{
  public function create(){
    fAuthorization::requireLoggedIn();
    $work = new Work();
    $work->setGid(fRequest::get('gid'));
    $work->setDesp(fRequest::get('desp'));
    $work->setName(fRequest::get('name'));
    $work->store();
    $this->ajaxReturn(array(
			    'status' => 'ok',
			    'html-code' => "<tr><th>".$work->getName()."</th><th>".$work->getDesp().'</th>'.
			    '<th><input type="hidden" value="0" name="work'.$work->getId().'"/>'.
			    '<input type="checkbox" value="1" name="work'.$work->getId().'"/>'.
			    '<th><a href="'.HOST_URL."/work/".$work->getId()."/delete/".'">删除</a></th'."</tr>"
			    ));
  }
}
