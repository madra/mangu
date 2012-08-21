<?php
//if the installation fil exists we don't display anything
if (file_exists('install'.EXT))
{
    // Load the installation check
    return include 'install'.EXT;
    exit();
}else
{
require_once(ROOT.DS.'tpl'.DS."$file.body.php");
}
?>

