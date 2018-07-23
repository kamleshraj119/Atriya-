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
<div class="col-md-12 resp-work-exp" style="margin-top:20px;">
	
	<input id="eid" name="eid" type="hidden" value="{$EMP_ID}" />
	<input id="manpower_charge" name="manpower_charge" type="hidden" value="{$DATA[0].total_am}" />
	<input id="service_charge" name="service_charge" type="hidden" value="{$DATA[0].service_charge}" />
	<input id="gst" name="gst" type="hidden" value="{$DATA[0].gst}" />
	<input id="amount_payable" name="amount_payable" type="hidden" value="{$DATA[0].total_pay}" />
	<input id="email" name="email" type="hidden" value="{$DETAILS[0].email}" />
	<input id="mobile" name="mobile" type="hidden" value="{$DETAILS[0].mobile}" />
	<input id="gstin" name="gstin" type="hidden" value="{$DETAILS[0].gstin}" />
	<input id="checkout" name="checkout" type="hidden" value="{$DATA[0].checkout}" />
	<section class="" id="benifit" style="">

		<div class="container-fluid" style="padding-top:10px;">
			<div class="row">
				{if $DATA|@count gt 0}
				<div class="cart-card resp-cart-card col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12" style="">
					{foreach from=$DATA item=$r key=key}
					<input type="checkbox" name="cartid[]" value="{$r.id}" style="display:none" checked="checked" />
					<div style="margin: 10px 0px 10px 0px;{if $DATA|@count gt 1} border-bottom: 1px solid #e9e7e7;{/if}" class="row" data-wow-delay="0.2s">
						<div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 col-xs-12">
							<center>
							{if $r.profile_pic!=""}
								<img style="margin: 10px 0px 0px 0px;" src="http://skillchamps.in/admin/images/candidate/{$r.cid}/{$r.profile_pic}" width="87px" height="92px" alt="">
								{else}
								<img style="margin: 10px 0px 0px 0px;" src="http://skillchamps.in/assets/images/individu-1.png" alt="">
							{/if}
								</center>
							
						</div>

						<div style="margin-bottom: 20px" class="col-xl-10 col-lg-10 col-md-10 col-sm-12 col-xs-12 cart-p">

							<h4>{$r.mem_name} <span style="color:#ccc;">({$r.from_date} To {$r.to_date})</span></h4>
							<div class="row">
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4">
									<p style="text-align: center;">
										<b>Salary :</b> ₹{$r.exp_sal}
									</p>
								</div>
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4">
									<p style="text-align: center;">
										<b>Period :</b> {$r.period}
									</p>
								</div>
								<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4">
									<p style="text-align: center;">
										<b>Total : ₹{if $r.exp_sal!='' && $r.period!=''}{math equation="x * y" x=$r.exp_sal y=$r.period}{else}0{/if}</b>
									</p>
								</div>
							</div>
							<div class="row">
								
									
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4">
										<p style="text-align: center;">
										<a style="color: #062223; font-size: 16px;" href="javascript:void(0);" data-toggle="modal"  onclick="ShowExp('{$r.cid}');">Experience</a>
										</p>
									</div>
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4">
										<p style="text-align: center;">
										<a style="color: #062223; font-size: 16px;" href="javascript:void(0);" data-toggle="modal"  onclick="ShowVideo('{$r.cid}');">Video</a>
										</p>
									</div>
									<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4">
										<p style="text-align: center;">
										<a style="color: #062223; font-size: 16px;" href="javascript:void(0);" data-toggle="modal"  onclick="deleteFromCart('{$r.t1id}')">Remove</a>
										</p>
									</div>
									
								
								{if $r.available=="NO"}
								<div style="text-align:center;" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
									<span style="color:#DA3438;"><i>Candidate not avilable.</i></span>
								</div>
								{/if}
							</div>
						</div>
						

					</div>
					
					
					
					
					{/foreach}
				</div>
				
				<div class="cart-card col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12" style="">
					<h4 style="text-align: center;">Price Details</h4>
					<hr>
					
					<div class="col-xl-8 col-lg-8 col-sm-8 col-xs-8">
					<p><b>Total Price :</b></p>
					</div>
					<div class="col-xl-4 col-lg-4 col-sm-4 col-xs-4">
					 <span class="fr">₹{$DATA[0].total_am|string_format:"%.2f"}</span>
					</div>
					<div class="col-xl-8 col-lg-8 col-sm-8 col-xs-8">
					<p><b>Services Charge :</b></p>
					</div>
					<div class="col-xl-4 col-lg-4 col-sm-4 col-xs-4">
					 <span class="fr">₹{$DATA[0].service_charge|string_format:"%.2f"}</span>
					</div>
					<div class="col-xl-8 col-lg-8 col-sm-8 col-xs-8">
					<p><b>GST (18%) :</b></p>
					</div>
					<div class="col-xl-4 col-lg-4 col-sm-4 col-xs-4">
					 <span class="fr">₹{$DATA[0].gst|string_format:"%.2f"}</span>
					</div>
					
					<hr>
					<div class="col-xl-8 col-lg-8 col-sm-8 col-xs-8">
					<p><b>Amount Payable :</b></p>
					</div>
					<div class="col-xl-4 col-lg-4 col-sm-4 col-xs-4">
					 <span class="fr">₹{$DATA[0].total_pay|string_format:"%.2f"}</span>
					</div>
					
					<hr>
					
					<div class="col-xl-12 col-lg-12 col-sm-12 col-xs-12 cart-btns-mine-athor">
					 <center>
						<a style="" href="javascript:void(0);" data-toggle="modal"  onclick="checkout();">Checkout</a>
					</center>
				
					</div>
				</div>
				{else}
					No Items.
				{/if}
			</div>
				
		</div>
	</section>
</div>
</form>
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
	
	function checkout(){
		var checkout=document.getElementById("checkout").value;
		if(checkout=="true"){
			document.getElementById("frmcheckout").action = "admin/application/CheckoutProcess.php";
	    	document.getElementById("frmcheckout").submit();
		}else{
			alert("Please remove unavailable candidate.");
		}
		
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
</script>
{/literal}
