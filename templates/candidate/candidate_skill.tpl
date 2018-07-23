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
<div class="work-exp col-md-12" style="margin-top: 15px;">
	<div class="msg-con" >
		{if $MSG!=""}
		<div style="background:#e9e4d4;height:40px;margin-bottom:20px;">
			<b style="font-size:24px;">{$MSG}</b>
		</div>
		{/if}
	</div>
		<form name="frmAvail" id="frmAvail" action="" class="form-horizontal" method="post">

			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<div  style="margin-bottom:20px;">
							<h4>Add/Update Preferred Skill</h4>
						</div>
					</div>

					<div  class="col-md-12">
						<div class="col-xl-4 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<input type="hidden" class="def-input" name="cid" id="cid"  value="{$CID}">
								<input type="hidden" class="def-input" name="t3id" id="t3id">
								<div class="col-md-12">
									<strong>Job Sector*</strong>
								</div>
								<div class="col-md-12">
									<select name="sector" id="sector_skill" class="def-input" onchange="getCourseBySectorId()">
										<option value="" disabled selected>Select Job Sector</option>
										{foreach from=$SECTORS item=r key=key}
										<option value="{$r.id}" {if $SKILLS[0].sector==$r.id}selected{/if}>{$r.name}</option>
										{/foreach}
									</select>
		
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<div class="col-md-12">
									<strong>Job Role*</strong>
								</div>

								<div class="col-md-12" id="p">
									<select id="course" name="course" class="def-input" >
										<option value="" > Select Job Role</option>

									</select>
								</div>

							</div>
							

						</div>
						<div class="col-md-12 col-sm-12">
							<div class="form-group">
								<div class="col-md-12">
									<strong>Skill</strong>
								</div>
								<div class="col-md-12" id="skill_div" style="float: left;">

								</div>
							</div>
						</div>

					</div>
				</div>
			</div><!--/.personal-data -->

			<div class="col-md-12 ">
				<input  type="button" class="get-loc" value="SUBMIT" name="btnSubmit " id="btnSubmit" onclick="submitForm()" >
			</div>

		</form>
		<div class="col-md-12 body" style="margin-top:20px;">
			<div style="margin-bottom:20px;">
				<h4>Preferred Skill</h4>
			</div>
			<div style="margin-top:10px; width: 100%;">

				<table class="table-hover js-basic-example dataTable large-table example">

					<thead style="border-bottom:3px solid #fcc512 !important;">
						<tr style="background: #eee;">
							<th style="width:5%;"><a href="javascript:void(0);" class="row-head">S.no<b class="caret"></b></a></th>
							<th style="width:10%;"><a href="javascript:void(0);" class="row-head">Sector<b class="caret"></b></a></th>
							<th style="width:10%;"><a href="javascript:void(0);" class="row-head">Job Role<b class="caret"></b></a></th>
							<th style="width:10%;"><a href="javascript:void(0);" class="row-head">Skill<b class="caret"></b></a></th>
							<th style="width:10%;"><a href="javascript:void(0);" class="row-head">Action<b class="caret"></b></a></th>
						</tr>
					</thead>
					<tbody>
						{foreach from=$DATA item=r key=key}
						<tr>
							<td >{$key+1}</td>
							<td>{$r.sector_name}</td>
							<td>{$r.course_name}</td>
							<td>{$r.multiskill}</td>
							<td><a href="javascript:void(0)" onclick="getCandidateSkillById('{$r.t3id}')" class="get-loc" style="float:left; margin-right:10px"><i class="material-icons">create</i></a><a href="javascript:void(0)" onclick="DeleteCandidateSkill('{$r.t3id}')" class="get-loc" style="float:left; margin-right:10px"><i class="material-icons">delete</i></a></td>
						</tr>
						{/foreach}
					</tbody>
				</table>
			</div>

		</div>
	</div>
</div>

{literal}
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script>

	function getCandidateSkillById(skillId) {
		var callback = function(res) {
			$(document).scrollTop(0);
			var response = res.responseText;
			var obj = JSON.parse(response)[0];
			document.getElementById("cid").value = obj.cid;
			document.getElementById("t3id").value = obj.t3id;
			document.getElementById("sector_skill").value = obj.sector;
			getCourseBySectorIdWithSelctedItem(obj.job_role, obj.sector);
			getSkillsByCourseIdWithSelctedItem(obj.skill, obj.job_role);
		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?id=" + skillId + "&REQUEST=GET_CANDIDATE_SKILL";
		var process = ajax.process(url, parameter);

	}
	function getCourseBySectorId() {
		var sector = document.getElementById("sector_skill").value;
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
	

	function submitForm() {
		if (validateForm()) {
			var empjobid = document.getElementById("t3id").value;
			if (empjobid == "") {
				document.getElementById("frmAvail").action = "candidate.php?action=save_candidate_skill";
				document.getElementById("frmAvail").submit();
			} else {
				document.getElementById("frmAvail").action = "candidate.php?action=update_candidate_skill";
				document.getElementById("frmAvail").submit();
			}

		}
	}

	function validateForm() {

		var chk_arr_skill = document.getElementsByName("skill[]");
		var skillCount = 0;
		for (var i = 0; i < chk_arr_skill.length; i++) {
			if (chk_arr_skill[i].checked == true)
				skillCount++;
		}

		if (document.getElementById("sector_skill").value.trim() == "") {
			frmAvail.sector.focus();
			alert("Please enter sector");
			return false;
		} else if (document.getElementById("course").value == "0") {
			frmAvail.course.focus();
			alert("Please enter job role");
			return false;
		}  else if (skillCount == 0) {
			chk_arr_skill[0].focus();
			alert("Please enter skill");
			return false;
		}  else
			return true;
	}

	function DeleteCandidateSkill(id) {
		var where_to = confirm("Do you really want to Delete this??");
		if (where_to == true) {
			window.location.href = "candidate.php?action=delete_candidate_skill&id=" + id;

		}

	}
	

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
</script>

{/literal}

