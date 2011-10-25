<?php
class Cache {


#	internal variables

	#	Constructor
	function __construct ()
	{
    $this->body_expiry = 100*60*3;
    $this->header_expiry = 100*60*3;
    $this->footer_expiry = 100*60*3;
    # code...

	}
	###

//cache the body
public function cache_body($data,$scriptname)
{
$expiry = $this->body_expiry;
$filename = "{$scriptname}.body.cache";
if(!$this->checkCacheFile($filename,$data,$expiry))
    {
    $this->writeCache($data, $filename);
    }else
    {
    $data = $this->readCache($filename,$expiry);
    }
return $data;	# code...
}


//cache the header
public function cache_header($data,$scriptname)
{
$expiry = $this->header_expiry;
$filename = "{$scriptname}.header.cache";
if(!$this->checkCacheFile($filename,$data,$expiry))
    {
    $this->writeCache($data, $filename);
    }else
    {
    $data = $this->readCache($filename,$expiry);
    }
return $data;
}



//cache the footer
public function cache_footer($data,$scriptname)
{
//seconds
$expiry = $this->footer_expiry ;
$filename = "{$scriptname}.footer.cache";
if(!$this->checkCacheFile($filename,$data,$expiry))
    {
    $this->writeCache($data, $filename);
    }else
    {
    $data = $this->readCache($filename,$expiry);
    }
return $data;
}



 function writeCache($content, $filename)
{
  $file = ROOT.DS.'cache'.DS.$filename;
  $fp = fopen($file, 'w+');
  fwrite($fp, $content);
  fclose($fp);
}




function readCache($filename,$expiry)
{

$file = ROOT.DS.'cache'.DS.$filename;
  if (file_exists($file))
  {
    if ((time() - $expiry) > filemtime($file))
    {
      return false;

    }

    $cache = file($file);

    return implode('', $cache);

  }

  return false;

}

//check if a cachec file has expired
function checkCacheFile($filename,$data,$expiry)
{
$file = ROOT.DS.'cache'.DS.$filename;
  if (file_exists($file))
  {

    //if the file has expired or if it has been changed
    if ((time() - $expiry) > filemtime($file) || $data != file_get_contents($file))
    {
      return false;

    }else
    {
      return true;
    }
  }else
    {
     return false;
    }
}

}

