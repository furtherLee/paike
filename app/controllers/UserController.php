<?php
class UserController extends Controller{

  public function showLoginPage(){
    $this->render('User/login', $this->defaultContext);
  }

  public function showRegisterPage(){
    $this->render('User/register', $this->$defaultContext);
  }

} 