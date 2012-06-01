<?php
class ImageController extends Controller{
  public function uploadAvatar(){
    $str = uniqid('user_');
    if (self::isImage($_FILES['avatar-file'])){
      move_uploaded_file($_FILES['avatar-file']['tmp_name'], IMAGE_PATH.$str.".jpg");
      $this->ajaxReturn(array('status' => 'ok', 'path' => "$str.jpg"));
    }
    else{
      $this->ajaxReturn(array('status' => 'error', 'message' => 'cannot save your image file'), 400);
    }
  }

  protected static function isImage($f)
  {
    return $f['type'] == 'image/jpeg' || $f['type'] == 'image/pjpeg';
  }

}