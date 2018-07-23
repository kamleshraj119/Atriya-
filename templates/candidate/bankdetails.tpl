<div class="work-exp col-md-12" style="margin-top: 15px;">

	<form class="form-horizontal" method="post" name="form_bank" id="form_bank" enctype="multipart/form-data">

		<div class="personal-data col-md-12">
			<div class="col-md-12">
				<div>
					<h4>Add/Update Bank Accounts - Candidate</h4>
				</div>
			</div>
			<div class="personal-data col-md-12">

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12" >
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<strong>Bank Name*</strong>
						</div>
						<div class="col-md-12">
							<input type="hidden" class="form-control" name="cid" id="cid"  value="{$CID}">
							<input type="hidden" class="form-control" name="id" id="id">
							<input type="text" class="def-input" placeholder="Bank Name*" name="bank_name" id="bank_name">
						</div>
					</div>

					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="col-md-12">
							<strong>Bank Account Number*</strong>
						</div>
						<div class="col-md-12">
							<input type="text" class="def-input" placeholder="Account Number*" name="account_number" id="account_number">
						</div>
					</div>

					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12" >
						<div class="col-md-12">
							<strong>Ifsc Code*</strong>
						</div>
						<div class="col-md-12">
							<input type="text" class="def-input" placeholder="Ifsc Code*" name="ifsc_code" id="ifsc_code">
						</div>
					</div>

					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="col-md-12">
							<strong>Account Holder Name*</strong>
						</div>
						<div class="col-md-12">
							<input type="text" class="def-input" placeholder="Account Holder Name*" name="account_holder_name" id="account_holder_name">
						</div>
					</div>
					<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<strong for="files">Cancelled Cheque</strong>
						</div>
						<div class="col-md-12">
							<input type="file" class="def-input"  name="chequepic" id="chequepic" >
						</div>
					</div>

				</div>

			</div>
		</div><!--/.personal-data -->
		<div style="clear:both;"></div>
		<div class="col-md-12 ">
		
				<input id="save" name="save"  type="button" class="get-loc" value="SUBMIT" onclick="submitForm()" style="margin-left:40px;">
	
		</div>

	</form>

	<div class="personal-data col-md-12">

		<div class="col-md-12">
			<div >
				<h4>Bank Information</h4>
			</div>
		</div>
		<div class="col-md-12">
			<div style="margin-top:10px;">
				<div class="table-responsive" >
					<table class="table-hover js-basic-example dataTable large-table" style="width: 100%;">
						<thead style="border-bottom:3px solid #062223;">
							<tr style="background: #eee;">

								<!--<th style="padding: 20px;" width="10%"><a style="color:#062223;" href="javascript:void(0);" class="row-head">S.no<b class="caret"></b></a></th>-->
								<th style="padding: 20px;" width="17%"><a style="color:#062223;" href="javascript:void(0);" class="row-head">Account Holder Name<b class="caret"></b></a></th>
								<th style="padding: 20px;" width="17%"><a style="color:#062223;" href="javascript:void(0);" class="row-head">Bank Account Number<b class="caret"></b></a></th>
								<th style="padding: 20px;" width="17%"><a style="color:#062223;" href="javascript:void(0);" class="row-head">Ifsc code<b class="caret"></b></a></th>
								<th style="padding: 20px;" width="17%"><a style="color:#062223;" href="javascript:void(0);" class="row-head">Bank Name<b class="caret"></b></a></th>
								<th style="padding: 20px;" width="17%"><a style="color:#062223;" href="javascript:void(0);" class="row-head">Cheque Image<b class="caret"></b></a></th>
								<th style="padding: 20px;" width="15%"><a style="color:#062223;" href="javascript:void(0);" class="row-head">Action<b class="caret"></b></a></th>
							</tr>
						</thead>
						
						<tbody>
							{foreach from=$DATA item=r key=key}
							<tr width="100%">
								<!--<td style="padding: 20px;">{$key+1}.</td>-->
								<td style="padding: 20px;" width="17%">{$r.account_holder_name}</td>
								<td style="padding: 20px;" width="17%">{$r.account_number}</td>
								<td style="padding: 20px;" width="17%">{$r.ifsc_code}</td>
								<td style="padding: 25px;" width="17%">{$r.bank_name}</td>
								<td style="padding: 20px;" width="17%"><a href="http://skillchamps.in/admin/images/candidate/{$r.uid}/{$r.chaque}" target="_blank"><img src="http://skillchamps.in/admin/images/candidate/{$r.uid}/{$r.chaque}" width="200" height="200"/></a></td>
								<td style="padding: 20px;" width="15%"><a href="javascript:void(0)" onclick="getbankdetailsbycid('{$CID}')" class="get-loc" style="float:left; margin-right:10px"><i class="material-icons">edit</i></a><a href="javascript:void(0)" onclick="DeleteCandidateBankDetails('{$CID}')" class="get-loc" style="float:left; margin-right:10px"><i class="material-icons">delete</i></a></td>
							</tr>
							{/foreach}
						</tbody>
						
					</table>
				</div>
			</div>
		</div>

	</div>
</div>

{literal}
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script>
	function decodeHTMLEntities(text) {
		var entities = [['amp', '&'], ['apos', '\''], ['#x27', '\''], ['#x2F', '/'], ['#39', '\''], ['#47', '/'], ['lt', '<'], ['gt', '>'], ['nbsp', ' '], ['quot', '"'], ["#039", "'"]];

		for (var i = 0, max = entities.length; i < max; ++i)
			text = text.replace(new RegExp('&' + entities[i][0] + ';', 'g'), entities[i][1]);
		return text;
	}

	function getbankdetailsbycid(cid) {
		var callback = function(res) {
			$(document).scrollTop(0);
			var response = res.responseText;
			var obj = JSON.parse(response)[0];
			document.getElementById("cid").value = cid;
			document.getElementById("id").value = obj.id;
			document.getElementById("bank_name").value = decodeHTMLEntities(obj.bank_name);
			document.getElementById("ifsc_code").value = obj.ifsc_code;
			document.getElementById("account_number").value = obj.account_number;
			document.getElementById("account_holder_name").value = decodeHTMLEntities(obj.account_holder_name);
			//document.getElementById("chequepic").innerHTML = obj.chaque;

		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?cid=" + cid + "&REQUEST=CANDIDATE_BANK_DETAILS";
		var process = ajax.process(url, parameter);

	}

	function DeleteCandidateBankDetails(id) {
		var where_to = confirm("Do you really want to Delete this??");
		if (where_to == true) {
			window.location.href = "candidate.php?action=delete_candidate_bank_details&id=" + id;
		}
	}

	function submitForm() {
		if (validateForm()) {
			var id = document.getElementById("id").value;
			if (id == "") {
				document.getElementById("form_bank").action = "candidate.php?action=save_candidate_bank_details";
				document.getElementById("form_bank").submit();
			} else {
				document.getElementById("form_bank").action = "candidate.php?action=update_candidate_bank_details";
				document.getElementById("form_bank").submit();
			}
		}
	}

	function validateForm() {

		if (document.getElementById("bank_name").value == "") {
			form_bank.bank_name.focus();
			alert("Please enter bank name");
			return false;
		} else if (!(/^[A-Za-z \\s]+$/).test(document.getElementById("bank_name").value)) {
			form_bank.bank_name.focus();
			alert("Please enter alphabets");
			return false;
		} else if (document.getElementById("account_number").value == "") {
			form_bank.account_number.focus();
			alert("Please enter account number!");
			return false;
		} else if (isNaN(document.getElementById("account_number").value)) {
			form_bank.account_number.focus();
			alert("You have entered invalid account number!");
			return false;
		} else if ((document.getElementById("account_number").value.length < 11 || document.getElementById("account_number").value.length > 16)) {
			form_bank.account_number.focus();
			alert("Please check account number!");
			return false;
		} else if (/[^a-zA-Z0-9]/.test(document.getElementById("ifsc_code").value)) {
			form_bank.ifsc_code.focus();
			alert('Please enter alphanumeric characters only!');
			return false;
		} else if (document.getElementById("ifsc_code").value.length != 11) {
			form_bank.ifsc_code.focus();
			alert("Please enter 11 digit ifsccode!");
			return false;
		} else if (document.getElementById("account_holder_name").value == "") {
			form_bank.account_holder_name.focus();
			alert("Please enter account holder name!");
			return false;
		} else if (!(/^[A-Za-z \\s]+$/).test(document.getElementById("account_holder_name").value)) {
			form_bank.account_holder_name.focus();
			alert("Please enter alphabets!");
			return false;
		} else {
			document.getElementById("form_bank").submit();
			return true;
		}
	}

</script>

{/literal}

