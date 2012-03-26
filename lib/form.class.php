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
public function startForm($options = null)
{

$str = '<form ';


if($options && count($options) > 0)
    {
    foreach ($options as $key => $value)
    {
    # code...
    $str .= " $key = '$value' ";
    }
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
}

//modal dialog
public function modal($data)
{

}


}
###

?>

