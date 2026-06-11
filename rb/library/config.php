<?php

error_reporting(E_ALL);
ini_set('display_errors','off');

//session_start();

// define('DB_HOST','localhost');
// define('DB_USER','paandy');
// define('DB_PASS','100%Data');
// define('DB_NAME','dbadmin');

define('DS','/');
define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('INC_PATH', SITE_ROOT.DS.'includes'.DS);
define('LIB_PATH', SITE_ROOT.DS.'library'.DS);
define('ClASS_PATH', SITE_ROOT.DS.'class'.DS);
define('ADMIN_PATH', SITE_ROOT.DS.'admin'.DS);
define('SITE_PATH', SITE_ROOT.DS.'public'.DS);
define('TEMPLATE', SITE_ROOT.DS.'template'.DS);

//include(LIB_PATH.'class.session.php');
//include(LIB_PATH.'class.spage.php');
include(LIB_PATH.'class.template.php');

//include(ClASS_PATH.'class.class_user.php');

//$session = new session();
//$spage = new spage();

# define constant, serialize array
define ("USER_LEVELS", serialize (array ("Admin", "Accountant", "Cashier")));

define('CASHIER_PERMISSIONS', serialize (array ('dashboard','index','manage_orders','reports_cheff','delivery','add-order','overall-invoices')));
define('ACCOUNTANT_PERMISSIONS', serialize (array ('dashboard','index','reports_cheff','delivery','reports_all','reports_products_only','overall-invoices','all-payment','reports-overall')));



?>