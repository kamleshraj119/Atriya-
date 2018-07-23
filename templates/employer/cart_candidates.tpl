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
<form id="frmcheckout" name="frmcheckout" method="post" >
	<input id="eid" name="eid" type="hidden" value="{$EMP_ID}" />
	<input id="manpower_charge" name="manpower_charge" type="hidden"  />
	<input id="service_charge" name="service_charge" type="hidden"  />
	<input id="gst" name="gst" type="hidden" />
	<input id="amount_payable" name="amount_payable" type="hidden" />
	<input id="email" name="email" type="hidden" value="{$DETAILS[0].email}" />
	<input id="mobile" name="mobile" type="hidden" value="{$DETAILS[0].mobile}" />
	<input id="gstin" name="gstin" type="hidden" value="{$DETAILS[0].gstin}" />
	<input type="checkbox" id="cartid" name="cartid[]"  style="display:none" checked="checked" />	
</form>	
<div class="col-md-12 resp-work-exp" style="margin-top:20px;">
	
	<section class="" id="benifit" style="">

		<div class="container-fluid" style="padding-top:10px;">
			<div class="row">
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 cart-card">
					{if $DATA|@count gt 0}
					{foreach from=$DATA item=$r key=key}
					<div class="row" data-wow-delay="0.2s">
						<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12">
							<center>
							{if $r.profile_pic!=""}
								<img style="margin: 10px 0px 0px 0px;" src="http://skillchamps.in/admin/images/candidate/{$r.cid}/{$r.profile_pic}" width="87px" height="92px" alt="">
								{else}
								<img style="margin: 10px 0px 0px 0px;" src="http://skillchamps.in/assets/images/individu-1.png" alt="">
							{/if}
								</center>
							
						</div>

						<div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-xs-12 cart-p">

							<h4>{$r.mem_name} <span style="color:#ccc;">({$r.from_date} To {$r.to_date})</span></h4>
							<div class="row">
								
								<div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-xs-12">
									
									<p>
										Salary :<br> <span>₹{$r.exp_sal}</span>
									</p>
									
								</div>
								<div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-xs-12">
									
									<p>
										Period :<br> <span> {$r.period}</span>
									</p>
									
								</div>
								<div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-xs-12">
								
									<p>
										Total : <br> <span> ₹{$r.total_am|string_format:"%.2f"}</span>
									</p>
								
								</div>
								<div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-xs-12">
									
									<p>
										Service Charge : <br> <span> ₹{$r.service_charge|string_format:"%.2f"}</span>
									</p>
								
								</div>
								<div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-xs-12">
									
									<p>
										GST (18%) : <br> <span> ₹{$r.gst|string_format:"%.2f"}</span>
									</p>
							
								</div>
								<div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-xs-12">
								
									<p>
										Payable Amount :<br> <span> ₹{$r.total_pay|string_format:"%.2f"}</span>
									</p>
								
									</div>
								</div>
								<div class="row">
								
								<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
									
										<div class="cart-btns-mine">
											
											<a style="margin-right: 10px;" href="javascript:void(0);" data-toggle="modal"  onclick="ShowExp('{$r.cid}');">Experience</a>
											
										</div>

										<div class="cart-btns-mine">
											
											<a style="margin-right: 10px;" href="javascript:void(0);" data-toggle="modal"  onclick="ShowVideo('{$r.cid}');">Video</a>
											
										</div>

										<div class="cart-btns-mine">
											
											<a style="margin-right: 10px;" href="javascript:void(0);" data-toggle="modal"  onclick="deleteFromCart('{$r.t1id}')">Remove</a>
											
										</div>
										
										<div class="cart-btns-mine-def cart-btns-mine-span">
											{if $r.available=="YES"}
											<a href="javascript:void(0);" data-toggle="modal"   onclick="checkout('{$r.total_am}','{$r.service_charge}','{$r.gst}','{$r.total_pay}','{$r.id}','{$r.available}');">CHECKOUT</a>
											{else}
											<span style="color:#DA3438;">Candidate not avilable.</span>
											{/if}
										</div>
										
									
								</div>
							</div>
							</div>
					</div>
					<hr>
					{/foreach}
					{else}
						No Items.
					{/if}
					</div>
					
					
				</div>
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

	function deleteFromCart(avId) {

		var callback = function(res) {
			var response = res.responseText;
			alert(response);
			window.location.reload();
		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?&av_id=" + avId + "&REQUEST=DELETE_CART_CANDIDATE";
		var process = ajax.process(url, parameter);
	}

	function hireCandidate(avId, empJobId) {
		var callback = function(res) {
			var response = res.responseText;
			alert(response);
			window.location.reload();
		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?emp_job_id=" + empJobId + "&av_id=" + avId + "&REQUEST=HIRE_CANDIDATE";
		var process = ajax.process(url, parameter);
	}
	
	function checkout(manpower,serviceCharge,gst,total,cartId,available){
		if(available=="YES"){
			document.getElementById("manpower_charge").value = manpower;
			document.getElementById("service_charge").value = serviceCharge;
			document.getElementById("gst").value = gst;
			document.getElementById("amount_payable").value = total;
			document.getElementById("cartid").value = cartId;
			document.getElementById("frmcheckout").action = "admin/application/CheckoutProcess.php";
		    document.getElementById("frmcheckout").submit();
		}else{
			alert("Candidate is not available.");
		}
		
	}
</script>
{/literal}

