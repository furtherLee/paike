<?php

/**
 * Load Venders
 */
require_once(__DIR__.'/vendors/flourish.php');
require_once(__DIR__.'/vendors/slim.php');
require_once(__DIR__.'/vendors/twig.php');
include_once(__DIR__.'/init.php');

/**
 * Load Models
 */
require_once(__DIR__.'/models/User.php');
require_once(__DIR__.'/models/Group.php');
require_once(__DIR__.'/models/Member.php');
/**
 * Load Controllers
 */
require_once(__DIR__.'/controllers/Controller.php');
require_once(__DIR__.'/controllers/UserController.php');
require_once(__DIR__.'/controllers/GroupController.php');

/**
 * Set Up Routes
 */
require_once(__DIR__.'/routes.php');
