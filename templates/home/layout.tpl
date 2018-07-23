<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta content="IE=edge" http-equiv="X-UA-Compatible">
		<meta content="width=device-width, initial-scale=1" name="viewport">
		<meta content="SkillChamps " name="description">
		<meta content="SkillChamps" name="author">

		<link rel="shortcut icon" href="assets/images/favicon/favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" href="assets/images/favicon/apple-touch-icon.png" />

		<title>SkillChamps</title>

		<!--Bootstrap-->
		<link href="assets/stylesheets/css/bootstrap.css" rel="stylesheet">

		<!--Font Style-->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,400italic,300italic" rel="stylesheet" type="text/css">
		<link href='https://fonts.googleapis.com/css?family=Montserrat:200,300,500,700' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Lato:700' rel='stylesheet' type='text/css'>
		<link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500" rel="stylesheet">

		<!-- font-awesome.css -->
		<link href="assets/stylesheets/css/fontawesome/font-awesome.css" rel="stylesheet">

		<!--JQuery-->

		<script src="assets/javascripts/jquery.min.js"></script>

		<!-- Slick -->
		<link href="assets/stylesheets/css/slick/slick.css" rel="stylesheet">
		<link href="assets/stylesheets/css/slick/slick-theme.css" rel="stylesheet">

		<!-- animate.css -->
		<link href="assets/stylesheets/css/animate.css" rel="stylesheet">

		<!-- pe-icon.css -->
		<link href="assets/stylesheets/css/pe-icon-7-stroke/pe-icon-7-stroke.css" rel="stylesheet">
		<link href="assets/stylesheets/css/pe-icon-7-stroke/helper.css" rel="stylesheet">

		<!-- animate.css -->
		<link href="assets/stylesheets/css/animate.css" rel="stylesheet">

		<!-- User Defined Style -->
		<link href="assets/stylesheets/css/components.css" rel="stylesheet">
		<script src="assets/javascripts/skillchamps.js"></script>
		<script src="assets/javascripts/ajax.js"></script>
		<script src="assets/javascripts/sha512.js"></script>

		<script>
			$(document).ready(function() {
				// Add smooth scrolling to all links
				$("a").on('click', function(event) {

					// Make sure this.hash has a value before overriding default behavior
					if (this.hash !== "") {
						// Prevent default anchor click behavior
						event.preventDefault();

						// Store hash
						var hash = this.hash;

						// Using jQuery's animate() method to add smooth page scroll
						// The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
						$('html, body').animate({
							scrollTop : $(hash).offset().top
						}, 800, function() {

							// Add hash (#) to URL when done scrolling (default click behavior)
							window.location.hash = hash;
						});
					} // End if
				});
			});
		</script>
		<script>
			(function(i, s, o, g, r, a, m) {
				i['GoogleAnalyticsObject'] = r;
				i[r] = i[r] ||
				function() {
					(i[r].q = i[r].q || []).push(arguments)
				}, i[r].l = 1 * new Date();
				a = s.createElement(o),
				m = s.getElementsByTagName(o)[0];
				a.async = 1;
				a.src = g;
				m.parentNode.insertBefore(a, m)
			})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

			ga('create', 'UA-107038257-1', 'auto');
			ga('send', 'pageview');
		</script>
		
	</head>

	<body>
		<div class="preloader">
			<div class="image-container">
				<div class="image"><img src="assets/images/preloader.gif" alt="">
				</div>
			</div>
		</div>
		<div class="container" id="home">
			<!-- Navbar Start -->
			<nav class="navbar navbar-inverse navbar-fixed-top">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#home"></a>
					</div><!--/.navbar-header -->
					<div class="collapse navbar-collapse" id="navbar">
						<ul class="nav navbar-nav navbar-right">
							<li >
								<a href="#about" >What is SkillChamps? </a>

							</li>
							<li>
								<a href="#benifit">Benefits</a>

							</li>
							<li >
								<a href="#hiw" >How It Works </a>

							</li>
							<li >
								<a href="#search" >Hire Champs </a>

							</li>

							<li >
								<a target="_blank" href="pricing.html" >Pricing</a>

							</li>
							
							<li >
								
								<a href="index.php?action=Frontblog"  target="_blank">Blogs </a>

							</li>

							<li>
								<a href="#" class="register" data-toggle="modal" data-target="#LogIn">Login</a>
							</li>
						</ul>
					</div><!--/ Collapse -->
				</div>
			</nav>
		</div>
		<!-- Navbar Ends -->

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
								<option value="SkillMitra">Skill Mitra</option>
								<option value="Employer">Employer</option>
								<option value="Guru">Guru</option>
								<option value="Trainee">Trainee</option>
								<option value="TrainingCenter">Training Center</option>

							</select>
							<input type="text" name="username" id="username" class="login-form def-input" placeholder="Mobile	">
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
								<option value="SkillMitra">SkillMitra</option>
								<option value="Employer">Employer</option>
								<option value="Guru">Guru</option>
								<option value="Trainee">Trainee</option>
								<option value="TrainingCenter">Training Center</option>
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

		<!-- Banner Starts -->
		<section class="banner carousel slide" id="banner-carousel">

			<ol class="carousel-indicators">
				<li data-target="#banner-carousel" data-slide-to="0" class="active"></li>
				<li data-target="#banner-carousel" data-slide-to="1"></li>
				<li data-target="#banner-carousel" data-slide-to="2"></li>
				<li data-target="#banner-carousel" data-slide-to="3"></li>
			</ol>
			<div class="carousel-inner">
				<div class="item active" style="background:url(assets/images/banner-1.jpg); background-size:cover; background-attachment: fixed;">
					<div class="overlay"></div>
					<div class="container">
						<div class="content-wrap valign-wrap">
							<div class="content valign-middle" style="padding-top:30%;">
								<div class="text-content col-md-8 col-md-offset-2 col-xs-12">
									<div class="heading resp-heading animated fadeInUp wow" data-wow-delay="0.7">
										<h1 style="line-height:50px;"><span style="font-weight:200">Start Your</span> Dream Career</h1>
									</div>
									<div class="banner-description animated fadeInUp wow" data-wow-delay="1.7">
										<p class="resp-para">
											SKILLCHAMPS brings the Best TRAINERS, MENTORS & EMPLOYERS to you
										</p>
									</div>
									<div class="button-wrap animated fadeInUp wow" data-wow-delay="2.2">

										<a href="index.php?action=register-trainee" class="resp-btn-mine def-btn btn-bg-blue">I NEED TRAINING </a>&nbsp;&nbsp; <a href="index.php?action=register-candidate" class="resp-btn-mine def-btn btn-bg-yellow">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I NEED JOB &nbsp;&nbsp; &nbsp;&nbsp;</a>&nbsp;&nbsp; <a href="index.php?action=register-employer" class="resp-btn-mine def-btn btn-bg-orange">&nbsp;&nbsp;&nbsp;I NEED STAFF&nbsp;&nbsp; &nbsp;</a>
										<br>
										<br>

									</div>
									
									<div class="button-wrap animated fadeInUp wow" data-wow-delay="2.2">

										<a href="">
											<img class="resp-zc" style="width: 100px;" alt="" src="assets/images/zellar.png"/>
										</a>&nbsp;&nbsp; 
										
										<a class="resp-zel" href="" style="color:#fff; 
											margin-left: -40px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Powered by: Zellar Consultants &nbsp;&nbsp; &nbsp;&nbsp;
										</a>
										
										<br>
										<br>

									</div>
								</div>
							</div>
						</div>
						<!--/ Content Wrap -->
					</div>
					<!--/ Container -->
				</div>
				<!--/ Item -->

				<div class="item" style="background:url(assets/images/banner-2.jpg); background-size:cover; background-attachment: fixed;">
					<div class="overlay"></div>
					<div class="container">
						<div class="content-wrap valign-wrap">
							<div class="content valign-middle" style="padding-top:30%;">
								<div class="text-content col-md-8 col-md-offset-2 col-xs-12 ">
									<div class="heading resp-heading animated fadeInUp wow" data-wow-delay="0.7">
										<h1 class="" style="line-height:50px;"><span style="font-weight:200">Meet Your</span> Skill Mitra</h1>
									</div>
									<div class="banner-description animated fadeInUp wow" data-wow-delay="1.7">
										<p class="resp-para">
											Your FRIEND, GUIDE & ANYTIME GO-TO MAN
										</p>
									</div>
									<div class="button-wrap animated fadeInUp wow" data-wow-delay="2.2">

										<a href="index.php?action=register-trainee" class="resp-btn-mine def-btn btn-bg-blue">I NEED TRAINING </a>&nbsp;&nbsp; <a href="index.php?action=register-candidate" class="resp-btn-mine def-btn btn-bg-yellow">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I NEED JOB &nbsp;&nbsp; &nbsp;&nbsp;</a>&nbsp;&nbsp; <a href="index.php?action=register-employer" class="resp-btn-mine def-btn btn-bg-orange">&nbsp;&nbsp;&nbsp;I NEED STAFF&nbsp;&nbsp; &nbsp;</a>
										<br>
										<br>

									</div>
									
									<div class="button-wrap animated fadeInUp wow" data-wow-delay="2.2">

										<a href="">
											<img class="resp-zc" style="width: 100px;" alt="" src="assets/images/zellar.png"/>
										</a>&nbsp;&nbsp; 
										
										<a class="resp-zel" href="" style="color:#fff; 
											margin-left: -40px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Powered by: Zellar Consultants &nbsp;&nbsp; &nbsp;&nbsp;
										</a>
										
										<br>
										<br>

									</div>
										
								</div>
							</div>
						</div>
						<!--/ Content Wrap -->
					</div>
					<!--/ Container -->
				</div>
				<!--/ Item -->

				<div class="item" style="background:url(assets/images/banner-3.jpg); background-size:cover; background-attachment: fixed;">
					<div class="overlay"></div>
					<div class="container">
						<div class="content-wrap valign-wrap">
							<div class="content valign-middle" style="padding-top:30%;">
								<div class="text-content col-md-8 col-md-offset-2 col-xs-12">
									<div class="heading resp-heading animated fadeInUp wow" data-wow-delay="0.7">
										<h1 style="line-height:50px;"><span style="font-weight:200">BE BLESSED BY </span>GURUS</h1>
									</div>
									<div class="banner-description animated fadeInUp wow" data-wow-delay="1.7">
										<p class="resp-para">
											GET RATED, REVIEWED & RECOMMENDED By the BEST in the INDUSTRY
										</p>
									</div>
									<div class="button-wrap animated fadeInUp wow" data-wow-delay="2.2">
										<a href="index.php?action=register-trainee" class="resp-btn-mine def-btn btn-bg-blue">I NEED TRAINING </a>&nbsp;&nbsp; <a href="index.php?action=register-candidate" class="resp-btn-mine def-btn btn-bg-yellow">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I NEED JOB &nbsp;&nbsp; &nbsp;&nbsp;</a>&nbsp;&nbsp; <a href="index.php?action=register-employer" class="resp-btn-mine def-btn btn-bg-orange">&nbsp;&nbsp;&nbsp;I NEED STAFF&nbsp;&nbsp; &nbsp;</a>
										<br>
										<br>

									</div>
									
									<div class="button-wrap animated fadeInUp wow" data-wow-delay="2.2">

										<a href="">
											<img class="resp-zc" style="width: 100px;" alt="" src="assets/images/zellar.png"/>
										</a>&nbsp;&nbsp; 
										
										<a class="resp-zel" href="" style="color:#fff; 
											margin-left: -40px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Powered by: Zellar Consultants &nbsp;&nbsp; &nbsp;&nbsp;
										</a>
										
										<br>
										<br>

									</div>
										
								</div>
							</div>
						</div>
						<!--/ Content Wrap -->
					</div>
					<!--/ Container -->
				</div>
				<!--/ Item -->

				<div class="item" style="background:url(assets/images/banner-4.jpg); background-size:cover; background-attachment: fixed;">
					<div class="overlay"></div>
					<div class="container">
						<div class="content-wrap valign-wrap">
							<div class="content valign-middle" style="padding-top:30%;">
								<div class="text-content col-md-8 col-md-offset-2 col-xs-12">
									<div class="heading resp-heading animated fadeInUp wow" data-wow-delay="0.7">
										<h1 style="line-height:50px;"><span style="font-weight:200">BE A CHAMP,</span> GET HIRED</h1>
									</div>
									<div class="banner-description animated fadeInUp wow" data-wow-delay="1.7">
										<p class="resp-para">
											No Applications, No CVs, No Interviews, INSTANT HIRE
										</p>
									</div>
									<div class="button-wrap animated fadeInUp wow" data-wow-delay="2.2">

										<a href="index.php?action=register-trainee" class="resp-btn-mine def-btn btn-bg-blue">I NEED TRAINING </a>&nbsp;&nbsp; <a href="index.php?action=register-candidate" class="resp-btn-mine def-btn btn-bg-yellow">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I NEED JOB &nbsp;&nbsp; &nbsp;&nbsp;</a>&nbsp;&nbsp; <a href="index.php?action=register-employer" class="resp-btn-mine def-btn btn-bg-orange">&nbsp;&nbsp;&nbsp;I NEED STAFF&nbsp;&nbsp; &nbsp;</a>
										<br>
										<br>

									</div>
									
									<div class="button-wrap animated fadeInUp wow" data-wow-delay="2.2">

										<a href="">
											<img class="resp-zc" style="width: 100px;" alt="" src="assets/images/zellar.png"/>
										</a>&nbsp;&nbsp; 
										
										<a class="resp-zel" href="" style="color:#fff; 
											margin-left: -40px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Powered by: Zellar Consultants &nbsp;&nbsp; &nbsp;&nbsp;
										</a>
										
										<br>
										<br>

									</div>
										
								</div>
							</div>
						</div>
						<!--/ Content Wrap -->
					</div>
					<!--/ Container -->
				</div>
				<!--/ Item -->

			</div>
			<!--/ Carousel Inner -->

			<!-- Controls -->
			<a class="left carousel-control" href="#banner-carousel" role="button" data-slide="prev">
			<div class="control left">
				<div class="shape">
					<i class="fa fa-angle-left"></i>
				</div>
			</div> </a>
			<a class="right carousel-control" href="#banner-carousel" role="button" data-slide="next">
			<div class="control right">
				<div class="shape">
					<i class="fa fa-angle-right"></i>
				</div>
			</div> </a>

		</section><!--/.banner-->
		<!--/ Banner Ends -->

		<!-- Learning Solution Starts -->
		<section class="learning-solution " id="about" style="padding-top:80px;">
			<div class="container sec-pad" >

				<div class="col-md-12 col-sm-12 learning-solution-item wow animated fadeIn" data-wow-delay="0.3s"  >

					<h1 class="resp-h-cont"><span style="font-weight:300">WHAT IS </span>SKILLCHAMPS? </h1>
					<p>
						SKILLCHAMPS is a TRAIN-2-HIRE ECOSYSTEM which helps the young Indian identify his calling, skill-sets and get Trained by the best trainers, Ranked & Reviewed by Industry Representatives for Instant Hiring by Industry.
						<br>
						<br>
						It aims to be a LAKSHYA DARSHAK & MARG DARSHAK for every Young Indian.
					</p>

					<div class="sec-h-pad-b"></div>
				</div><!--/.learning-solution-item-->

			</div>

		</section><!--/.learning-solution-->
		<!-- Learning Solution Ends -->

		<!-- About Us Starts -->
		<section class="about-us" style="background:url('assets/images/about-us.jpg') center; background-size: cover;">
			<div class="overlay-about-us"></div>
			<div class="container sec-pad">
				<div class="col-md-7 col-sm-7">
					<div class="content">
						<div class="title-underlined animated wow fadeInLeft" data-wow-delay="0s">
							<h2>About</h2>
						</div>
						<p class="animated wow fadeInLeft" data-wow-delay="0s">
							Good to see you here, looking forward to knowing who we are.

							We are catalysts of Change, obsessed with cause of
							<br>
							<br>

							&raquo;&nbsp; &nbsp;Enabling every young indian to find his calling,
							<br>

							&raquo;&nbsp; &nbsp;	Blending Knowledge with Personality of every individual
							<br>

							&raquo;&nbsp; &nbsp;	Impart Wisdom with Knowledge
							<br>

							&raquo;&nbsp; &nbsp;	Earn Livelihood with values a Society needs.
							<br>
							<br>

							Because we believe that every person who finds his calling, is a CHAMPION and we are laying the FOUNDATION OF THE CHAMPIONS.
						</p>
						<div class="sec-h-pad-t"></div>

					</div>
				</div>
			</div>
		</section><!--/.about-us-->
		<!-- About Us Ends -->

		<!-- Testimonials 1 Starts -->

		<!-- Testimonials 1 Ends -->
		<!-- Job Counter Starts -->
		<section class="job-counter">
			<div class="container">
				<div class="counter-wrap sec-pad col-md-12 col-sm-12 col-xs-12">
					<div class="counter-column col-md-3 col-sm-3 text-center animated wow fadeIn" data-wow-delay="0s">
						<div class="icon">
							<i class="pe-7s-culture pe-2x"></i>
						</div>
						<div class="separator"></div>
						{assign var=e value=$DATA[0].emp+25}
						<div class="counter-number" data-to="{$e}" data-speed="3000" data-from="0"></div>
						<div class="bottom-text">
							Companies
						</div>
					</div><!--/.counter-column -->
					<!--<div class="counter-column col-md-3 col-sm-3 text-center animated wow fadeIn" data-wow-delay="0.2s">
					<div class="icon">
					<i class="pe-7s-id pe-2x"></i>
					</div>
					<div class="separator"></div>
					<div class="counter-number" data-to="8000" data-speed="3000" data-from="0"></div>
					<div class="bottom-text">
					Jobs
					</div>
					</div><!--/.counter-column -->
					<div class="counter-column col-md-3 col-sm-3 text-center animated wow fadeIn" data-wow-delay="0.4s">
						<div class="icon">
							<i class="pe-7s-user pe-2x"></i>
						</div>
						<div class="separator"></div>
						{assign var=c value=$DATA[0].c+2000}
						<div class="counter-number" data-to="{$c}" data-speed="3000" data-from="0"></div>
						<div class="bottom-text">
							Candidates
						</div>
					</div><!--/.counter-column -->
					<div class="counter-column col-md-3 col-sm-3 text-center animated wow fadeIn" data-wow-delay="0.6s">
						<div class="icon">
							<i class="pe-7s-users pe-2x"></i>
						</div>
						<div class="separator"></div>
						{assign var=g value=$DATA[0].guru+250}
						<div class="counter-number" data-to="{$g}" data-speed="3000" data-from="0"></div>
						<div class="bottom-text">
							Gurus
						</div>
					</div><!--/.counter-column -->
				</div>
			</div>
		</section><!--/.job-counter-->

		<section class="learning-solution job-info-2" id="benifit" style="padding-top:100px; padding-bottom:100px;">

			<div class="container sec-pad" >
				<div class="heading sec-hq-pad-b animated wow fadeIn">
					<h1>Benefits</h1>

				</div>

				<div class="col-md-4 col-sm-4 learning-solution-item wow animated fadeIn" data-wow-delay="0.0s" style="background:url(assets/images/01.png) no-repeat;">

					<h2>Scientific way to find your Calling </h2>

					<div class="sec-h-pad-b"></div>
				</div><!--/.learning-solution-item-->

				<div class="col-md-4 col-sm-4 learning-solution-item wow animated fadeIn" data-wow-delay="0.5s" style="background:url(assets/images/02.png) no-repeat;">

					<h2>No CVs, No Interviews </h2>
					<div class="sec-h-pad-b"></div>
				</div><!--/.learning-solution-item-->

				<div class="col-md-4 col-sm-4 learning-solution-item animated wow fadeIn" data-wow-delay="1.0s" style="background:url(assets/images/03.png) no-repeat;">

					<h2>Get Best Trainers & Mentors <div class="sec-h-pad-b"></div></h2>

				</div><!--/.learning-solution-item-->

				<div class="col-md-4 col-sm-4 learning-solution-item animated wow fadeIn" data-wow-delay="1.5s" style="background:url(assets/images/04.png) no-repeat;">

					<h2>Choose your Work, love your family <div class="sec-h-pad-b"></div></h2>

				</div><!--/.learning-solution-item-->
				<div class="col-md-4 col-sm-4 learning-solution-item animated wow fadeIn" data-wow-delay="2.0s" style="background:url(assets/images/05.png) no-repeat;">

					<h2>Choose your Boss, No exploitation <div class="sec-h-pad-b"></div></h2>

				</div><!--/.learning-solution-item-->
				<div class="col-md-4 col-sm-4 learning-solution-item animated wow fadeIn" data-wow-delay="2.5s" style="background:url(assets/images/06.png) no-repeat;">

					<h2>Start earning within few minutes <div class="sec-h-pad-b"></div></h2>

				</div><!--/.learning-solution-item-->

			</div>

			<div class="container ">

				<div class="job-content-2 animated wow fadeIn" >

					<div class="col-md-4 col-sm-6 job-item fulltime animated wow fadeIn" data-wow-delay="2.7s">
						<div class="content-wrap">
							<div class="company-logo valign-wrap">
								<div class="valign-middle">
									<img src="assets/images/benifit2.jpg">
								</div>
							</div>
							<div class="company-info parttime">
								<div class="job-type">
									<span>Start Training Instantly</span>
								</div>

								<div class="job-description">
									You Submit Details,
									<br>
									Skill Mitra Meets you,
									<br>
									Profile is Validated.
									<br>
									Start Your Training
								</div>

								<a href="index.php?action=register-trainee" class="read-more">
								<div class="text">
									Register Now
								</div>
								<div class="right-arrow">
									<i class="fa fa-angle-right"></i>
								</div></a>
							</div>
						</div>
					</div><!--/.job-item -->

					<div class="col-md-4 col-sm-6 job-item internship animated wow fadeIn" data-wow-delay="3.2s">
						<div class="content-wrap">
							<div class="company-logo valign-wrap">
								<div class="valign-middle">
									<img src="assets/images/benifit3.jpg">
								</div>
							</div>
							<div class="company-info internship">
								<div class="job-type">
									<span>Find Job Instantly</span>
								</div>

								<div class="job-description">
									Submit your profile
									<br>

									Assigned to a Guru
									<br>

									Get Recommended
									<br>
									Get Hired

								</div>
								<a href="index.php?action=register-candidate" class="read-more">
								<div class="text">
									Register Now
								</div>
								<div class="right-arrow">
									<i class="fa fa-angle-right"></i>
								</div></a>
							</div>
						</div>
					</div><!--/.job-item -->

					<div class="col-md-4 col-sm-6 job-item freelance animated wow fadeIn" data-wow-delay="3.6s">
						<div class="content-wrap">
							<div class="company-logo valign-wrap">
								<div class="valign-middle">
									<img src="assets/images/benifit1.jpg">
								</div>
							</div>
							<div class="company-info freelance">
								<div class="job-type">
									<span>FIND STAFF INSTANTLY</span>
								</div>

								<div class="job-description">
									Get Registered
									<br>

									Get Nearby Champs
									<br>

									Review Videos
									<br>
									Hire Candidates

								</div>

								<a href="index.php?action=register-employer" class="read-more">
								<div class="text">
									Register Now
								</div>
								<div class="right-arrow">
									<i class="fa fa-angle-right"></i>
								</div></a>
							</div>
						</div>
					</div><!--/.job-item -->

				</div>

			</div>
		</section>

		<!-- Client Logos Starts -->
		<section class="client-logos-wrap sec-pad"  id="hiw"  >
			<div class="container" style="padding-top:80px;" >
				<div class="heading sec-hq-pad-b animated wow fadeIn"  data-wow-delay="0.5s">
					<h1>HOW IT WORKS</h1>

				</div>

				<div class="counter-wrap sec-pad col-md-12 col-sm-12 col-xs-12">
					<div class="counter-column col-md-12 col-sm-3 text-center animated wow fadeIn" data-wow-delay="0.9s">
						<div class="icon">
							<img src="assets/images/program-model.png" width="100%" >
						</div>

					</div>
				</div>
			</div><!--/.container-fluid -->
		</section><!--/.client-logo-wrap -->
		<!-- Client Logos Ends -->
		
	

		<section class="browse-resumes sec-hq-pad-t sec-hq-pad-b" id="search" >
			<div class="container" style="padding:80px 0px;">
				<div class="heading sec-hq-pad-b animated wow fadeIn">
					<h2 style="text-align:center">Hire Champs</h2>

				</div>
				<form name="searchfrm" action="index.php?action=search_candidates" method="post">

					<div class="col-md-12 col-sm-12 search-panel form-group animated wow fadeIn" data-wow-delay="0.2s">

						<div class="input-group">

							<div class="input-col">
								<div class="form-group">
									<input type="text" class="def-input" placeholder="Pincode" name="pincode" id="pincode">
								</div>
							</div>

							<div class="input-col">
								<div class="form-group">
									<select name="category" id="category" class="def-input def-select">
										<option value="" selected disabled>Choose Category</option>
										{foreach from=$JOB_CATEGORY item=$r key=key}
										<option value="{$r.course_id}">{$r.course_name}</option>
										{/foreach}
									</select>
								</div>
							</div>

							<div class="search-col">
								<input  type="submit" class="search-btn2" value="Search">
							</div>
				</form>
			</div>
			</div><!--/.search-panel -->

			</div>
		</section>

		{include file="home/footer.tpl"}
		{literal}
		<!-- livezilla.net PLACE SOMEWHERE IN BODY -->
		<script type="text/javascript" id="e756b6273eca1f773cfe6e6ed612c664" src="http://localhost:8080/livezilla/script.php?id=e756b6273eca1f773cfe6e6ed612c664"></script>
		<!-- livezilla.net PLACE SOMEWHERE IN BODY -->
		{/literal}
	</body>

</html>