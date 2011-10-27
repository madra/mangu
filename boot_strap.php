<?php
require_once('class.inc.php');
    if(isset($_GET['url']))
    {
    $links = unserialize(ALLOWED_PAGES);
        if(in_array($_GET['url'],$links))
        {
        require_once(''.$_GET['url'].'.php');
        }else
        {
        require_once('404.php');
        }
    }else
    {
    require_once('404.php');
    }
?>

