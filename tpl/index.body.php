<div id="main" style="height:600px;">
            <div id="clouds1"></div>
            <div id="clouds2"></div>
            <div id="sign"></div>
            <div id="rain"></div>
       




<div id="my-modal" class="modal" style="position: relative; top: auto; left: auto; margin: 0 auto; z-index: 10000;top:40px;">
          <div class="modal-header">
            
            <h1>

<?php
echo " Mangu <small> PHP MVC Framework (".VERSION.") </small> ";
?>  
            </h1>
          </div>
          <div class="modal-body">
           

            <p>
             <i> Mangu </i> is the luganda word for quickly.
             Built to take the pain out of php web developement ,built for coders by coders.
             Bootstrap , Git and Jquery
            </p>



  <p>
    If you are exploring Mangu for the very first time, you should start by reading the <a href="<?php echo BASE_PATH; ?>user_guide">User Guide</a>.
  </p>


  <p>
   Before you download ,read about installation <a href="<?php echo BASE_PATH; ?>user_guide/installation/index.html">here</a>  
   Download the lastest version <a href="https://github.com/madra/mangu">here</a> and contribute <a href="https://github.com/madra/mangu">here</a>
  </p>

          </div>
          <div class="modal-footer">
             <!-- 
            <a href="#" class="btn primary">Primary</a>
            <a href="#" class="btn secondary">Secondary</a>
          -->
          </div>
        </div>
</div>


 <style type="text/css">


.float_left {
  display: inline;
  float: left;
}

.float_right {
  display: inline;
  float: right;
}

.selected, .important {
  font-weight: bold;
}

.clear {
  height: 0;
  clear: both;
  width: 0;
}

.help {
  cursor: help;
}

.align_right {
  text-align: right;
}

.align_center {
  text-align: center;
}

.valign_middle {
  vertical-align: middle !important;
}

.overflow_hidden {
  overflow: hidden;
}

.full_height {
  height: 100%;
}

.full_width {
  width: 100%;
}

.disabled, .loading {
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=50);
  opacity: 0.5;
}

.position_relative {
  position: relative;
}

.position_absolute {
  position: absolute;
}

.color_green {
  color: #55ab26;
}

@font-face {
  font-family: "League Gothic";
  src: url(/static/fonts/LeagueGothic/LeagueGothic.eot);
  src: url(/static/fonts/LeagueGothic/LeagueGothic.eotiefix) format('eot'), url(/static/fonts/LeagueGothic/LeagueGothic.woff) format('woff'), url(/static/fonts/LeagueGothic/LeagueGothic.ttf) format('truetype');
}

body {
  font-family: Arial, sans-serif;
  color: #454d54;
  font-size: 12px;
  line-height: 17px;
}

/* @group links */
a {
  color: #0084ff;
  text-decoration: none;
}
a:visited {
  color: #0084ff;
}
a:focus {
  color: #0051cc;
}
a:hover {
  color: #0051cc;
}
a:active {
  color: #0051cc;
}
a:hover {
  text-decoration: underline;
}

/* @end */
/* @group headers */
h1, h2, h3, h4, h5, h6 {
  font-weight: bold;
}

h1 {
  font-size: 21px;
  padding-bottom: 10px;
}

/* @end */
/* @group forms */
textarea, input[type="text"], input[type="password"] {
  color: #676f76;
}

/* @end */
/* @group tables */
/* tables still need 'cellspacing="0"' in the markup */
/* @end */
/* @group block tags */
/* @end */
/* @group inline tags */
small {
  font-size: 85%;
}

/* @end */
/* @group replaced tags */
img {
  -ms-interpolation-mode: bicubic;
}

/* @end */
.overlay {
  background: transparent;
  height: 100%;
  left: 0;
  position: absolute;
  top: 0;
  width: 100%;
  cursor: default;
}

.loading_text {
  background: url(/static/images/icons/loader.gif) no-repeat left center;
  display: block;
  padding-left: 22px;
}

#header {
  background: #22262a url('/static/images/layout/bg_header.png') repeat-x top left;
  border-bottom: 1px solid #22262a;
  height: 60px;
  left: 0;
  line-height: 60px;
  min-width: 1200px;
  position: absolute;
  top: 0;
  width: 100%;
  z-index: 10;
}
#header #header_wrapper {
  padding: 0 30px;
}
#header #header_wrapper #header_logo a {
  text-indent: -119988px;
  overflow: hidden;
  text-align: left;
  background-image: url('/static/images/logos/logo_small_dmcloud.png');
  background-repeat: no-repeat;
  background-position: 50% 50%;
  display: block;
  height: 60px;
  width: 168px;
}
#header #header_wrapper #header_links {
  margin: 0;
  padding: 0;
  border: 0;
  overflow: hidden;
  *zoom: 1;
}
#header #header_wrapper #header_links li {
  list-style-image: none;
  list-style-type: none;
  margin-left: 0px;
  white-space: nowrap;
  display: inline;
  float: left;
  padding-left: 10px;
  padding-right: 10px;
}
#header #header_wrapper #header_links li:first-child, #header #header_wrapper #header_links li.first {
  padding-left: 0;
}
#header #header_wrapper #header_links li:last-child {
  padding-right: 0;
}
#header #header_wrapper #header_links li.last {
  padding-right: 0;
}
#header #header_wrapper #header_links a {
  -moz-border-radius: 4px;
  -webkit-border-radius: 4px;
  -o-border-radius: 4px;
  -ms-border-radius: 4px;
  -khtml-border-radius: 4px;
  border-radius: 4px;
  border: 1px solid transparent;
  color: #e3e6e8;
  font-weight: bold;
  padding: 4px 8px;
  text-decoration: none;
  text-shadow: #0b0c0e 0px 1px 1px;
}
#header #header_wrapper #header_links a.icon {
  background-position: 4px center;
  background-repeat: no-repeat;
  padding-left: 30px;
}
#header #header_wrapper #header_links a.icon.help {
  background-image: url('/static/images/icons/16x16/icon_help.png');
}
#header #header_wrapper #header_links a.icon.user {
  background-image: url('/static/images/icons/16x16/icon_user.png');
}
#header #header_wrapper #header_links a.icon.logout {
  background-image: url('/static/images/icons/16x16/icon_logout.png');
}
#header #header_wrapper #header_links a.icon.twitter {
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=50);
  opacity: 0.5;
  background-image: url('/static/images/icons/16x16/icon_twitter.png');
}
#header #header_wrapper #header_links a.icon.twitter:hover {
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
  opacity: 1;
}
#header #header_wrapper #header_links a:hover {
  background-color: #171a1c;
  border-top-color: #171a1c;
  border-bottom-color: #454d54;
}

#header {
  -moz-box-shadow: 0px 1px 3px #222222;
  -webkit-box-shadow: 0px 1px 3px #222222;
  -o-box-shadow: 0px 1px 3px #222222;
  box-shadow: 0px 1px 3px #222222;
}

/*Animations* */
@-webkit-keyframes rain {
  from {
    background-position: 0em 0em;
  }

  to {
    background-position: -400em 1000em, -450em 1050em;
  }
}

@-webkit-keyframes cloud1 {
  from {
    background-position: 0 top;
  }

  to {
    background-position: -1024px top;
  }
}

@-webkit-keyframes cloud2 {
  from {
    background-position: -600px top;
  }

  to {
    background-position: -1624px top;
  }
}

@-webkit-keyframes sign404 {
  0% {
    -webkit-transform: rotate(0deg) translate(20px);
  }

  20% {
    -webkit-transform: rotate(-4deg) translate(-20px);
  }

  30% {
    -webkit-transform: rotate(0deg) translate(20px);
  }

  100% {
    -webkit-transform: rotate(0deg) translate(20px);
  }
}

@-webkit-keyframes light {
  0% {
    background-color: #243442;
  }

  10% {
    background-color: #243442;
  }

  11% {
    background-color: #666666;
  }

  12% {
    background-color: #243442;
  }

  30% {
    background-color: #243442;
  }

  31% {
    background-color: gray;
  }

  32% {
    background-color: #243442;
  }

  100% {
    background-color: #243442;
  }
}

/*Assets* */
#sign {
  -webkit-animation-name: sign404;
  -webkit-animation-duration: 10s;
  -webkit-animation-iteration-count: infinite;
  position: absolute;
  bottom: 0;
  right: 10%;
  display: block;
  height: 500px;
  width: 300px;
  background: url('../images/sign.png') no-repeat center top;
}

body {
  -webkit-animation-name: light;
  -webkit-animation-duration: 10s;
  -webkit-animation-timing-function: ease in out;
  -webkit-animation-iteration-count: infinite;
  background-color: #243442;
  background-color: #243442;
  overflow: hidden;
}

#rain {
  -webkit-animation-name: rain;
  -webkit-animation-duration: 10s;
  -webkit-animation-iteration-count: infinite;
  -webkit-animation-timing-function: linear;
  height: 100%;
  position: absolute;
  top: 0;
  width: 100%;
  background-image: url('../images/raindrops2.png'), url('../images/raindrops3.png');
}

#clouds1 {
  -webkit-animation-name: cloud1;
  -webkit-animation-duration: 40s;
  -webkit-animation-iteration-count: infinite;
  -webkit-animation-timing-function: linear;
  position: absolute;
  display: block;
  width: 100%;
  height: 300px;
  background: url('images/clouds2.png') repeat-x;
}

#clouds2 {
  -webkit-animation-name: cloud2;
  -webkit-animation-duration: 30s;
  -webkit-animation-iteration-count: infinite;
  -webkit-animation-timing-function: linear;
  position: absolute;
  width: 100%;
  height: 600px;
  background: url('images/clouds1.png') repeat-x -600px top;
}


#home_container {

border: 0 none !important;
background :0 none !important;
padding :0 none !important;
margin: 0 none !important;
width: auto !important;
-webkit-box-shadow: none !important;
-moz-box-shadow: none   !important;
box-shadow: none  !important;
}


#footer_container {
  font-size: 15px;
bottom: 0px;
position: fixed;
}

.home_content_wrapper {
padding :0  !important;
margin:0  !important;
width: auto !important;
-webkit-box-shadow: 0 none !important;
-moz-box-shadow: 0  none !important;
}

#header_out {
z-index:10000;
top: 0;
position: relative;
display: block;
overflow: hidden;
}

 </style>