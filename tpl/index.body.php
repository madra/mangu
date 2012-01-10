<?php
echo "<h1>Hello  mangu!!! ".VERSION." </h1>";
/*
$form = new Form();
$form->tabs(array('tab1'=>'tab1','tab2'=>'tab1'));
$form->startForm();
$form->label('text','textInput');
$form->textInput($array = array('name'=>'textInput','class'=>'textInput'));
$form->label('text','textInput');
$form->selectBox();
$form->textArea();
$form->submitButton($array = array('name'=>'textInput','class'=>'btn'));
$form->endForm();
*/
?>

<div class="page-header"><h1>Modals</h1></div>
<div id="my-modal" style="display:none;">
<div id="my-modal" class="modal" style="position: relative; top: auto; left: auto; margin: 0 auto; z-index: 10000">
          <div class="modal-header">
            <a href="#" class="close">&times;</a>
            <h3>Mangu Rocks!!!</h3>
          </div>
          <div class="modal-body">
            <p>One fine body…</p>
          </div>
          <div class="modal-footer">
            <a href="#" class="btn primary">Primary</a>
            <a href="#" class="btn secondary">Secondary</a>
          </div>
        </div>
</div>
<button data-controls-modal="my-modal" data-backdrop="true" data-keyboard="true" class="btn danger">Launch Modal</button>

<div class="page-header"><h1>Dropdown</h1></div>
<ul class="tabs">
  <li class="active"><a href="#">Home</a></li>
  <li class="dropdown" data-dropdown="dropdown" >
    <a href="#" class="dropdown-toggle">Dropdown</a>
    <ul class="dropdown-menu">
      <li><a href="#">Secondary link</a></li>
      <li><a href="#">Something else here</a></li>
      <li class="divider"></li>
      <li><a href="#">Another link</a></li>
    </ul>
  </li>
</ul>
</div>

