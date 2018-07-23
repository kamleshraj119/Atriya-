<form enctype= "multipart/form-data" action="candidate.php?action=upload_doc" method="post" name="videoform" id="videoform">
	<div class="col-md-12" style="margin-top:20px;">

		<h4>Documents</h4>

		<div class="my-bookmark post-a-job" style="margin-top:10px;">
			<div class="form-group">
				<input type="hidden" id="cid" name="cid" value="{$CID}" />
				<select name="type" id="type" class="def-input">
					<option value=""> Select Document Type</option>
					<option value="Document" >Document</option>
					<option value="Certificates" >Certificate</option>
					<option value="CV" >CV</option>
					<option value="Other">Other</option>
				</select>

			</div>
			<div class="form-group mar-t-20 mar-b-20" style="padding:0px;">

				<div class="def-btn upload-file-btn">
					<span><i class="fa fa-upload"></i>&nbsp; Browse Document</span>
					<input type="file" name="filename" id="filename" class="upload" onchange="getFileData(this);">
				</div>
				<div class="small-desc" id="small-desc">
					Max 32MB
				</div>

			</div>
		</div>
		<a href="javascript:void(0)" onclick="UploadDocument()" class="get-loc">Submit</a>

		<div class="personal-data col-md-12">
			<div class="row">
				<div class="col-md-12">
					<div class="row">

						<h4>Uploaded Documents</h4>
					</div>
				</div>
				<div class="col-md-12">
					<div class="row">
						<div class="my-bookmark" style="margin-top:10px;">
							<div class="table-responsive">
								<table class="table-hover js-basic-example dataTable large-table" style="width:100%;" id="example">
									<thead style="border-bottom:3px solid #062223;">
										<tr style="background: #eee;">

											<th style="padding: 20px;"><a style="color:#062223;" href="javascript:void(0);" class="row-head">S.no<b class="caret"></b></a></th>
											<th style="padding: 20px;"><a style="color:#062223;" href="javascript:void(0);" class="row-head">Document<b class="caret"></b></a></th>
											<th style="padding: 20px;"><a style="color:#062223;" href="javascript:void(0);" class="row-head">Type<b class="caret"></b></a></th>
											<th style="padding: 20px;"><a style="color:#062223;" href="javascript:void(0);" class="row-head">Date<b class="caret"></b></a></th>
											<th style="padding: 20px;"><a style="color:#062223;" href="javascript:void(0);" class="row-head">Action<b class="caret"></b></a></th>
										</tr>
									</thead>

									<tbody>
										{foreach from=$DATA item=r key=key}
										<tr>
											<td style="padding: 20px;">{$key+1}.</td>
											<td style="padding: 20px;"><a href="http://skillchamps.in/docs/{$r.cid}/{$r.file_name}" target="_blank">{$r.file_name}</a></td>
											<td style="padding: 20px;">{$r.type}</td>
											<td style="padding: 20px;">{$r.added_date}</td>
											<td style="padding: 20px;"><a href="javascript:void(0)" onclick="DeleteCandidateDoc('{$r.id}')" class="get-loc" style="float:left; margin-right:5px"><i class="material-icons">delete</i></a></td>
										</tr>
										{/foreach}
									</tbody>

								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	{literal}
	<style>
		.paginate_button {
			border-radius: 0 !important;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-material-datetimepicker.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<script type="text/javascript"  src="assets/js/moment-with-locales.min.js"></script>
	<script type="text/javascript"  src="assets/js/bootstrap-material-datetimepicker.js"></script>
	<script>
		function getFileData(myFile) {
			var file = myFile.files[0];
			var filename = file.name;
			document.getElementById('small-desc').innerHTML = filename;
		}

		function UploadDocument() {
			if (document.getElementById("type").value == "") {
				alert("Please select document type");
				return false;
			} else if (document.getElementById("filename").value == "") {
				alert("Please choose file.");
				return false;
			} else {
				document.videoform.submit();
				return true;
			}
		}

		function DeleteCandidateDoc(id) {
			var where_to = confirm("Do you really want to Delete this??");
			if (where_to == true) {
				window.location.href = "candidate.php?action=delete_doc&id=" + id;

			}

		}

	</script>
	{/literal}
