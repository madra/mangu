<?php
class Ui {
#	internal variables
 private static $_instance;
#	Constructor
#initiate the page title
    function __construct ($title = null,$seo = null,$description = null) {
    //error messages
    $this->user_error = Usererror::getInstance();


    //initiate the class for error messages
    $this->notif = Notif::get_notif();

    //set this to disable or enable  SE indexing
    //public pages can be indexed private pages can't
    $this->seo = $seo;
        # code...

$this->benchmarking = false;

        $this->title = $title;
        $this->description = $description;
        $this->links = array();
         $this->bodyOnload = null;


        /**
        *javascript variables
        * we display javascript at the bottom by defauls
        * we also have default javascript values
        */

        $this->js = array('bootstrap-modal','bootstrap-alerts','bootstrap-twipsy','bootstrap-popover','bootstrap-dropdown','bootstrap-scrollspy','bootstrap-tabs','bootstrap-buttons');
        $this->default_js = true;
        $this->top_js = array('jquery_1.7.1.min','html5','ui');



        $this->default_css = true;
        $this->css = array('ui','bootstrap','icon');



        $this->api = new Api();


        $this->errors = array();

        $this->cache = new Cache();
        $sc = $_SERVER['SCRIPT_NAME'];
        $this->scriptname = strtolower(substr(strrchr($sc,DS),1));

        $this->png_fix = null;



        //for caching
        $this->header = null;
        $this->footer=null;
        $this->body=null;
		//custom user display
		$this->custom_display = null;


        //generate the .htaccess file
        if(GENERATE_HTACCESS)
        {
        $this->generate_htaccess();
        }

    //variable that controlls display
    $this->display = true;
}

static function get_ui()
{
return self::$_instance;
}



public function benchmark()
{
 $this->benchmarking = true;
}

    ###
public function unset_display() {
       $this->display = null;
    }


function unset_header()
{
$this->header = false;
}



public function set_fullScreen($width = null)
{
if($width)
    {
      $this->wrapper_width = "$width";
    }else
{
 $this->wrapper_width = "100%";
}

}


    #set the javascript for ie
    public function set_javascript_ie($links) {
        $this->js_ie = $links;
    }


    #all javascript resides in the js folder
    #by default javascript is at bottom
    public function set_javascript($js) {
        $this->js = $js;
    }

       #set javascript to be include at the top
          public function set_top_javascript($js = null) {
            //if we are allowing defualt javascript files
            if($this->default_js && is_array($js))
            {
            $js =array_merge($js,$this->default_js);
            }elseif(is_array($js))
            {
              $this->top_js = $js;
            }
          }


 #unset the default javascript files
    public function unset_default_javascript() {
        $this->default_js = false;
    }

    #set the stylesheets
    #all stylesheets resided in the css folder
    public function set_css($css = null) {
        if($this->default_css && is_array($css))
            {
            $this->css = array_merge($css,$this->css);
            }elseif(is_array($css))
            {
            $this->css = $css;
            }
    }

    public function unset_default_css() {
        $this->default_css = null;
    }



    #display the header
    public function header() {
    ob_start();
    $ui = $this;
    require_once(ROOT.DS.'tpl'.DS."header.php");
    $this->header = ob_get_contents();
    ob_clean();
    }

    //include files from the tpl directory
    //body files are in he format of example.body.ph

    public function body($file,$onload = null) {
    ob_start();
    $ui = $this;
    $this->bodyOnload = "onLoad=$onload";
    require_once(ROOT.DS.'tpl'.DS."body.php");
    $this->body = ob_get_contents();
    ob_clean();
    }

    public function footer() {
    ob_start();
    $ui = $this;
    require_once(ROOT.DS.'tpl'.DS."footer.php");
    $this->footer = ob_get_contents();
    ob_clean();
    }



    //clean the markup
    public function __destruct() {

  //just in case you need to benchmark
            if($this->benchmarking)
            {
              $bench = new Benchmark();
              $bench->initiate();
              $bench->set_marker(1);
            }

        if($this->display)
        {
    //if caching is allowed
        if(CACHE)
        {
        $scriptname = str_replace('.php','',$this->scriptname);
        $this->header =  $this->cache->cache_header($this->header,$scriptname);
        $this->footer =  $this->cache->cache_footer($this->footer,$scriptname);
        $this->body =  $this->cache->cache_body($this->body,$scriptname);
         }



        //display the data
        ob_start();
        echo $this->header . $this->body . $this->footer ;
        $data = ob_get_contents();
        ob_clean();
        $data = $this->api->return_data($data);
		echo $data;
        }

     if($this->benchmarking)
            {
              $bench->set_marker(2);
              $bench->print_report();
            }


        }


//create an htaccess file
private function generate_htaccess()
{
  $content = file_get_contents(BASE_PATH.'lib/htaccess.php');
  $file = ROOT.DS.'.htaccess';
  $fp = fopen($file, 'w+');
  fwrite($fp, $content);
  fclose($fp);
}

function auto_version($file)
{
//var_dump($file);
//Util::pre($_SERVER['DOCUMENT_ROOT']);

//check if the file exists..if it doesnt we return
  if(!file_exists(BASE_DIR . $file))
    return  STATIC_BASE_PATH.''.$file;


  $mtime = filemtime(BASE_DIR . $file);
  return  STATIC_BASE_PATH.''.preg_replace('{\\.([^./]+)$}', ".$mtime.\$1", $file);
}

}
###

