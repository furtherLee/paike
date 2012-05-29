<?php

class Controller{
  private static $global_context = array(
					 "HOST_URL" => HOST_URL,
					 "JS_HOME" => JS_HOME,
					 "CSS_HOME" => CSS_HOME,
					 "IMG_HOME" => IMG_HOME
				    );
  
  protected function render($name, $context){
    $loader = new Twig_Loader_Filesystem(__DIR__.'/../views');
    $twig = new Twig_Environment($loader);
    echo $twig->render("/$name.html", array_merge(Controller::$global_context, $context));
   }

  protected function ajaxReturn($ary, $code = 200){
    Slim::getInstance()->response()->status($code);
    echo json_encode($ary);
  }

}
