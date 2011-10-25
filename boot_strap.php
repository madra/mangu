<?php
require_once('class.inc.php');
//print_r($_REQUEST);
//var_dump($_GET['url']);
    if(isset($_GET['url']))
    {
    Util::checkUrl($_GET['url']);
    }else
    {
    Util::relocate("404.php");
    }
?>

