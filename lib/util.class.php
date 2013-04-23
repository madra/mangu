<?php

#doc
#    classname:    Util
#    scope:        PUBLIC
#
#/doc

class Util
{
    #    internal variables

    #    Constructor
    function __construct ()
    {
        # code...

    }
    ###
static function Notice($msg,$type)
{
//usage
//Util::Notif($msg,$type_of_message)

$notif = Notif::get_notif();
$notif->add_notif($type,$msg);
$notif->show_notif();
}

static function getScriptName()
{

//get the file name

$scriptname = null;
if(isset($_GET['url']))
    {
    $scriptname = $_GET['url'];
    }else
    {
    $sc = $_SERVER['SCRIPT_NAME'];
    $scriptname = strtolower(substr(strrchr($sc,DS),1));
    $scriptname = str_replace('.php','',$scriptname);
    }
return $scriptname;
}

//print out the contents of an array or variable or object
static function pre($array)
{
if(is_array($array))
    {
echo'<pre>';
print_r($array);
echo'</pre>';
    }else
    {
    echo'<pre>';
    var_dump($array);
    echo'</pre>';
    }
}

public static function split_str($str,$end,$start = 0,$strext = null)
{
           if(strlen($str) > $end)
           {
           $msg = substr($str,$start,$end);

 //add an optional str extension...something like $str.....
                if($strext)
                {
                $msg .= "$strext";
                }
            return $msg;
           }else
           {
           return $str;
           }

}


public static function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}

}
###

?>

