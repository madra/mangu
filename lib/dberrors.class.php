<?php


#doc
#	classname:	Errors
#	scope:		PUBLIC
#
#/doc

class Dberrors extends  Exception
{
	#	internal variables

	#	Constructor
	function __construct ($message,$code = null)
	{
		# code...
	parent::__construct($message, $code);


	///errors for the user


	}
	###



public function set_db($e)
{

if(DEVELOPMENT_ENVIRONMENT)
{
$notif = Notif::get_notif();
if(DB_DRIVER == 'mysql')
{
 $databaseErrorMessage = mysql_error();
}
elseif(DB_DRIVER == 'postgre')
{
 $databaseErrorMessage = pg_last_error();
}

ob_start();
echo "<b><h4>Database Error</h4></b>";
echo $databaseErrorMessage . " <br /> ";
echo " <pre> Code : " .$e->getCode() ."<br /></pre><pre>" ."File :"  .$e->getFile() ."<br /></pre><pre>" ."Line : " .$e->getLine() ."<br/></pre>";	# code...
$msg = ob_get_contents();
ob_end_clean();
$notif->add_notif(1,"$msg");
$notif->show_notif();
}else
{

//display the default message for when something goes wrong
/*
$uerror->default_message();
*/
}
}




}
###

?>

