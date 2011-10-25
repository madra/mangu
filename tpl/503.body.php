<?php
$notif = Notif::get_notif();
$notif->add_notif(1,"Server error");
$notif->show_notif();
?>

