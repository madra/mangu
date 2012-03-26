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


}
###

?>

