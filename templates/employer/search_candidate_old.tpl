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
		<!--[if lt IE 9]>
		<script src="js/html5shiv.min.js"></script>
		<script src="js/respond.min.js"></script>
		<![endif]-->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/flexi.js"></script>
		<script src="assets/js/ajax.js"></script>
		<script src="assets/js/sha512.js"></script>
		<script type="text/javascript" src="assets/js/moment.js"></script>

		<link href="assets/stylesheets/jquery-datatable/skin/bootstrap/css/datatableCostum.css" rel="stylesheet">
		<script src="assets/stylesheets/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
		<script src="assets/stylesheets/jquery-datatable/jquery.dataTables.js"></script>
		<script src="assets/js/jquery-datatable.js"></script>
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
		<!-- start header -->
		<header style="background:url(assets/images/bg.jpg);" id="pageHeader" class="header navbar">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar" aria-expanded="false">
						<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php"><img alt="logo" src="assets/images/logo12.png" /></a>
				</div>

			</div>
		</header>
		<!-- end header -->

		<!-- Banner Grey Starts -->
		<section class="works-section" style="margin-top:-70px;">
			<div class="container-fluid" style="margin-bottom:-105px;">

				<div class="row clearfix">
					<!--Work Block-->
					<div class="col-md-12" >
						<div class="row">
							<div class="col-md-12" id="shrink_mine2" style="padding: 20px; position: fixed;
							width: 92%; z-index: 9; background: #fff;">
								<form name="searchfrm" action="employer.php?action=search_candidates" method="post">
									<div class="col-md-5">
										<input class="def-input" placeholder="Pincode" name="pincode" id="pincode" type="text">
									</div>
									<div class="col-md-5">
										<select name="category" id="category" class="def-input def-select">
											<option value="" selected="">Choose Category</option>
											{foreach from=$JOB_CATEGORY item=$r key=key}
											<option value="{$r.course_id}">{$r.course_name}</option>
											{/foreach}
										</select>
									</div>
									<div class="col-md-2">
										<input style="width: 100%; padding:10px;" class="reply" value="Search" type="submit">
									</div>
								</form>
							</div>
							<div style="margin-top: 86px;"></div>
							<div class="container-fluid job-info-2">

								<div class="job-content-2 animated wow fadeIn" data-wow-delay="0.2s">
									{foreach from=$DATA item=$r key=key}
									<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-xs-12 job-item fulltime">
										<div class="content-wrap">
											<div class="company-logo valign-wrap">
												<div class="valign-middle">
													<div class="company-logo valign-wrap">
														<div class="valign-middle">
															<iframe width="100%" height="215" src="https://www.youtube.com/embed/{get_candidate_video cid=$r.uid}" frameborder="0" allowfullscreen></iframe>
															<a href="javascript:void(0);" data-toggle="modal" data-target="#video" onclick="ShowVideo('{$r.uid}');" style="display:block; position:absolute; top:0; width:100%; height:215px; z-index:99999;"></a>
														</div>
													</div>
												</div>
											</div>
											<div class="company-info parttime">
												<div class="job-type" style="padding-top:0px; padding-bottom:5px;">
													<div class="job-info-2-type-name">
														{$r.name} <i class="pe-7s-ribbon pe-lg" style="color:#fcc512;"></i>
													</div>
													<div class="job-info-2-type-age">
														{$r.gender} / Age: {get_age dob=$r.dob} yr / Pin: {$r.pincode}
													</div>
													<p></p>
												</div>

												<div class="job-rating" style="padding-bottom:8px;">
													<div class="main-ratn">

														<div class="rating-txt">
															Personal
														</div>
														<div class="rating-str">
															<form id="ratingsForm">
																<div class="stars">
																	<input type="radio" name="star" class="star-1" id="star-1-1" />
																	<label class="star-1" for="star-1-1">1</label>
																	<input type="radio" name="star" class="star-2" id="star-1-2" />
																	<label class="star-2" for="star-1-2">2</label>
																	<input type="radio" name="star" class="star-3" id="star-1-3" />
																	<label class="star-3" for="star-1-3">3</label>
																	<input type="radio" name="star" class="star-4" id="star-1-4" />
																	<label class="star-4" for="star-1-4">4</label>
																	<input type="radio" name="star" class="star-5" id="star-1-5" />
																	<label class="star-5" for="star-1-5">5</label>
																	<span></span>
																</div>

															</form>
														</div>

													</div>
													<div class="main-ratn">

														<div class="rating-txt">
															Skill
														</div>
														<div class="rating-str">
															<form id="ratingsForm">
																<div class="stars">
																	<input type="radio" name="star" class="star-1" id="star-2-1" />
																	<label class="star-1" for="star-2-1">1</label>
																	<input type="radio" name="star" class="star-2" id="star-2-2" />
																	<label class="star-2" for="star-2-2">2</label>
																	<input type="radio" name="star" class="star-3" id="star-2-3" />
																	<label class="star-3" for="star-2-3">3</label>
																	<input type="radio" name="star" class="star-4" id="star-2-4" />
																	<label class="star-4" for="star-2-4">4</label>
																	<input type="radio" name="star" class="star-5" id="star-2-5" />
																	<label class="star-5" for="star-2-5">5</label>
																	<span></span>
																</div>

															</form>
														</div>

													</div>
													<div class="main-ratn">

														<div class="rating-txt">
															Guru
														</div>
														<div class="rating-str">
															<form id="ratingsForm">
																<div class="stars">
																	<input type="radio" name="star" class="star-1" id="star-3-1" />
																	<label class="star-1" for="star-3-1">1</label>
																	<input type="radio" name="star" class="star-2" id="star-3-2" />
																	<label class="star-2" for="star-3-2">2</label>
																	<input type="radio" name="star" class="star-3" id="star-3-3" />
																	<label class="star-3" for="star-3-3">3</label>
																	<input type="radio" name="star" class="star-4" id="star-3-4" />
																	<label class="star-4" for="star-3-4">4</label>
																	<input type="radio" name="star" class="star-5" id="star-3-5" />
																	<label class="star-5" for="star-3-5">5</label>
																	<span></span>
																</div>

															</form>
														</div>

													</div>
													<div style="clear:both"></div>

												</div>

												<div  style="float:right; margin-right:10px;">
													<a href="#" class="read-more2">
													<div class="right-arrow">
														<i class="fa fa-lg fa-facebook"></i>
													</div></a>
													<a href="#" class="read-more3">
													<div class="right-arrow">
														<i class="fa fa-lg fa-linkedin"></i>
													</div></a>
												</div>
												<div style="clear:both"></div>
											</div>
										</div>
									</div><!--/.job-item -->
									{/foreach}

								</div>

							</div>
						</div>
					</div>
				</div>
		</section>
		<!-- Resume Form Ends -->
<br>
<br>
<br>
		<!-- end section contact -->
		<div class="social-icon-div">
			<div class="container">
				<a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-google-plus"></i></a><a href="#"><i class="fa fa-instagram"></i></a>
				<p>
					Copyright © 2017 FLEXIHIRE, All Rights Reserved.
				</p>
			</div>
		</div>
		<!-- Start Scroll To Top -->
		<div id="scroll-top">
			<i class="fa fa-angle-up"></i>
		</div>
		<!-- end Scroll To Top -->

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
		<script src="assets/js/main.js"></script>
		<script>
			new WOW().init();
		</script>
		<script>
			$('ul.nav li.dropdown').hover(function() {
				$(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
			}, function() {
				$(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
			});
		</script>
	</body>
</html>