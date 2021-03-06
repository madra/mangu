<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">

  <!-- Use the .htaccess and remove these lines to avoid edge case issues.
       More info: h5bp.com/b/378 -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1">
<?php
echo
'<link rel="SHORTCUT ICON" href="'.STATIC_BASE_PATH.'images/fav.png">';
#set the title
if(!empty($ui->title))
    {
    echo"<title>{$ui->title}</title>";
    }else
    {
    echo"<title>".APP_NAME."</title>";
    }
        #set description
        if($ui->description) {
            echo"<meta name='description' content='{$ui->description}'>";
            }


          #set the css
            while (list($key,$value) = each($ui->css)) {
                if(!empty($value))
                    {
                     echo "<link href='".$ui->auto_version("css/$value.css")."' rel='stylesheet' type='text/css' />";
                    }
            }




        #set the javascript
        while (list($key,$value) = each($ui->top_js)) {
echo" <script type='text/javascript' src='".$ui->auto_version("js/$value.js")."'></script>";
                    }


echo
'
  <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="'.BASE_PATH.'js/html5.js"></script>
    <![endif]-->
';
echo'</head>';

            //guys at yahoo say this helps
            //to make the website faster
            flush();
echo'<body>';
?>
  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->

