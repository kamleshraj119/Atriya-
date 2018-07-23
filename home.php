<?php
require_once ("./libs.inc.php");
$data=$user -> getCountUsersByRole($dbHelper, $mysqli);
$courseList=$course -> getCourse($dbHelper, $mysqli, '');
?>
<!DOCTYPE html>
<html lang="en">
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8" />
    <!-- IE Compatibility Meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- First Mobile Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flexi Hire</title>
    <link rel="shortcut icon" href="assets/img/fav.ico" />
    <link rel="stylesheet" href="assets/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css" />
    <link rel="stylesheet" href="assets/css/lity.min.css" />
    <link rel="stylesheet" href="assets/css/animate.css" />
    <link rel="stylesheet" href="assets/css/lightbox.css" />
    <link rel="stylesheet" href="assets/css/red_style.css" />
    <link rel="stylesheet" href="assets/css/rev-settings.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <script type="text/javascript" src="assets/js/flexi.js"></script>
    <script src="assets/js/ajax.js"></script>
    <script src="assets/js/sha512.js"></script>
    <link rel="stylesheet" href="assets/css/media.css" />
    <!--[if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
        <script src="js/respond.min.js"></script>
      <![endif]-->
</head>

<body>
    <!-- Start  Loading Section -->
    <div class="loading-overlay">
        <div class="loading">
            <div>
                <div class="c1"></div>
                <div class="c2"></div>
                <div class="c3"></div>
                <div class="c4"></div>
            </div>
            <span>loading</span>
        </div>
    </div>
    <!-- end loading section -->








    <!-- Login Modal -->
        <div class="modal fade login" id="LogIn" role="dialog">
            <div class="modal-dialog login-dialog">

                <div class="login-content">
                    <div class="login-header">
                        <h3>Sign In</h3>
                        <hr>
                    </div>
                    <div class="login-body">

                        <form action="#" class="form-horizontal">
                            <select name="category" id="category" class=" login-form  def-input def-select">
                                <option value="" disabled selected>Login As</option>
                                <option value="Candidate">Candidate</option>
                                <option value="Employer">Employer</option>

                            </select>
                            <input type="text" name="username" id="username" class="login-form def-input" placeholder="Mobile   ">
                            <input type="password" name="password" id="password" class="login-form def-input" placeholder="Password">
                            <div class="remember-me-forgot-pw">
                                <div class="col-md-6 no-padding">
                                    <input type="checkbox">
                                    <label>Remember me</label>
                                </div>
                                <div class="col-md-6 no-padding text-right">
                                    <a href="#"  data-toggle="modal" data-target="#forgotpass" data-dismiss="modal">Forgot your password?</a>
                                </div>
                            </div>
                            <a href="javascript:void(0);" onclick="Login();">
                            <div class="sign-in">
                                Sign In
                            </div> </a>
                        </form>
                        <div class="dont-have">
                            Don't have an account yet? <a href="javascript:void(0);" data-toggle="modal" data-target="#Register" data-dismiss="modal">Register now!</a>
                        </div>
                    </div>
                </div><!--/.login-content-->

            </div>
        </div>
        <!-- Login Ends -->






<!-- Register -->
        <div class="modal fade login" id="Register" role="dialog">
            <div class="modal-dialog login-dialog">

                <div class="login-content">
                    <div class="login-header">
                        <h3>Register</h3>
                        <hr>
                    </div>
                    <div class="login-body">

                        <form action="#" class="form-horizontal">
                            <select name="reg_category" id="reg_category" class="login-form  def-input def-select">
                                <option value="" disabled selected>Register As</option>
                                <option value="Candidate">Candidate</option>
                                <option value="Employer">Employer</option>
                            </select>

                            <a href="javascript:void(0);" onclick="Register();">
                            <div class="sign-in">
                                Submit
                            </div></a>
                            <div class="dont-have">
                                <a href="#" data-toggle="modal" data-target="#LogIn" data-dismiss="modal">Already have an account</a>
                            </div>
                        </form>
                    </div>
                </div><!--/.login-content-->

            </div>
        </div>
        <!-- Register Ends -->








<!-- password -->
        <div class="modal fade login" id="forgotpass" role="dialog">
            <div class="modal-dialog login-dialog">

                <div class="login-content">
                    <div class="login-header">
                        <h3>Recover Password</h3>
                        <hr>
                    </div>
                    <div class="login-body">

                        <input type="text" name="fp_mobile" id="fp_mobile" class="login-form def-input" placeholder="Mobile">

                        <a href="javascript:void(0);" onclick="forgotPassword();">
                        <div class="sign-in">
                            Submit
                        </div></a>
                        <div class="dont-have">
                            <a href="#" data-toggle="modal" data-target="#LogIn" data-dismiss="modal">I know my password</a>
                        </div>
                        </form>
                    </div>
                </div><!--/.login-content-->

            </div>
        </div>
        <!-- Register Ends -->












    <!-- start header -->
    <header id="pageHeader" class="header navbar">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar" aria-expanded="false">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img alt="logo" src="assets/images/logo12.png" /></a>
            </div>
            <nav id="myNavbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#banner_slider">Home</a></li>
                    <li><a href="#about">What is FlexiHire?</a></li>
                    <li><a href="#services">Benifits</a></li>
                    <li><a href="#work">How it Works</a></li>
                    <li><a href="#pricing">Pricing</a></li>
                    <!--<li><a href="">Blogs</a></li>-->
                    <li><a class="login-mine" id="shrink_mine" href="#" data-toggle="modal" data-target="#LogIn">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- end header -->
    <!-- start section home -->
    <section id="banner_slider">
        
        <article class="content">
            
            <div id="rev_slider_24_1_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="website-intro" data-source="gallery">
                <div id="rev_slider_24_1" class="rev_slider fullscreenbanner tiny_bullet_slider" style="display:none;" data-version="5.4.1">
                    <ul>
                        <li data-index="rs-68" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="600" data-thumb="assets/img/content/slider/slide-3.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="" data-slicey_shadow="0px 0px 0px 0px transparent"><img src="assets/img/content/slider/slide-3.jpg" alt="" data-bgposition="center center" data-kenburns="on" data-duration="5000" data-ease="Power2.easeInOut" data-scalestart="100" data-scaleend="150" data-rotatestart="0" data-rotateend="0" data-blurstart="20" data-blurend="0" data-offsetstart="0 0" data-offsetend="0 0" class="rev-slidebg" data-no-retina>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-68-layer-9" data-x="['center','center','center','center']" data-hoffset="['-112','-43','-81','44']" data-y="['middle','middle','middle','middle']" data-voffset="['-219','-184','-185','182']" data-width="['250','250','150','150']" data-height="['150','150','100','100']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":300,"speed":1000,"frame":"0","from":"rX:0deg;rY:0deg;rZ:0deg;sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3700","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 5;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-68-layer-10" data-x="['center','center','center','center']" data-hoffset="['151','228','224','117']" data-y="['middle','middle','middle','middle']" data-voffset="['-212','-159','71','-222']" data-width="['150','150','100','100']" data-height="['200','150','150','150']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":350,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3650","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-68-layer-29" data-x="['center','center','center','center']" data-hoffset="['339','-442','104','-159']" data-y="['middle','middle','middle','middle']" data-voffset="['2','165','-172','219']" data-width="['250','250','150','150']" data-height="['150','150','100','100']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":400,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3600","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-68-layer-12" data-x="['center','center','center','center']" data-hoffset="['162','216','-239','193']" data-y="['middle','middle','middle','middle']" data-voffset="['195','245','6','146']" data-width="['250','250','100','100']" data-height="150" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":450,"speed":1000,"frame":"0","from":"opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3550","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 8;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-68-layer-34" data-x="['center','center','center','center']" data-hoffset="['-186','-119','273','-223']" data-y="['middle','middle','middle','middle']" data-voffset="['269','217','-121','69']" data-width="['300','300','150','150']" data-height="['200','200','150','150']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":500,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3500","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 9;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-68-layer-11" data-x="['center','center','center','center']" data-hoffset="['-325','292','162','-34']" data-y="['middle','middle','middle','middle']" data-voffset="['3','55','-275','-174']" data-width="150" data-height="['250','150','50','50']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":550,"speed":1000,"frame":"0","from":"opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3450","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 10;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-68-layer-27" data-x="['center','center','center','center']" data-hoffset="['-429','523','-190','-306']" data-y="['middle','middle','middle','middle']" data-voffset="['-327','173','181','480']" data-width="['250','250','150','150']" data-height="['300','300','150','150']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":320,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3680","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 11;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-68-layer-28" data-x="['center','center','center','center']" data-hoffset="['422','-409','208','225']" data-y="['middle','middle','middle','middle']" data-voffset="['-245','-72','294','-14']" data-width="['300','300','150','150']" data-height="['250','250','100','100']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":360,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3640","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 12;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-68-layer-30" data-x="['center','center','center','center']" data-hoffset="['549','-445','28','58']" data-y="['middle','middle','middle','middle']" data-voffset="['236','400','316','287']" data-width="['300','300','150','200']" data-height="['250','250','150','50']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":400,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3600","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 13;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-68-layer-31" data-x="['center','center','center','center']" data-hoffset="['-522','492','-151','262']" data-y="['middle','middle','middle','middle']" data-voffset="['339','-180','330','-141']" data-width="['300','300','150','150']" data-height="['250','250','100','100']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":440,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3560","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 14;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-68-layer-32" data-x="['center','center','center','center']" data-hoffset="['-588','-375','-253','-207']" data-y="['middle','middle','middle','middle']" data-voffset="['72','-328','-172','-111']" data-width="['300','300','150','150']" data-height="['200','200','150','150']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":480,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3520","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 15;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-68-layer-33" data-x="['center','center','center','center']" data-hoffset="['-37','73','-76','-100']" data-y="['middle','middle','middle','middle']" data-voffset="['-401','-340','-293','-246']" data-width="['450','400','250','250']" data-height="['100','100','50','50']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":310,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3690","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 16;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-68-layer-35" data-x="['center','center','center','center']" data-hoffset="['186','38','116','17']" data-y="['middle','middle','middle','middle']" data-voffset="['363','402','190','395']" data-width="['350','400','250','250']" data-height="['100','100','50','50']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":340,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3660","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 17;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper " id="slide-68-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-width="full" data-height="full" data-whitespace="nowrap" data-type="shape" data-basealign="slide" data-responsive_offset="off" data-responsive="off" data-frames='[{"delay":10,"speed":500,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"wait","speed":500,"frame":"999","to":"opacity:0;","ease":"Power4.easeOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 18;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption revolution-btn tp-resizeme" id="slide-68-layer-2" data-x="['center','center','center','center']" data-hoffset="['1','1','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-70','-70','-70','-70']" data-fontsize="['90','90','70','50']" data-lineheight="['90','90','70','50']" data-width="['none','none','481','360']" data-height="none" data-whitespace="['nowrap','nowrap','normal','normal']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:0.9;sY:0.9;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"sX:0.9;sY:0.9;opacity:0;fb:20px;","ease":"Power3.easeInOut"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]">Candidates</div>
                            <div class="tp-caption revolution-btn-2 tp-resizeme" id="slide-68-layer-3" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['90','90','60','30']" data-fontsize="['25','25','25','20']" data-lineheight="['35','35','35','30']" data-width="['480','480','480','360']" data-height="none" data-whitespace="normal" data-type="text" data-responsive_offset="on" data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:0.9;sY:0.9;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"sX:0.9;sY:0.9;opacity:0;fb:20px;","ease":"Power3.easeInOut"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]">Work whenever and wherever You want.... </div><a class="revolution-btn button-md primary-button tp-caption rev-btn revolution-btn tp-resizeme" href="#" id="slide-68-layer-7" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['200','200','160','120']" data-width="250" data-height="none" data-whitespace="nowrap" data-type="button" data-actions='' data-responsive_offset="on" data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:0.9;sY:0.9;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"sX:0.9;sY:0.9;opacity:0;fb:20px;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"0","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;fb:0;","style":"c:rgba(255,255,255,1);bs:solid;bw:0 0 0 0;"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[50,50,50,50]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[50,50,50,50]">LEARN MORE</a></li>


                        
                        <li data-index="rs-66" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="600" data-thumb="assets/img/content/slider/slide-2.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="" data-slicey_shadow="0px 0px 0px 0px transparent"><img src="assets/img/content/slider/slide-2.jpg" alt="" data-bgposition="center center" data-kenburns="on" data-duration="5000" data-ease="Power2.easeInOut" data-scalestart="100" data-scaleend="150" data-rotatestart="0" data-rotateend="0" data-blurstart="20" data-blurend="0" data-offsetstart="0 0" data-offsetend="0 0" class="rev-slidebg" data-no-retina>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-66-layer-9" data-x="['center','center','center','center']" data-hoffset="['-112','-43','-81','44']" data-y="['middle','middle','middle','middle']" data-voffset="['-219','-184','-185','182']" data-width="['250','250','150','150']" data-height="['150','150','100','100']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":300,"speed":1000,"frame":"0","from":"rX:0deg;rY:0deg;rZ:0deg;sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3700","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 5;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-66-layer-10" data-x="['center','center','center','center']" data-hoffset="['151','228','224','117']" data-y="['middle','middle','middle','middle']" data-voffset="['-212','-159','71','-222']" data-width="['150','150','100','100']" data-height="['200','150','150','150']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":350,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3650","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-66-layer-29" data-x="['center','center','center','center']" data-hoffset="['339','-442','104','-159']" data-y="['middle','middle','middle','middle']" data-voffset="['2','165','-172','219']" data-width="['250','250','150','150']" data-height="['150','150','100','100']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":400,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3600","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-66-layer-12" data-x="['center','center','center','center']" data-hoffset="['162','216','-239','193']" data-y="['middle','middle','middle','middle']" data-voffset="['195','245','6','146']" data-width="['250','250','100','100']" data-height="150" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":450,"speed":1000,"frame":"0","from":"opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3550","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 8;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-66-layer-34" data-x="['center','center','center','center']" data-hoffset="['-186','-119','273','-223']" data-y="['middle','middle','middle','middle']" data-voffset="['269','217','-121','69']" data-width="['300','300','150','150']" data-height="['200','200','150','150']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":500,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3500","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 9;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-66-layer-11" data-x="['center','center','center','center']" data-hoffset="['-325','292','162','-34']" data-y="['middle','middle','middle','middle']" data-voffset="['3','55','-275','-174']" data-width="150" data-height="['250','150','50','50']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":550,"speed":1000,"frame":"0","from":"opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3450","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 10;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-66-layer-27" data-x="['center','center','center','center']" data-hoffset="['-429','523','-190','-306']" data-y="['middle','middle','middle','middle']" data-voffset="['-327','173','181','480']" data-width="['250','250','150','150']" data-height="['300','300','150','150']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":320,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3680","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 11;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-66-layer-28" data-x="['center','center','center','center']" data-hoffset="['422','-409','208','225']" data-y="['middle','middle','middle','middle']" data-voffset="['-245','-72','294','-14']" data-width="['300','300','150','150']" data-height="['250','250','100','100']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":360,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3640","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 12;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-66-layer-30" data-x="['center','center','center','center']" data-hoffset="['549','-445','28','58']" data-y="['middle','middle','middle','middle']" data-voffset="['236','400','316','287']" data-width="['300','300','150','200']" data-height="['250','250','150','50']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":400,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3600","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 13;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-66-layer-31" data-x="['center','center','center','center']" data-hoffset="['-522','492','-151','262']" data-y="['middle','middle','middle','middle']" data-voffset="['339','-180','330','-141']" data-width="['300','300','150','150']" data-height="['250','250','100','100']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":440,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3560","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 14;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-66-layer-32" data-x="['center','center','center','center']" data-hoffset="['-588','-375','-253','-207']" data-y="['middle','middle','middle','middle']" data-voffset="['72','-328','-172','-111']" data-width="['300','300','150','150']" data-height="['200','200','150','150']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":480,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3520","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 15;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-66-layer-33" data-x="['center','center','center','center']" data-hoffset="['-37','73','-76','-100']" data-y="['middle','middle','middle','middle']" data-voffset="['-401','-340','-293','-246']" data-width="['450','400','250','250']" data-height="['100','100','50','50']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":310,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3690","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 16;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-66-layer-35" data-x="['center','center','center','center']" data-hoffset="['186','38','116','17']" data-y="['middle','middle','middle','middle']" data-voffset="['363','402','190','395']" data-width="['350','400','250','250']" data-height="['100','100','50','50']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":340,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3660","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 17;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper " id="slide-66-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-width="full" data-height="full" data-whitespace="nowrap" data-type="shape" data-basealign="slide" data-responsive_offset="off" data-responsive="off" data-frames='[{"delay":10,"speed":500,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"wait","speed":500,"frame":"999","to":"opacity:0;","ease":"Power4.easeOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 18;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption revolution-btn tp-resizeme" id="slide-66-layer-2" data-x="['center','center','center','center']" data-hoffset="['1','1','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-70','-70','-70','-70']" data-fontsize="['90','90','70','50']" data-lineheight="['90','90','70','50']" data-width="['none','none','481','360']" data-height="none" data-whitespace="['nowrap','nowrap','normal','normal']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:0.9;sY:0.9;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"sX:0.9;sY:0.9;opacity:0;fb:20px;","ease":"Power3.easeInOut"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]">Employers</div>
                            <div class="tp-caption revolution-btn-2 tp-resizeme" id="slide-66-layer-3" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['90','90','60','30']" data-fontsize="['25','25','25','20']" data-lineheight="['35','35','35','30']" data-width="['480','480','480','360']" data-height="none" data-whitespace="normal" data-type="text" data-responsive_offset="on" data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:0.9;sY:0.9;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"sX:0.9;sY:0.9;opacity:0;fb:20px;","ease":"Power3.easeInOut"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]">Get skilled professionals whenever and wherever you want.... </div><a class="revolution-btn button-md primary-button tp-caption revolution-btn tp-resizeme" href="#" id="slide-66-layer-7" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['200','200','160','120']" data-width="250" data-height="none" data-whitespace="nowrap" data-type="button" data-actions='' data-responsive_offset="on" data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:0.9;sY:0.9;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"sX:0.9;sY:0.9;opacity:0;fb:20px;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"0","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;fb:0;","style":"c:rgba(255,255,255,1);bs:solid;bw:0 0 0 0;"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[50,50,50,50]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[50,50,50,50]">DIVE RIGHT IN </a></li>
                        



                            <li data-index="rs-67" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="600" data-thumb="assets/img/content/slider/slide-1.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="" data-slicey_shadow="0px 0px 0px 0px transparent"><img src="assets/img/content/slider/slide-1.jpg" alt="" data-bgposition="center center" data-kenburns="on" data-duration="5000" data-ease="Power2.easeInOut" data-scalestart="100" data-scaleend="150" data-rotatestart="0" data-rotateend="0" data-blurstart="20" data-blurend="0" data-offsetstart="0 0" data-offsetend="0 0" class="rev-slidebg" data-no-retina>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-67-layer-9" data-x="['center','center','center','center']" data-hoffset="['-112','-43','-81','44']" data-y="['middle','middle','middle','middle']" data-voffset="['-219','-184','-185','182']" data-width="['250','250','150','150']" data-height="['150','150','100','100']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":300,"speed":1000,"frame":"0","from":"rX:0deg;rY:0deg;rZ:0deg;sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3700","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 5;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-67-layer-10" data-x="['center','center','center','center']" data-hoffset="['151','228','224','117']" data-y="['middle','middle','middle','middle']" data-voffset="['-212','-159','71','-222']" data-width="['150','150','100','100']" data-height="['200','150','150','150']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":350,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3650","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 6;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-67-layer-29" data-x="['center','center','center','center']" data-hoffset="['339','-442','104','-159']" data-y="['middle','middle','middle','middle']" data-voffset="['2','165','-172','219']" data-width="['250','250','150','150']" data-height="['150','150','100','100']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":400,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3600","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 7;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-67-layer-12" data-x="['center','center','center','center']" data-hoffset="['162','216','-239','193']" data-y="['middle','middle','middle','middle']" data-voffset="['195','245','6','146']" data-width="['250','250','100','100']" data-height="150" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":450,"speed":1000,"frame":"0","from":"opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3550","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 8;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-67-layer-34" data-x="['center','center','center','center']" data-hoffset="['-186','-119','273','-223']" data-y="['middle','middle','middle','middle']" data-voffset="['269','217','-121','69']" data-width="['300','300','150','150']" data-height="['200','200','150','150']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":500,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3500","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 9;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-67-layer-11" data-x="['center','center','center','center']" data-hoffset="['-325','292','162','-34']" data-y="['middle','middle','middle','middle']" data-voffset="['3','55','-275','-174']" data-width="150" data-height="['250','150','50','50']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":550,"speed":1000,"frame":"0","from":"opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3450","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 10;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-67-layer-27" data-x="['center','center','center','center']" data-hoffset="['-429','523','-190','-306']" data-y="['middle','middle','middle','middle']" data-voffset="['-327','173','181','480']" data-width="['250','250','150','150']" data-height="['300','300','150','150']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":320,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3680","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 11;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-67-layer-28" data-x="['center','center','center','center']" data-hoffset="['422','-409','208','225']" data-y="['middle','middle','middle','middle']" data-voffset="['-245','-72','294','-14']" data-width="['300','300','150','150']" data-height="['250','250','100','100']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":360,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3640","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 12;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-67-layer-30" data-x="['center','center','center','center']" data-hoffset="['549','-445','28','58']" data-y="['middle','middle','middle','middle']" data-voffset="['236','400','316','287']" data-width="['300','300','150','200']" data-height="['250','250','150','50']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":400,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3600","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 13;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-67-layer-31" data-x="['center','center','center','center']" data-hoffset="['-522','492','-151','262']" data-y="['middle','middle','middle','middle']" data-voffset="['339','-180','330','-141']" data-width="['300','300','150','150']" data-height="['250','250','100','100']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":440,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3560","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 14;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-67-layer-32" data-x="['center','center','center','center']" data-hoffset="['-588','-375','-253','-207']" data-y="['middle','middle','middle','middle']" data-voffset="['72','-328','-172','-111']" data-width="['300','300','150','150']" data-height="['200','200','150','150']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="300" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":480,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3520","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 15;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-67-layer-33" data-x="['center','center','center','center']" data-hoffset="['-37','73','-76','-100']" data-y="['middle','middle','middle','middle']" data-voffset="['-401','-340','-293','-246']" data-width="['450','400','250','250']" data-height="['100','100','50','50']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":310,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3690","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 16;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper tp-slicey tp-resizeme" id="slide-67-layer-35" data-x="['center','center','center','center']" data-hoffset="['186','38','116','17']" data-y="['middle','middle','middle','middle']" data-voffset="['363','402','190','395']" data-width="['350','400','250','250']" data-height="['100','100','50','50']" data-whitespace="nowrap" data-type="shape" data-slicey_offset="250" data-slicey_blurstart="0" data-slicey_blurend="20" data-responsive_offset="on" data-frames='[{"delay":340,"speed":1000,"frame":"0","from":"sX:1;sY:1;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"+3660","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 17;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption tp-shape tp-shapewrapper " id="slide-67-layer-1" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-width="full" data-height="full" data-whitespace="nowrap" data-type="shape" data-basealign="slide" data-responsive_offset="off" data-responsive="off" data-frames='[{"delay":10,"speed":500,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"wait","speed":500,"frame":"999","to":"opacity:0;","ease":"Power4.easeOut"}]' data-textAlign="['inherit','inherit','inherit','inherit']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 18;background-color:rgba(6, 34, 35, 0.7);"> </div>
                            <div class="tp-caption rev-slider-content tp-resizeme" id="slide-67-layer-2" data-x="['center','center','center','center']" data-hoffset="['1','1','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-70','-70','-70','-70']" data-fontsize="['90','90','70','50']" data-lineheight="['90','90','70','50']" data-width="['none','none','481','360']" data-height="none" data-whitespace="['nowrap','nowrap','normal','normal']" data-type="text" data-responsive_offset="on" data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:0.9;sY:0.9;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"sX:0.9;sY:0.9;opacity:0;fb:20px;","ease":"Power3.easeInOut"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]">Grow Together</div>
                            <div class="tp-caption revolution-btn-2 tp-resizeme" id="slide-67-layer-3" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['90','90','60','30']" data-fontsize="['25','25','25','20']" data-lineheight="['35','35','35','30']" data-width="['480','480','480','360']" data-height="none" data-whitespace="normal" data-type="text" data-responsive_offset="on" data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:0.9;sY:0.9;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"sX:0.9;sY:0.9;opacity:0;fb:20px;","ease":"Power3.easeInOut"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]">Be the master of your destiny.</div><!--<a class="revolution-btn button-md primary-button tp-caption rev-btn tp-resizeme" href="#" id="slide-67-layer-7" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['200','200','160','120']" data-width="250" data-height="none" data-whitespace="nowrap" data-type="button" data-actions='' data-responsive_offset="on" data-frames='[{"delay":1000,"speed":2000,"frame":"0","from":"sX:0.9;sY:0.9;opacity:0;fb:20px;","to":"o:1;fb:0;","ease":"Power3.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"sX:0.9;sY:0.9;opacity:0;fb:20px;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"0","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;fb:0;","style":"c:rgba(255,255,255,1);bs:solid;bw:0 0 0 0;"}]' data-textAlign="['center','center','center','center']" data-paddingtop="[0,0,0,0]" data-paddingright="[50,50,50,50]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[50,50,50,50]">GET STARTED </a>--></li>


                    </ul>
                    <div class="tp-bannertimer tp-bottom"></div>
                </div>
            </div>
        </article>
    </section>
    <!-- end section home -->
    <!-- start section about -->
    <section class="about" id="about">
        <div class="container">
            <p class="para">Words About Us</p>
            <!--<h1 class="heading"><span>What is</span> Flexi Hire?</h1>-->
            <div class="row">
                <div class="col-sm-6">
                    <div class="words wow fadeInLeft" data-wow-delay="0.8s">
                        <h2>What is Flexi Hire?</h2>
                        <p>FLEXIHIRE is a TRAIN-2-HIRE ECOSYSTEM which helps the young Indian identify his calling, skill-sets and get Trained by the best trainers, Ranked & Reviewed by Industry Representatives for Instant Hiring by Industry. </p>
                        <p>It aims to be a LAKSHYA DARSHAK & MARG DARSHAK for every Young Indian.</p>
                        
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="image wow fadeInRight" data-wow-delay="0.5s">
                        <img alt="about" src="assets/images/about.jpg" class="img-responsive center-block">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section about -->
    <!-- start section skills -->
    <section class="skills">
        <div class="col-md-6 back-div hidden-sm hidden-xs">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-6" style="padding:70px 15px 70px 30px">
                    <h1 class="heading">About Flexi Hire</h1>
                    <p>Good to see you here, looking forward to knowing who we are. We are catalysts of Change, obsessed with cause of</p>
                    <ul style="list-style-type: none;">
                        <li><i style="color: #085658;" class="fa fa-arrow-circle-right"></i>&nbsp;&nbsp;&nbsp;Enabling every young indian to find his calling,</li>
                        <li><i style="color: #085658;" class="fa fa-arrow-circle-right"></i>&nbsp;&nbsp;&nbsp;Blending Knowledge with Personality of every individual</li>
                        <li><i style="color: #085658;" class="fa fa-arrow-circle-right"></i>&nbsp;&nbsp;&nbsp;Impart Wisdom with Knowledge</li>
                        <li><i style="color: #085658;" class="fa fa-arrow-circle-right"></i>&nbsp;&nbsp;&nbsp;Earn Livelihood with values a Society needs.</li>
                    </ul>
                    <br>
                    <p>Because we believe that every person who finds his calling, is a CHAMPION and we are laying the FOUNDATION OF THE CHAMPIONS. </p>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- end section skills -->
    <!-- start section services -->
    <section class="services" id="services">
        <div class="container">
          
            <h1 style="color: #085658;" class="heading">BENIFITS</h1>
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="item">
                        <i class="fa fa-location-arrow"></i>
                        <h3>Call Tracking</h3>
                        <p>Scientific way to find your Calling</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="item">
                        <i class="fa fa-id-badge"></i>
                        <h3>Direct Job</h3>
                        <p>No CVs, No Interviews</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="item">
                        <i class="fa fa-gear"></i>
                        <h3>Get Trained</h3>
                        <p>Get Best Trainers & Mentors</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="item">
                        <i class="fa fa-briefcase"></i>
                        <h3>Work</h3>
                        <p>Choose your Work, love your family</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="item">
                        <i class="fa fa-user-secret"></i>
                        <h3>Boss</h3>
                        <p>Choose your Boss, No exploitation</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="item">
                        <i class="fa fa-rupee"></i>
                        <h3>Earn Money</h3>
                        <p>Start earning within few minutes</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section services -->
   
    
    <!-- start section facts -->
    <section class="facts">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="item">
                            <i class="fa fa-industry"></i>
                            <h4 class="counter">433</h4>
                            <p>Companies</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="item">
                            <i class="fa fa-users"></i>
                            <h4 class="counter">357</h4>
                            <p>Candidates</p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- end section facts -->
    <!-- start section work -->

    <section id="work" class="section-experience-education bgPrimaryColor">
       
        <h2 style="text-align: center;"><strong>How it Works</strong></h2>
        <ul class="timeline">
            <li>
                <div class="icon"><img src="assets/img/reg.svg" alt=""></div>
                <div class="animation-chain overflow-hidden" data-animation='fadeInLeft'>
                    <h3>Register</h3>
                    <h4>For Both Employer & Candidate</h4>
                    <div class="date">Register Yourself On Flexihire Portal</div>
                </div>
               
            </li>
            <li>
                <div class="icon"><img src="assets/img/suitcase.svg" alt=""></div>
                <div class="animation-chain overflow-hidden" data-animation='fadeInRight'>
                    <h3>Preferred Job</h3>
                    <h4>For Both Employer & Candidate</h4>
                    <div class="date">Enter Your Preferred Location</div>
                </div>
              
            </li>
            <li>
                <div class="icon"><img src="assets/img/cap.svg" alt=""></div>
                <div class="animation-chain overflow-hidden" data-animation='fadeInLeft'>
                    <h3>Preferred Skill</h3>
                    <h4>For Both Employer & Candidate</h4>
                    <div class="date">Enter Your Preferred Skill</div>
                </div>
            </li>
            <li>
                <div class="icon"><img src="assets/img/calendar.svg" alt=""></div>
                <div class="animation-chain overflow-hidden" data-animation='fadeInRight'>
                    <h3>Availability Period</h3>
                    <h4>For Both Employer & Candidate</h4>
                    <div class="date">Enter Your Availability Period</div>
                </div>
             
            </li>
            <li>
                <div class="icon"><img src="assets/img/rupee.svg" alt=""></div>
                <div class="animation-chain overflow-hidden" data-animation='fadeInLeft'>
                    <h3>Salary</h3>
                    <h4>For Both Employer & Candidate</h4>
                    <div class="date">Enter Amount For Salary(Employer) & Desired Salary(Candidate)</div>
                </div>
              
            </li>
            <li>
                <div class="icon"><img src="assets/img/agreement.svg" alt=""></div>
                <div class="animation-chain overflow-hidden" data-animation='fadeInRight'>
                    <h3>Hire</h3>
                    <h4>For Employer Only</h4>
                    <div class="date">Employer Can Choose Candidates From List And Hire Them.</div>
                </div>
            
            </li>


           
        </ul>
     
    </section>
    <!-- end section work -->
    <!--start section twitter -->
    <section class="hire-candidate">
        <div class="overlay">
            <div class="container">
                <p>HIRE CANDIDATES</p>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="contact-form">
                            <form name="searchfrm" action="index.php?action=search_candidates" method="post">
                                <div class="controls">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input id="" class="form-control" type="text" name="Pincode" placeholder="Pincode" >
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <select name="category" id="category" class="form-control">
                                                <option value="" selected disabled>Choose Category</option>
                                                <?php 
                                                for($i=0;$i<count($courseList);$i++){
                                                     echo "<option value='".$courseList[$i]['course_id']."'>".$courseList[$i]['course_name']."</option>";
                                                }
                                                ?>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="submit" value="Search">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--end section twitter -->
   
    <!--start section price -->
    <section class="price" id="pricing">
        <div class="container">
            <!--<p class="para">Packages</p>-->
            <h1 style="color:#085658;" class="heading">Our Prices</h1>
            <div class="row">
                <div class="col-sm-6">
                    <div class="item">
                        <center>
                            <div class="price-box">
                                <!--<p>Personal</p>-->
                                <span><strong>Personal</strong></span>
                            </div>
                            <p><i class="fa fa-check"></i> <strong>For 10 Hiring</strong></p>
                            <p><i class=""></i> 2.5% Service Charge on total amount + GST</p>
                            <p><i class="fa fa-check"></i> <strong>Afterward</strong></p>
                            <p><i class=""></i> 4% Service Charge on total amount + GST</p>
                            <!--<a href="#" class="a-btn">Order Now</a>-->
                        </center>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="item">
                        <center>
                            <div class="price-box">
                                <!--<p>Business</p>-->
                                <span><strong>Business</strong></span>
                            </div>
                            <p><i class="fa fa-check"></i> <strong>Contact Us</strong></p>
                            <p><i class=""></i> <strong>Email Us: </strong><a style="color:#02e4b6;" href="mailto:support@flexihire.co.in">support@flexihire.co.in</a></p>
                            <p><i class="fa fa-check"></i> <strong>Phone</strong></p>
                            <p><i class=""></i> (+91) 9711621353</p>
                            <!--<a href="#" class="a-btn">Order Now</a>-->
                        </center>
                    </div>
                </div>
                <!--<div class="col-sm-4">
                    <div class="item">
                        <div class="price-box">
                            <p>Business</p>
                            <span><strong>$99</strong> /mo</span>
                        </div>
                        <p><i class="fa fa-check"></i> 3 Users</p>
                        <p><i class="fa fa-check"></i> 2GB Space</p>
                        <p><i class="fa fa-check"></i> Supporting</p>
                        <p><i class="fa fa-check"></i> Well Documented</p>
                        <p><i class="fa fa-check"></i> 3 Accounts</p>
                        <p><i class="fa fa-check"></i> Free Updates</p>
                        <a href="#" class="a-btn">Order Now</a>
                    </div>
                </div>-->
            </div>
        </div>
    </section>
    <!--end section price -->
    <!-- start section video -->
    <!--<section class="video">
        <div class="overlay">
            <h2>Get ready to start your journey and watch our video.</h2>
            <a href="https://www.youtube.com/watch?v=uQBL7pSAXR8" data-lity>
                <i class="fa fa-play"></i>
            </a>
        </div>
    </section>-->
    <!-- end section video -->
    <!--start section blog -->
    <section class="blog">
        <div class="container">
            <!--<p class="para">Latest</p>-->
            <h1 style="color:#085658;" class="heading">Register Yourself</h1>
            <div class="row">
                <div class="col-md-6">
                    <div class="blog-area">
                        <div class="image">
                            <img alt="image" class="img-responsive" src="assets/images/man-job-interacting-executive-business_1098-6796.jpg">
                        </div>
                        <div class="box">
                            <a href="#"><h1 style="text-align: center;">Find Job Instantly</h1></a>
                            <!--<span><i class="fa fa-calendar"></i>12 July,2017</span>
                            <span><i class="fa fa-comment"></i>12 Comments</span>-->
                            <p style="text-align: center; padding: 20px; font-size: 17px;">Submit your profile Assigned to a Guru Get Recommended Get Hired</p>
                            <center>
                                <a href="#" class="a-btn">Register Now</a>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="blog-area">
                        <div class="image">
                            <img alt="image" class="img-responsive" src="assets/images/back202.jpg">
                        </div>
                        <div class="box">
                            <a href="#"><h1 style="text-align: center;">Find Staff Instantly</h1></a>
                            <!--<span><i class="fa fa-calendar"></i>12 July,2017</span>
                            <span><i class="fa fa-comment"></i>12 Comments</span>-->
                            <p style="text-align: center; padding: 20px; font-size: 17px;">Get Registered Get Nearby Champs Review Videos Hire Candidates</p>
                            <center>
                                <a href="#" class="a-btn">Register Now</a>
                            </center>
                        </div>
                    </div>
                </div>
                <!--<div class="col-md-4">
                    <div class="blog-area">
                        <div class="image">
                            <img alt="image" class="img-responsive" src="images/back.jpg">
                        </div>
                        <div class="box">
                            <a href="#"><h1>Qamer helps clients</h1></a>
                            <span><i class="fa fa-calendar"></i>12 July,2017</span>
                            <span><i class="fa fa-comment"></i>12 Comments</span>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                            <a href="#" class="a-btn">Read More</a>
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
    </section>
    <!--end section blog -->
    <!--start section purchase -->
    <section class="purchase">
        <div class="overlay">
            <div class="container">
                <div class="title">
                    <h1 style="color: #fff;">Have A <span> <strong>Question?</strong></span></h1>
                    <p style="color: #fff; font-size: 14px;">We're here to help! Check out FAQs.</p>
                    <a target="_blank" href="faq.html" class="a-btn">Go To FAQs</a>

                    <p style="font-size: 14px; margin-top:20px;">
                        <a style="color: #fff;" target="_blank" href="privacy-policy.html">Privacy Policy </a> | <a target="_blank" style="color: #fff;" href="refund-policy.html">Refund Plocy </a> | <a target="_blank" style="color: #fff;" href="termsandcondition.html">Terms & Conditions </a></p>
                </div>

                

            </div>
        </div>
    </section>
    <!--end section purchase -->
    
    <div class="social-icon-div">
        <div class="container">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-google-plus"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
            <p>Copyright © 2017 FLEXIHIRE, All Rights Reserved.</p>
        </div>
    </div>
    <!-- Start Scroll To Top -->
    <div id="scroll-top">
        <i class="fa fa-angle-up"></i>
    </div>
    <!-- end Scroll To Top -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/waypoints.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/typed.js"></script>
    <script src="assets/js/validator.js"></script>
    <script src="assets/js/lity.min.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/imagesloaded.pkgd.min.js"></script>

    <script src="assets/js/jquery.textillate.js"></script>
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <script src="assets/js/revolution/jquery.themepunch.tools.min.js"></script>
    <script src="assets/js/revolution/jquery.themepunch.revolution.min.js"></script>
    <script src='assets/js/revolution/revolution.addon.slicey.min8a54.js?ver=1.0.0'></script>
    <script src="assets/js/revolution/revolution.extension.actions.min.js"></script>
    <script src="assets/js/revolution/revolution.extension.kenburn.min.js"></script>
    <script src="assets/js/revolution/revolution.extension.layeranimation.min.js"></script>
    <script src="assets/js/revolution/revolution.extension.migration.min.js"></script>
    <script src="assets/js/revolution/revolution.extension.slideanims.min.js"></script>

    <script src="assets/js/main.js"></script>
    <script src="assets/js/main1.js"></script>
    <script>
    new WOW().init();
    </script>
</body>

</html>