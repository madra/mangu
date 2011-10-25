<?php
/**
*classname:    Notif
*scope:        private
*system wide notifications
*a  singleton class embeded into the Ui class
*called from within the app with $ui->notif
*/

class Notif
{
    //    internal variables
    //the type of notification type so we can change the styling
 public $type;
 private $notif;
 private static $_instance;

    #    Constructor
    private function __construct ()
    {

    /**
    *failure message is red
    *warning message is yellow
    *success is blue
    */
    $this->type = array("",
    'failure',
    'warning',
    'success'
      );
    }
    ###

     //add a notification
    function add_notif($type,$msg)
    {
    $this->notif[] = array(1=>$type,2=>$msg);
    }

    /**show the message in the current position
    * the close option always us to switch off the close button
    */
    function show_notif($close = null)
    {
    if(is_array($this->notif))
    {
    foreach($this->notif as $notice)
    {
    $this->format_notice($notice[1],$notice[2],$close);
    }
    $this->notif = null;
    }
    }

    /**format the specific message for display
    * the close option always us to switch off the close button
    */
    private function format_notice($type,$msg,$close = null)
    {
    $divid = md5(uniqid(rand(), true));
    $style = array('','noticefail','noticewarn','noticesuccess','noticestatus','noticeblack','noticefade','noticesoft');
       if($type == 6)
	{
echo
"
<div id='$divid' class='{$style[$type]}'>
 $msg
<script type='text/javascript'>
new Effect.Fade('$divid',{ fps: 10, duration: 5 });
</script>
</div>
";
}else
{
    echo
    "
    <div class='noticecontainer'><div id='$divid' class='{$style[$type]}' style='padding:1.5%;'>
     ";

    if(!$close)
    {
    echo
    "
    <div class='noticeimsgdiv'>
    <img id='noticeimsg' src='".BASE_PATH."images/close2.png' class='iepngfix'  Onclick=$('#$divid').hide()></img>
    </div>
    ";
    }

    echo
    "
    $msg

    </div></div>
    ";
    }
    }


 //a popup notice
 function popup_notice($button,$cancelbutton = null)
 {
 $id = md5(uniqid(rand(), true));
 echo "<div class='noticepopup' id='$id'>";

  foreach($button as $key => $value)
    {
	echo "<a Onclick=$value; class='noticepopupbuttonlink'><span class='noticepopupbutton'>$key</span></a>";
	}



   //cancel lin
  if($cancelbutton)
	{
	echo "<a Onclick=$cancelbutton;canvas_popup_close('$id'); class='noticepopupbuttonlink'><span class='noticepopupbutton'>Cancel</span></a>";
	}else
	{
   	echo "<a Onclick=canvas_popup_close('$id'); class='noticepopupbuttonlink'><span class='noticepopupbutton'>Cancel</span></a>";
 	}

   echo "</div>";
 }


 /**
 *call our class from here
 */
     public static function get_notif() {
  if( ! (self::$_instance instanceof self) ) {
     self::$_instance = new self();
  }
  return self::$_instance;
}

}
####

?>

