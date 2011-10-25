<?php
    require_once('class.inc.php');
    $ui = new Ui('Page not found',1);
    //$ui->set_css($css = array(""));
    //$ui->set_javascript($js = array("default"));
    $ui->header();
    $ui->body('404');
    $ui->footer();
?>

