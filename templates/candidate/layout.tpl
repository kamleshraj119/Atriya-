<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<!-- IE Compatibility Meta -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- First Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Flexi Hire</title>
		<link href="assets/css/stylesheets/bootstrap.css" rel="stylesheet">
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
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Raleway:100,200,300,400,500,600,700,800,900" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/media.css" />
		<!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
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
		/*	input[type='file'
			] {
				color: transparent;
			}*/
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
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="candidate.php"><img alt="logo" src="assets/images/logo12.png" /></a>
				</div>
				<nav id="myNavbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<!--    Custom notification added -->
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle waves-effect waves-dark" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i style="color: #fcc512; font-size: 25px;" class="fa fa-bell-o"></i>
							{if $CANDIDATENOTIFICATION|count>0}
							<div class="notify">
								<span class="heartbit"></span><span class="point"></span>
							</div> {/if}
							</a>
							<div class="dropdown-menu dropdown-menu-right mailbox mailbox-mine animated bounceInDown">
								<ul style="margin-left:-20px;">
									<li>
										<div class="drop-title">
											<b>Notifications</b>
										</div>
									</li>
									<li>
										<div class="message-center">
											{if $DETAILS[0].overall_per==100}

											<h6>All cought up</h6>

											{/if}
											<!-- Message -->

											{if $DETAILS[0].profile_pic==''}
											<a href="javascript:void(0);" data-toggle="modal" data-target="#profile">
											<div class="btn btn-danger btn-circle">
												<i class="fa fa-upload"></i>
											</div>
											<div class="mail-contnet">
												<h5>Profile Picture</h5><span class="mail-desc">Upload Profile Picture to complete Your&nbsp;</span><span class="time">Profile</span>
											</div> </a>
											{/if}
											<!-- Message -->

											<!-- Message -->
											{if $DETAILS[0].profile_per lt 100}
											<a href="javascript:void(0);" data-toggle="modal" data-target="#profile">
											<div class="btn btn-danger btn-circle">
												<i class="fa fa-user"></i>
											</div>
											<div class="mail-contnet">
												<h5>Personal Information</h5><span class="mail-desc">Fill Personal Information to complete Your&nbsp;</span><span class="time">Profile</span>
											</div> </a>
											{/if}
											<!-- Message -->
											{if $DETAILS[0].exp_count lt 1}
											<a href="candidate.php?action=history">
											<div class="btn btn-success btn-circle">
												<i class="fa fa-briefcase"></i>
											</div>
											<div class="mail-contnet">
												<h5>Experience Details</h5><span class="mail-desc">Fill Experience Details to complete Your&nbsp;</span><span class="time">Profile</span>
											</div> </a>
											{/if}
											<!-- Message -->
											{if $DETAILS[0].ac_count lt 1}
											<a href="candidate.php?action=candidate_bank_details">
											<div class="btn btn-info btn-circle">
												<i class="fa fa-bank"></i>
											</div>
											<div class="mail-contnet">
												<h5>Bank Details</h5><span class="mail-desc">Fill Bank Details to complete Your&nbsp;</span><span class="time">Profile</span>
											</div> </a>
											{/if}
											<!-- Message -->
											{if $DETAILS[0].doc_per lt 100}
											<a href="candidate.php?action=candidate_doc">
											<div class="btn btn-primary btn-circle">
												<i class="fa fa-file-text"></i>
											</div>
											<div class="mail-contnet">
												<h5>Documents</h5><span class="mail-desc">Upload Documents to complete Your&nbsp;</span><span class="time">Profile</span>
											</div> </a>
											{/if}

											{if $DETAILS[0].vid_count lt 1}
											<a href="candidate.php?action=videos">
											<div class="btn btn-primary btn-circle">
												<i class="fa fa-film"></i>
											</div>
											<div class="mail-contnet">
												<h5>Video</h5><span class="mail-desc">Upload Video to complete Your&nbsp;</span><span class="time">Profile</span>
											</div> </a>
											{/if}
											{if $DETAILS[0].edu_count lt 1}
											<a href="candidate.php?action=can_education">
											<div class="btn btn-primary btn-circle">
												<i class="fa fa-graduation-cap"></i>
											</div>
											<div class="mail-contnet">
												<h5>Education Details</h5><span class="mail-desc">Fill Educational details to complete Your&nbsp;</span><span class="time">Profile</span>
											</div> </a>
											{/if}
											{foreach from=$CANDIDATENOTIFICATION  item=$cn key=key}
											<a href="candidate.php?action=can_notification">
											<div class="btn btn-primary btn-circle"><img src="http://skillchamps.in/admin/images/broadcast/{$cn.image}" style="width: 20px;height: 20px;">
											</div>
											<div class="mail-contnet">
												<h5>{$cn.title}</h5><span class="mail-desc">{$cn.message}</span><span class="time">Profile</span>
											</div> </a>
											{/foreach}
										</div>
									</li>
									<!--<li>
									<a class="nav-link text-center" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
									</li>-->
								</ul>
							</div>
						</li>
						<!--     End Notification  -->
						<li class="dropdown">
							<a style="padding: 24px 0 5px 0;" id="shrink_mine1" class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);"> <img style="border:1px solid #02e4b6; border-radius:50%; width: 40px; height: 40px;" src="http://skillchamps.in/admin/images/candidate/{$DETAILS[0].uid}/{$DETAILS[0].profile_pic}" />&nbsp;&nbsp;&nbsp;Hello {$DETAILS[0].name} <span class="caret"></span></a>
							<ul class="dropdown-menu" style="display: none;">
								<li>
									<a href="candidate.php">MY ACCOUNT</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="javascript:void(0);" data-toggle="modal" data-target="#profile">EDIT PROFILE</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="javascript:void(0);" data-toggle="modal" data-target="#pass">CHANGE PASSWORD</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="candidate.php?action=candidate_loc">Preferred Job Location</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="candidate.php?action=candidate_skill">Preferred Skill</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="candidate.php?action=candidate_bank_details">Bank Details</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="candidate.php?action=subscribed">Subscription Plan</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="candidate.php?action=compose">Support</a>
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

		<div class="modal fade login" id="rejectJob" role="dialog">
			<div class="modal-dialog login-dialog">

				<div class="login-content">
					<div class="login-header">
						<h3>Reject Job</h3>
						<hr>
					</div>
					<div class="login-body">

						<form action="#" class="form-horizontal">
							<input type="hidden" id="hid" name="hid" />
							<input type="text" name="reason" id="reason" class="login-form def-input" placeholder="Enter Reason">

							<a href="javascript:void(0);" onclick="rejectJob()">
							<div class="sign-in">
								Submit
							</div> </a>
						</form>

					</div>
				</div><!--/.login-content-->

			</div>
		</div>
		<!-- Change Password Modal -->
		<div class="modal fade login" id="pass" role="dialog">
			<div class="modal-dialog login-dialog">

				<div class="login-content">
					<div class="login-header">
						<h3>Change Password</h3>
						<hr>
					</div>
					<div class="login-body">

						<form  class="form-horizontal">

							<input type="password" name="newpassword" id="newpassword" class="login-form def-input" placeholder="Enter New Password">

							<a href="javascript:void(0);" onclick="ChangePassword()">
							<div class="sign-in get-loc">
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

						<form action="candidate.php?action=update_profile" class="form-horizontal" enctype="multipart/form-data" method="post" name="profile_edit" id="profile_edit" onsubmit="return EditForm();">
							<label>Upload Profile Image</label>
							<input type="file" name="profile_pic" id="profile_pic" {if $DETAILS[0].profile_pic != ""}title="{$DETAILS[0].profile_pic}"style="color: transparent;"{/if} class="upload" >
							<img id="myImg" src="http://skillchamps.in/admin/images/candidate/{$DETAILS[0].uid}/{$DETAILS[0].profile_pic}" alt="your image" />
							<input type="text" name="name" id="name" value="{$DETAILS[0].name}" class="login-form def-input" placeholder="Name*" maxlength="50" >
							<input type="text" name="father_name" id="father_name" value="{$DETAILS[0].father_name}" class="login-form def-input" placeholder="Father name*" maxlength="50">
							<input type="text" name="dob" id="dob" value="{if $DETAILS[0].dob=='0000-00-00'}""{else}{$DETAILS[0].dob}{/if}" class="login-form def-input" placeholder="YYYY-MM-DD*">
							<select name="gender" id="gender" class="login-form  def-input def-select">
								<option value="" disabled="disabled" {if $DETAILS[0].gender==""}selected{/if}>Select Gender*</option>
								<option value="Male" {if $DETAILS[0].gender=="Male"}selected{/if}>Male </option>
								<option value="Female" {if $DETAILS[0].gender=="Female"}selected{/if}>Female</option>
							</select>
							<select name="marital_status" id="marital_status" class="login-form  def-input def-select">
								<option value="" disabled {if $DETAILS[0].marital_status==""}selected{/if}>Select Marital Status*</option>
								<option value="Single" {if $DETAILS[0].marital_status=="Single"}selected{/if}>Single </option>
								<option value="Married" {if $DETAILS[0].marital_status=="Married"}selected{/if}>Married</option>
							</select>
							<input type="text" name="mobile" id="mobile" value="{$DETAILS[0].mobile}" class="login-form def-input" placeholder="Mobile*">
							<input type="text" name="email" id="email" value="{$DETAILS[0].email}" class="login-form def-input" placeholder="Email id*">
							<input type="text" name="aadhaar" id="aadhaar" value="{$DETAILS[0].aadhaar}" class="login-form def-input" placeholder="Aadhaar*">
							<input type="text" name="address" id="address" value="{$DETAILS[0].address}" class="login-form def-input" placeholder="Address*" maxlength="200">
							<input type="text" name="city" id="city" value="{$DETAILS[0].city}" class="login-form def-input" placeholder="City*" maxlength="25"> <!--pattern='[A-Za-z\\s]*'-->
							<select name="state" id="state" value="{$DETAILS[0].state}" class="def-input def-select">
								<option value="" disabled selected> Select State* </option>
								{foreach from=$STATES item=r key=key}
								<option value="{$r.id}" {if $DETAILS[0].state==$r.id}selected{/if}>{$r.state_name}</option>
								{/foreach}

							</select>
							<input type="text" value="{$DETAILS[0].pincode}" name="pincode" id="pincode" class="login-form def-input" placeholder="Location-Pincode*">

							<div class="input-group" style="padding-top:10px;">
								<span class="input-group-addon"><i class="fa fa-facebook"></i></span>
								<input type="text" name="facebook" value="{$DETAILS[0].facebook}" class="form-control def-input" placeholder="Facebook">
							</div>
							<div class="input-group" style="padding-top:18px;">
								<span class="input-group-addon"><i class="fa fa-linkedin"></i></span>
								<input type="text" name="linkedin" value="{$DETAILS[0].linkedin}" class="form-control def-input" placeholder="Linkedin">
							</div>
							<br>
							<input type="submit" class="get-loc" value="Update" >

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

						<iframe width="100%" height="auto" src="https://www.youtube.com/embed/gjuOiuW6lTI" frameborder="0" allowfullscreen></iframe>

					</div>
					<div class="login-body" style="text-align:center;">

						<form action="#" class="form-horizontal">

							<a href="javascript:void(0);" class="approve">APPROVE</a><a href="javascript:void(0);" class="approve reject">REJECT</a>

						</form>
					</div>
				</div><!--/.login-content-->

			</div>
		</div>

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
						<!-- <div class="work-block work-block-cand work-block-resp-small1 col-xs-12" style="padding-top:30px;">
						<a href="candidate.php?action=video_meeting" >
						<div class="inner-box">
						<div class="icon-box">
						<span><img src="assets/img/video.png"></span>
						</div>
						<h3><a href="javascript:void(0);">Video Meeting Request</a></h3>
						</div> </a>
						</div>-->
						<!--Work Block-->
						<div class="work-block work-block-cand work-block-resp-small1 col-xs-12" style="padding-top:30px;">
							<a href="candidate.php?action=availability">
							<div class="inner-box">
								<div class="icon-box">
									<span><img src="assets/img/availability.png" /></span>
									<span class="number">{$VAL|@count}</span>
								</div>
								<h3><a href="candidate.php?action=availability">Availability</a></h3>
							</div> </a>
						</div>
						<!--Work Block-->

						<div class="work-block work-block-resp1 work-block-cand col-xs-12">
							<a href="candidate.php?action=videos">
							<div class="inner-box">
								<div class="icon-box">
									<span><img src="assets/img/video.png" /></span>
									<span class="number">{$VIDEOS|@count}</span>
								</div>
								<h3><a href="candidate.php?action=videos">Video</a></h3>
							</div> </a>
						</div>
						<!--Work Block-->
						<div class="work-block work-block-resp-small work-block-cand1 work-block-cand2 col-xs-12">
							<a href="candidate.php?action=candidate_doc">
							<div class="inner-box">
								<div class="icon-box">
									<span><img src="assets/img/docs.png" /></span>
									<span class="number"></span>
								</div>
								<h3><a href="candidate.php?action=candidate_doc">Documents</a></h3>
							</div> </a>
						</div>
						<!--Work Block-->
						<div class="work-block work-block-resp-small work-block-cand1 work-block-cand2 col-xs-12">
							<a href="candidate.php?action=can_education">
							<div class="inner-box">
								<div class="icon-box">
									<i class="material-icons" style="color: gray;margin-left:15px;">school</i>
									<span class="number"></span>
								</div>
								<h3><a href="candidate.php?action=can_education" >Education</a></h3>
							</div> </a>
						</div>
						<!--Work Block-->
						<div class="work-block col-xs-12">
							<a href="candidate.php?action=history">
							<div class="inner-box">
								<div class="icon-box">
									<span><img src="assets/img/history.png" /></span>
									<span class="number"></span>
								</div>
								<h3><a href="candidate.php?action=history">History</a></h3>
							</div> </a>
						</div>
						<!--Work Block-->
						<div class="work-block work-block-resp1 work-block-resp-small1 col-xs-12">
							<a href="candidate.php?action=blogs">
							<div class="inner-box">
								<div class="icon-box">
									<span><img src="assets/img/blogs.png" /></span>
									<span class="number">{$BLOGS|@count}</span>
								</div>
								<h3><a href="candidate.php?action=blogs">Blogs</a></h3>
							</div> </a>
						</div>
						<!--Work Block-->
						<div class="work-block col-xs-12">
							<a href="candidate.php?action=articles">
							<div class="inner-box">
								<div class="icon-box">
									<span><img src="assets/img/articles.png" /></span>
									<span class="number">{$ARTICLES|@Count}</span>
								</div>
								<h3><a href="candidate.php?action=articles">Articles</a></h3>
							</div> </a>
						</div>
						<!--Work Block-->
						<!--Work Block-->
						<div class="work-block col-xs-12 resp-cand-last">
							<a href="candidate.php?action=messages">
							<div class="inner-box">
								<div class="icon-box">
									<span><img src="assets/img/msg.png" /></span>
									<span class="number">{$INBOX|@count}</span>
								</div>
								<h3><a href="candidate.php?action=messages">Messages</a></h3>
							</div> </a>
						</div>
						<!--Work Block-->

					</div>
					<div class="col-md-11 col_11_resp" style="border-left: 1px solid #062223; margin-left: -1px;margin-top:37px;">
						<div class="row">

							{include file=$PAGE}

						</div>
					</div>
				</div>
			</div>

			</div>
		</section>
		<!-- Resume Form Ends -->

		<!-- end section contact -->
		<div class="social-icon-div">
			<div class="container">
				<a href="javascript:void(0);"><i class="fa fa-facebook"></i></a>
				<a href="javascript:void(0);"><i class="fa fa-twitter"></i></a>
				<a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a>
				<a href="javascript:void(0);"><i class="fa fa-instagram"></i></a>
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
		<script src="assets/js/particles.js"></script>
		<script src="assets/js/app.js"></script>
		<script src="assets/js/waypoints.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/typed.js"></script>
		<script src="assets/js/validator.js"></script>
		<script src="assets/js/lity.min.js"></script>
		<script src="assets/js/lightbox.js"></script>
		<script src="assets/js/mixitup.js"></script>
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
			$(document).ready(function() {
				$('#year').bootstrapMaterialDatePicker({
					time : false,
					clearButton : true
				});
				$('#fromdate').bootstrapMaterialDatePicker({
					time : false,
					clearButton : true
				});
				$('#todate').bootstrapMaterialDatePicker({
					time : false,
					clearButton : true
				});
				$('#dob').bootstrapMaterialDatePicker({
					time : false,
					clearButton : true
				});
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
			$('ul.nav li.dropdown').hover(function() {
				$(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
			}, function() {
				$(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
			});
			function EditForm() {
				if (document.getElementById("name").value == "") {
					profile_edit.name.focus();
					alert("Please enter name!");
					return false;
				}else if(!(/^[A-Za-z \\s]+$/).test(document.getElementById("name").value)){
					profile_edit.name.focus();
					alert("Please enter alphabets only!");
					return false;
				} else if (document.getElementById("father_name").value == "") {
					profile_edit.father_name.focus();
					alert("Please enter father name!");
					return false;
				}else if(!(/^[A-Za-z \\s]+$/).test(document.getElementById("father_name").value)){			
					profile_edit.father_name.focus();
					alert("Please enter alphabets only!");
					return false;
				}else if (document.getElementById("dob").value == "") {
					profile_edit.dob.focus();
					alert("Please enter date of birth!");
					return false;
				} else if (!(document.getElementById("dob").value).match(/^\d{4}-\d{2}-\d{2}$/)) {
					profile_edit.dob.focus();
					alert("Invalid date format!");
					return false;
				} else if (checkDOB(document.getElementById("dob").value) == false) {
					profile_edit.dob.focus();
					alert("You cannot enter a date in the future!");
					return false;
				} else if (document.getElementById("gender").value == "") {
					profile_edit.gender.focus();
					alert("Please select gender!");
					return false;
				} else if (document.getElementById("marital_status").value == "") {
					profile_edit.marital_status.focus();
					alert("Please select marital status!");
					return false;
				} else if (document.getElementById("mobile").value == "" || isNaN(document.getElementById("mobile").value) || document.getElementById("mobile").value.length != 10) {
					alert("Please enter 10 digit mobile number!");
					profile_edit.mobile.focus();
					return false;
				} else if (document.getElementById("email").value == "") {
					alert("Please enter email id!");
					profile_edit.email.focus();
					return false;
				} else if (!validateEmail(document.getElementById("email").value)) {
					alert("Please enter valid email id!");
					profile_edit.email.focus();
					return false;
				} else if (document.getElementById("aadhaar").value == "" || isNaN(document.getElementById("aadhaar").value) || document.getElementById("aadhaar").value.length != 12) {
					profile_edit.aadhaar.focus();
					alert("Please enter 12 digit aadhaar number!");
					return false;
				} else if(!(/^[0-9a-zA-Z\_ ]+$/).test(document.getElementById("address").value)){				
					profile_edit.address.focus();
					alert("Please enter valid address!");
					return false;
				} else if(!(/^[A-Za-z\\s]+$/).test(document.getElementById("city").value)){				
					profile_edit.city.focus();
					alert("Please enter city name!");
					return false;
				}else if (document.getElementById("state").value == "") {
					profile_edit.state.focus();
					alert("Please select state!");
					return false;
				}else if (isNaN(document.getElementById("pincode").value)) {
					profile_edit.pincode.focus();
					alert("Please enter digits only in pincode!");
					return false;
				} else if (document.getElementById("pincode").value == "" || document.getElementById("pincode").value.length != 6) {
					profile_edit.pincode.focus();
					alert("Please enter 6 digit pincode!");
					return false;
				} else {
					return true;
				}
			}

			function checkDOB(dateString) {
				var myDate = new Date(dateString);
				var today = new Date();
				if (myDate > today) {
					return false;
				}
				return true;
			}
			function validateEmail(email) {
				var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				return re.test(String(email).toLowerCase());
			}
		</script>
		{/literal}

	</body>

</html>