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
<div class="col-md-12 resp-work-exp" style="margin-top:20px;">

	<h4>Hired Candidates</h4>

	<div class="my-bookmark" style="margin-top:10px;">
		<div class="table-responsive">
			<table class=" table-hover js-basic-example dataTable large-table">

					<thead style="border-bottom:3px solid #fcc512 !important;">
						<tr style="background: none;">
						<th style="padding: 20px;"><a style="color:#062223;" href="#" class="row-head">Name<b class="caret"></b></a></th>
						<th style="padding: 20px;"><a style="color:#062223;" href="#" class="row-head">Phone<b class="caret"></b></a></th>
						<th style="padding: 20px;"><a style="color:#062223;" href="#" class="row-head">Pincode<b class="caret"></b></a></th>
						<th style="padding: 20px;"><a style="color:#062223;" href="#" class="row-head">Start Date<b class="caret"></b></a></th>
						<th style="padding: 20px;"><a style="color:#062223;" href="#" class="row-head">Ending date<b class="caret"></b></a></th>
						<th style="padding: 20px;"><a style="color:#062223;" href="#" class="row-head">Status<b class="caret"></b></a></th>
						<th style="padding: 20px;"><a style="color:#062223;" href="#" class="row-head">Action<b class="caret"></b></a></th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$DATA item=$r key=key}
					<tr>
						<td style="padding: 20px;"><a href="#" data-toggle="modal" data-target="#rating"> {$r.mem_name} </a></td>
						<td style="padding: 20px;">{$r.mobile}</td>
						<td style="padding: 20px;">{$r.pincode}</td>
						<td style="padding: 20px;">{$r.from_date}</td>
						<td style="padding: 20px;">{$r.to_date} </td>
						<td style="padding: 20px;">{$r.job_status}</td>
						<td style="padding: 20px;">
							{if $r.job_status=='Hired' && $r.job_status!='Canceled'}
							<a href="javascript:void(0)" onclick="showStartJob('{$r.hid}')" class="reply" style="color:#fff; float:left; margin-right:10px">Start Job</a>{/if}
							{if $r.job_status!='Terminated' || $r.job_status=='Hired'}
							<a href="javascript:void(0)" onclick="showTerminateJob('{$r.hid}')" class="reply" style="color:#fff; float:left; margin-right:10px">Terminate</a>{/if}
							<!--<a href="javascript:void(0)" onclick="rehireCandidate('{$r.emp_job_id}','{$r.hcid}')" class="reply" style="color:#fff; float:left; margin-right:10px">Rehire</a>-->
							<a href="employer.php?action=insert_user_rating&cid={$r.hcid}" class="reply" style="color:#fff; float:left; margin-right:10px">Rate</a>
						</td>
					</tr>
					{/foreach}
				</tbody>
			</table>
		</div>
	</div>

</div>

{literal}
<script>
	function rehireCandidate (empJobId,candidateId) {
	  var callback = function(res) {
			var response = res.responseText;
			alert(response);
			window.location.reload();
		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?emp_job_id=" + empJobId +"&cid="+candidateId+"&REQUEST=REHIRE_CANDIDATE";
		var process = ajax.process(url, parameter);
	}
	function showStartJob (hid) {
		document.getElementById("id").value=hid;
	  	$('#startJob').modal('show');
	}
	function showTerminateJob (hid) {
	  	document.getElementById("hid").value=hid;
	  	$('#terminateJob').modal('show');
	}
</script>
{/literal}
