{literal}
<script>
	(function(i, s, o, g, r, a, m) {
		i['GoogleAnalyticsObject'] = r;
		i[r] = i[r] ||
		function() {
			(i[r].q = i[r].q || []).push(arguments)
		}, i[r].l = 1 * new Date();
		a = s.createElement(o), m = s.getElementsByTagName(o)[0];
		a.async = 1;
		a.src = g;
		m.parentNode.insertBefore(a, m)
	})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

	ga('create', 'UA-107038257-1', 'auto');
	ga('send', 'pageview');

	function showRejectJob(hid) {
		document.getElementById("hid").value = hid;
		$('#rejectJob').modal('show');
	}
</script>

<style>
	.subs-upper {
		/*background: #ecb62a;*/
		background: #004d40;
	}
	.subs-upper h4 {
		color: #ffffff !important;
		line-height: 50px;
	}

	.subs-upper h3 {
		color: #ffffff !important;
		padding: 15px;
		font-size: 18px;
	}

	.subs-upper a {
		color: #ffffff;
		font-size: 14px;
		background: #8e6600;
		padding: 10px;
		line-height: 90px;
		border: 1px solid #8e6600;
		transition: all .3s;
	}

	.subs-upper a:hover {
		background: transparent;
		border: 1px dashed #ffffff;
	}

	.subs-upper input {
		background: #ffffff;
		color: #ffffff;
	}

	.subs-down {
		background: #eee;
	}

	.subs-down p {
		text-align: justify;
		font-size: 14px;
		padding: 20px;
	}

	.subs-down h5 {
		line-height: 40px;
	}

	.subs-down h5:first-child {
		margin-top: 30px;
	}
	.subs-down h5:last-child {
		margin-bottom: 30px;
	}

	.subs-foot {
		background: #eeeeee;
		padding: 20px;
	}
	.subs-foot a {
		color: #8c8c8c;
		/* background: #909090; */
		padding: 10px;
		/* border: 1px solid #909090; */
		transition: all .3s;
		border-radius: 6px;
	}

	.subs-foot a:hover {
		background: transparent;
		border: 1px dashed #909090;
	}

	label input[type="checkbox"] ~
	i.fa.fa-square-o {
		color: #ffffff;
		font-size: 18px;
		display: inline;
	}
	label input[type="checkbox"] ~
	i.fa.fa-check-square-o {
		display: none;
		font-size: 18px;
	}
	label input[type="checkbox"]:checked ~
	i.fa.fa-square-o {
		display: none;
		font-size: 18px;
	}
	label input[type="checkbox"]:checked ~
	i.fa.fa-check-square-o {
		color: #ffffff;
		font-size: 18px;
		display: inline;
	}

	label.btn span {
		font-size: 1.3em;
	}

	label input[type="radio"] ~
	i.fa.fa-circle-o {
		color: #ffffff;
		font-size: 21px;
		display: inline;
	}
	label input[type="radio"] ~
	i.fa.fa-dot-circle-o {
		display: none;
		font-size: 21px;
	}
	label input[type="radio"]:checked ~
	i.fa.fa-circle-o {
		display: none;
		font-size: 21px;
	}
	label input[type="radio"]:checked ~
	i.fa.fa-dot-circle-o {
		color: #ffffff;
		font-size: 21px;
		display: inline;
	}
	label:hover input[type="radio"] ~
	i.fa {
		color: #ffffff;
	}

	div[data-toggle="buttons"] label {
		display: inline-block;
		padding: 6px 12px;
		margin-bottom: 0;
		font-size: 14px;
		font-weight: normal;
		line-height: 2em;
		text-align: left;
		white-space: nowrap;
		vertical-align: top;
		cursor: pointer;
		background-color: none;
		border: 0px solid #ffffff;
		border-radius: 3px;
		color: #ffffff;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		-o-user-select: none;
		user-select: none;
	}

	label.btn {
		box-shadow: none !important;
	}

	.subs-box {
		transition: all .4s;
	}

	.subs-box:hover {
		margin-top: -30px;
	}

	@media only screen and (max-width: 1100px) and (min-width: 992px) {
		.subs-down-resp {
			height: 290px;
			line-height: 21px;
		}

		.subs-upper-resp h3 {
			line-height: 35px;
		}

		.subs-upper-resp {
			height: 130px;
		}

	}

</style>

{/literal}
<form id="frmcheckout" name="frmcheckout" method="post" >
	<input id="user_id" name="uid" type="hidden" value="{$USERDETAILS[0].uid}" />
	<input id="service_charge" name="service_charge" type="hidden"  value=""/>
	<input id="gst" name="gst" type="hidden" value=""/>
	<input id="amount_payable" name="amount_payable" type="hidden" value=""/>
	<input id="sr_id" name="sr_id" type="hidden" value=""/>
	<input id="gstin" name="gstin" type="hidden" value="{$USERDETAILS[0].gstin}"/>
	<input id="mobileNum" name="mobile" type="hidden" value="{$USERDETAILS[0].mobile}"/>
	<input id="emailId" name="email" type="hidden" value="{$USERDETAILS[0].email}"/>
	<input id="type" name="type" type="hidden" value="{$TYPE}"/>

</form>

<div class="col-md-12">

	<div class="msg-con">
		<h2 style="color: #444444 !important;">SUBSCRIPTIONS</h2>

		<div style="height:1px; float:left; width:100%; background-color:#ccc; margin-top:10px" ></div>

		<div class="row" style="margin-top: 50px;" >
			{foreach from=$DATA item=r key=key}
			<form id="subs{$r.sd_id}" name="subs{$r.sd_id}">
				<div class="col-md-4 col-sm-12 col-xs-12 subs-box" >
					<div class="col-md-12 subs-upper subs-upper-resp">
						<h3 align="center" {if $r.active== "YES"} style="margin-bottom: -12px;"{/if}>{$r.name}{if $r.active== "YES"} <b>(Active)</b>{/if}</h3>
						{if $r.active== "YES"}
						<span style="margin-left:140px;color:#ffff;"> ({$r.start_date} &nbsp;to&nbsp;  {$r.end_date})</span>
						{/if}
					</div>
					<div class="col-md-12 subs-down subs-down-resp">
						<p>
							{$r.des}
						</p>
					</div>
					<div class="col-md-12 subs-upper">
						<div class="btn-group btn-group-vertical" data-toggle="buttons">
							{foreach from=$r.rates item=r1 key=key1}
							<label class="btn" onclick="checkRate('{$r1.rate}','{$r.sd_id}');">
								<input type="radio" name='rate_amount' value="{$r1.rate},{$r1.gst},{$r1.total},{$r1.sr_id},{$r1.st_id}" id="rate_amount" data-DivId="sub{$r.sd_id}rate_amount{$r1.sr_id}" >
								<i class="fa fa-circle-o fa-2x"></i><i class="fa fa-dot-circle-o fa-2x" ></i> <span>&nbsp; ₹ {$r1.rate}&nbsp;{$r1.st_name}</span> </label>
							{/foreach}

						</div>
						<br>
						<div class="btn-group btn-group-vertical">
							<label class="btn" id="credit{$r.sd_id}">
								<input type="checkbox" name='credit' style="visibility: hidden; margin-left: -12px;">
								<i style="margin-right: 0.15em;" class="fa fa-square-o fa-2x"></i><i class="fa fa-check-square-o fa-2x"></i> <span style="font-size: 15px; color: #fff;"> Use Credits</span> </label>
						</div>
						<br>
					</div>
					<div class="col-md-12 subs-foot">
						<center>
							<input type="hidden" id="radioValue" value="">
							<input type="hidden" name="status" id="status" value="{$r.active}">
							<a href="javascript:void(0);"  id="subs_checkout" onclick="Checkout('{$r.sd_id}');">Start</a>
						</center>
					</div>
				</div>
			</form>
			{/foreach}
		</div>

	</div>

</div>
{literal}
<script>
	function checkRate(rate, sdId) {
		if (rate <= 0) {
			$("#credit" + sdId).hide();
		} else {
			$("#credit" + sdId).show();
		}
	}

	function Checkout(sd_id) {
		var myDivId = "subs" + sd_id;
		var radioCheck = document.forms[myDivId].elements["rate_amount"].checked;
		var formValue = document.forms[myDivId].elements["rate_amount"].value;
		var uid = document.getElementById('user_id').value;		
		var status = document.forms[myDivId].elements["status"].value;
		if(status == "YES"){
			alert("subscription plan is active!");
		}else{
			if (radioCheck == false) {
			alert("Please select subscription plan !");
		} else {
			if (formValue == "" || formValue == null) {
				alert("Please select subscription plan !");
			} else {
				var sr_id = '';
				var data = formValue.split(",");
				sr_id = data[3];
				if (data[0] > 0) {
					document.getElementById("service_charge").value = data[0];
					document.getElementById("gst").value = data[1];
					document.getElementById("amount_payable").value = data[2];
					document.getElementById("sr_id").value = data[3];
					document.getElementById("frmcheckout").action = "admin/application/CheckoutProcessSubscription.php";
					document.getElementById("frmcheckout").submit();
				} else {
					window.location.href = "candidate.php?action=insert_subscription&sr_id=" + sr_id + "&uid=" + uid;
				}
			}
		} 
		}
		
	}
</script>
{/literal}

