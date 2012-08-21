<?php
/** Configuration Variables **/
define ('DEVELOPMENT_ENVIRONMENT',true);
define ('CACHE',false);
define('CUSTOM_ERROR_HANDLING',true);
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

//database configuration
define('DB_NAME', 'meka_database');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'localhost');
define('DB_DRIVER','mysql');

//the version of the database class..we have on or two
define('DRAQL_VERSION',2);

//memcahe configuration
define('MEMCACHE_HOST','localhost');
define('MEMCACHE_TTL',20);
define('MEMCACHE_ENABLED',TRUE);

//create an htaccess file,do this once please!!!!!
define('GENERATE_HTACCESS',true);

//file path
define('BASE_PATH','http://'.$_SERVER['SERVER_NAME'].'/'.array_pop(explode(DS,ROOT)).'/');

define('BASE_DIR',$_SERVER['DOCUMENT_ROOT']);

//config directoory holding the config.php
define('CONFIG_DIR',BASE_DIR.'/config/');

define('STATIC_BASE_PATH',BASE_PATH);


define('ALLOWED_PAGES',serialize(array ('index')));
define('APP_NAME','mangu');
define('VERSION',0.2);
define('SESS_KEY',md5(BASE_PATH));


define('EXT','.php');