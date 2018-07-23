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

	function showRejectJob(hid) {
		document.getElementById("hid").value = hid;
		$('#rejectJob').modal('show');
	}
</script>
<script src="assets/js/jQuery-plugin-progressbar.js"></script>
<style>
	.card {

		width: 45%;
		background-color: #eee;
		color: #000;
		border: 1px solid #ccc;
		box-sizing: border-box;
		margin-bottom: 30px;
		padding: 10px;
		margin-left: 30px;
		transition: all .5s;
	}

	.card:hover {
		box-shadow: 1px 2px 18px #999999;
	}

	.card-1 {

		width: 93.5%;
		background-color: #eee;
		color: #000;
		border: 1px solid #ccc;
		box-sizing: border-box;
		margin-bottom: 30px;
		padding: 10px;
		margin-left: 30px;
		transition: all .5s;
	}

	.card-1:hover {
		box-shadow: 1px 2px 18px #999999;
	}

	.card-2 {
		box-sizing: border-box;
		margin-right: 25px;
		transition: all .5s;
	}

	.card-2:hover {
		box-shadow: 1px 2px 18px #999999;
	}

	.progress-bar-1 {
		position: relative;
		height: 130px;
		width: 130px;
	}

	.progress-bar-1 div {
		position: absolute;
		height: 130px;
		width: 130px;
		border-radius: 50%;
	}

	.progress-bar-1 div span {
		position: absolute;
		font-family: Arial;
		font-size: 25px;
		line-height: 120px;
		height: 115px;
		width: 115px;
		left: 8px;
		top: 8px;
		text-align: center;
		border-radius: 50%;
		background-color: #ffffff;
		color: #335ecb;
	}

	.progress-bar-1 .background {
		background-color: #b3cef6;
	}

	.progress-bar-1 .rotate {
		clip: rect(0 70px 130px 0);
		background-color: #4b86db;
	}

	.progress-bar-1 .left {
		clip: rect(0 70px 130px 0);
		opacity: 1;
		background-color: #b3cef6;
	}

	.progress-bar-1 .right {
		clip: rect(0 70px 130px 0);
		transform: rotate(180deg);
		opacity: 0;
		background-color: #4b86db;
	}

	.progress-bar-2 {
		position: relative;
		height: 85px;
		width: 85px;
		margin-left: -3px;
	}

	.progress-bar-2 div {
		position: absolute;
		height: 85px;
		width: 85px;
		border-radius: 50%;
	}

	.progress-bar-2 div span {
		position: absolute;
		font-family: Arial;
		font-size: 21px;
		line-height: 75px;
		height: 75px;
		width: 75px;
		left: 5px;
		top: 5px;
		text-align: center;
		border-radius: 50%;
		background-color: #ffffff;
		color: #335ecb;
	}

	.progress-bar-2 .background {
		background-color: #b3cef6;
	}

	.progress-bar-2 .rotate {
		clip: rect(0 45px 85px 0);
		background-color: #4b86db;
	}

	.progress-bar-2 .left {
		clip: rect(0 45px 85px 0);
		opacity: 1;
		background-color: #b3cef6;
	}

	.progress-bar-2 .right {
		clip: rect(0 85px 45px 0);
		transform: rotate(90deg);
		opacity: 0;
		background-color: #4b86db;
	}

	@keyframes
	toggle {  0% {
	opacity: 0;
	}
	100% {
	opacity: 1;
	}
	}

</style>
{/literal}

<div class="col-md-12" style="margin:20px 0px;">
	<div class="msg-con" >
		{if $MSG!=""}
		<div style="background:#e9e4d4;height:40px;margin-bottom:20px;">
			<b style="font-size:24px;">{$MSG}</b>
		</div>
		{/if}
	</div>
	{foreach from=$HIRED item=r key=key}
	{if $r.job_status=='Hired' && $r.job_status!='Canceled'}
	<div class="row">
		<div class="col-md-10" style="background:#e9e4d4;height:40px;margin-bottom:20px;margin-left: 28px;width: 80%;">
			<p>
				You have been hired by {$r.company_name} for period {$r.from_date} to {$r.to_date}. Reporting address is {$r.address}. OTP for joining is {$r.mcode}.
			</p>
		</div>
		<div class="col-md-2">
			<a href="javascript:void(0)" onclick="showRejectJob('{$r.hid}')" class="get-loc" style="float:left; margin-right:10px">Reject Job</a>
		</div>
		<div class="col-md-12">
			&nbsp;
		</div>
	</div>
	{/if}
	{/foreach}
</div>

<br>
<br>





<div class="col-md-12">
	<div class="msg-con">
		<h4 style="color: #444444 !important;"><img src="assets/images/top-5.png" >&nbsp;&nbsp;Top 5 Candidates</h4>

		<div style="height:1px; float:left; width:100%; background-color:#ccc; margin-top:10px" ></div>

		<div class="row" style="margin: 50px 0px;">

			{foreach from=$CANDIDATEHOME['top_five'] item=$c key=key}
			<div class="col-md-2 col-sm-2 col-xs-12 card-2" style="margin-top: 20px; margin-left: 10px;">

				<div class="row">

					<center>
						<div class="col-md-12" style="background: #335ecb;">
							<div style="padding: 13px 0px;" class="row">
								<img style="border-radius: 50%; border:2px solid #fff; width: 100px;height: 100px;" src="http://skillchamps.in/admin/images/candidate/{$c.uid}/{$c.profile_pic}" />
								<p style="margin-top:10px;color: #fff; height: 72px;">
									{$c.name}
								</p>
							</div>

						</div>

						<div class="col-md-12" style="background: #b4c9ff;">
							<p style="font-size: 14px;">
								Amount
							</p>
							<p style="font-size: 14px; font-weight: bold;">
								₹{$c.total}
							</p>
							<div class="progress-bar-2" id="{$c.uid}" data-percent="{$c.per|string_format:"%d"}" data-duration="2000" data-color="#e1e3e3,#325eca"></div>
							<script>
								$("#{$c.uid}").loading();
							</script>
							<p style="font-size: 14px; font-weight: bold; padding: 10px 0px;">
								Performance
							</p>
						</div>
					</center>

				</div>

			</div>
			{/foreach}
		</div>

	</div>
</div>

<div class="col-md-12">

	<div class="msg-con">
		<h4 style="color: #444444 !important;"><img src="assets/images/rocket.png">&nbsp;&nbsp;Rocket</h4>

		<div style="height:1px; float:left; width:100%; background-color:#ccc; margin-top:10px" ></div>
		<div class="row" style="margin: 50px 0px;">
			<div class="col-md-4 col-sm-4 col-xs-12">

				<center>

					<div class="progress-bar-1" id="p" data-percent="{$CANDIDATEHOME['rocket'][0].change_per|string_format:"%d"}" data-duration="2000" data-color="#e1e3e3,#325eca"></div>
					<p>
						Change 7 Days
					</p>
					<script>
						$("#p").loading();
					</script>
				</center>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12 subs-box">
				<center>
					<div class="progress-bar-1" id="q" data-percent="{$CANDIDATEHOME['rocket'][0].cur_per|string_format:"%d"}" data-duration="2000" data-color="#e1e3e3,#325eca"></div>
					<p>
						Performance
					</p>
					<script>
						$("#q").loading();
					</script>
				</center>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12 subs-box">
				<center>
					{if $CANDIDATEHOME['rocket'][0].in_nxt_per lt $CANDIDATEHOME['rocket'][0].cur_per && $CANDIDATEHOME['rocket'][0].in_nxt_per != 0}
					<br>
					<p align="center">
					{math equation="({$CANDIDATEHOME['rocket'][0].in_pkt_nxt} - {$CANDIDATEHOME['rocket'][0].in_pkt})"}	&nbsp;Packets<br>
					</p>
					{else if $CANDIDATEHOME['rocket'][0].in_nxt_per == 0}
					
					<br><br>
					{else}
					<div class="progress-bar-1" id="r" data-percent="{$CANDIDATEHOME['rocket'][0].in_nxt_per|string_format:"%d"}" data-duration="2000" data-color="#e1e3e3,#325eca"></div>
					{/if}					
					<p>
						Boost Next Change
					</p>
					<script>
						$("#r").loading();
					</script>
				</center>
			</div>
		</div>
		<div class="row">

			<div class="col-md-6 card">
				<h4 style="text-align: center; background: #335ecb; color: #fff; padding: 5px 0px;">Crossed Candidate</h4>

				<p align="center">
					{$CANDIDATEHOME['rocket'][0].in_rank_nxt}
				</p>

			</div>

			<div class="col-md-6 card">
				<h4 style="text-align: center; background: #335ecb; color: #fff; padding: 5px 0px;">Chasing Candidate</h4>

				<p align="center">
					{$CANDIDATEHOME['rocket'][0].in_rank_prv}
				</p>

			</div>

		</div>

		<div class="row">

			<div class="col-md-12 card-1">
				<h4 style="text-align: center; background: #335ecb; color: #fff; padding: 5px 0px;"><img src="assets/images/rank.png">&nbsp;&nbsp;Candidate Rank</h4>
				<br>
				<div class="col-md-4">
					<center>
						<img src="assets/images/company.png">
						<h5 style="text-align: center;">Company</h5>
						<p align="center">
							{$CANDIDATEHOME['rocket'][0].in_rank_com}
						</p>
					</center>
				</div>

				<div class="col-md-4">
					<center>
						<img src="assets/images/depot.png">
						<h5 style="text-align: center;">Depot</h5>
						<p align="center">
							{$CANDIDATEHOME['rocket'][0].in_rank_depo}
						</p>
					</center>
				</div>

				<div class="col-md-4">
					<center>
						<img src="assets/images/world.png">
						<h5 style="text-align: center;">World</h5>
						<p align="center">
							{$CANDIDATEHOME['rocket'][0].in_rank}
						</p>

					</center>
				</div>
			</div>

		</div>

		<div class="row">

			<div class="col-md-12 card-1">
				<h4 style="text-align: center; background: #335ecb; color: #fff; padding: 5px 0px;"><img src="assets/images/total-work.png">&nbsp;&nbsp;Candidate Total Work</h4>
				<br>
				<div class="col-md-4">
					<center>
						<img src="assets/images/hour.png">
						<h5 style="text-align: center;">Hours</h5>
						<p align="center">
							{$CANDIDATEHOME['rocket'][0].in_hours}
						</p>
					</center>
				</div>

				<div class="col-md-4">
					<center>
						<img src="assets/images/days.png">
						<h5 style="text-align: center;">Days</h5>
						<p align="center">
							{$CANDIDATEHOME['rocket'][0].in_days}
						</p>
					</center>
				</div>

				<div class="col-md-4">
					<center>
						<img src="assets/images/shift.png">
						<h5 style="text-align: center;">Shift</h5>
						<p align="center">
							{$CANDIDATEHOME['rocket'][0].in_shift}
						</p>
					</center>
				</div>
			</div>

		</div>

	</div>

</div>

<div class="col-md-12">

	<div class="msg-con">
		<h4 style="color: #444444 !important;"><img src="assets/images/pocket.png">&nbsp;&nbsp;Pocket</h4>

		<div style="height:1px; float:left; width:100%; background-color:#cccccc; margin-top:10px; margin-bottom:30px;" ></div>

		<div class="row">

			<div class="col-md-12 card-1">
				<h4 style="text-align: center; background: #335ecb; color: #fff; padding: 5px 0px;"><img src="assets/images/hard1.png">&nbsp;&nbsp;Work Hard</h4>
				<br>
				<div class="col-md-4">
					<h5 style="text-align: center;">Cash</h5>
					<p align="center">
						₹{$CANDIDATEHOME['pocket']['work_hard'].cash}
					</p>
				</div>

				<div class="col-md-4">
					<h5 style="text-align: center;">Points</h5>
					<p align="center">
						{$CANDIDATEHOME['pocket']['work_hard'].points}
					</p>
				</div>

				<div class="col-md-4">
					<h5 style="text-align: center;">Credits</h5>
					<p align="center">
						{$CANDIDATEHOME['pocket']['work_hard'].credits}
					</p>
				</div>
			</div>

		</div>

		<div class="row">

			<div class="col-md-12 card-1">
				<h4 style="text-align: center; background: #335ecb; color: #fff; padding: 5px 0px;"><img src="assets/images/feel-good.png">&nbsp;&nbsp;Feel Good</h4>
				<br>
				<div class="col-md-4">
					<h5 style="text-align: center;">Incentive</h5>
					<p align="center">
						₹{$CANDIDATEHOME['pocket']['feel_good'].incentive}
					</p>
				</div>

				<div class="col-md-4">
					<h5 style="text-align: center;">Awards</h5>
					<p align="center">
						{$CANDIDATEHOME['pocket']['feel_good'].awards}
					</p>
				</div>

				<div class="col-md-4">
					<h5 style="text-align: center;">Loyalty</h5>
					<p align="center">
						{$CANDIDATEHOME['pocket']['feel_good'].loylty}
					</p>
				</div>
			</div>

		</div>

		<div class="row">

			<div class="col-md-12 card-1">
				<h4 style="text-align: center; background: #335ecb; color: #fff; padding: 5px 0px;"><img src="assets/images/compliance.png">&nbsp;&nbsp;Compliance</h4>
				<br>
				<div class="col-md-4">
					<h5 style="text-align: center;">Training</h5>
					<p align="center">
						{$CANDIDATEHOME['pocket']['compliance'].tarining}
					</p>
				</div>

				<div class="col-md-4">
					<h5 style="text-align: center;">Counselling</h5>
					<p align="center">
						{$CANDIDATEHOME['pocket']['compliance'].counselling}
					</p>
				</div>

				<div class="col-md-4">
					<h5 style="text-align: center;">Bench</h5>
					<p align="center">
						{$CANDIDATEHOME['pocket']['compliance'].Bench}
					</p>
				</div>
			</div>

		</div>

		<div class="row">

			<div class="col-md-12 card-1">
				<h4 style="text-align: center; background: #335ecb; color: #fff; padding: 5px 0px;"><img src="assets/images/growing-old.png">&nbsp;&nbsp;Growing Old</h4>
				<br>
				<div class="col-md-4">
					<h5 style="text-align: center;">Earned</h5>
					<p align="center">
						₹{$CANDIDATEHOME['pocket']['growing_old'].earned}
					</p>
				</div>

				<div class="col-md-4">
					<h5 style="text-align: center;">Lost</h5>
					<p align="center">
						{$CANDIDATEHOME['pocket']['growing_old'].lost}
					</p>
				</div>

				<div class="col-md-4">
					<h5 style="text-align: center;">Opportunity</h5>
					<p align="center">
						{$CANDIDATEHOME['pocket']['growing_old'].opportunity}
					</p>
				</div>
			</div>

		</div>

		<div class="row">

			<div class="col-md-12 card-1">
				<h4 style="text-align: center; background: #335ecb; color: #fff; padding: 5px 0px;"><img src="assets/images/feel-young.png">&nbsp;&nbsp;Feel Young</h4>
				<br>
				<div class="col-md-4">
					<h5 style="text-align: center;">Earned</h5>
					<p align="center">
						₹{$CANDIDATEHOME['pocket']['feel_young'].earned}
					</p>
				</div>

				<div class="col-md-4">
					<h5 style="text-align: center;">Lost</h5>
					<p align="center">
						{$CANDIDATEHOME['pocket']['feel_young'].lost}
					</p>
				</div>

				<div class="col-md-4">
					<h5 style="text-align: center;">Opportunity</h5>
					<p align="center">
						{$CANDIDATEHOME['pocket']['feel_young'].opportunity}
					</p>
				</div>
			</div>
		</div>
	</div>
</div>





<div class="col-md-12">

	<div class="col-md-12" style="padding-bottom: 10px;">

		<h3><img src="assets/images/msg.png" />&nbsp;&nbsp;&nbsp;Recent Messages 
			<a class="msg-v-all1 get-loc" href="candidate.php?action=messages" >View All</a>
		</h3>
		

	</div>



	<div class="col-md-12" style="padding-bottom: 10px; margin-top: 15px;">
		<form action="candidate.php?action=home" method="POST">

			{foreach from=$DATA item=r key=key}
			<a href="candidate.php?action=read_message&id={$r.msg_id}" class="msg-wrp">
			<p style="padding: 0px 0px 20px 0px;border-bottom: 1px solid #efecec;">
				#{$r.msg_number} &nbsp;&nbsp;&nbsp;&nbsp;{$r.msg}
				<br>
				Last updated on {$DATA[0].msg_posted_on}
			</p> </a>

			{/foreach}
		</form>
	</div>

</div>