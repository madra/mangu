<?php

/**
* @package    Form
* @access        PUBLIC
* This is a form allows you to create new forms easily
*/

class Form
{




/**
*
*
*
*/
public function startForm($action = null,$method = null,$enctype = null,$id = null,$target= null,$style = null)
{

$str = '<form ';


if($id)
    {
    $str .="id='$id'";
    }

if($style)
    {
    $str .="style='$style'";
    }



if($action)
    {
     $str .="action='$action'";
    }




if($method)
    {
     $str .="method='$method'";
    }



if($enctype)
{
 $str .="enctype='$enctype'";
}

if($target)
{
$str .= "target='$target' ";
}

$str .= ' />';
echo $str;
}

function label($for,$label)
{
echo"<label for='$for'>$label</label>";
}

//text area
//class and value are optional
public function textArea($name = 'textarea',$id = null,$class = null,$javascript = null,$value=null,$cols=null,$rows=null)
{

$str ="<textarea name='$name' ";
if($id)
    {
$str .= "id ='$id'";
    }

if($class)
    {
$str .= "class ='$class'";
    }



if($cols)
    {
  $str .= "cols ='$cols'";
    }

if($rows)
    {
      $str .= "rows ='$rows'";
    }


if($javascript)
{
$javascipt_functions = explode('\\|',$javascript);

for($v = 0;$v < count($javascipt_functions);$v++)
{
$str .= "{$javascipt_functions[$v]}";
}
}

$str .=">$value</textarea>";
echo $str;
}


//input text
public function textInput($options = array(),$javascript = null)
{
    $str ="<input type='text' ";
    if(count($options) > 0)
    {
    foreach ($options as $key => $value)
    {
    # code...
    $str .= " $key = '$value' ";
    }
    }

if($javascript)
{
$javascipt_functions = explode('\\|',$javascript);

for($v = 0;$v < count($javascipt_functions);$v++)
{
$str .= "{$javascipt_functions[$v]}";
}
}

$str .=' >';
echo $str;
}


//input submit
public function hiddenInput($options=array(),$javascript = null)
{

$str = "<input type='hidden' ";

    if(count($options) > 0)
    {
    foreach ($options as $key => $value)
    {
    # code...
    $str .= " $key = '$value' ";
    }
    }


if($javascript)
{
$jstr ='';
$javascipt_functions = explode('\\|',$javascript);
for($v = 0;$v < count($javascipt_functions);$v++)
{
$jstr .= "{$javascipt_functions[$v]}";
}

$str .=" $jstr";
}
$str .=" />";
echo $str;
}

//input password
public function passwordInput($options = array(),$javascript = null)
{

$str = "<input type='password' ";

if(count($options) > 0)
    {
    foreach ($options as $key => $value)
    {
    # code...
    $str .= " $key = '$value' ";
    }
    }

if($javascript)
{
$jstr ='';
$javascipt_functions = explode('\\|',$javascript);
for($v = 0;$v < count($javascipt_functions);$v++)
{
$jstr .= "{$javascipt_functions[$v]}";
}

$str .=" $jstr";
}


$str .=" />";
echo $str;
}


//input submit
public function submitButton($options = array(),$javascript= null)
{
$str ="<input type='submit'  ";
if(count($options) > 0)
    {
    foreach ($options as $key => $value)
    {
    # code...
    $str .= " $key = '$value' ";
    }
    }

if($javascript)
{
$javascipt_functions = explode('\\|',$javascript);

for($v = 0;$v < count($javascipt_functions);$v++)
{
$str .= "{$javascipt_functions[$v]}";
}
}

$str .=' >';
echo $str;
}


//select tag
public function selectBox($name = 'select',$option_values = array(),$options = array(),$javascript = null)
{

$str = "<select name='$name' ";

if(count($options) > 0)
    {
    foreach ($options as $key => $value)
    {
    # code...
    $str .= " $key = '$value' ";
    }
    }


if($javascript)
{
$javascipt_functions = explode('\\|',$javascript);
for($v = 0;$v < count($javascipt_functions);$v++)
{
$str .= "{$javascipt_functions[$v]}";
}
}

$str .= ' >';

if(is_array($option_values))
    {

    foreach($option_values as $key => $value)
    {
    $str .="<option value='$key'>$value</option>";

    }

    }else
    {
    $options = explode('|',$option_values);
    for($c = 0;$c < count($options);$c++)
        {
             $str .="<option>{$options[$c]}</option>";
        }


    }



$str .= "</select>";
echo $str;
}


//check buttons
public function checkBox($options = array(),$javascript = null)
{
$str = "<input type='checkbox' ";

if(count($options) > 0)
    {
    foreach ($options as $key => $value)
    {
    # code...
    $str .= " $key = '$value' ";
    }
    }


if($javascript)
{
$jstr ='';
$javascipt_functions = explode('\\|',$javascript);
for($v = 0;$v < count($javascipt_functions);$v++)
{
$jstr .= "{$javascipt_functions[$v]}";
}

$str .=" $jstr";
}


$str .=" />";
echo $str;


}


//file upload
public function fileUpload($options = array(),$javascript = null)
{

$str ="<input type='file' ";
if(count($options) > 0)
    {
    foreach ($options as $key => $value)
    {
    # code...
    $str .= " $key = '$value' ";
    }
    }

if($javascript)
{
$javascipt_functions = explode('\\|',$javascript);

for($v = 0;$v < count($javascipt_functions);$v++)
{
$str .= "{$javascipt_functions[$v]}";
}
}

$str .=' >';
echo $str;
}

//end form
public function endForm()
{
echo "</form>";
}


//the tabs
public function tabs($array = array(),$fontsize = null)
{
echo "<ul class='tabs'>";

if(count($array) < 1)
    {
    $array = array('tab1'=>"Onclick=alert_val();");
?>
<script type="text/javascript">function alert_val(){alert("please provide atleast on tab value")};</script>
<?php
   }

$c = 1;
foreach($array as $key => $value)
{
//if the key value is just an index
if(is_numeric($key))
{
echo "<li><a href='#tab$c' >$value</a></li>";
}else
{
echo "<li><a href='#tab$c' ".$value.">$key</a></li>";
}


$c++;
}
echo '</ul>';
//the javascript
?>

<script type='text/javascript'>


 jQuery(function($){


$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});

 });
</script>

<style type='text/css'>
ul.tabs {
	margin: 0;
	padding: 0;
	float: left;
	list-style: none;
	height: 26px; /*--Set height of tabs--*/
	border-bottom: 1px solid #CECECE;
	border-left: 1px solid #CECECE;
	width: 100%;
}
ul.tabs li {
	float: left;
	margin: 0;
	padding: 0;
	height: 25px; /*--Subtract 1px from the height of the unordered list--*/
	line-height: 25px; /*--Vertically aligns the text within the tab--*/
	border: 1px solid #CECECE;
	border-left: none;
	margin-bottom: -1px; /*--Pull the list item down 1px--*/
	overflow: hidden;
	position: relative;
	background-color:#E6E6E6;
}
ul.tabs li a {
	text-decoration: none;
	display: block;
	color:#4C4C4C;
<?php

if($fontsize)
    {

 echo"font-size:{$fontsize}px;";

}else
{

 echo"font-size:15px;";

}
?>
   padding:1px 10px 1px;
	border: 1px solid #fff; /*--Gives the bevel look with a 1px white border inside the list item--*/
	outline: none;
}
ul.tabs li a:hover {
	background: #ccc;

}
html ul.tabs li.active, html ul.tabs li.active a:hover  { /*--Makes sure that the active tab does not listen to the hover properties--*/
	background: #fff;
	border-bottom: 1px solid #fff; /*--Makes the active tab look like it's connected with its content--*/
	display: inline;
}

.tab_container {
	border: 1px solid #CECECE;
	border-top: none;
	overflow: hidden;
	clear: both;
	float: left; width: 100%;
	background: #fff;
}
.tab_content {
	padding: 20px;
	font-size: 1.2em;

}
</style>
<?php
}

}
###

?>

