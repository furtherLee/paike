<?php
class ScheduleController extends Controller{
  public function showSchedule($id){
    $schedule = new Schedule($id);
    $group = new Group($schedule->getGid());
    $map = array();
    foreach($group->genWorks() as $work){
      $ret = $this->calcUsers($id, $work->getId());
      $str = $ret['str'];
      $workRatio = $ret['num']."/".$work->getNum();
      $map[] = array('workName' => $work->getName(),
		     'workers' => $str,
		     'workRatio' => $workRatio);
    }

    $this->render('Schedule/item', array('schedule' => $schedule,
					 'map' => $map
					 ));
  }

  private function calcUsers($sid, $wid){
    $num = 0;
    $assigns = fRecordSet::build('Assign',
				 array('sid=' => $sid,
				       'wid=' => $wid));
    $ret = "";
    foreach($assigns as $assign){
      $user = new User($assign->getUid());
      $ret = $ret." ".$user->getName();
      $num++;
    }
    return array('str' => $ret, 'num' => $num);
  }

}
