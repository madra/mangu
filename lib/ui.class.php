<?php
class Ui {
#	internal variables

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
        //javascript variables
        $this->js = array();
        $this->top_js = array();
        $this->default_js = null;
        $this->js_ie = array();


        $this->css = array();



        $this->api = new Api();

        $this->default_css = null;

        $this->errors = array();

        $this->cache = new Cache();
        $sc = $_SERVER['SCRIPT_NAME'];
        $this->scriptname = strtolower(substr(strrchr($sc, "/"),1));

        $this->png_fix = null;



        $this->wrapper_width = "960px";
        $this->header = true;



        //for caching
        $header;
        $footer;
        $body;
		//custom user display
		$this->custom_display = null;

     //for testing
  if(DEVELOPMENT_ENVIRONMENT)
  {
  $this->test = new Test();
  }


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

#apps
public function set_app_js($css) {
        $this->app_js = $css;
    }

public function set_app_css($css) {
        $this->app_css = $css;

    }

public function set_normal_quick_search()
{
 $this->home_header = 1;
}

    function set_admin($a = null) {
        if(!$a == null) {
            $this->admin = true;
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
          public function set_top_javascript($js) {
        $this->top_js = $js;
          }


 #unset the default javascript files
    public function unset_default_javascript() {
        $this->default_js = 1;

    }

    #set the stylesheets
    #all stylesheets resided in the css folder
    public function set_css($css) {
        $this->css = $css;

    }

    public function unset_default_css() {
        $this->default_css = 1;

    }

    #set the errors for the page
    public function set_errors($errors) {
        $this->errors[] =  $errors;
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

}
###

