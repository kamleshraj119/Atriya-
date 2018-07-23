{literal}
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
{/literal}

<div class="col-md-12 resp-work-exp" style="margin-top:20px;">
	<h4>SHORTLISTED CANDIDATES</h4>
	<section class="learning-solution job-info-2" id="benifit" style=" padding-bottom:100px;">

		
			<div class="job-content-2 animated wow fadeIn" data-wow-delay="0.2s">
				{foreach from=$DATA item=$r key=key}
				<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-xs-12 col-mine-def">
					<div class="content-wrap">
						<div class="company-logo valign-wrap">
							<div class="valign-middle">
								{if $r.profile_pic!=""}
								<img src="http://skillchamps.in/admin/images/candidate/{$r.uid}/{$r.profile_pic}" width="81px" height="82px" alt="">
								{else}
								<img src="http://skillchamps.in/assets/images/individu-1.png" width="81px" height="82px" alt="">
								{/if}
							</div>
						</div>
						<div class="company-info parttime">
							<div class="job-type" style="padding-top:0px; padding-bottom:5px;">
								<div class="job-info-2-type-name job-info-2-type-name-mine">
									{$r.mem_name} <i class="pe-7s-ribbon pe-lg" style="color:#fcc512;"></i>
								</div>
								<div class="job-info-2-type-age job-info-2-type-age-mine">
									{$r.gender} / Age: {get_age dob=$r.dob} yr / Pin: {$r.pincode}
								</div>
								<p></p>
							</div>
							<div class="job-type" style="padding-top:0px; padding-bottom:5px;">
								<div class="job-info-2-type-age job-info-2-type-age-mine2">
									{$r.job_type}</br>
									{$r.state_name}/{$r.district_name}/{$r.area_name}/{$r.multilocal}</br>
									{$r.sector_name}/{$r.course_name}/{$r.multiskill}
								</div>
								<p></p>
								<div class="job-info-2-type-name job-info-2-type-name-mine2">
									{$r.from_date} {$r.from_time} To {$r.to_date} {$r.to_time}
								</div>
								<p></p>
								<div class="job-info-2-type-name job-info-2-type-age-min3">
									Expected Salary:{$r.exp_sal}
								</div>
								<p></p>
							</div>

							<!--<div class="job-rating" style="padding-bottom:8px;">
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

							</div>-->
							<div class="container-fluid" style="background: #FFFFFF;">
								<div  class="row"><!-- style="border-top: 1px dotted #ccc;" -->

									<div style="margin: 10px 0px 10px 0px;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="row exp-btn-mine">
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
												<div class="row">
													<a href="javascript:void(0);" data-toggle="modal"  onclick="addToCart('{$r.cid}','{$EMP_ID}','{$r.emp_job_id}','{$r.t1id}');" class="read-more">
													<div class="right-arrow">
														Add to cart
													</div></a>

												</div>
											</div>

											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
												<div class="row">
													<a href="javascript:void(0);" data-toggle="modal"  onclick="deleteShortlist('{$r.t1id}')" class="read-more">
													<div class="right-arrow">
														Remove
													</div></a>

												</div>
											</div>

											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
												<div class="row">
													<a href="javascript:void(0);" data-toggle="modal"  onclick="ShowVideo('{$r.cid}');" class="read-more">
													<div class="right-arrow">
														Video
													</div></a>

												</div>
											</div>
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
												<div class="row">
													<a href="javascript:void(0);" data-toggle="modal"  onclick="ShowExp('{$r.cid}');" class="read-more">
													<div class="right-arrow">
														Experience
													</div></a>
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>

							<!--<div  style="float:center;">
								<a href="#" class="read-more2">
								<div class="right-arrow">
									<i class="fa fa-lg fa-facebook"></i>
								</div></a>
								<a href="#" class="read-more2">
								<div class="right-arrow">
									<i class="fa fa-lg fa-linkedin"></i>
								</div></a>
							</div>-->
							<div style="clear:both"></div>
						</div>
					</div>
				</div><!--/.job-item -->
				{/foreach}

			</div>
	</section>
</div>

{literal}
<script>
	function ShowExp(id) {
		var callback = function(res) {
			var response = res.responseText;
			response = response.trim();
			if (response == "NO") {
				alert("No experience detail found.");
			} else {
				document.getElementById("expDiv").innerHTML = response;
				$('#work_experience').modal('show');
			}
		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?cid=" + id + "&REQUEST=EMPLOYEMENT_HISTORY_POPUP";
		var process = ajax.process(url, parameter);

	}

	function ShowVideo(id) {
		//document.getElementById("videoBox").innerHTML=id;
		var callback = function(res) {
			var response = res.responseText;
			response = response.trim();
			//alert(response);
			if (response == "NO") {
				alert("No video found");
			} else {
				document.getElementById("canvideoBox").innerHTML = response;
				$('#canvideo').modal('show');
			}
		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?cid=" + id + "&REQUEST=GET_CANDIDATE_VIDEO";
		var process = ajax.process(url, parameter);

	}

	function ShowNextVideo() {
		var id = document.getElementById("cid").value;
		var cvid = document.getElementById("cvid").value;
		var callback = function(res) {
			var response = res.responseText;
			response = response.trim();
			if (response == "NO") {
				alert("No more videos");
			} else {
				document.getElementById("canvideoBox").innerHTML = response;
				$('#canvideo').modal('show');
			}
		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?cid=" + id + "&vid=" + cvid + "&REQUEST=getCandidateNextVideo";
		var process = ajax.process(url, parameter);

	}

	function ShowPrevVideo() {
		var id = document.getElementById("cid").value;
		var cvid = document.getElementById("cvid").value;
		var callback = function(res) {
			var response = res.responseText;
			response = response.trim();
			if (response == "NO") {
				alert("No more videos");
			} else {
				document.getElementById("canvideoBox").innerHTML = response;
				$('#canvideo').modal('show');
			}
		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?cid=" + id + "&vid=" + cvid + "&REQUEST=getCandidatePrevVideo";
		var process = ajax.process(url, parameter);

	}

	function deleteShortlist(avId) {

		var callback = function(res) {
			var response = res.responseText;
			alert(response);
			window.location.reload();
		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?&av_id=" + avId + "&REQUEST=DELETE_SHORTLISTED_CANDIDATE";
		var process = ajax.process(url, parameter);
	}


	function addToCart(cid, eid, empJobId,avId) {
		var callback = function(res) {
			var response = res.responseText;
			alert(response);
			window.location.reload();
		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?cid=" + cid +"&eid="+eid+"&emp_job_id="+empJobId+"&av_id="+avId+"&REQUEST=ADD_TO_CART_CANDIDATES";
		var process = ajax.process(url, parameter);
	}
</script>
{/literal}

