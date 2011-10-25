<?php


/**
*classname:    Usererror
*scope:        PUBLIC
*singleton so we can keep track of the errors
*/

class Usererror 
{

private  $errors;
private $msg;
private static $_instance;
private function __construct() {
$this->msg = array('',
"Please fill out all the fields",
"The username you provided is already in use",
"please provide a valid email address",
'The Username/Password you provided is invalid',
'The email you provide is already in use',
"Your Password Should Be Six Or More Characters"

);

}


//set the default message to display when something goes wrong
public function default_message()
{


echo
"
<div class='usererror'>
There was an error,please refresh the page
</div>
";

}

/*
*create an array of error msgs to display the user
*use the display_notice() method  to display the errors
*/

public function set_notice($type)
{
/*
form errors
1 password error
2 username error
3 email error
*/

$this->errors[] = $this->msg[$type];

}



/*
display the error message to the ui
*/   

public function display_notice()
{
    //if its an array and the count is greater than 0 we continue
    if(is_array($this->errors) && count($this->errors) > 0){
		  while (list($key,$value) = each($this->errors))
		{

			echo "<div id='notice'>".$value.'</div><br />';
		}
		//reset the errors array
		$this->errors = null;
		}
}



/*
return the same instatnce of the class
*/
public static function getInstance() {
  if( ! (self::$_instance instanceof self) ) {
     self::$_instance = new self();
  }
  return self::$_instance;
}

}







?>
