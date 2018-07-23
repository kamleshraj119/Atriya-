<div class="work-exp col-md-12 " style="margin-top:15px;">
	<div class="msg-con" >
		{if $MSG!=""}
		<div style="background:#e9e4d4;height:40px;margin-bottom:20px;">
			<b style="font-size:24px;">{$MSG}</b>
		</div>
		{/if}
	</div>
	<h4 style="margin-left:15px;">Add/Update Availability</h4>
	<form action="" class="form-horizontal" method="post" name="form_avail" id="form_avail">

		<div class="personal-data col-md-12">

		
				<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="col-md-12">
						<strong>From Date*</strong>
					</div>
					<div class="col-md-12">
						<input type="hidden" class="form-control" name="cid" id="cid"  value="{$CID}">
						<input type="hidden" class="form-control" name="id" id="id">
						<input type="text" class="def-input" placeholder="From Date" name="from_date" id="from_date" onchange="addWorkDays()">
					</div>
				</div>
				<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="col-md-12">
						<strong>To Date*</strong>
					</div>
					<div class="col-md-12">
						<input type="text" class="def-input" placeholder="To Date" name="to_date" id="to_date" onchange="addWorkDays()">
					</div>
				</div>
				<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="col-md-12">
						<strong>From Time*</strong>
					</div>
					<div class="col-md-12">
						<input type="text" class="def-input" placeholder="From Time" name="from_time" id="from_time" onchange="addWorkDays()">
					</div>
				</div>
				<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="col-md-12">
						<strong>To Time*</strong>
					</div>
					<div class="col-md-12">
						<input type="text" class="def-input" placeholder="To Time" name="to_time" id="to_time" onchange="addWorkDays()" >
					</div>
				</div>
				<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="col-md-12">
						<strong>Job Type*</strong>
					</div>
					<div class="col-md-12">
						<select name="job_type_id" id="job_type_id" class="def-input" onchange="addWorkDays()">
							<option value="" disabled selected>Select Job Type</option>
							{foreach from=$JOBTYPE item=r key=key}
							<option value="{$r.id}">{$r.name}</option>
							{/foreach}
						</select>
						<input type="hidden" name="period" id="period">
						<input type="hidden" name="flag" id="flag" value="false">

					</div>
				</div>
		
				
				

				<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="col-md-12">
						<strong>Expected Salary*</strong>
					</div>
					<div class="col-md-12">
						<input type="text" class="def-input" placeholder="Expected Salary" name="exp_sal" id="exp_sal">
					</div>
				</div>

			
			
				<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="col-md-12">
						<strong>Location*</strong><div id="sel_loc"></div>
					</div>

					<div class="col-md-12">
						<select name="loc_id" id="loc_id" class="def-input" onchange="addWorkDays()">
							<option value="" disabled selected>Select Preferred Job Location</option>
							{foreach from=$LOCAL item=r key=key}
							<option value="{$r.t3id}">{$r.multilocal}</option>
							{/foreach}
						</select>
					</div>
				</div>
			
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class="form-group">
					<div class="col-md-12">
						<strong>Skill*</strong><div id="sel_skill"></div>
					</div>
					<div class="col-md-12">
						<select name="skill_id" id="skill_id" class="def-input" >
							<!-- class="form-control show-tick"-->
							<option value="" disabled selected>Select Preferred Skill</option>
							{foreach from=$SKILLS item=r key=key}
							<option value="{$r.t3id}">{$r.multiskill}</option>
							{/foreach}
						</select>
					</div>
				</div>
			</div>

		</div><!--/.personal-data -->
		<div style="clear:both;"></div>
		<div class="col-md-12 ">
				<input  type="button" class="get-loc" value="SUBMIT" onclick="submitForm()" style="margin-left:15px;">
		</div>

	</form>
</div>
<div class="col-md-12 body" style="margin-top:20px;">

	<h4>Availability</h4>

	<div style="margin-top:10px;">

		<table class="table-hover js-basic-example dataTable large-table" id="availability">

			<thead style="border-bottom:3px solid #fcc512 !important;">
				<tr style="background: #eee;">
					<th><a href="javascript:void(0);" class="row-head">S.no<b class="caret"></b></a></th>
					<th><a href="javascript:void(0);" class="row-head">Date<b class="caret"></b></a></th>
					<th><a href="javascript:void(0);" class="row-head">Time<b class="caret"></b></a></th>
					<th><a href="javascript:void(0);" class="row-head">Period<b class="caret"></b></a></th>
					<th><a href="javascript:void(0);" class="row-head">Expected Salary<b class="caret"></b></a></th>
					<th><a href="javascript:void(0);" class="row-head">Sector<b class="caret"></b></a></th>
					<th><a href="javascript:void(0);" class="row-head">Skills<b class="caret"></b></a></th>
					<th><a href="javascript:void(0);" class="row-head">State<b class="caret"></b></a></th>
					<th><a href="javascript:void(0);" class="row-head">Job Type<b class="caret"></b></a></th>
					<th><a href="javascript:void(0);" class="row-head">Action<b class="caret"></b></a></th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$VAL item=r key=key}
				<tr>
					<td>{$key+1}</td>
					<td>{$r.from_date}&nbsp;<b> to </b>&nbsp;{$r.to_date}</td>
					<td>{$r.from_time}&nbsp;<b> to </b>&nbsp;{$r.to_time}</td>
					<td>{$r.period}</td>
					<td>{$r.exp_sal}</td>
					<td>{$r.sector_name}</td>
					<td>{$r.multiskill}</td>
					<td>{$r.state_name}</td>
					<td>{$r.job_type}</td>
					<td><a href="javascript:void(0)" onclick="getAvailabilityId('{$r.t3id}')"  class="get-loc" style="float:left; margin-right:10px"><i class="material-icons">edit</i></a><a href="javascript:void(0)" onclick="DeleteCandidateAvailability('{$r.t3id}')" class="get-loc" style="float:left; margin-right:10px"><i class="material-icons">delete</i></a></td>
				</tr>
				{/foreach}
			</tbody>
		</table>
	</div>

</div>

{literal}
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-material-datetimepicker.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<script type="text/javascript"  src="assets/js/moment-with-locales.min.js"></script>
<script type="text/javascript"  src="assets/js/bootstrap-material-datetimepicker.js"></script>
<script>
	$(function() {
		$('#from_date').bootstrapMaterialDatePicker({
			time : false,
			clearButton : true
		});
		$('#to_date').bootstrapMaterialDatePicker({
			time : false,
			clearButton : true
		});
		$('#from_time').bootstrapMaterialDatePicker({
			date : false,
			shortTime : false,
			format : 'HH:mm'
		});
		$('#to_time').bootstrapMaterialDatePicker({
			date : false,
			shortTime : false,
			format : 'HH:mm'
		});
	});
	function getAvailabilityId(avId) {
		var callback = function(res) {
			$(document).scrollTop(0);
			var response = res.responseText;
			var obj = JSON.parse(response)[0];
			document.getElementById("cid").value = obj.cid;
			document.getElementById("id").value = obj.t3id;
			document.getElementById("from_date").value = obj.from_date;
			document.getElementById("from_time").value = obj.from_time;
			document.getElementById("exp_sal").value = obj.exp_sal;
			document.getElementById("to_date").value = obj.to_date;
			document.getElementById("to_time").value = obj.to_time;
			document.getElementById("job_type_id").value = obj.job_type_id;
			document.getElementById("period").value = obj.period;
			//		document.getElementById("sel_loc").innerHTML = obj.multilocal;
			//		document.getElementById("sel_skill").innerHTML = obj.multiskill;
			var x = document.getElementById("skill_id");
			var locId = document.getElementById("loc_id");
			var i;
			for ( i = 0; i < x.length, i < locId.length; i++) {
				if (x.options[i].text == obj.multiskill || locId.options[i].text == obj.multilocal) {
					x.options[i].selected = true;
					locId.options[i].selected = true;
				}
			}
		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?av_id=" + avId + "&REQUEST=GET_AVAILABILITY_BY_ID";
		var process = ajax.process(url, parameter);

	}

	function addWorkDays() {
		var typeid = document.getElementById('job_type_id').value.trim();
		var fromdate = document.getElementById('from_date').value.trim();
		var todate = document.getElementById('to_date').value.trim();
		var fromtime = document.getElementById('from_time').value.trim();
		var totime = document.getElementById('to_time').value.trim();

		if (typeid == "" || fromdate == "" || todate == "" || fromtime == "" || totime == "") {
			flag = "false";
			document.getElementById("flag").value = flag;
			return false;
		}

		var a = moment(todate + ' ' + totime);
		var b = moment(fromdate + ' ' + fromtime);
		var d1 = moment(todate);
		var d2 = moment(fromdate);
		var flag = "false";
		var works;
		switch(typeid) {
		case "1":
			if (d1 < d2 || totime < fromtime) {
				flag = "true";
				alert("please select the right dates/times");
				return false;
			} else {
				flag = "false";
				works = a.diff(b, 'hours');
				return true;
			}
			break;
		case "2":
			if (d1 < d2) {
				flag = "true";
				alert("please select the right dates & job type");
				return false;
			} else {
				flag = "false";
				works = d1.diff(d2, 'days');
				return true;
			}
			break;
		case "3":
			if (d1 < d2) {
				flag = "true";
				alert("please select the right dates & job type");
				return false;
			} else {
				var d3 = moment(todate).add(1, 'days');
				works = d3.diff(d2, 'weeks');
				if (works == 0)
					works = 1;
				var endDate = d2.add(works, 'weeks');
				endDate.subtract(1, 'days');
				if (endDate.isSame(d1)) {
					flag = "false";
				} else {
					flag = "true";
					alert("Please select dates multiple of week.To date should be " + endDate.format("MM/DD/YYYY"));
					return false;
				}
			}
			break;
		case"4":
			if (d1 < d2) {
				flag = "true";
				alert("Please select the right dates & job type.");
				return false;
			} else {
				var d3 = moment(todate).add(1, 'days');
				works = d3.diff(d2, 'months');
				if (works == 0)
					works = 1;
				var endDate = d2.add(works, 'months');
				endDate.subtract(1, 'days');
				if (endDate.isSame(d1)) {
					flag = "false";
				} else {
					flag = "true";
					alert("Please select dates multiple of month.To date should be " + endDate.format("MM/DD/YYYY"));
					return false;
				}
			}
			break;
		case "5":
			if (d1 < d2) {
				flag = "true";
				alert("please select the right dates/times");
				return false;
			}
		}
		document.getElementById("flag").value = flag;
		document.getElementById("period").value = works;
	}

	function DeleteCandidateAvailability(id) {
		var where_to = confirm("Do you really want to Delete this??");
		if (where_to == true) {
			window.location.href = "candidate.php?action=delete_candidate_availability&id=" + id;

		}

	}

	function submitForm() {
		if (validateForm()) {
			var avid = document.getElementById("id").value;
			if (avid == "") {
				document.form_avail.action = "candidate.php?action=save_availability";
				document.form_avail.submit();
			} else {
				document.form_avail.action = "candidate.php?action=update_candidate_availability";
				document.form_avail.submit();
			}
		}
	}

	function validateForm() {

		if (document.getElementById("from_date").value == "") {
			alert("Please enter from date");
			form_avail.from_date.focus();
			return false;
		} else if (document.getElementById("to_date").value == "") {
			alert("Please enter to date");
			form_avail.to_date.focus();
			return false;
		} else if (document.getElementById("from_time").value == "") {
			alert("Please enter from time");
			form_avail.from_time.focus();
			return false;
		} else if (document.getElementById("to_time").value == "") {
			alert("Please enter to time");
			form_avail.to_time.focus();
			return false;
		} else if (document.getElementById("job_type_id").value == "") {
			alert("Please select job type id");
			form_avail.job_type_id.focus();
			return false;
		} else if (document.getElementById("exp_sal").value == "") {
			alert("Please enter salary");
			form_avail.exp_sal.focus();
			return false;
		} else if (document.getElementById("loc_id").value == "") {
			alert("Please select location");
			form_avail.loc_id.focus();
			return false;
		} else if (document.getElementById("skill_id").value == "") {
			alert("Please select skill");
			form_avail.skill_id.focus();
			return false;
		} else if (document.getElementById("flag").value == "true") {
			alert("Please select correct date time.");
			return false;
		} else
			var ret=addWorkDays();
			if(ret == true)
			return true;
			else
			return false;
	}

</script>

{/literal}

