<?php
class UserController extends Controller{

  public function showLoginPage(){
    $this->render('User/login', array());
  }

  public function showRegisterPage(){
    $this->render('User/register', array());
  }

} 