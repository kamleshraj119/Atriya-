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
<style>
	@media print {
		aside#sidebar, header[role="banner"], footer, #comments, #respond, button, source, title, section {
			display: none;
		}
		#container #content #main {
			width: 90%;
			margin: 0px;
			padding: 0px;
		}
		* {
			color: #000;
			background-color: #fff;@include box-shadow(none);
			@include text-shadow(none);
		}
		a:after {
			content: "( " attr(href) " )";
		}
	}

	.comp {
		padding: 10px;
	}

	.comp h3, p {
		float: right;
	}

	table {
		width: 100%;
	}

	table th {
		text-align: center !important;
	}
	table, th, td {
		border: 1px solid black;
		border-collapse: collapse;
	}

	th, td {
		padding: 5px;
		text-align: left;
	}

	#mine {
		width: 100%;
		height: auto;
	}

	#mine td {
		border: none !important;
	}

	#mine tr th {
		padding: 20px 0px 20px 0px;
	}
	caption {
		border: 1px solid #000;
	}

	.print-button {
		padding: 5px;
		width: 100px;
		font-size: 15px;
		background-color: #1baa58;
		color: #fff;
		border: 1px solid #1baa58;
		transition: all 0.5s;
	}

	.print-button:hover {
		background-color: transparent;
		color: #1baa58;
	}

</style>
{/literal}
<div class="container">

	<section style="border:1px solid #000;margin-top:100px;">
		<div class="row">
			<div class="col-md-12">
				<h3 style="text-align: center;">HIRED CANDIDATES</h3>
				<hr>
				{foreach from=$DATASUCCESS item=$r key=key}
				<div style="border:1px solid green; width: 90%; margin: 0 auto;" class="row">
					<div class="col-md-12">
						<h4>{$r.mem_name}</h4>
					</div>
					<div class="col-md-2">
						<img style="padding: 20px 0px 10px 10px;" width="100px" src="http://skillchamps.in/admin/images/candidate/{$r.uid}/{$r.profile_pic}">
					</div>
					<div style="" class="col-md-5">
						<p style="float: none; padding: 20px; background: #ccc; font-weight: bold;">
							From Date:{$r.from_date}
							<br>
							From Time:{$r.from_time}
							<br>
							Salary:{$r.sal}
						</p>
					</div>
					<div style="" class="col-md-5">
						<p style="float: none; padding: 20px; margin-right: 10px;background: #ccc; font-weight: bold;">
							To Date:{$r.to_date}
							<br>
							To Time:{$r.to_time}
							<br>
							Job Type:₹{$r.job_type}
						</p>
					</div>
					<div class="col-md-12">
						<h4 style="color: green; text-align: center;">**Candidate Hired Successfully**</h4>
					</div>
				</div>

				<br>
				{/foreach}
				{foreach from=$DATAFAILED item=$r key=key}
				<div style="border:1px solid red; width: 90%; margin: 0 auto;" class="row">
					<div class="col-md-12">
						<h4>{$r.mem_name}</h4>
					</div>
					<div class="col-md-2">
						<img style="padding: 20px 0px 10px 10px;" width="100px" src="admin/images/candidate/{$r.cart_cid}/{$r.profile_pic}">
					</div>
					<div style="" class="col-md-5">
						<p style="float: none; padding: 20px; background: #ccc; font-weight: bold;">
							From Date:{$r.from_date}
							<br>
							From Time:{$r.from_time}
							<br>
							Salary:₹{$r.sal}
						</p>
					</div>
					<div style="" class="col-md-5">
						<p style="float: none; padding: 20px; margin-right: 10px;background: #ccc; font-weight: bold;">
							To Date:{$r.to_date}
							<br>
							To Time:{$r.to_time}
							<br>
							Job Type:{$r.job_type}
						</p>
					</div>
					<div class="col-md-12">
						<h4 style="color: red; text-align: center;">**Candidate Is Not Available For Hiring**</h4>
					</div>
				</div>
				<br>
				{/foreach}
			</div>
		</div>
	</section>
	<br>
	<br>

</div>

