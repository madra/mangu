<?php
    require_once('class.inc.php');
    $ui = new Ui('Mangu 0.1',1);
  //  $ui->set_css($css = array(""));
//    $ui->set_javascript($js = array("default"));
    $ui->header();
    $ui->body('index');
    $ui->footer();
 $ui->benchmark();
?>

