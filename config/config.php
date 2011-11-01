<?php
/** Configuration Variables **/
define ('DEVELOPMENT_ENVIRONMENT',true);
define ('CACHE',false);
define('CUSTOM_ERROR_HANDLING',true);
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

//database configuration
define('DB_NAME', '');
define('DB_USER', '');
define('DB_PASS', '');
define('DB_HOST', '');
define('DB_DRIVER','');


//create an htaccess file,do this once please!!!!!
define('GENERATE_HTACCESS',false);

//file path
define('BASE_PATH','http://'.$_SERVER['SERVER_NAME'].'/'.array_pop(explode(DS,ROOT)).'/');
define('BASE_DIR',$_SERVER['DOCUMENT_ROOT']);
define('STATIC_BASE_PATH',BASE_PATH);


define('ALLOWED_PAGES',serialize(array ('index')));
define('APP_NAME','mangu');
