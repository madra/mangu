<?php
$notif = Notif::get_notif();
$notif->add_notif(4,"Page not found");
$notif->show_notif();
?>

