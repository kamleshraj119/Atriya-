<div class="col-md-12">
	<div class="work-exp col-md-12 col-sm-12 sec-hq-pad-t content-wrap" >
		<div class="form-header">
			<h4 style="text-align:left;">ADD OLD EMPLOYMENT</h4>
			{if $DATA.old|@count==0}
			<span>*If Not applicable please check NA.</span>
			{/if}
		</div>
		<div  class="col-md-12">
			{if $DATA.old|@count==0}
			<div class="col-md-12">
				<div class="form-group">
					<input type="checkbox" id="chk_edu" class="filled-in" name="chak_edu" onclick="toogleForm();" />
					<label for="chk_edu">NA</label>
				</div>
			</div>
			{/if}
		</div>
		<form action=""  method="post" name="candidate_history" id="candidate_history">
			<div class="form-group">
				<div class="col-md-12"  style="text-align:left;">
					<strong >Company Name*</strong>
				</div>
				<div class="col-md-12">
					<input type="text" class="def-input" placeholder="Company Name" name="comp_name" id="comp_name">
					<input type="hidden" name="cid" id="cid" value="{$CID}" />
					<input type="hidden" name="id" id="id" value="">
				</div>
				<div class="col-md-12"  style="text-align:left;">
					<strong >Company Address*</strong>
				</div>
				<div class="col-md-12">
					<input type="text" class="def-input" placeholder="Company Address" name="comp_address" id="comp_address">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12" style="text-align:left;">
					<strong>Position*</strong>
				</div>
				<div class="col-md-12">
					<input type="text" class="def-input" placeholder="Position" name="position" id="position">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12" style="text-align:left;">
					<strong>Contact Person*</strong>
				</div>
				<div class="col-md-12">
					<input type="text" class="def-input" placeholder="Contact Person " name="contact_person" id="contact_person">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12" style="text-align:left;">
					<strong>Pincode*</strong>
				</div>
				<div class="col-md-12">
					<input type="text" class="def-input"  name="pincode" id="past_pincode" placeholder="Pincode">
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12" style="text-align:left;">
					<strong>Period*</strong>
				</div>
				<div class="col-md-6 col-sm-6">

					<input type="text" id="start_date" name="start_date" class="def-input def-select" placeholder="YYYY-MM-DD">
				</div>
				<div class="col-md-6 col-sm-6">
					<input type="text" id="end_date" name="end_date" class="def-input def-select" placeholder="YYYY-MM-DD">
				</div>

			</div>

	</div>
</div><!--/.work-exp -->
<div class="col-md-12 sec-h-pad-t text-left">
	<input type="button" value="Submit" id="submit" class="get-loc" onclick="submitForm()" style="margin-left:30px;">
</div>
</form>

<div class="col-md-12" style="margin-top:20px;">

	<h4> Old Employment</h4>

	<div class="my-bookmark" style="margin-top:10px;">

		<table class="table-hover js-basic-example dataTable large-table">
			<thead style="border-bottom:3px solid #fcc512 !important;">
				<tr style="background: #eee;">
					<th style="width:10%;"><a href="javascript:void(0);" class="row-head">Company Name<b class="caret"></b></a></th>
					<th style="width:10%;"><a href="javascript:void(0);" class="row-head">Position<b class="caret"></b></a></th>
					<th style="width:10%;"><a href="javascript:void(0);" class="row-head">Experience<b class="caret"></b></a></th>
					<th style="width:10%;"><a href="javascript:void(0);" class="row-head">Start Date<b class="caret"></b></a></th>
					<th style="width:10%;"><a href="javascript:void(0);" class="row-head">End Date<b class="caret"></b></a></th>
					<th style="width:10%;"><a href="javascript:void(0);" class="row-head">Action<b class="caret"></b></a></th>
				</tr>
			</thead>

			<tbody>
				{foreach from=$DATA.old item=r key=key}
				<tr>
					<td>{$r.comp_name}</td>
					<td>{if $r.comp_name!= "NA"}{$r.position}{/if}</td>
					<td>{if $r.comp_name!= "NA"}{$r.exp}{/if}</td>
					<td>{if $r.comp_name!= "NA"}{$r.start_date}{/if}</td>
					<td>{if $r.comp_name!= "NA"}{$r.end_date}{/if}</td>
					<td><a href="javascript:void(0)" onclick="getEmployementDetails('{$r.id}')" class="get-loc" style="float:left; margin-right:10px"><i class="material-icons">edit</i></a><a href="javascript:void(0)" onclick="DeleteEmployementDetails('{$r.id}')" class="get-loc" style="float:left; margin-right:10px"><i class="material-icons">delete</i></a></td>
				</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
	<br>
	<h4> Site Employment</h4>

	<div class="my-bookmark" style="margin-top:10px;">

		<table class="table-hover js-basic-example dataTable large-table">
			<thead style="border-bottom:3px solid #fcc512 !important;">
				<tr style="background: #eee;">
					<th style="width:10%;"><a href="javascript:void(0);" class="row-head">Company Name<b class="caret"></b></a></th>
					<th style="width:10%;"><a href="javascript:void(0);" class="row-head">Job Type<b class="caret"></b></a></th>
					<th style="width:10%;"><a href="javascript:void(0);" class="row-head">Experience<b class="caret"></b></a></th>
					<th style="width:10%;"><a href="javascript:void(0);" class="row-head">From Date<b class="caret"></b></a></th>
					<th style="width:10%;"><a href="javascript:void(0);" class="row-head">To Date<b class="caret"></b></a></th>
				</tr>
			</thead>

			<tbody>
				{foreach from=$DATA.site item=r key=key}
				<tr>
					<td>{$r.company_name}</td>
					<td>{$r.job_type}</td>
					<td>{$r.exp}</td>
					<td>{$r.from_date}</td>
					<td>{$r.to_date}</td>

				</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
	<br>
	<br>
	<br>
</div>
{literal}
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-material-datetimepicker.css">

<script type="text/javascript"  src="assets/js/moment-with-locales.min.js"></script>
<script type="text/javascript"  src="assets/js/bootstrap-material-datetimepicker.js"></script>
<script>
	$(function() {
		$('#start_date').bootstrapMaterialDatePicker({
			time : false,
			clearButton : true
		});
		$('#end_date').bootstrapMaterialDatePicker({
			time : false,
			clearButton : true
		});
	});

	function toogleForm() {
		if (document.getElementById('chk_edu').checked) {
			document.getElementById('candidate_history').style.display = "none";
			document.getElementById("comp_name").value = "NA";
			document.getElementById("comp_address").value = "NA";
			document.getElementById("position").value = "NA";
			document.getElementById("contact_person").value = "NA";
			document.getElementById("past_pincode").value = "NA";
			document.getElementById("start_date").value = "NA";
			document.getElementById("end_date").value = "NA";
		} else {
			document.getElementById('candidate_history').style.display = "block";
			document.getElementById("comp_name").value = "";
			document.getElementById("comp_address").value = "";
			document.getElementById("position").value = "";
			document.getElementById("contact_person").value = "";
			document.getElementById("past_pincode").value = "";
			document.getElementById("start_date").value = "";
			document.getElementById("end_date").value = "";
		}
	}

	function submitForm() {
		if (validationForm()) {
			var id = document.getElementById("id").value.trim();
			var cid = document.getElementById("cid").value.trim();
			var cName = document.getElementById("comp_name").value.trim();
			var cAddress = document.getElementById("comp_address").value.trim();
			var position = document.getElementById("position").value.trim();
			var cPerson = document.getElementById("contact_person").value.trim();
			var pin = document.getElementById("past_pincode").value.trim();
			var startDate = document.getElementById("start_date").value.trim();
			var endDate = document.getElementById("end_date").value.trim();
			var callback = function(res) {
				var d = res.responseText;
				if (d.trim() == "Success") {
					alert("Employment details saved successfully.");
					window.location.reload();
				} else
					alert(d);

			};

			var ajax = new Ajax(callback);
			var url = "admin/application/ajax.php";
			var parameter = "";
			if (id == "") {
				url += "?cid=" + cid + "&end_date=" + endDate + "&comp_name=" + cName + "&comp_address=" + cAddress + "&position=" + position + "&contact_person=" + cPerson + "&pincode=" + pin + "&start_date=" + startDate + "&REQUEST=ADD_EMPLOYEMENT_HISTORY";
			} else {
				url += "?cid=" + cid + "&id=" + id + "&end_date=" + endDate + "&comp_name=" + cName + "&comp_address=" + cAddress + "&position=" + position + "&contact_person=" + cPerson + "&pincode=" + pin + "&start_date=" + startDate + "&REQUEST=UPDATE_EMPLOYEMENT_HISTORY";
			}
			var process = ajax.process(url, parameter);
		}
	}

	function getEmployementDetails(id) {
		var callback = function(res) {
			$(document).scrollTop(0);
			var response = res.responseText;
			var obj = JSON.parse(response)[0];
			document.getElementById("cid").value = obj.cid;
			document.getElementById("id").value = obj.id;
			document.getElementById("comp_name").value = decodeHTMLEntities(obj.comp_name);
			document.getElementById("comp_address").value = decodeHTMLEntities(obj.comp_address);
			document.getElementById("position").value = decodeHTMLEntities(obj.position);
			document.getElementById("contact_person").value = decodeHTMLEntities(obj.contact_person);
			document.getElementById("past_pincode").value = obj.pincode;
			/*if (obj.start_date == "0000-00-00" && obj.end_date == "0000-00-00") {
				document.getElementById("start_date").value = "0";
				document.getElementById("end_date").value = "0";
			} else {*/
				document.getElementById("start_date").value = obj.start_date;
				document.getElementById("end_date").value = obj.end_date;
			//}

		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?id=" + id + "&REQUEST=EMPLOYEMENT_HISTORY_DETAILS";
		var process = ajax.process(url, parameter);

	}

	function DeleteEmployementDetails(id) {
		var where_to = confirm("Do you really want to Delete this??");
		if (where_to == true) {
			window.location.href = "candidate.php?action=deleteoldhistroy&id=" + id;

		}

	}

	function validationForm() {
		var zipcode = /^([1-9])([0-9]){5}$/;

		if (document.getElementById("comp_name").value.trim() == "") {
			alert("Please enter company name");
			candidate_history.comp_name.focus();
			return false;
		} else if (document.getElementById("comp_address").value.trim() == "") {
			alert("Please enter company address");
			candidate_history.comp_address.focus();
			return false;
		} else if (document.getElementById("position").value.trim() == "") {
			alert("Please enter position");
			candidate_history.position.focus();
			return false;
		} else if (document.getElementById("contact_person").value.trim() == "") {
			alert("Please enter contact person name");
			candidate_history.contact_person.focus();
			return false;
		} else if (document.getElementById("past_pincode").value.trim() == "") {
			alert("Please enter pincode");
			candidate_history.past_pincode.focus();
			return false;
		} else if (!document.getElementById("past_pincode").value == "NA") {
			if (!zipcode.test(document.getElementById("past_pincode").value)) {
				alert("Please enter 6 digit correct pincode");
				candidate_history.past_pincode.focus();
				return false;
			}
		} else if (document.getElementById("start_date").value.trim() == "") {
			alert("Please enter start date");
			candidate_history.start_date.focus();
			return false;
		} else if (document.getElementById("end_date").value.trim() == "") {
			alert("Please enter end date");
			candidate_history.end_date.focus();
			return false;
		} else {
			var fromdate = document.getElementById('start_date').value.trim();
			var todate = document.getElementById('end_date').value.trim();
			var d1 = moment(todate);
			var d2 = moment(fromdate);
			if (d1 < d2) {
				alert("please select the right dates");
				return false;
			} else {
				return true;
			}
		}
	}
	function decodeHTMLEntities(text) {
		var entities = [['amp', '&'], ['apos', '\''], ['#x27', '\''], ['#x2F', '/'], ['#39', '\''], ['#47', '/'], ['lt', '<'], ['gt', '>'], ['nbsp', ' '], ['quot', '"'], ["#039", "'"]];

		for (var i = 0, max = entities.length; i < max; ++i)
			text = text.replace(new RegExp('&' + entities[i][0] + ';', 'g'), entities[i][1]);
		return text;
	}

</script>
{/literal}
