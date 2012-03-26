<?php
require('config/config.php');



/** Check if environment is development and display errors **/
function setReporting() {
ini_set('memory_limit', '94m');
if (DEVELOPMENT_ENVIRONMENT == true) {
	error_reporting(E_ALL);
	ini_set('display_errors','On');
   // set_error_handler("manguErrorHandler");
} else {
	error_reporting(E_ALL);
	ini_set('display_errors','Off');
	ini_set('log_errors', 'On');
	ini_set('error_log', ROOT.DS.'tmp'.DS.'logs'.DS.'error.log');
}
}


/**error handler**/
function manguErrorHandler($num, $str, $file, $line) {
$notif = Notif::get_notif();
ob_start();
        print "
            <div class='error_handler'>
            Encountered error $num in $file, line $line: $str\n
            <br/>
            </div>";

$msg = ob_get_contents();
ob_end_clean();
$notif->add_notif(1,"$msg");
$notif->show_notif();
  }

/** Check for Magic Quotes and remove them **/

function stripSlashesDeep($value) {
	$value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
	return $value;
}

function removeMagicQuotes() {
if ( get_magic_quotes_gpc() ) {
	$_GET    = stripSlashesDeep($_GET   );
	$_POST   = stripSlashesDeep($_POST  );
	$_COOKIE = stripSlashesDeep($_COOKIE);
}
}


/** Check register globals and remove them **/
function unregisterGlobals() {
    if (ini_get('register_globals')) {
        $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
        foreach ($array as $value) {
            foreach ($GLOBALS[$value] as $key => $var) {
                if ($var === $GLOBALS[$key]) {
                    unset($GLOBALS[$key]);
                }
            }
        }
    }
}



function __autoload($name) {
//all files should be stored in lower case with format
//classname.class.php
 $className = $name;
$name = strtolower($name);
$file = ROOT.DS."lib/$name.class.php";
If(file_exists(ROOT . DS . 'lib' . DS . $name . '.class.php'))
{
require_once(ROOT . DS . 'lib' . DS . $name . '.class.php');
}
else
{
throw new Exception('Class "' . $name . '" could not be autoloaded');
}
}

ini_set ('magic_quotes_gpc', 0);

setReporting();
removeMagicQuotes();
session_start();

