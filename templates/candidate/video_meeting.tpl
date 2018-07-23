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

</script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.1.9/jquery.datetimepicker.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.1.9/jquery.datetimepicker.min.js"></script>
{/literal}
<form name="frmAvail" id="frmAvail" action="" class="form-horizontal" method="post">
	<div class="work-exp col-md-12">
		<br>
		<div class="msg-con" >
			{if $MSG!=""}
			<div style="background:#e9e4d4;height:40px;margin-bottom:20px;">
				<b style="font-size:24px;">{$MSG}</b>
			</div>
			{/if}
		</div>
		<div class="row">

			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<div  style="margin-bottom:20px;">
							<h4>Request Video Meeting</h4>
						</div>
					</div>

					<div class="col-md-12">
						<input type="hidden" class="def-input" name="id" id="id" value="{$ID}">
						<input type="hidden" class="def-input" name="uid" id="uid" value="{$CID}">
						<input type="hidden" class="def-input" name="title" id="title" value="Skillchamps interview {$DETAILS[0].name} {$DETAILS[0].mobile}">
					</div>
					<div class="col-md-6" >

						<div class="form-group">
							<div class="col-md-12">
								<strong>From*</strong>
							</div>
							<div class="col-md-12">
								<input type="text" class="def-input" id="event-start-time" name="from" placeholder="Event Start Time" autocomplete="off" readonly/>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<strong>Email(Gmail)*</strong>
							</div>
							<div class="col-md-12">
								<input type="email" class="def-input" name="gmail" id="gmail">

							</div>
						</div>

					</div>
					<div class="col-md-6">

						<div class="form-group">
							<div class="col-md-12">
								<strong>To*</strong>
							</div>
							<div class="col-md-12">
								<input type="text" class="def-input" id="event-end-time" name="to" placeholder="Event End Time" autocomplete="off"  readonly/>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<strong>Skill*</strong>
							</div>
							<div class="col-md-12">
								<select name="skill_name" id="skill_name" class="form-control show-tick" >
									<option value="" disabled selected>Select Prefered Skill</option>
									{foreach from=$SKILLS item=r key=key}
									<option value="{$r.multiskill}">{$r.multiskill}</option>
									{/foreach}
								</select>
							</div>
						</div>
					</div>

				</div>

			</div>
		</div>
	</div><!--/.personal-data -->

	<div class="col-md-12 ">
		<input  type="button" class="btn  btn-raised btn-success waves-effect" value="SUBMIT" name="btnSubmit " id="btnSubmit" onclick="submitForm()" >
	</div>

</form>
<div class="col-md-12 body" style="margin-top:20px;">
	<div style="margin-bottom:20px;" class="row">
		<h4>Video Meeting</h4>
	</div>
	<div class="my-bookmark" style="margin-top:10px; overflow-x: scroll; width: 100%;">

		<table class="table-hover js-basic-example dataTable large-table">

			<thead style="border-bottom:3px solid #fcc512 !important;">
				<tr style="background: none;">
					<th>S.No</th>
					<th>Title</th>
					<th>Video</th>
					<th>Timing</th>
					<th>Skill</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				{assign 'prv' ''}
				{assign 'cur' ''}
				{assign 'nxt' ''}

				{foreach from=$DATA item=r key=key}
				{assign 'cur' $DATA[$key].session_id}
				{assign 'nxt' $DATA[$key+1].session_id}
				{if $cur != $prv}
				<tr>
					<td>{$key+1}.</td>
					<td>{$r.title}</td>
					<td>{if $r.video_url!=''}
					<video height="250" width="100%" controls>
						<source src="../videos/{$r.uid}/{$r.video_url}" type="video/mp4">

						Your browser does not support the video tag.
					</video>{/if}</td>
					<td>{$r.from_date} To {$r.to_date}</td>
					<td>{if $r.interviewer=="YES"} {$r.param_name}  {if $r.interviewer=="YES" AND $r.status=="Approved"}-{$r.param_value}{/if} {/if}
					{else}
					{if $r.interviewer=="YES"}, {$r.param_name} {if $r.interviewer=="YES" AND $r.status=="Approved"}-{$r.param_value}{/if} {/if}
					{/if}
					{$prv=$cur}
					{if $nxt!=$cur} </td>
					<td>{$r.status}</td>
				</tr>
				{/if}
				{/foreach}
			</tbody>
		</table>
	</div>

</div>

{literal}
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script>
	// Selected time should not be less than current time
	function AdjustMinTime(ct) {
		var dtob = new Date(), current_date = dtob.getDate(), current_month = dtob.getMonth() + 1, current_year = dtob.getFullYear();

		var full_date = current_year + '-' + (current_month < 10 ? '0' + current_month : current_month ) + '-' + (current_date < 10 ? '0' + current_date : current_date );

		if (ct.dateFormat('Y-m-d') == full_date)
			this.setOptions({
				minTime : 0
			});
		else
			this.setOptions({
				minTime : false
			});
	}

	// DateTimePicker plugin : http://xdsoft.net/jqplugins/datetimepicker/
	$("#event-start-time, #event-end-time").datetimepicker({
		format : 'Y-m-d H:i',
		minDate : 0,
		minTime : 0,
		step : 5,
		onShow : AdjustMinTime,
		onSelectDate : AdjustMinTime
	});
	$("#event-date").datetimepicker({
		format : 'Y-m-d',
		timepicker : false,
		minDate : 0
	});

</script>
<script>
	function submitForm() {
		if (validateForm()) {
			var id = document.getElementById("id").value;
			if (id == "") {
				document.getElementById("frmAvail").action = "candidate.php?action=req_video_meeting";
				document.getElementById("frmAvail").submit();
			} else {
				//document.getElementById("frmAvail").action = "candidate.php?action=update_can_education";
				//document.getElementById("frmAvail").submit();
			}

		}
	}

	function validateForm() {

		if (document.getElementById("gmail").value == "") {
			frmAvail.gmail.focus();
			alert("Please enter email");
			return false;
		} else if (document.getElementById("event-start-time").value == "") {
			frmAvail.from.focus();
			alert("Please enter start time");
			return false;
		} else if (document.getElementById("event-end-time").value == "") {
			frmAvail.to.focus();
			alert("Please enter end time");
			return false;
		} else if (document.getElementById("skill_name").value == "") {
			frmAvail.skill_name.focus();
			alert("Please enter skill");
			return false;
		} else {
			return true;
		}
	}

	function DeleteCandidateEducation(id) {
		var where_to = confirm("Do you really want to Delete this??");
		if (where_to == true) {
			window.location.href = "candidate.php?action=delete_can_education&id=" + id;

		}

	}

</script>

{/literal}

