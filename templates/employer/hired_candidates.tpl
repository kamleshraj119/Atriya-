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
	function validateForm() {
		if (document.getElementById("msg_subject").value == "") {
			form_msg.msg_subject.focus();
			alert("Please select message subject");
			return false;
		} else if (document.getElementById("msg").value == "") {
			form_msg.msg.focus();
			alert("Please enter message");
			return false;
		}
	}

	function showOther() {
		var sub = document.getElementById("msg_subject").value;
		if (sub == "Other") {
			document.getElementById("subDiv").style.display = 'block';
		} else
			document.getElementById("subDiv").style.display = 'none';
	}
</script>
{/literal}
<div class="col-md-12 resp-work-exp" style="margin-top:20px;">

	<h4>Hired Candidates</h4>

	<div class="my-bookmark" style="margin-top:10px; overflow-x: scroll; width: 100%;">
		<div class="table-responsive">
			<table class=" table-hover js-basic-example dataTable large-table" id="example1">

				<thead style="border-bottom:3px solid #fcc512 !important;">
					<tr style="background: none;">
						<th>
						<input  class="new-ckeck" type="checkbox" name="select_all" value="1" id="example-select-all">
						</th>
						<th style="padding: 20px;"><a style="color:#062223;" href="javascript:void();" class="row-head">Name<b class="caret"></b></a></th>
						<th style="padding: 20px;"><a style="color:#062223;" href="javascript:void();" class="row-head">Phone<b class="caret"></b></a></th>
						<th style="padding: 20px;"><a style="color:#062223;" href="javascript:void();" class="row-head">Pincode<b class="caret"></b></a></th>
						<th style="padding: 20px;"><a style="color:#062223;" href="javascript:void();" class="row-head">Start Date<b class="caret"></b></a></th>
						<th style="padding: 20px;"><a style="color:#062223;" href="javascript:void();" class="row-head">End Date<b class="caret"></b></a></th>
						<th style="padding: 20px;"><a style="color:#062223;" href="javascript:void();" class="row-head">Status<b class="caret"></b></a></th>
						<th style="padding: 20px;"><a style="color:#062223;" href="javascript:void();" class="row-head">Action<b class="caret"></b></a></th>
					</tr>
				</thead>
				<tbody>
					<select class="def-input" name="hiredCandidate" id="hiredCandidate" onchange="showHireCandidate();" style="width:200px;margin-bottom:15px;">

						<option value="CurrentlyHired" id="CurrentlyHired" {if $HIRED_CANDIDATES[0].true eq 'true'} selected {/if}><b>Currently Hired</b></option>
						<option value="TotalHired" id="TotalHired" {if $HIRED_CANDIDATES[0].false eq 'false'} selected {/if}><b>Total Hired</b></option>
					</select>
					{foreach from=$HIRED_CANDIDATES item=$r key=key}
					<tr>
						<td>
						<input type="checkbox" value="{$r.hcid}" class="new-ckeck" name="id[]" id="check" />
						</td>
						<td style="padding: 20px;"><a href="#" data-toggle="modal" data-target="#rating"> {$r.name} </a> {if $smarty.now|date_format:'%Y-%m-%d'|strtotime lt {$r.to_date}|strtotime}
						<input type="hidden" name="period" id="period" value="true"/>
						{else}
						<input type="hidden" name="period" id="period" value="false"/>
						{/if} </td>
						<td style="padding: 20px;">{$r.mobile}</td>
						<td style="padding: 20px;">{$r.pincode}</td>
						<td style="padding: 20px;">{$r.from_date}</td>
						<td style="padding: 20px;">{$r.to_date} </td>
						<td style="padding: 20px;">{$r.job_status}</td>
						<td style="padding: 20px;"> {if $r.job_status=='Hired' && $r.job_status!='Canceled' && $smarty.now|date_format:'%Y-%m-%d' eq $r.from_date} <a href="javascript:void(0)" onclick="showStartJob('{$r.hid}')" class="get-loc" style=" float:left; margin-right:10px;color: #02e4b6;">Start Job</a>{/if}
						{if $r.job_status!='Terminated' || $r.job_status=='Hired'} <a href="javascript:void(0)" onclick="showTerminateJob('{$r.hid}')" class="get-loc" style="float:left; margin-right:10px;color: #02e4b6;">Terminate</a>{/if} <!--<a href="javascript:void(0)" onclick="rehireCandidate('{$r.emp_job_id}','{$r.hcid}')" class="get-loc" style="float:left; margin-right:10px;color: #02e4b6;">Rehire</a>--><a href="employer.php?action=insert_user_rating&cid={$r.hcid}" class="get-loc" style="float:left; margin-right:10px;color: #02e4b6;">Rate</a></td>
					</tr>
					{/foreach}
				</tbody>
			</table>
			{if $HIRED_CANDIDATES|count > 0}
			<input type="button" id="msgButton" value="Send Message" name="grpButton" class="get-loc" style="margin-left:12px; margin-bottom: 10px;" onclick="sendMessage();">
			{/if}
		</div>
	</div>

</div>

{literal}
<script>
$(document).ready(function() {
		// Handle click on "Select all" control
		$('#example-select-all').on('click', function() {
			// Check/uncheck all checkboxes in the table
			/*var rows = table.rows({
			 'search' : 'applied'
			 }).nodes();*/
			$('input:checkbox').not(this).prop('checked', this.checked);
			//$('input:checkbox[id^="check"]', rows).prop('checked', this.checked);
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
		var e = document.getElementById("hiredCandidate");
		var hiredCandidate = e.options[e.selectedIndex].value;
		if(hiredCandidate == "CurrentlyHired" ){
			$('#msgButton').css('display','block');
		}else{
			$('#msgButton').css('display','none');
		}

	});
	function sendMessage() {
		var values = $("input[name='id[]']:checked").map(function() {
			return $(this).val();
		}).get();
		if (values == "" || values == null) {
			alert("Please select candidate!");
			return false;
		} else {
			$('#sendMessages').modal('show');
			$("#msgto").val(values);
			return true;
		}
	}

	function rehireCandidate(empJobId, candidateId) {
		var callback = function(res) {
			var response = res.responseText;
			alert(response);
			window.location.reload();
		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?emp_job_id=" + empJobId + "&cid=" + candidateId + "&REQUEST=REHIRE_CANDIDATE";
		var process = ajax.process(url, parameter);
	}

	function showStartJob(hid) {
		document.getElementById("id").value = hid;
		$('#startJob').modal('show');
	}

	function showTerminateJob(hid) {
		document.getElementById("hid").value = hid;
		$('#terminateJob').modal('show');
	}

	function showHireCandidate() {

		var e = document.getElementById("hiredCandidate");
		var hiredCandidate = e.options[e.selectedIndex].value;
		if (hiredCandidate == "CurrentlyHired" || hiredCandidate == "TotalHired") {
			window.location.href = "employer.php?action=hired_candidates&period=" + hiredCandidate;
		} else {
			window.location.href = "employer.php?action=hired_candidates&period=CurrentlyHired";
		}
	}
</script>
{/literal}