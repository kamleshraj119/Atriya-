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
		{literal}
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
		{/literal}
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

		<style>
			.main-ratn {
				width: 33%;
				float: left;
			}
			.rating-txt {
				width: 100%;
				float: left;
				text-align: center;
				font-size: 13px;
			}
			.rating-str {
				width: 100%;
				float: left;
			}
			form .stars {
				background: url("stars.png") repeat-x 0 0;
				width: 100px;
				margin: 0 auto;
			}

			form .stars input[type="radio"] {
				position: absolute;
				opacity: 0;
				filter: alpha(opacity=0);
			}
			form .stars input[type="radio"].star-5:checked ~
			span {
				width: 100%;
			}
			form .stars input[type="radio"].star-4:checked ~
			span {
				width: 80%;
			}
			form .stars input[type="radio"].star-3:checked ~
			span {
				width: 60%;
			}
			form .stars input[type="radio"].star-2:checked ~
			span {
				width: 40%;
			}
			form .stars input[type="radio"].star-1:checked ~
			span {
				width: 20%;
			}
			form .stars label {
				display: block;
				width: 20px;
				height: 20px;
				margin: 0 !important;
				padding: 0 !important;
				text-indent: -999em;
				float: left;
				position: relative;
				z-index: 10;
				background: transparent !important;
				cursor: pointer;
			}
			form .stars label:hover ~
			span {
				background-position: 0 -30px;
			}
			form .stars label.star-5:hover ~
			span {
				width: 100% !important;
			}
			form .stars label.star-4:hover ~
			span {
				width: 80% !important;
			}
			form .stars label.star-3:hover ~
			span {
				width: 60% !important;
			}
			form .stars label.star-2:hover ~
			span {
				width: 40% !important;
			}
			form .stars label.star-1:hover ~
			span {
				width: 20% !important;
			}
			form .stars span {
				display: block;
				width: 0;
				position: relative;
				top: 0;
				left: 0;
				height: 30px;
				background: url("stars.png") repeat-x 0 -60px;
				-webkit-transition: -webkit-width 0.5s;
				-moz-transition: -moz-width 0.5s;
				-ms-transition: -ms-width 0.5s;
				-o-transition: -o-width 0.5s;
				transition: width 0.5s;
			}

		</style>

	</head>

	<body>
		<div class="preloader">
			<div class="image-container">
				<div class="image"><img src="assets/images/preloader.gif" alt="">
				</div>
			</div>
		</div>
		<div class="container" id="home" >
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
						<a class="navbar-brand" href="index.html"></a>
					</div><!--/.navbar-header -->
					<div class="collapse navbar-collapse" id="navbar">

						<ul class="nav navbar-nav navbar-right">

							<li class="dropdown">
								<a href="#pages" data-toggle="dropdown" class="dropdown-toggle">HELLO {$DETAILS[0].name} <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li>
										<a href="candidate-home.html">MY ACCOUNT</a>
									</li>
									<li>
										<a href="#" data-toggle="modal" data-target="#profile">EDIT PROFILE</a>
									</li>
									<li>
										<a href="#" data-toggle="modal" data-target="#pass">CHANGE PASSWORD</a>
									</li>
									<li>
										<a href="candidate-support.html">Support</a>
									</li>

								</ul>
							</li>

							<li>
								<a href="#" class="register" >LOGOUT</a>
							</li>
						</ul>

					</div><!--/ Collapse -->
				</div>
			</nav>
		</div>
		<!-- Navbar Ends -->

		<!-- Change Password Modal -->
		<div class="modal fade login" id="pass" role="dialog">
			<div class="modal-dialog login-dialog">

				<div class="login-content">
					<div class="login-header">
						<h3>Change Password</h3>
						<hr>
					</div>
					<div class="login-body">

						<form action="#" class="form-horizontal">

							<input type="password" name="" class="login-form def-input" placeholder="Enter New Password">

							<a href="#">
							<div class="sign-in">
								Submit
							</div> </a>
						</form>

					</div>
				</div><!--/.login-content-->

			</div>
		</div>
		<!-- Login Ends -->

		<!-- Profile -->
		<div class="modal fade login" id="profile" role="dialog">
			<div class="modal-dialog login-dialog">

				<div class="login-content">
					<div class="login-header">
						<h3>Edit Profile</h3>
						<hr>
					</div>
					<div class="login-body">

						<form action="#" class="form-horizontal">
							<label>Upload Profile Image</label>
							<input type="file" class="upload" >
							<input type="text" name="" class="login-form def-input" placeholder="ABCD">
							<input type="text" name="" class="login-form def-input" placeholder="XYZ">
							<input type="text" name="" class="login-form def-input" placeholder="28-MAR-1900">
							<input type="text" name="" class="login-form def-input" placeholder="27 yrs">
							<select name="" id="" class="login-form  def-input def-select">
								<option value="" disabled >Gender</option>
								<option value="male" selected>Male </option>
								<option value="female">Female</option>
							</select>
							<select name="" id="" class="login-form  def-input def-select">
								<option value="" disabled >Marital Status</option>
								<option value="male" selected>Single </option>
								<option value="female">Married</option>
							</select>
							<input type="text" name="" class="login-form def-input" placeholder="9568526475">
							<input type="text" name="" class="login-form def-input" placeholder="abc@xyz.com">
							<input type="text" name="" class="login-form def-input" placeholder="Address">
							<input type="text" name="" class="login-form def-input" placeholder="110019">
							<input type="text" name="" class="login-form def-input" placeholder="123456789245">

							<div class="input-group" style="padding-top:10px;">
								<span class="input-group-addon"><i class="fa fa-facebook"></i></span>
								<input type="text" class="form-control def-input" placeholder="Facebook">
							</div>
							<div class="input-group" style="padding-top:18px;">
								<span class="input-group-addon"><i class="fa fa-linkedin"></i></span>
								<input type="text" class="form-control def-input" placeholder="Linkedin">
							</div>
							<a href="#">
							<div class="sign-in">
								Save
							</div></a>

						</form>
					</div>
				</div><!--/.login-content-->

			</div>
		</div>
		<!-- Prifile Ends -->

		<!-- Video -->
		<div class="modal fade login" id="video" role="dialog">
			<div class="modal-dialog login-dialog" style="width:80%">

				<div class="login-content">
					<div class="login-header">

						<iframe width="100%" height="500px" src="https://www.youtube.com/embed/gjuOiuW6lTI" frameborder="0" allowfullscreen></iframe>

					</div>
					<div class="login-body" style="text-align:center;">

						<form action="#" class="form-horizontal">

							<a href="#" class="approve">APPROVE</a><a href="#" class="approve reject">REJECT</a>

						</form>
					</div>
				</div><!--/.login-content-->

			</div>
		</div>
		<!-- Register Ends -->

		<!-- Banner Grey Starts -->
		<section class="banner-grey">
			<div class="container" >

			</div>
		</section>
		<!-- Banner Grey Ends -->

		<!-- Resume Form -->

		<section class="user-profile animated wow fadeIn" data-wow-delay="0.2s">

			<div class="container sec-hq-pad-t sec-h-pad-b">

				<div class="col-md-3 col-sm-3 col-xs-12 content-wrap" >
					<div class="user-photo-wrap valign-wrap" style="margin-bottom:120px;">
						<div class="user-photo valign-middle">
							<img src="assets/images/individu-1.png" alt="">

						</div>

						<div class="img-ditels col-xs-12" >
							{$DETAILS[0].name}
							<br>

							<p>
								<i class="fa fa-phone" style="margin-bottom:15px;"></i>&nbsp; {$DETAILS[0].mobile}
							</p>

							<a href="#" class="def-btn-sml btn-sml-bg-yellow" data-toggle="modal" data-target="#profile">&nbsp;&nbsp;EDIT PROFILE  &nbsp;&nbsp; </a>&nbsp;&nbsp;
						</div>

					</div><!--/.user-photo-wrap -->
				</div>

				<div class="personal-data col-md-9 col-sm-9">
					<div class="col-md-12 no-l-padding">
						<div class="col-md-10 col-sm-10 col-xs-10">
							<h3>Welcome History </h3>
						</div>

					</div>

					<div class="col-md-12 no-l-padding sec-q-pad-t content ">
						<div class="col-md-12 ">

							<a href="candidate-video.html" class=" box-6 ">
							<div class="box-in box-bdr">

								<div class="box-img">
									<img src="assets/images/icons/video.png" >
								</div>
								<div class="box-in-tex txt-cl2">
									25
								</div>
								<div class="tx-box">
									Video
								</div>
								<div class="row row-bg2"></div>
							</div> </a>

							<a href="candidate-history.html" class=" box-6 ">
							<div class="box-in box-bdr">

								<div class="box-img">
									<img src="assets/images/icons/history.png" >
								</div>
								<div class="box-in-tex txt-cl3">
									25
								</div>
								<div class="tx-box">
									History
								</div>
								<div class="row row-bg3"></div>
							</div> </a>

							<a href="blog.html" class=" box-6 ">
							<div class="box-in box-bdr">

								<div class="box-img">
									<img src="assets/images/icons/blog.png" >
								</div>
								<div class="box-in-tex txt-cl4">
									30
								</div>
								<div class="tx-box">
									Blog
								</div>
								<div class="row row-bg4"></div>
							</div> </a>

							<a href="artical.html" class=" box-6 ">
							<div class="box-in box-bdr">

								<div class="box-img">
									<img src="assets/images/icons/Articals.png" >
								</div>
								<div class="box-in-tex txt-cl5">
									30
								</div>
								<div class="tx-box">
									Artical
								</div>
								<div class="row row-bg5"></div>
							</div> </a>

							<a href="skill-mitra-message.html " class=" box-6 ">
							<div class="box-in ">

								<div class="box-img">
									<img src="assets/images/icons/msg.png" >
								</div>
								<div class="box-in-tex txt-cl6">
									5
								</div>
								<div class="tx-box">
									Messages
								</div>
								<div class="row row-bg6"></div>
							</div> </a>

						</div>

					</div>

					<!--/.social-media-wrap -->

					<form action="candidate.php?action=upload_video" method="post" name="videofrm">
						<div class="col-md-12" style="margin-top:20px;">

							<h4>Videos</h4>

							<div class="my-bookmark post-a-job" style="margin-top:10px;">
								<div class="form-group">

									<input type="text" name="youtube" id="youtube" class="def-input" placeholder="youtube link">

								</div>
								<div class="form-group mar-t-20 mar-b-20" style="padding:0px;">

									<h5>or</h5>

									<div class="def-btn upload-file-btn">
										<span><i class="fa fa-upload"></i>&nbsp; Browse Video</span>
										<input type="file" class="upload">
									</div>
									<div class="small-desc">
										Max 2MB
									</div>

								</div>
							</div>
							<a href="javascript:void(0)" onclick="UploadVideo()" class="def-btn btn-bg-blue">Submit</a>

							<div class="job-info-2">

								<h4>Uploaded Videos</h4>

								<div>

									<div class="job-content-2 animated wow fadeIn" data-wow-delay="0.2s">
										{foreach from=$VIDEOS item=r key=key}
										<div class="col-md-4 col-sm-6 job-item fulltime">
											<div class="content-wrap">
												<div class="company-logo valign-wrap">
													<div class="valign-middle">
														<iframe  height="250" src="https://www.youtube.com/embed/{$r.video}" frameborder="0" allowfullscreen></iframe>

													</div>
												</div>
												<div class="company-info parttime">
													<div class="job-type" style="padding-top:10px; padding-bottom:5px;">
														<div class="job-info-2-type-age">
															Dated : {$r.posted_on}
														</div>

													</div>

												</div>
											</div>
										</div><!--/.job-item -->
										{/foreach}

										<!--/.job-item -->

										<!--/.job-item -->

									</div>

								</div>
							</div>

						</div>

						<!--/.education-timeline -->

						<!--/.work-exp-timeline -->

						<!--/.personal-skill -->

						<!--/.professional-skill -->
		</section>

		
		<!-- Resume Form Ends -->

		<!-- Got a Question Starts -->
		<!--/.got-a-question -->
		<!-- Footer Starts -->
		<footer>
			<div class="footer-content sec-pad">
				<div class="container">

					<div class="col-md-4 col-sm-4 content-wrap">
						<div class="brand-logo">
							<img src="assets/images/SkillChamps-white.png" alt="">
						</div>
						<div class="sec-q-pad-b"></div>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur viverra vulputate tincidunt. Fusce ultricies dui pretium purus vestibulum suscipit. Proin ut turpis a mauris porttitor luctus eu quis velit. Nunc libero dolor, commodo sit amet nunc nec, sollicitudin semper ligula.
						</p>
					</div>

					<div class="col-md-3 col-sm-3 content-wrap">
						<div class="title-underlined">
							<h3>Job Seekers</h3>
						</div>
						<p>
							<a href="#">Register</a>
						</p>
						<p>
							<a href="#">Login</a>
						</p>
						<p>
							<a href="#">Jobs by Specialization</a>
						</p>
						<p>
							<a href="#">Terms of Use</a>
						</p>
						<p>
							<a href="#">Privacy Policy</a>
						</p>
						<p>
							<a href="#">Disclaimer</a>
						</p>

					</div>

					<div class="col-md-2 col-sm-2 content-wrap">
						<div class="title-underlined">
							<h3>Quick Links</h3>
						</div>
						<p>
							<a href="#">FAQ</a>
						</p>
						<p>
							<a href="#">Search Candidates</a>
						</p>

						<p>
							<a href="#">How it Works</a>
						</p>
						<p>
							<a href="#">Site Map</a>
						</p>
					</div>

					<div class="col-md-3 col-sm-3 content-wrap">
						<div class="title-underlined">
							<h3>Contact</h3>
						</div>
						<p>
							Support
							<br>

							+91 99999 99999
						</p>

						<div class="sec-q-pad-b"></div>

					</div>
				</div>
			</div>

			<div class="copyright sec-q-pad">
				<div class="container">
					<div class="col-md-7 col-sm-7 col-xs-6 left-section">
						<p>
							&copy; 2017 SkillChamps - Developed by Cybss
						</p>
					</div>
					<div class="col-md-5 col-sm-5 col-xs-6 right-section text-right">
						<a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
						<a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
						<a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
						<a href="#" class="dribbble"><i class="fa fa-dribbble"></i></a>
						<a href="#" class="vimeo"><i class="fa fa-vimeo"></i></a>
					</div>
				</div>
			</div>
		</footer>
		<!-- Footer Ends -->

		<!-- JavaScripts -->
		<script src="assets/javascripts/bootstrap.min.js"></script>
		<script src="assets/javascripts/wow.min.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js"></script>
		<script src="assets/javascripts/custom.js"></script>
		<script src="assets/javascripts/jquery.countTo.js"></script>
		<script src="assets/javascripts/isotope.pkgd.min.js"></script>
		<script src="assets/javascripts/slick.min.js"></script>
		<script src="assets/javascripts/jquery.parallax-1.1.3.js"></script>
		<script src="assets/javascripts/jquery.appear.min.js"></script>
		<script src="assets/javascripts/smoothproducts.min.js"></script>
		<script src="assets/javascripts/custom-map-job-map.js"></script>
		<script src="assets/javascripts/custom-map-post-a-job.js"></script>
		<script src="assets/javascripts/custom-map-contact-us.js"></script>
	</body>

</html>