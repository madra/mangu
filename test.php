<?php
    require_once('class.inc.php');
    $ui = new Ui('Mangu 0.1',1);
    //$ui->set_css($css = array(""));
   // $ui->set_javascript($js = array("default"));
   // $ui->unset_default_css();
    //$ui->unset_default_javascript();
    $ui->header();
    $ui->body('test');
    $ui->footer();
    //$ui->benchmark();
?>

