<?php
class UserController extends Controller{

  public function showHomePage(){
    //    fAuthorization::requireLoggedIn();
    $userToken = fAuthorization::getUserToken();
    // TODO
    $this->render("User/homepage", array());
   }

  public function showLoginPage(){
    $this->render('User/login', array('title' => '欢迎来到排客'));
  }

  public function showRegisterPage(){
    $this->render('User/register', array('title' => '成为一名排客'));
  }

  public function edit($id){
  }

  public function login(){
 
    if (fAuthorization::checkLoggedIn()) {
      fURL::redirect(fAuthorization::getRequestedURL(false, HOST_URL));
    }
    else{
      try{
        $user = new User(array('email' => fRequest::get('email')));
      }
      catch(fNotFoundException $e){
        $this->ajaxReturn(array('error' => array(
                                                 'email' => '这个邮箱没有被注册过'
                                                 )),
                          400);
        return;
      }
      
      if($user->passCheckOK(fRequest::get('pass'))){
        fAuthorization::setUserToken(array(
					   'id' => $user->getId(),
					   'name' => $user->getName(),
					   'email' => $user->getEmail()
                                           ));
        $this->ajaxReturn(array('redirect' => fAuthorization::getRequestedURL(false, HOST_URL)));
      }
      else{
        $this->ajaxReturn(array('error' => array(
                                                 'pass' => '密码不正确'
                                                 )),
                          400);
      }
    }
  }

  public function register(){
    // TODO check whether the email is registed
    $iter = rand(2, 16);
    
    $salt = md5(uniqid(time(),true));
    
    $user = new User();
    
    $user->setEmail(fRequest::get('email'));
    
    $user->setIter($iter);
    
    $user->setSalt($salt);
    
    $user->setPassword(User::calcPassword(fRequest::get('password'), $salt, $iter));
    
    $user->setName(fRequest::get('name'));
    
    $user->setSex(fRequest::get('sex'));

    $user->setBirthday(fRequest::get('birthday'));

    $user->store();
    
    $this->ajaxReturn(array(
                            'status' => 'OK',
                            'user_id' => $user->getId()
                            ));
    
  }
  
  public function logout(){
    $back = fRequest::get('back');
    
    fAuthorization::destroyUserInfo();
    fSession::clear();
    
    if (empty($back)){
      fURL::redirect(HOST_URL);
    }
    else{
      fURL::redirect($back);
    }
  }

} 
