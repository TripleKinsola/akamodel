<?php
/**
 * <h1>Akaddit v2 Function Helpers</h1>
 * @author Akinsola Ademola, A [07062671144]
 * @version 2.0, 2014/2015
 * @link http://geekerbyte.blogspot.com => TripleKinsola@gmail.com
 * @copyright date('Y');
 * 
 */
ini_set('display_errors', false);//Cancel this line or comment it out @ producton
// Define the core paths
// Define them as absolute paths to make sure that require_once works as expected

// DIRECTORY_SEPARATOR is a PHP pre-defined constant
// (\ for Windows, / for Unix)

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null : 
	define('SITE_ROOT', "..");

defined('MODELS_LIB_PATH') ? null : define('MODELS_LIB_PATH', SITE_ROOT.DS.'application'.DS.'models');
defined('HELPERS_LIB_PATH') ? null : define('HELPERS_LIB_PATH', SITE_ROOT.DS.'application'.DS.'helpers');

// load config file first
require_once(SITE_ROOT.DS.'config'.DS.'config.inc.php');

// require_once(HELPERS_LIB_PATH.DS."Mailer".DS."class.phpmailer.php");
// require_once(HELPERS_LIB_PATH.DS."Mailer".DS."class.smtp.php");
// require_once(HELPERS_LIB_PATH.DS."Mailer".DS."language".DS."phpmailer.lang-en.php");

// load database-related classes core objects
require_once(MODELS_LIB_PATH.DS.'dbase.class.php');
//db_abstract/migrations first, for ease of use for other classes
//require_once(MODELS_LIB_PATH.DS."db_abstract".DS."migrations".DS.'adminuser.mig.php');

// load basic functions and class helpers next so that everything after can use them
require_once(HELPERS_LIB_PATH.DS.'functions.help.php');
require_once(HELPERS_LIB_PATH.DS.'session.help.php');
require_once(HELPERS_LIB_PATH.DS.'pagination.help.php');

//Other related core objects
require_once(MODELS_LIB_PATH.DS.'profile.class.php');
require_once(MODELS_LIB_PATH.DS.'user.class.php');
require_once(MODELS_LIB_PATH.DS.'log.class.php');
?>