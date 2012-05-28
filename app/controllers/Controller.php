<?php

class Controller{
  protected $defaultContext = array(
				    "JS_HOME" => JS_HOME
				    );
  
  protected function render($name, $context){
    $loader = new Twig_Loader_Filesystem(__DIR__.'/../views');
    $twig = new Twig_Environment($loader);
    echo $twig->render("/$name.html", $context);
   }

  protected function ajaxReturn($ary){
    echo json_encode($ary);
  }

}
