<?php


#doc
#	classname:	Canvas
#	scope:		PUBLIC
#
/*
modification of container class

*/
#/doc

class Canvas
{
	#	internal variables

	#	Constructor
	function __construct ()
	{

    # code...

	 //div data placeholders
	 $this->topbar = null;
	 $this->leftbar = null;
	 $this->middlebar = null;
	 $this->bottombar = null;

	 //source of the canvas,web or mobile or watever
     //middlebar width
	  $this->middlebarwidth = null;
    $this->onclick = null;
    $this->onmouseover = null;
    $this->onmouseout = null;
	}
	###

	function top_bar($data = null,$top_barid = null)
	{
	ob_start();
	echo "<div class='canvas_top_bar' id='{$top_barid}' >";
	echo $data ;
	echo "</div>";
	$this->topbar = ob_get_contents();
    ob_end_clean();
	}



	function left_bar($data,$width,$middlebarid = null)
	{
	 //the width of the middle bar is the 100% - leftbar width
	$this->middlebarwidth = 99 - $width;
	ob_start();
	echo "<div class='canvas_left_bar' id='$middlebarid' style='width:$width%;'>";
	echo $data;
	echo "</div>";
	$this->leftbar = ob_get_contents();
    ob_end_clean();
	}

	function middle_bar($data,$middlebarid = null)
	{
	ob_start();
	echo "<div class='canvas_middle_bar' id='$middlebarid' style='width:{$this->middlebarwidth}%;' >";
	echo $this->topbar;
	echo $data;
	echo "</div>";
	$this->middlebar = ob_get_contents();
    ob_end_clean();
	}

	function bottom_bar($text,$bottom_barid = null)
	{
	ob_start();
	echo "<div class='canvas_bottom_bar' id='{$bottom_barid}' >";
    echo $text;
	echo "</div>";
	$this->bottombar = ob_get_contents();
    ob_end_clean();
	}


    //actions to perform on the div
    function onClick($onclick)
    {
    $this->onclick = "OnClick=$onclick";
    }


        //actions to perform on the div
    function onMouseOver($onclick)
    {
    $this->onmouseover = "OnMouseOver=$onclick";
    }



         //actions to perform on the div
    function onMouseOut($onclick)
    {
    $this->onmouseout = "OnMouseOut=$onclick";
    }





    function display($style = null,$id = null)
    {
    echo "<div style='$style' id='{$id}' class='canvas_wrapper' {$this->onclick} {$this->onmouseover} {$this->onmouseout} >";
    echo $this->leftbar .$this->middlebar .$this->bottombar;
    echo "</div>";
    }
}
###

?>

