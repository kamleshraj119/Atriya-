<div class="work-exp resp-work-exp col-md-12">

	<div class="msg-con" >
		{if $MSG!=""}
		<div style="background:#e9e4d4;height:40px;margin-bottom:20px;">
			<b style="font-size:24px;">{$MSG}</b>
		</div>
		{/if}
	</div>

	<div class="row">
		<form name="frmAvail" id="frmAvail" action="" class="form-horizontal" method="post">

			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<div  style="margin-bottom:20px;">
							<h4> Add/Update Job</h4>
						</div>
					</div>
					<div  class="col-md-12">

						<!--<div class="col-xl-4 col-md-6 col-sm-6 col-xs-12"></div>-->
						<div class="form-group col-xl-4 col-md-6 col-sm-6 col-xs-12">
							<div class="col-md-12">
								<strong>Job Title*</strong>
							</div>
							<div class="col-md-12">
								<input type="hidden" class="def-input" name="eid" id="eid"  value="{$EMP_ID}">
								<input type="hidden" class="def-input" name="t3id" id="t3id">
								<input type="text" class="def-input" placeholder="Title" name="title" id="title">
							</div>
						</div>
						<div class="form-group col-xl-4 col-md-6 col-sm-6 col-xs-12">
							<div class="col-md-12">
								<strong>Job Description*</strong>
							</div>
							<div class="col-md-12">
								<textarea name="des" id="des" placeholder="Job Description" class="def-input"></textarea>
							</div>
						</div>
						<div class="form-group col-xl-4 col-md-6 col-sm-6 col-xs-12">
							<div class="col-md-12">
								<strong>From Date*</strong>
							</div>
							<div class="col-md-12">
								<input type="text" class="def-input" placeholder="From Date" name="from_date" id="from_date" onchange="addWorkDays()">
							</div>
						</div>
						<div class="form-group col-xl-4 col-md-6 col-sm-6 col-xs-12">
							<div class="col-md-12">
								<strong>To Date*</strong>
							</div>
							<div class="col-md-12">
								<input type="text" class="def-input" placeholder="To Date" name="to_date" id="to_date" onchange="addWorkDays()">
							</div>
						</div>

						<div class="form-group col-xl-4 col-md-6 col-sm-6 col-xs-12">
							<div class="col-md-12">
								<strong>From Time*</strong>
							</div>
							<div class="col-md-12">
								<input type="text" class="def-input" placeholder="From Time" name="from_time" id="from_time" onchange="addWorkDays()">
							</div>
						</div>
						<div class="form-group col-xl-4 col-md-6 col-sm-6 col-xs-12">
							<div class="col-md-12">
								<strong>To Time*</strong>
							</div>
							<div class="col-md-12">
								<input type="text" class="def-input" placeholder="To Time" name="to_time" id="to_time" onchange="addWorkDays()" >
							</div>
						</div>
						<div class="form-group col-xl-4 col-md-6 col-sm-6 col-xs-12">
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
						<div class="form-group col-xl-4 col-md-6 col-sm-6 col-xs-12">
							<div class="col-md-12">
								<strong>Salary*</strong>
							</div>
							<div class="col-md-12">
								<input type="text" class="def-input" placeholder="Salary" name="sal" id="sal">
							</div>
						</div>
						<div class="form-group col-xl-4 col-md-6 col-sm-6 col-xs-12">
							<div class="col-md-12">
							<b>Job Location*</b>
							</div>
							<div class="col-md-12">
							<select name="ejlcid" id="ejlcid" class="def-input" >
								<option value="" disabled selected>Select Job Location</option>
								{foreach from=$EJLC item=r key=key}
								<option value="{$r.t3id}">{$r.address}</option>
								{/foreach}
							</select>
							</div>
						</div>
						<div class="form-group col-xl-4 col-md-6 col-sm-6 col-xs-12">
							<div class="col-md-12">
								<strong>Job Sector*</strong>
							</div>
							<div class="col-md-12">
								<select name="sector" id="sector" class="def-input" onchange="getCourseBySectorId()">
									<option value="" disabled selected>Select Job Sector</option>
									{foreach from=$SECTORS item=r key=key}
									<option value="{$r.id}" {if $SKILLS[0].sector==$r.id}selected{/if}>{$r.name}</option>
									{/foreach}
								</select>

							</div>
						</div>

						<div class="form-group col-xl-4 col-md-6 col-sm-6 col-xs-12">
							<div class="col-md-12">
								<strong>Job Role*</strong>
							</div>
							<div id="p">
								<div class="col-md-12" >
									{literal}
									<script type="text/javascript">
										function getCourseBySectorIdWithSelctedItem(course_id, sector_id) {
											var sector = sector_id;

											var callback = function(res) {
												var d = res.responseText;
												var strl = d.length;
												var strarr = new Array();
												strarr = d.split("^");

												var myDiv = document.getElementById("p");
												var element = document.getElementById('course');
												if ( typeof (element) != 'undefined' && element != null) {
													// exists.
													element.parentNode.removeChild(element);
												}
												var x = document.createElement("select");
												x.id = "course";
												x.name = "course";
												x.className = 'def-input';
												x.options.length = 0;
												for (var i = 0; i < strarr.length; i++) {
													var optNew = document.createElement('option');
													if (strarr[i] != '') {
														var cat = strarr[i].split('~');
														var text = cat[1];
														var value = cat[0];
														optNew.text = text;
														optNew.value = value;
														if (course_id == value)
															optNew.setAttribute("selected", true);
														try {
															x.add(optNew, null);
															// standards compliant; doesn't work in IE
															//x.appendChild(optNew);
														} catch(ex) {
															//alert(ex.message);
															x.appendChild(optNew);
															// IE only

														}

													}
												}
												myDiv.appendChild(x);
												myDiv.className = 'col-md-12';

											};
											var ajax = new Ajax(callback);
											var url = "admin/application/ajax.php";
											var parameter = "";
											url += "?sector=" + sector + "&REQUEST=GET_JOBS_ROLE_BY_SECTOR_ID";
											var process = ajax.process(url, parameter);

										}

										getCourseBySectorIdWithSelctedItem('{/literal}{$SKILLS[0].course}{literal}', '{/literal}{$SKILLS[0].sector}{literal}');
									</script>
									{/literal}
								</div>
							</div>
						</div>

						<!--<div class="col-md-6 col-sm-6 ">-->

						<div class="form-group col-xl-4 col-md-6 col-sm-6 col-xs-12" style="margin-left: 10px;">
							<div class="col-md-12">
								<strong>Skill*</strong>
							</div>
							<div id="skill_div" >
								<div class="col-md-12">
									{literal}
									<script type="text/javascript">
										function getSkillsByCourseIdWithSelctedItem(skill_id, course_id) {
											var sector = course_id;
											var skillArr = skill_id.split(",");
											var callback = function(res) {
												var d = res.responseText;
												var strl = d.length;
												var strarr = new Array();
												strarr = d.split("^");

												var myDiv = document.getElementById("skill_div");
												while (myDiv.firstChild) {
													myDiv.removeChild(myDiv.firstChild);
												}
												for (var i = 0; i < strarr.length; i++) {
													if (strarr[i] != '') {
														var cat = strarr[i].split('~');
														var text = cat[1];
														var value = cat[0];
														var checkbox = document.createElement('input');
														checkbox.type = "checkbox";
														checkbox.name = "skill[]";
														checkbox.value = value;
														checkbox.id = "skill" + i;
														var flag = false;
														for (var j = 0; j < skillArr.length; j++) {
															if (value == skillArr[j]) {
																flag = true;
															}
														}
														checkbox.className = "filled-in";
														var label = document.createElement('label');
														label.htmlFor = "skill" + i;
														label.appendChild(document.createTextNode(text + " "));
														myDiv.appendChild(checkbox);
														if (flag) {
															var replacement = 'checked>';
															myDiv.innerHTML = myDiv.innerHTML.replace(/>([^>]*)$/, replacement + '$1');
														}

														myDiv.appendChild(label);
														myDiv.innerHTML = myDiv.innerHTML + "&nbsp;";
													}
												}

											};
											var ajax = new Ajax(callback);
											var url = "admin/application/ajax.php";
											var parameter = "";
											url += "?course=" + sector + "&REQUEST=GET_SKILLS_BY_JOBROLE_ID";

											var process = ajax.process(url, parameter);
										}

										getSkillsByCourseIdWithSelctedItem('{/literal}{$SKILLS[0].skill}{literal}', '{/literal}{$SKILLS[0].course}{literal}');
									</script>
									{/literal}
								</div>
							</div>
						</div>
						

						<!--	</div>-->

					</div>

				</div>
			
			</div><!--/.personal-data -->
		
				<div class="col-md-12 ">
				<input  type="button" class="get-loc" value="SUBMIT" name="btnSubmit " id="btnSubmit" onclick="submitForm()" style="margin-left: 15px;">
			</div>
	
			

		</form>
		<div class="col-md-12 body" style="margin-top:20px;">
			<div style="margin-bottom:20px;">
				<h4>Posted Jobs</h4>
			</div>
			<div class="my-bookmark" style="margin-top:10px; overflow-x: scroll; width: 100%;">

				<table class=" table-hover js-basic-example dataTable large-table">

					<thead style="border-bottom:3px solid #fcc512 !important;">
						<tr style="background: none;">
							<th width="5%"><a href="javascript:void();" class="row-head">S.no<b class="caret"></b></a></th>
							<th width="10%"><a href="javascript:void();" class="row-head">Title<b class="caret"></b></a></th>
							<th width="10%"><a href="javascript:void();" class="row-head">Date<b class="caret"></b></a></th>
							<th width="10%"><a href="javascript:void();" class="row-head">Time<b class="caret"></b></a></th>
							<th width="10%"><a href="javascript:void();" class="row-head">Salary<b class="caret"></b></a></th>
							<th width="10%"><a href="javascript:void();" class="row-head">Job Type<b class="caret"></b></a></th>
							<th width="20%"><a href="javascript:void();" class="row-head">Action<b class="caret"></b></a></th>
						</tr>
					</thead>
					<tbody>
						{foreach from=$DATA item=r key=key}
						<tr>
							<td >{$key+1}</td>
							<td>{$r.title|@html_entity_decode}</td>
							<td>{$r.from_date} <b> &nbsp;&nbsp;to&nbsp;&nbsp;</b>{$r.to_date}</td>
							<td>{$r.from_time}<b> &nbsp;&nbsp;to&nbsp;&nbsp;</b>{$r.to_time}</td>
							<td>{$r.sal}</td>
							<td>{$r.job_type}</td>
							<td><a href="javascript:void(0)" onclick="getEmpJobsId('{$r.t3id}')" class="get-loc" style="color:#fff; float:left; margin-right:5px;width:55px;"><i class="material-icons">create</i></a><a href="javascript:void(0)" onclick="DeleteEmpJobs('{$r.t3id}')" class="get-loc" style="color:#fff; float:left; margin-right:5px;width:55px;"><i class="material-icons">delete</i></a><a href="employer.php?action=get_available_candidate_for_job&emp_job_id={$r.t3id}" title="Available candidates for job" class="get-loc" style="color:#fff; float:left; margin-right:5px;width:55px;"><i class="material-icons">person</i></a><a href="employer.php?action=shortlisted_candidates_jobs&emp_job_id={$r.t3id}" title="Shortlisted candidates" class="get-loc" style="color:#fff; float:left; margin-right:5px;width:55px;"><i class="material-icons">person_add</i></a><a href="employer.php?action=cart_candidates_jobs&emp_job_id={$r.t3id}" title="Cart" class="get-loc" style="color:#fff; float:left; margin-right:5px;width:55px;"><i class="material-icons">shopping_cart</i></a><a href="employer.php?action=hired_candidates_jobs&emp_job_id={$r.t3id}" title="Hired candidates" class="get-loc" style="color:#fff; float:left; margin-right:5px;width:55px;"><i class="material-icons">person_pin</i></a></td>
						</tr>
						{/foreach}
					</tbody>
				</table>
			</div>
			<br>
			<br>
			<br>
		</div>

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
	function getEmpJobsId(empjobid) {
		var callback = function(res) {
			$(document).scrollTop(0);
			var response = res.responseText;
			var obj = JSON.parse(response)[0];
			document.getElementById("t3id").value = obj.t3id;
			document.getElementById("title").value = HtmlEncode(obj.title);
			document.getElementById("des").value = HtmlEncode(obj.des);
			document.getElementById("eid").value = obj.eid;
			document.getElementById("from_date").value = obj.from_date;
			document.getElementById("from_time").value = obj.from_time;
			document.getElementById("sal").value = obj.sal;
			document.getElementById("to_date").value = obj.to_date;
			document.getElementById("to_time").value = obj.to_time;
			document.getElementById("job_type_id").value = obj.job_type_id;
			document.getElementById("period").value = obj.period;
			document.getElementById("sector").value = obj.job_sector;
			getCourseBySectorIdWithSelctedItem(obj.job_role, obj.job_sector);
			getSkillsByCourseIdWithSelctedItem(obj.skill, obj.job_role);
			document.getElementById("ejlcid").value = obj.emp_job_loc_id;
		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?emp_job_id=" + empjobid + "&REQUEST=GET_EMP_JOBS_BY_ID";
		var process = ajax.process(url, parameter);

	}

	function getCourseBySectorId() {
		var sector = document.getElementById("sector").value;
		var callback = function(res) {
			var response = res.responseText;

			var d = res.responseText;
			var strl = d.length;
			var strarr = new Array();
			strarr = d.split("^");

			var myDiv = document.getElementById("p");
			var element = document.getElementById('course');
			if ( typeof (element) != 'undefined' && element != null) {
				// exists.
				element.parentNode.removeChild(element);
			}
			var x = document.createElement("select");
			x.id = "course";
			x.name = "course";
			x.className = 'def-input';
			x.onchange = getSkillsByCourseId;
			//var x=document.getElementById('course');
			x.options.length = 0;
			for (var i = 0; i < strarr.length; i++) {
				var optNew = document.createElement('option');
				if (strarr[i] != '') {
					var cat = strarr[i].split('~');
					var text = cat[1];
					var value = cat[0];
					optNew.text = text;
					optNew.value = value;
					try {
						x.add(optNew, null);
						// standards compliant; doesn't work in IE
						//x.appendChild(optNew);
					} catch(ex) {
						//alert(ex.message);
						x.appendChild(optNew);
						// IE only

					}

				}
			}
			myDiv.appendChild(x);
			myDiv.className = 'col-md-12';

		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?sector=" + sector + "&REQUEST=GET_JOBS_ROLE_BY_SECTOR_ID";
		var process = ajax.process(url, parameter);

	}

	function getSkillsByCourseId(skill_id, course_id) {
		var sector = document.getElementById("course").value;
		var callback = function(res) {
			var response = res.responseText;

			var d = res.responseText;
			var strl = d.length;
			var strarr = new Array();
			strarr = d.split("^");

			var myDiv = document.getElementById("skill_div");
			while (myDiv.firstChild) {
				myDiv.removeChild(myDiv.firstChild);
			}

			for (var i = 0; i < strarr.length; i++) {

				if (strarr[i] != '') {
					var cat = strarr[i].split('~');
					var text = cat[1];
					var value = cat[0];
					var checkbox = document.createElement('input');
					checkbox.type = "checkbox";
					checkbox.name = "skill[]";
					checkbox.value = value;
					checkbox.id = "skill" + i;
					checkbox.className = "filled-in";

					var label = document.createElement('label');
					label.htmlFor = "skill" + i;
					label.appendChild(document.createTextNode(text + " "));

					myDiv.appendChild(checkbox);
					myDiv.appendChild(label);
					myDiv.innerHTML = myDiv.innerHTML + "&nbsp;";
				}
			}

		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?course=" + sector + "&REQUEST=GET_SKILLS_BY_JOBROLE_ID";
		var process = ajax.process(url, parameter);

	}

	function getDistrictByStateIdNew(ele) {
		var sector = ele.value;
		var callback = function(res) {
			var d = res.responseText;
			var strl = d.length;
			var strarr = new Array();
			strarr = d.split("^");

			var myDiv = document.getElementById("s");
			var element = document.getElementById('district');
			if ( typeof (element) != 'undefined' && element != null) {
				// exists.
				element.parentNode.removeChild(element);
			}
			var x = document.createElement("select");
			x.id = "district";
			x.name = "district";
			x.className = 'def-input';
			x.onchange = getAreaByDistrictId;

			x.options.length = 0;
			for (var i = 0; i < strarr.length; i++) {
				var optNew = document.createElement('option');
				if (strarr[i] != '') {
					var cat = strarr[i].split('~');
					var text = cat[1];
					var value = cat[0];
					optNew.text = text;
					optNew.value = value;
					try {
						x.add(optNew, null);
						// standards compliant; doesn't work in IE
						//x.appendChild(optNew);
					} catch(ex) {
						//alert(ex.message);
						x.appendChild(optNew);
						// IE only

					}

				}
			}
			myDiv.appendChild(x);
			myDiv.className = 'col-md-12';

		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?state=" + sector + "&REQUEST=GET_DISTRICT_BY_STATE_ID";
		var process = ajax.process(url, parameter);

	}

	function getAreaByDistrictId() {
		var sector = document.getElementById("district").value;

		var callback = function(res) {
			var d = res.responseText;
			var strl = d.length;
			var strarr = new Array();
			strarr = d.split("^");

			var myDiv = document.getElementById("q");
			var element = document.getElementById('area');
			if ( typeof (element) != 'undefined' && element != null) {
				// exists.
				element.parentNode.removeChild(element);
			}
			var x = document.createElement("select");
			x.id = "area";
			x.name = "area";
			x.className = 'def-input';
			x.onchange = getLocalityByAreaId;

			x.options.length = 0;
			for (var i = 0; i < strarr.length; i++) {
				var optNew = document.createElement('option');
				if (strarr[i] != '') {
					var cat = strarr[i].split('~');
					var text = cat[1];
					var value = cat[0];
					optNew.text = text;
					optNew.value = value;
					try {
						x.add(optNew, null);
						// standards compliant; doesn't work in IE
						//x.appendChild(optNew);
					} catch(ex) {
						//alert(ex.message);
						x.appendChild(optNew);
						// IE only

					}

				}
			}
			myDiv.appendChild(x);
			myDiv.className = 'col-md-12';

		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?district=" + sector + "&REQUEST=GET_AREA_BY_DISTRICT_ID";
		var process = ajax.process(url, parameter);

	}

	function getLocalityByAreaId() {
		var sector = document.getElementById("area").value;

		var callback = function(res) {
			var d = res.responseText;
			var strl = d.length;
			var strarr = new Array();
			strarr = d.split("^");
			var myDiv = document.getElementById("m");
			while (myDiv.firstChild) {
				myDiv.removeChild(myDiv.firstChild);
			}

			for (var i = 0; i < strarr.length; i++) {
				if (strarr[i] != '') {
					var divTemp = document.createElement('div');
					var cat = strarr[i].split('~');
					var text = cat[1];
					var value = cat[0];
					var checkbox = document.createElement('input');
					checkbox.type = "checkbox";
					checkbox.name = "locality[]";
					checkbox.value = value;
					checkbox.id = "locality" + i;
					checkbox.className = "filled-in";

					var label = document.createElement('label');
					label.htmlFor = "locality" + i;
					label.appendChild(document.createTextNode(text + " "));

					divTemp.appendChild(checkbox);
					divTemp.appendChild(label);
					myDiv.appendChild(divTemp);

				}
			}

		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?area=" + sector + "&REQUEST=GET_LOCALITY_BY_AREA_ID";
		var process = ajax.process(url, parameter);

	}

	function submitForm() {
		if (validateForm()) {
			var empjobid = document.getElementById("t3id").value;
			if (empjobid == "") {
				document.getElementById("frmAvail").action = "employer.php?action=save_employer_jobs";
				document.getElementById("frmAvail").submit();
			} else {
				document.getElementById("frmAvail").action = "employer.php?action=update_employer_jobs";
				document.getElementById("frmAvail").submit();
			}

		}
	}

	function validateForm() {
		var flag = document.getElementById("flag").value;
		var chk_arr_locality = document.getElementsByName("locality[]");
		var localCount = 0;
		for (var i = 0; i < chk_arr_locality.length; i++) {
			if (chk_arr_locality[i].checked == true)
				localCount++;
		}
		var chk_arr_skill = document.getElementsByName("skill[]");
		var skillCount = 0;
		for (var i = 0; i < chk_arr_skill.length; i++) {
			if (chk_arr_skill[i].checked == true)
				skillCount++;
		}
		if (document.getElementById("title").value == "") {
			frmAvail.title.focus();
			alert("Please enter title");
			return false;
		} else if (document.getElementById("des").value == "") {
			frmAvail.des.focus();
			alert("Please enter description");
			return false;
		} else if (document.getElementById("from_date").value == "") {
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
			alert("Please select job type");
			form_avail.job_type_id.focus();
			return false;
		} else if (document.getElementById("sector").value == "") {
			frmAvail.sector.focus();
			alert("Please enter sector");
			return false;
		} else if (document.getElementById("course").value == "0") {
			frmAvail.course.focus();
			alert("Please enter job role");
			return false;
		} else if (skillCount == 0) {
			chk_arr_skill[0].focus();
			alert("Please enter skill");
			return false;
		} else if (document.getElementById("sal").value == "") {
			frmAvail.sal.focus();
			alert("Please enter salary");
			return false;
		} else if (document.getElementById("ejlcid").value.trim() == "") {
			frmAvail.ejlcid.focus();
			alert("Please enter job location");
			return false;
		} else if (document.getElementById("flag").value == "true") {
			alert("Please select correct date time.");
			return false;
		} else
			return true;
	}

	function addWorkDays() {
		var typeid = document.getElementById('job_type_id').value.trim();
		var fromdate = document.getElementById('from_date').value.trim();
		var todate = document.getElementById('to_date').value.trim();
		var fromtime = document.getElementById('from_time').value.trim();
		var totime = document.getElementById('to_time').value.trim();

		if (typeid == "" || fromdate == "" || todate == "" || fromtime == "" || totime == "") {
			flag = "true";
			document.getElementById("flag").value = flag;
			return;
		}

		var a = moment(todate + ' ' + totime);
		var b = moment(fromdate + ' ' + fromtime);

		var t1 = moment(totime);
		var t2 = moment(fromtime);

		var d1 = moment(todate);
		var d2 = moment(fromdate);
		var flag = "false";
		var works;
		switch(typeid) {
		case "1":
			if (d1 < d2 || t1 < t2) {
				flag = "true";
				alert("please select the right dates/times");
			} else {
				flag = "false";
				works = a.diff(b, 'hours');
			}
			break;
		case "2":
			if (d1 < d2) {
				flag = "true";
				alert("please select the right dates & job type");
			} else {
				flag = "false";
				works = d1.diff(d2, 'days');
			}
			break;
		case "3":
			if (d1 < d2) {
				flag = "true";
				alert("please select the right dates & job type");
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
				}

			}
			break;
		case"4":
			if (d1 < d2) {
				flag = "true";
				alert("Please select the right dates & job type.");
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
				}

			}

			break;

		}
		document.getElementById("flag").value = flag;
		document.getElementById("period").value = works;
	}

	function DeleteEmpJobs(id) {
		var where_to = confirm("Do you really want to Delete this??");
		if (where_to == true) {
			window.location.href = "employer.php?action=delete_employer_jobs&id=" + id;
		}
	}

	function HtmlEncode(str) {
		var res = '';
		res = str.replace(/&amp;/g, "").replace(/amp;/g, "").replace(/&/g, "").replace(/#039;/g, "'");
		return res;
	}
</script>

{/literal}

