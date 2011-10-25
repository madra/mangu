<?php
echo "<h1>Hello  mangu!!1</h1>";
$form = new Form();
$form->tabs(array('tab1'=>'tab1','tab2'=>'tab1'));
$form->startForm();
$form->label('text','textInput');
$form->textInput();
$form->label('text','textInput');
$form->selectBox();
$form->textArea();
$form->submitButton();
$form->endForm();
?>

