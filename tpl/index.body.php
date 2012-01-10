<div style='width:80%;margin-left:10%;margin-right:10%;margin-top:5%;margin-bottom:10%;'>
<?php
echo "<h1>Hello  mangu!!! ".VERSION." </h1>";
?>

<div class="page-header"><h4>Notification messages</h4></div>
<?php
$notif = Notif::get_notif();
$msg = 'Notification messages';
$notif->add_notif(1,$msg);
$notif->add_notif(2,$msg);
$notif->add_notif(3,$msg);
$notif->add_notif(4,$msg);
$notif-> show_notif();
?>

<div class="page-header"><h4>Modals</h4></div>
<div id="my-modal" class="modal" style="position: relative; top: auto; left: auto; margin: 0 auto; z-index: 10000;">
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
<button data-controls-modal="my-modal" data-backdrop="true" data-keyboard="true" class="btn danger">Launch Modal</button>

<div class="page-header"><h4>Dropdown</h4></div>
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



<div class="page-header"><h4>BreadCrumb</h4></div>
<ul class="breadcrumb">
  <li><a href="#">Home</a> <span class="divider">/</span></li>
  <li><a href="#">Middle page</a> <span class="divider">/</span></li>
  <li><a href="#">Another one</a> <span class="divider">/</span></li>
  <li class="active">You are here</li>
</ul>
</div>

