<!DOCTYPE html>
<html lang="en">

	<!-- Mirrored from demo.suavedigital.com/jobstar/blog-post-left-sidebar.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 17 Apr 2017 10:10:55 GMT -->
	<head>
		<meta charset="utf-8">
		<meta content="IE=edge" http-equiv="X-UA-Compatible">
		<meta content="width=device-width, initial-scale=1" name="viewport">
		<meta content="Jobstar - Job Board HTML Template" name="description">
		<meta content="Suave Digital" name="author">

		<link rel="shortcut icon" href="assets/images/favicon/favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" href="assets/images/favicon/apple-touch-icon.png" />
		<link rel="apple-touch-icon" sizes="57x57" href="assets/images/favicon/apple-touch-icon-57x57.png" />
		<link rel="apple-touch-icon" sizes="72x72" href="assets/images/favicon/apple-touch-icon-72x72.png" />
		<link rel="apple-touch-icon" sizes="76x76" href="assets/images/favicon/apple-touch-icon-76x76.png" />
		<link rel="apple-touch-icon" sizes="114x114" href="assets/images/favicon/apple-touch-icon-114x114.png" />
		<link rel="apple-touch-icon" sizes="120x120" href="assets/images/favicon/apple-touch-icon-120x120.png" />
		<link rel="apple-touch-icon" sizes="144x144" href="assets/images/favicon/apple-touch-icon-144x144.png" />
		<link rel="apple-touch-icon" sizes="152x152" href="assets/images/favicon/apple-touch-icon-152x152.png" />
		<title>Jobstar - Blog Post Left Sidebar</title>

		<!--Bootstrap-->
		<link href="assets/stylesheets/css/bootstrap.css" rel="stylesheet">

		<!--Font Style-->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,700,400italic,300italic" rel="stylesheet" type="text/css">
		<link href='https://fonts.googleapis.com/css?family=Montserrat:700' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Lato:700' rel='stylesheet' type='text/css'>

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
		<script src="assets/javascripts/sha512.js"></script>
		<script src="assets/javascripts/ajax.js"></script>
		<script src="admin/assets/js/moment.js"></script>
	</head>

	<body>
		<div class="preloader">
			<div class="image-container">
				<div class="image"><img src="assets/images/preloader.gif" alt="">
				</div>
			</div>
		</div>
		<div class="container">
			<!-- Navbar Start -->
			<nav class="navbar navbar-inverse navbar-fixed-top navbar-bg-white">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="index.php"></a>
					</div><!--/.navbar-header -->
					<div class="collapse navbar-collapse" id="navbar">
						<ul class="nav navbar-nav navbar-right">
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

		<!-- Banner Grey Starts -->
		<section class="banner-grey">
			<input type="hidden" id="page_size" name="page_size" value="4" />
			<input type="hidden" id="page_no" name="page_no" value="1" />
			<div class="container sec-hq-pad-t sec-hq-pad-b animated wow fadeIn">
				<h2>Blogs</h2>
			</div>
		</section>
		<!-- Banner Grey Ends -->

		<!-- Blog Post Starts -->
		<section class="blog-post sec-pad animated wow fadeIn" data-wow-delay="0.2s">

			<div class="container">

				<div class="blog-sidebar">
					<div class="col-md-3 col-sm-3">

						<div class="sec-hq-pad-t">
							<h3>Recent Post</h3>
						</div>

						<div class="sidebar-list mar-t-10 sec-h-pad-b left">
							<ul>
								{foreach from=$RECENT item=$r key=key}
								<li>
									<a href="index.php?action=readblog&id={$r.blog_id}"> <span class="title-blog"> {$r.title} </span> <span class="date"><i class="fa fa-clock-o"></i> &nbsp; {$r.posted_on|date_format:"%B %e, %Y"}</span> </a>
								</li>
								{/foreach}
							</ul>
						</div>

						
				</div><!--/.blog-sidebar -->

				<div class="blog-content-info">
					<div class="col-md-9 col-sm-9">

						<div class="blog-content">
							<div class="col-md-10 col-sm-10">

								{$DATA[0].content|unescape:"html"}
								
							</div>
						</div><!--/.blog-content -->

						<div class="blog-info">
							<div class="col-md-2 col-sm-2">
								
								<div class="written-by">
									<p>
										Written by
									</p>
									<p>
										<strong>{$DATA[0].posted_by}</strong>
									</p>
								</div>

								<div class="blog-tag">
									<p>
										<i class="fa fa-clock-o"></i> &nbsp; {$DATA[0].posted_on|date_format:"%B %e, %Y"}
									</p>
									
								</div>
								
							</div>
						</div><!--/.blog-info -->

					</div>
				</div><!--/.blog-content-info -->

			</div><!--/.container -->

		</section><!--/.blog-post -->
		<!-- Blog Post Ends -->

		<!-- Footer Starts -->
		{include file="home/footer.tpl"}
		<!-- Footer Ends -->

	</body>

	<!-- Mirrored from demo.suavedigital.com/jobstar/blog-post-left-sidebar.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 17 Apr 2017 10:10:55 GMT -->
</html>