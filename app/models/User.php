<?php

class User extends fActiveRecord{

  protected function configure(){
  
  }

  public function passCheckOK($pass){
    return $this->getPassword() == self::calcPassword($pass, $this->getSalt(), $this->getIter());
  }

  public static function calcPassword($password, $salt, $iter){
    $pass = $password;
    for($i = 0; $i < $iter; $i++){
      $pass .= $salt;
      $pass = md5($pass);
    }
    return $pass;
  }

}
