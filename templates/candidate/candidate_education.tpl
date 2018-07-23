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
{/literal}
<div class="work-exp col-md-12">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12">
					<div  style="margin-bottom:20px;">
						<h4>Add/Update Education Details</h4>
						{if $DATA|@count==0}
						<span>*If Not applicable please check NA.</span>
						{/if}
					</div>
				</div>

				<div  class="col-md-12">
					{if $DATA|@count==0}
					<div class="col-md-12">
						<div class="form-group">
							<input type="checkbox" id="chk_edu" class="filled-in" name="chak_edu" onclick="toogleForm();" />
							<label for="chk_edu">NA</label>
						</div>
					</div>
					{/if}
				</div>

				<form name="frmAvail" id="frmAvail" action="" class="form-horizontal" method="post">
					<div class="col-md-6">
						<div class="form-group">
							<div class="col-md-12">
								<strong>Degree/Course Name*</strong>
							</div>
							<div class="col-md-12">
								<input type="hidden" class="def-input" name="uid" id="uid" value="{$CID}">
								<input type="hidden" class="def-input" name="id" id="edid" >
								<input type="text" class="def-input" name="course" id="course">

							</div>
						</div>

						<div class="form-group">
							<div class="col-md-12">
								<strong>Board/University</strong>
							</div>
							<div class="col-md-12">
								<input type="text" class="def-input" name="board" id="board">
							</div>
						</div>

					</div>
					<div class="col-md-6">
						<div class="form-group">
							<div class="col-md-12">
								<strong>Grade(Percentage/Cgpa)*</strong>
							</div>
							<div class="col-md-12">
								<input type="number" class="def-input"  name="grade" id="grade" maxlength='2'>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<strong>Passing Year*</strong>
							</div>
							<div class="col-md-12">
								<input type="text" class="def-input"  name="year" id="year">
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<div class="col-md-12">
								<strong>School/Institute Name*</strong>
							</div>
							<div class="col-md-12">
								<input type="text" class="def-input" name="school" id="school">

							</div>
						</div>

					</div>
					<div class="col-md-12">
						<div class="form-group">
							<div class="col-md-12">
								<strong>Documents</strong>
							</div>

							<div class="col-md-12">
								{foreach from=$DOC item=r key=key}
								<div class="col-lg-6 col-md-6 col-sm-12">
									<input type="radio" value="{$r.id}" name="docid" id="doc{$key}" />
									<label for = "doc{$key}"><a href="http://skillchamps.in/docs/{$r.cid}/{$r.file_name}" target="_blank">{$r.file_name}</a></label>
								</div>
								{/foreach}
							</div>

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
	<div style="margin-bottom:20px;" class="row">
		<h4>&nbsp;&nbsp;Education Details</h4>
	</div>
	<div class="my-bookmark" style="margin-top:10px; overflow-x: scroll; width: 100%;">

		<table class="table-hover js-basic-example dataTable large-table example" >

			<thead style="border-bottom:3px solid #fcc512 !important;">
				<tr style="background: #eee;">
					<th style="width:5%;"><a href="javascript:void(0);" class="row-head">S.No<b class="caret"></b></a></th>
					<th style="width:10%;"><a href="javascript:void(0);" class="row-head">Course<b class="caret"></b></a></th>
					<th style="width:10%;"><a href="javascript:void(0);" class="row-head">School/Institute<b class="caret"></b></a></th>
					<th style="width:10%;"><a href="javascript:void(0);" class="row-head">Board/University<b class="caret"></b></a></th>
					<th style="width:10%;"><a href="javascript:void(0);" class="row-head">Passing Year<b class="caret"></b></a></th>
					<th style="width:10%;"><a href="javascript:void(0);" class="row-head">Grade/CGPA<b class="caret"></b></a></th>
					<th style="width:10%;"><a href="javascript:void(0);" class="row-head">Document<b class="caret"></b></a></th>
					<th style="width:10%;"><a href="javascript:void(0);" class="row-head">Action<b class="caret"></b></a></th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$DATA item=r key=key}
				<tr>
					<td>{$key+1}.</td>
					<td>{$r.course}</td>
					<td>{$r.school_institute}</td>
					<td>{if $r.school_institute!=NA}{$r.board_university}{/if}</td>
					<td>{if $r.school_institute!=NA}{$r.passing_year}{/if}</td>
					<td>{if $r.school_institute!=NA}{$r.grade}{/if}</td>
					<td>{if $r.school_institute!=NA}<a href="http://skillchamps.in/docs/{$r.cid}/{$r.file_name}" target="_blank">{$r.file_name}</a>{/if}</td>
					<td><a href="javascript:void(0)" onclick="getCandidateEducationById('{$r.edid}')" class="get-loc" style="float:left; margin-right:10px"><i class="material-icons">create</i></a>&nbsp; <a href="javascript:void(0)" onclick="DeleteCandidateEducation('{$r.edid}')" class="get-loc" style="float:left; margin-right:10px"><i class="material-icons">delete</i></a></td>
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
	$(document).on("click", "input[name='docid']", function() {
		thisRadio = $(this);
		if (thisRadio.hasClass("imChecked")) {
			thisRadio.removeClass("imChecked");
			thisRadio.prop('checked', false);
		} else {
			thisRadio.prop('checked', true);
			thisRadio.addClass("imChecked");
		};
	})

	function toogleForm() {
		if (document.getElementById('chk_edu').checked) {
			document.getElementById('frmAvail').style.display = "none";
			document.getElementById("course").value = "NA";
			document.getElementById("grade").value = "0";
			document.getElementById("board").value = "NA";
			document.getElementById("year").value = "0";
			document.getElementById("school").value = "NA";
		} else {
			document.getElementById('frmAvail').style.display = "block";
			document.getElementById("course").value = "";
			document.getElementById("grade").value = "";
			document.getElementById("board").value = "";
			document.getElementById("year").value = "";
			document.getElementById("school").value = "";
		}
	}

	function getCandidateEducationById(id) {
		var callback = function(res) {
			$(document).scrollTop(0);
			var response = res.responseText;
			var obj = JSON.parse(response)[0];
			document.getElementById("edid").value = obj.edid;
			document.getElementById("course").value = decodeHTMLEntities(obj.course);
			document.getElementById("board").value = decodeHTMLEntities(obj.board_university);
			document.getElementById("year").value = obj.passing_year;
			document.getElementById("grade").value = obj.grade;
			document.getElementById("school").value = decodeHTMLEntities(obj.school_institute);
			for (var i = 0; i < document.frmAvail.docid.length; i++) {
				if (document.frmAvail.docid[i].value == obj.linked_doc_id) {
					document.frmAvail.docid[i].checked = true;
				}
			}
		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?id=" + id + "&REQUEST=GET_CANDIDATE_EDUCATION";
		var process = ajax.process(url, parameter);

	}

	function submitForm() {
		if (validateForm()) {
			var empjobid = document.getElementById("edid").value;
			if (empjobid == "") {
				document.getElementById("frmAvail").action = "candidate.php?action=save_can_education";
				document.getElementById("frmAvail").submit();
			} else {
				document.getElementById("frmAvail").action = "candidate.php?action=update_can_education";
				document.getElementById("frmAvail").submit();
			}

		}
	}

	function validateForm() {

		if (document.getElementById("course").value == "") {
			frmAvail.course.focus();
			alert("Please enter degree/course name");
			return false;
		} else if (document.getElementById("grade").value == "") {
			frmAvail.grade.focus();
			alert("Please enter grade");
			return false;
		}else if (document.getElementById("grade").value>100) {
			frmAvail.grade.focus();
			 alert("No numbers above 100");
			return false;
		} else if (document.getElementById("year").value == "") {
			frmAvail.year.focus();
			alert("Please enter passing year");
			return false;
		} else if (document.getElementById("school").value == "") {
			frmAvail.school.focus();
			alert("Please enter school/institute name");
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

	function decodeHTMLEntities(text) {
		var entities = [['amp', '&'], ['apos', '\''], ['#x27', '\''], ['#x2F', '/'], ['#39', '\''], ['#47', '/'], ['lt', '<'], ['gt', '>'], ['nbsp', ' '], ['quot', '"'], ["#039", "'"]];

		for (var i = 0, max = entities.length; i < max; ++i)
			text = text.replace(new RegExp('&' + entities[i][0] + ';', 'g'), entities[i][1]);
		return text;
	}
</script>

{/literal}

