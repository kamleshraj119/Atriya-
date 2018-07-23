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
		<!-- User Defined Style -->
		<link href="assets/css/components_emp.css" rel="stylesheet">

		<link rel="stylesheet" href="assets/css/font-awesome.min.css" />
		<link rel="stylesheet" href="assets/css/owl.carousel.min.css" />
		<link rel="stylesheet" href="assets/css/owl.theme.default.min.css" />
		<link rel="stylesheet" href="assets/css/lity.min.css" />
		<link rel="stylesheet" href="assets/css/animate.css" />
		<link rel="stylesheet" href="assets/css/lightbox.css" />
		<link rel="stylesheet" href="assets/css/red_style.css" />
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Raleway:100,200,300,400,500,600,700,800,900"
		rel="stylesheet">
		<link rel="stylesheet" href="assets/css/media.css" />
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/flexi.js"></script>
		<script src="assets/js/ajax.js"></script>
		<script src="assets/js/sha512.js"></script>
		<script type="text/javascript" src="assets/js/moment.js"></script>
		<link href="assets/stylesheets/jquery-datatable/skin/bootstrap/css/datatableCostum.css" rel="stylesheet">
		<script src="assets/stylesheets/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
		<script src="assets/stylesheets/jquery-datatable/jquery.dataTables.js"></script>
		<script src="assets/js/jquery-datatable.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBzK712U1ci_ZxJrbLt7O4iGdxBQJeEbE0"></script>
		<!--  custom added by kamlesh -->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-material-datetimepicker.css">
		<script type="text/javascript"  src="assets/js/moment-with-locales.min.js"></script>
		<script type="text/javascript"  src="assets/js/bootstrap-material-datetimepicker.js"></script>
		<!--  End by kamlesh -->
		<style>
			#myImg {
				float: right;
				width: 100px;
				margin-top: -42px;
				margin-right: 20px;
			}
			.login-body .upload {
				float: left;
				width: 254px;
			}
			/*input[type='file'
			 ] {
			 color: transparent;
			 }*/
		</style>
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

			function startJob() {
				var id = document.getElementById("id").value;
				var mcode = document.getElementById("mcode").value;
				var callback = function(res) {
					var response = res.responseText;
					alert(response);
					window.location.reload();
				};
				var ajax = new Ajax(callback);
				var url = "admin/application/ajax.php";
				var parameter = "";
				url += "?id=" + id + "&mcode=" + mcode + "&REQUEST=START_JOB";
				var process = ajax.process(url, parameter);
			}

			function terminateJob() {
				var id = document.getElementById("hid").value;
				var reason = document.getElementById("reason").value;
				var callback = function(res) {
					var response = res.responseText;
					alert(response);
					window.location.reload();
				};
				var ajax = new Ajax(callback);
				var url = "admin/application/ajax.php";
				var parameter = "";
				url += "?id=" + id + "&reason=" + reason + "&REQUEST=TERMINATE_JOB";
				var process = ajax.process(url, parameter);
			}
		</script>
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
					<a class="navbar-brand" href="employer.php"><img alt="logo" src="assets/images/logo12.png" /></a>
				</div>

				<nav id="myNavbar" class="navbar-collapse collapse" style="height: 300px;">
					<ul class="nav navbar-nav">
						<!--   Employer Notification  -->
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle waves-effect waves-dark" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i style="color: #fcc512; font-size: 25px;" class="fa fa-bell-o"></i> {if $CANDIDATENOTIFICATION|count>0}
							<div class="notify">
								<span class="heartbit"></span><span class="point"></span>
							</div> {/if}</a>
							<div class="dropdown-menu dropdown-menu-right mailbox mailbox-mine animated bounceInDown">
								<ul style="margin-left:-20px;">
									<li>
										<div class="drop-title">
											<b>Notifications</b>
										</div>
									</li>
									<li>
										<div class="message-center" >
											{if $CANDIDATENOTIFICATION|count>0}
											{foreach from=$CANDIDATENOTIFICATION  item=$cn key=key}
											<a href="employer.php?action=emp_notification">
											<div class="btn btn-primary btn-circle"><img src="http://skillchamps.in/admin/images/broadcast/{$cn.image}" style="width: 20px;height: 20px;">
											</div>
											<div class="mail-contnet">
												<h5>{$cn.title}</h5><span class="mail-desc">{$cn.message}</span><span class="time">Profile</span>
											</div> </a>
											{/foreach}
											{else}
											<p>
												<span>There is no notification.</span></a>
											</p>
											{/if}
										</div>
									</li>
									<!--<li>
									<a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
									</li>-->
								</ul>
							</div>
						</li>
						<!--  End Notification  -->
						<li class="dropdown">
							<a style="padding: 24px 0 5px 0;" id="shrink_mine1" class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);"> <img style="border:1px solid #02e4b6; border-radius:50%; width: 40px; height: 40px;" src="http://skillchamps.in/admin/images/candidate/{$DETAILS[0].uid}/{$DETAILS[0].profile_pic}" />&nbsp;&nbsp;&nbsp;Hello {$DETAILS[0].name} <span class="caret"></span></a>
							<ul class="dropdown-menu" style="display: none;">
								<li>
									<a href="employer.php">MY ACCOUNT</a>
								</li>
								<li>
									<a href="javascript:void(0);" data-toggle="modal" data-target="#profile">EDIT PROFILE</a>
								</li>
								<li>
									<a href="javascript:void(0);" data-toggle="modal" data-target="#pass">CHANGE PASSWORD</a>
								</li>
								<li>
									<a href="employer.php?action=compose">Support</a>
								</li>
								<li>
									<a href="employer.php?action=messages">Messages</a>
								</li>
								<li>
									<a href="employer.php?action=employer_jobs_loc">Job Location</a>
								</li>
								<li>
									<a href="employer.php?action=employer_jobs">My Jobs</a>
								</li>
								<li>
									<a href="employer.php?action=employer_order">My Order</a>
								</li>
								<li>
									<a href="employer.php?action=subscribed">Subscription Plan</a>
								</li>
							</ul>
						</li>
						<li>
							<a class="login-mine" id="shrink_mine" style="width: 100px;" href="index.php?action=logout">Logout</a>
						</li>
					</ul>
				</nav>
			</div>
		</header>
		<!-- end header -->
		<!-- view_profile -->
		<div class="modal fade" id="can_profile" role="dialog">
			<div class="modal-dialog" id="can_profile_body">

				<!-- Modal content-->

			</div>
		</div>
		<!-- view_profile -->
		<!-- view_documents -->
		<div class="modal fade" id="view_documents" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content" id="doc_body">

				</div>

			</div>
		</div>
		<!-- view_documents -->

		<!-- work exp model-->
		<div class="modal fade login" id="work_experience" role="dialog">
			<div class="modal-dialog login-dialog" style="width:80%; margin: 0 auto;">

				<div class="login-content">
					<div class="login-header" >
						<div class="container-fluid">

							<div class="row">
								<div id="expDiv" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

								</div>
							</div>

						</div>
					</div>

				</div>

			</div>
		</div><!--/.work exp model end-->
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

							<input type="password" name="newpassword" id="newpassword" class="login-form def-input" placeholder="Enter New Password">

							<a href="javascript:void(0);" onclick="ChangePassword()">
							<div class="sign-in">
								Submit
							</div> </a>
						</form>

					</div>
				</div><!--/.login-content-->

			</div>
		</div>
		<div class="modal fade login" id="startJob" role="dialog">
			<div class="modal-dialog login-dialog">

				<div class="login-content">
					<div class="login-header">
						<h3>Start Job</h3>
						<hr>
					</div>
					<div class="login-body">

						<form action="#" class="form-horizontal">
							<input type="hidden" id="id" name="id" />
							<input type="text" name="mcode" id="mcode" class="login-form def-input" placeholder="Enter OTP">

							<a href="javascript:void(0);" onclick="startJob()">
							<div class="sign-in">
								Submit
							</div> </a>
						</form>

					</div>
				</div><!--/.login-content-->

			</div>
		</div>
		<div class="modal fade login" id="terminateJob" role="dialog">
			<div class="modal-dialog login-dialog">

				<div class="login-content">
					<div class="login-header">
						<h3>Terminate Job</h3>
						<hr>
					</div>
					<div class="login-body">

						<form action="#" class="form-horizontal">
							<input type="hidden" id="hid" name="hid" />
							<input type="text" name="reason" id="reason" class="login-form def-input" placeholder="Enter Reason">

							<a href="javascript:void(0);" onclick="terminateJob()">
							<div class="sign-in">
								Submit
							</div> </a>
						</form>

					</div>
				</div><!--/.login-content-->

			</div>
		</div>
		<!-- Login Ends -->

		<!-- Send Messages Modal -->

		<div class="modal fade" id="sendMessages" role="dialog" >
			<div class="modal-dialog modal-sm login-dialog" style="background: #fff; padding: 20px; border-radius: 5px;">

				<h4>Write Message</h4>

				<form action="employer.php?action=send_message_to_hired" method="post" onsubmit="return validateForm()" name="form_msg" id="form_msg">
					<div class="my-bookmark" style="margin-top:10px;">

						<div class="form-group">

							<select name="msg_subject" id="msg_subject" class="def-input" onchange="showOther();">
								<option value="" disabled selected>Select Message Subject</option>

								{foreach from=$SUBJECT item=r key=key}

								<option value="{$r.subject}">{$r.subject}</option>

								{/foreach}
							</select>
						</div>
						<div class="form-group" id="subDiv" style="display: none;">
							<input type="text" name="sub_other" id="sub_other" class="def-input" placeholder="Subject" />
							<input type="hidden" name="msgto" id="msgto" class="def-input" />
						</div>
						<div class="form-group">
							<textarea name="msg" id="msg" class="def-input" style="height:100px;" placeholder="Message"></textarea>
						</div>
						<input type="submit" class="get-loc">

					</div>
				</form>
			</div>
		</div>

		<!-- End Send Messages Modal -->

		<div class="modal fade login" id="canvideo" role="dialog">
			<div class="modal-dialog login-dialog" style="width:50%; margin: 0 auto !important;">

				<div class="login-content">
					<div class="login-header" id="canvideoBox">

					</div>
					<div class="login-body" style="text-align:center;">

						<form action="#" class="form-horizontal">

							<a href="javascript:void(0);" onclick="ShowPrevVideo()" class="approve">&lt;&lt;</a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="ShowNextVideo()" class="approve">&gt;&gt;</a>

						</form>
					</div>
				</div><!--/.login-content-->

			</div>
		</div>
		<!-- Profile -->
		<div class="modal fade login" id="profile" role="dialog">
			<div class="modal-dialog login-dialog">

				<div class="login-content">
					<div class="login-header">
						<h3>Edit Profile</h3>
						<hr>
					</div>
					<div class="login-body">

						<form action="employer.php?action=update_profile" class="form-horizontal" enctype="multipart/form-data" method="post"  name="profile_edit" id="profile_edit" onsubmit="return EditForm()">
							<label>Upload Profile Image</label>
							<input type="file" class="upload" name="profile_pic" {if $DETAILS[0].profile_pic != ""}title="{$DETAILS[0].profile_pic}"{else} title="no file chosen" {/if}  value="{$DETAILS[0].profile_pic}" >

							<img id="myImg" src="http://skillchamps.in/admin/images/candidate/{$DETAILS[0].uid}/{$DETAILS[0].profile_pic}" alt="your image" />
							<input type="text" name="company_name" id="company_name" value="{$DETAILS[0].company_name}" class="login-form def-input"   placeholder="Company Name*" maxlength="50">
							<input type="text" name="name" id="name" value="{$DETAILS[0].name}" class="login-form def-input" placeholder="Employer Name" maxlength="50">
							<input type="text" name="landline" id="landline" value="{$DETAILS[0].landline}" class="login-form def-input" placeholder="Landline*" maxlength="50">

							<input type="text" name="aadhaar" id="aadhaar" value="{$DETAILS[0].aadhaar}" class="login-form def-input" placeholder="Udyog Aadhar*">
							<input type="text" name="email" id="email" value="{$DETAILS[0].email}" class="login-form def-input" placeholder="Email ID*">
							<input type="text" name="address" id="address" value="{$DETAILS[0].address}" class="login-form def-input" placeholder="Address*" maxlength="200">
							<input type="text" name="pincode" id="pincode" value="{$DETAILS[0].pincode}" class="login-form def-input" placeholder="Pincode*">
							<!--<input type="text" name="service_tax_no" id="service_tax_no" value="{$DETAILS[0].service_tax_no}" class="login-form def-input" placeholder="Service Tax No">-->
							<input type="text" name="pan_no" id="pan_no" value="{$DETAILS[0].pan_no}" class="login-form def-input" placeholder="Pan No*">
							<input type="text" name="tan_no" id="tan_no" value="{$DETAILS[0].tan_no}" class="login-form def-input" placeholder="Tan No*">
							<div class="input-group" style="padding-top:10px;">
								<span class="input-group-addon"><i class="fa fa-facebook"></i></span>
								<input type="text" name="facebook" value="{$DETAILS[0].facebook}" class="form-control def-input" placeholder="Facebook">
							</div>
							<div class="input-group" style="padding-top:18px;">
								<span class="input-group-addon"><i class="fa fa-linkedin"></i></span>
								<input type="text" name="linkedin" value="{$DETAILS[0].linkedin}" class="form-control def-input" placeholder="Linkedin">
							</div>
							<br>
							<input type="submit" class="get-loc" value="Update">

						</form>
					</div>
				</div><!--/.login-content-->

			</div>
		</div>
		<!-- Prifile Ends -->

		<!-- Video -->
		<div class="modal fade login" id="video" role="dialog">
			<div class="modal-dialog login-dialog" style="width:80%; margin:0 auto !important;">

				<div class="login-content">
					<div class="login-header">

						<iframe width="100%" height="500px" src="https://www.youtube.com/embed/gjuOiuW6lTI" frameborder="0" allowfullscreen></iframe>

					</div>
					<div class="login-body" style="text-align:center;">

						<form action="#" class="form-horizontal">

							<a href="javascript:void(0);" class="approve">APPROVE</a><a href="#" class="approve reject">REJECT</a>

						</form>
					</div>
				</div><!--/.login-content-->

			</div>
		</div>
		<!-- Register Ends -->
		<!-- Banner Grey Starts -->
		<section class="works-section" style="margin-top:-70px;">
			<div class="container-fluid" style="margin-bottom:-105px;">
				<!--Sec Title
				<div class="sec-title centered">
				<h2>Check How It Works</h2>
				</div>-->
				<div class="row clearfix">
					<!--Work Block-->
					<div class="col-md-1 col_1_resp" style="border-left:1px solid #063638; border-right: 1px solid #063638; z-index: 1;">
						<!--Work Block-->
						<div class="work-block work-block1 work-block-resp-small1 col-xs-12 resp-admin-menu" style="padding-top:30px;">
							<a href="employer.php?action=hired_candidates">
							<div class="inner-box">
								<div class="icon-box">
									<span><img src="assets/img/currently-hired.png" /></span><span class="number">{$HIRED_CANDIDATES_COUNT}</span>
								</div>
								<h3><a href="employer.php?action=hired_candidates">Hired Candidates</a></h3>
							</div> </a>
						</div>
						<!--Work Block-->

						<div class="work-block work-block-resp work-block-resp1 col-xs-12">
							<a href="employer.php?action=cart_candidates">
							<div class="inner-box">
								<div class="icon-box">
									<span><img src="assets/img/cart.png" /></span><span class="number">{$CART_CANDIDATES_COUNT}</span>
								</div>
								<h3><a href="employer.php?action=cart_candidates">Cart</a></h3>
							</div> </a>
						</div>
						<!--Work Block-->
						<div class="work-block work-block-resp work-block-resp-small col-xs-12">
							<a href="employer.php?action=shortlisted_candidates">
							<div class="inner-box">
								<div class="icon-box">
									<span><img src="assets/img/shortlisted.png" /></span><span class="number">{$SHORTLISTED_CANDIDATES_COUNT}</span>
								</div>
								<h3><a href="employer.php?action=shortlisted_candidates">Shortlisted</a></h3>
							</div> </a>
						</div>
						<!--Work Block-->
						<div class="work-block col-xs-12">
							<a href="employer.php?action=attendance_report_candidate">
							<div class="inner-box">
								<div class="icon-box">
									<span><img src="assets/img/attendance.png" /></span><span class="number"></span>
								</div>
								<h3><a href="employer.php?action=attendance_report_candidate">Attendance Report</a></h3>
							</div> </a>
						</div>
						<!--Work Block-->
						<div class="work-block work-block-resp1 work-block-resp-small1 col-xs-12">
							<a href="employer.php?action=blogs">
							<div class="inner-box">
								<div class="icon-box">
									<span><img src="assets/img/blogs.png" /></span><span class="number">{$BLOGS|@count}</span>
								</div>
								<h3><a href="employer.php?action=blogs">Blogs</a></h3>
							</div> </a>
						</div>
						<!--Work Block-->
						<div class="work-block col-xs-12">
							<a href="employer.php?action=articles">
							<div class="inner-box">
								<div class="icon-box">
									<span><img src="assets/img/articles.png" /></span><span class="number">{$ARTICLES|@Count}</span>
								</div>
								<h3><a href="employer.php?action=articles">Articles</a></h3>
							</div> </a>
						</div>
						<!--Work Block-->

					</div>
					<div class="col-md-11 col_11_resp" style="border-left: 1px solid #062223; margin-left: -1px;margin-top: 30px;">
						<div class="row">
							<div class="col-md-12 resp-top-search resp-top-search1" id="shrink_mine2" style="padding: 20px; position: fixed;
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
										<input  class="get-loc" value="Search" type="submit">
									</div>
								</form>
							</div>
							<div style="clear: both;"></div>
							<div class="container-fluid">

								{include file=$PAGE}

							</div>

						</div>
					</div>
				</div>
		</section>
		<!-- Resume Form Ends -->

		<!-- end section contact -->
		<div class="social-icon-div">
			<div class="container">
				<a href="javascript:void(0);"><i class="fa fa-facebook"></i></a><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a><a href="javascript:void(0);"><i class="fa fa-instagram"></i></a>
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
		{literal}
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
			$(function() {
				$(":file").change(function() {
					if (this.files && this.files[0]) {
						var reader = new FileReader();
						reader.onload = imageIsLoaded;
						reader.readAsDataURL(this.files[0]);
					}
				});
			});
			function imageIsLoaded(e) {
				$('#myImg').attr('src', e.target.result);
			};
			function EditForm() {
				if (document.getElementById("company_name").value == "") {
					profile_edit.company_name.focus();
					alert("Please enter company name!");
					return false;
				} else if (!(/^[0-9a-zA-Z\_ ]+$/).test(document.getElementById("company_name").value)) {
					profile_edit.company_name.focus();
					alert("Please enter alphabets only!");
					return false;
				} else if (document.getElementById("name").value == "") {
					profile_edit.name.focus();
					alert("Please enter employer name!");
					return false;
				} else if (!(/^[0-9a-zA-Z\_ ]+$/).test(document.getElementById("name").value)) {
					profile_edit.name.focus();
					alert("Please enter alphabets only!");
					return false;
				} else if (document.getElementById("landline").value == "") {
					alert("Please enter  landline number!");
					profile_edit.landline.focus();
					return false;
				} else if (isNaN(document.getElementById("landline").value)) {
					alert("Please enter digits only in landline number!");
					profile_edit.landline.focus();
					return false;
				} else if (document.getElementById("aadhaar").value == "" || isNaN(document.getElementById("aadhaar").value) || document.getElementById("aadhaar").value.length != 12) {
					profile_edit.aadhaar.focus();
					alert("Please enter 12 digit aadhaar number!");
					return false;
				} else if (document.getElementById("email").value == "") {
					alert("Please enter email id!");
					profile_edit.email.focus();
					return false;
				} else if (!validateEmail(document.getElementById("email").value)) {
					alert("Please enter valid email id!");
					profile_edit.email.focus();
					return false;
				} else if (!(/^[0-9a-zA-Z\_ ]+$/).test(document.getElementById("address").value)) {
					profile_edit.address.focus();
					alert("Please enter valid address!");
					return false;
				} else if (isNaN(document.getElementById("pincode").value)) {
					profile_edit.pincode.focus();
					alert("Please enter digits only in pincode!");
					return false;
				} else if (document.getElementById("pincode").value == "" || document.getElementById("pincode").value.length != 6) {
					profile_edit.pincode.focus();
					alert("Please enter 6 digit pincode!");
					return false;
				} else if (!(document.getElementById("pan_no").value).match("^[a-zA-Z0-9]*$")) {
					profile_edit.pan_no.focus();
					alert("Only alphanumeric characters are valid in this field!");
					return false;
				} else if (document.getElementById("pan_no").value == "" || document.getElementById("pan_no").value.length != 10) {
					profile_edit.pan_no.focus();
					alert("Please enter 10 digits pan no!");
					return false;
				} else if (!(document.getElementById("tan_no").value).match("^[a-zA-Z0-9]*$")) {
					profile_edit.tan_no.focus();
					alert("Only alphanumeric characters are valid in this field!");
					return false;
				} else if (document.getElementById("tan_no").value == "" || document.getElementById("tan_no").value.length != 10) {
					profile_edit.tan_no.focus();
					alert("Please enter 10 digits tan no!");
					return false;
				} else {
					return true;
				}
			}

			function validateEmail(email) {
				var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				return re.test(String(email).toLowerCase());
			}
		</script>
		{/literal}
	</body>
</html>