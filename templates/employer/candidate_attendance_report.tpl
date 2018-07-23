<div class="work-exp col-md-12  content-wrap resp-work-exp">

	<h4>Candidate's  Attendance Report </h4>

	<div class="my-bookmark">
		<form action="employer.php?action=attendance_report_candidate" method="post" name="form_attendance" id="form_attendance" onsubmit="return validateForm()">
			<div style="margin:10px 15px 15px 0px; float: left;">
				From date:
				<input type="text" id="fromdate" name="fromdate" placeholder=" YYYY-MM-DD ">
			</div>
			<div style="margin:10px 15px 15px 0px; float: left;" >
				To date:
				<input type="text" id="todate" name="todate" placeholder=" YYYY-MM-DD ">
			</div>
				<div style="margin:10px 0px 15px 0px; float: left;">
				<input type="submit" name="submit" value="Submit" class="get-loc"/>
			</div>
		</form>

		<form id="frm-example1" action="" style="overflow-x: scroll; width: 100%;">

			<table class=" table-hover js-basic-example dataTable large-table" id="example">

				<thead style="border-bottom:3px solid #fcc512 !important;">
					<tr style="background: none;">
						<th width="7%"><a href="#" class="row-head">S.No<b class="caret"></b></a></th>
						<th width="10%"><a href="#" class="row-head">Job<b class="caret"></b></a></th>
						<th width="10%"><a href="#" class="row-head">Name<b class="caret"></b></a></th>
						<th width="7%"><a href="#" class="row-head">Skillmitra<b class="caret"></b></a></th>
						<th width="8%"><a href="#" class="row-head">In Time<b class="caret"></b></a></th>
						<th width="10%"><a href="#" class="row-head">Out Time<b class="caret"></b></a></th>
						<th width="7%"><a href="#" class="row-head">Validity<b class="caret"></b></a></th>
						<br />
						<th width="8%"><a href="#" class="row-head">Daily Report<b class="caret"></b></a></th>
					</tr>
				</thead>
				<tbody>
					{foreach from=$DATA item=$r key=key}
					<tr>
						<td >{$key+1}</td>
						<td >{$r.title}<br/>{$r.address}</td>
						<td>{$r.t3name}</td>
						<td >{$r.t3skillmitra}</td>
						<td > {$r.t1date}<br />
							<a href="https://maps.googleapis.com/maps/api/staticmap?center={$r.t1lat},{$r.t1long}&markers=color:red%7Clabel:C%7C{$r.t1lat},{$r.t1long}&zoom=12&size=600x400&key=AIzaSyBzK712U1ci_ZxJrbLt7O4iGdxBQJeEbE0" class="col-teal" target="_blank">View on map</a>
						</td >
						<td >{$r.t2date}<br />
							<a href="https://maps.googleapis.com/maps/api/staticmap?center={$r.t2lat},{$r.t2long}&markers=color:red%7Clabel:C%7C{$r.t2lat},{$r.t2long}&zoom=12&size=600x400&key=AIzaSyBzK712U1ci_ZxJrbLt7O4iGdxBQJeEbE0" class="col-teal" target="_blank">View on map</a>
						</td>
						<td >{if $r.valid == "NO"}<i class="material-icons" style="color: red;">close</i>{else}<i class="material-icons" style="color: green;">done</i>{/if}</td>
						<td >{if $r.daily_report == "NO"}<i class="material-icons" style="color: red;">close</i>{else}<i class="material-icons" style="color: green;">done</i>{/if}</td>
					</tr>
					{/foreach}
				</tbody>
			</table>
		</form>

	</div>

</div>
{literal}
<style>
#example thead tr th{
	font-size: 18px;
}
#example tbody tr td{
	font-size: 15px;
}	
	
</style>
<!--  custom added by kamlesh -->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-material-datetimepicker.css">
		<script type="text/javascript"  src="assets/js/moment-with-locales.min.js"></script>
		<script type="text/javascript"  src="assets/js/bootstrap-material-datetimepicker.js"></script>
		<!--  End by kamlesh -->
<script>
	$(document).ready(function() {
			$('#fromdate').bootstrapMaterialDatePicker({
				time : false,
				clearButton : true
			});
			$('#todate').bootstrapMaterialDatePicker({
				time : false,
				clearButton : true
			});
	});	
	// Handle click on "Select all" control
		$('#example-select-all').on('click', function() {
			// Check/uncheck all checkboxes in the table
			var rows = table.rows({
				'search' : 'applied'
			}).nodes();
			$('input[type="checkbox"]', rows).prop('checked', this.checked);
		});

		// Handle click on checkbox to set state of "Select all" control
		$('#example tbody').on('change', 'input[type="checkbox"]', function() {
			// If checkbox is not checked
			if (!this.checked) {
				var el = $('#example-select-all').get(0);
				// If "Select all" control is checked and has 'indeterminate' property
				if (el && el.checked && ('indeterminate' in el)) {
					// Set visual state of "Select all" control
					// as 'indeterminate'
					el.indeterminate = true;
				}
			}
		});		
	function validateForm() {
		var fromDate='';
		var toDate='';
		 fromDate=document.getElementById("fromdate").value;
		 toDate=document.getElementById("todate").value;	
		if (document.getElementById("fromdate").value == "") {
			form_attendance.fromdate.focus();
			alert("Please select fromdate");
			return false;
		} else if (document.getElementById("todate").value == "") {
			form_attendance.todate.focus();
			alert("Please select todate");
			return false;
		}else{
//		window.location.href = "employer.php?action=attendance_report_candidate&from_date="+fromDate+"&to_date="+toDate;
		return true;
		}
	}
</script>
{/literal}
