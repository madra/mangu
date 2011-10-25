<?php


#doc
#	classname:	Connection
#	scope:		PUBLIC
#
#/doc

class Connection
{


private static $_instance;

private function __construct() {
$this->conn = false;
//if the driver is mysql
if(DB_DRIVER == 'mysql')
{

try
{
	$this->conn = mysql_connect(DB_HOST,DB_USER,DB_PASS);
	$sd = mysql_select_db(DB_NAME);
	if(!$this->conn || !$sd)
	{
		throw new Dberrors(1);
	}

}catch( Dberrors $e)
{
	$e->set_db($e);
}
}


//implement others here...soom :)
return $this->conn;
}


public static function getInstance() {
  if( ! (self::$_instance instanceof self) ) {
     self::$_instance = new self();
  }
  return self::$_instance;
}




}
###
?>

