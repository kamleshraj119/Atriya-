<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <!-- IE Compatibility Meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- First Mobile Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flexi Hire</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css" />
    <link rel="stylesheet" href="assets/css/lity.min.css" />
    <link rel="stylesheet" href="assets/css/animate.css" />
    <link rel="stylesheet" href="assets/css/lightbox.css" />
    <link rel="stylesheet" href="assets/css/red_style.css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/media.css" />
    <script type="text/javascript" src="assets/js/flexi.js"></script>
    <script src="assets/js/ajax.js"></script>
    <script src="assets/js/sha512.js"></script>
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
    <header style="background:url(assets/images/bg.jpg);" id="pageHeader" class="header navbar">
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

                    <li><a class="login-mine" id="shrink_mine" style="width: 120px;" href="index.php?action=register-candidate">I Need Job</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- end header -->

<br>
<br>
<br>
<br>
<br>
<br>



		<!-- Banner Grey Starts -->
		<section class="banner-grey" style="margin-top:-50px;">
			<div class="container sec-hq-pad-t sec-hq-pad-b">
				<h2 style="color: #085658;">Employer Registration</h2>
			</div>
		</section>
		<!-- Banner Grey Ends -->
		

		<!-- Resume Form -->

		<section class="resume-form sec-hq-pad-t sec-hq-pad-b animated wow fadeIn" data-wow-delay="0.2s" style="background-color:#f8fbfd; padding: 100px 0px 150px 0px; margin-bottom: -65px;">

            <div class="form-content">
                <div class="container">

                    <form name="regdfrm" action="index.php?action=save_employer_registration" class="form-horizontal" method="post">

                        <div class="personal-data col-md-4 d-shadow">

                            <div class="col-md-12 col-sm-12 no-padding ">
                                <div class="col-md-12 col-sm-12" >
                                    <div class="form-group">

                                        <div class="col-md-12">
                                            <input type="text" class="def-input" name="name" id="name" placeholder="Contact Person*" maxlength="50">
                                        </div>
                                    </div>

                                    <div class="form-group">

                                        <div class="col-md-12">
                                            <input type="text" class="def-input" name="company_name" id="company_name" placeholder="Company*" maxlength="100">
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <div class="col-md-12">
                                            <input type="text" class="def-input" name="phone" id="phone" placeholder="Mobile No*">
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <div class="col-md-12">
                                            <input type="text" class="def-input" name="email" id="email" placeholder="Email Id*">
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <div class="col-md-12">
                                            <input type="text" class="def-input" name="pincode" id="pincode" placeholder="Location-Pincode*">
                                        </div>
                                    </div>

                                    <input type="checkbox" name="terms" id="terms" placeholder=""/>
                                    I have read and understand this agreement, and i accept and agree to all of its terms and condition. I enter into this agreement voluntarily, with full knowledge of its effect. <a href="./templates/terms-us-conditions.html" target="_blank " style='color: #1f3a93'>Terms and condition</a>
                                    </br>
                                    </br>

                                    <div class="form-group">
                                        <div class="col-md-4 sec-h-pad-t text-left" style=" padding-top:5px;">
                                            <a href="javascript:void(0);" class="register_mine" onclick="validateEmployer()">Register</a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div><!--/.personal-data -->

                        <div class="personal-data col-md-4 hiw">

                            <h2 class="frm-hiw" >How it Works</h2>
                            <img src="assets/images/hiw_employer.png" >
                        </div>

                    </form>
                </div><!--/.container -->
            </div><!--/.form-content -->

        </section>
		<!-- Resume Form Ends -->


<br>
<br>
<br>


    <!-- end section contact -->
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
    {literal}
    <!-- end Scroll To Top -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/particles.js"></script>
    <script src="assets/js/app.js"></script>
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

<script src="assets/js/main.js"></script>
    <script>
    new WOW().init();
    </script>

{/literal}

</body>
</html>