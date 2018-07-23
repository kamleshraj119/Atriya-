function Register() {
	var category = document.getElementById("reg_category").value.trim();
	if (category == "Candidate") {
		window.location.href = "index.php?action=register-candidate";
	} else if (category == "Employer") {
		window.location.href = "index.php?action=register-employer";
	}
}

function forgotPassword() {
	var fp_mobile = document.getElementById("fp_mobile").value.trim();
	if (fp_mobile == null || fp_mobile == "") {
		alert("Mobile Required");

	} else {

		var callback = function(res) {
			var response = res.responseText.trim();
			alert(response);
			document.getElementById("fp_mobile").value = "";
			location.reload();

		};

		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?mobile=" + fp_mobile + "&REQUEST=FORGOT_USER_PASSOWRD";
		var process = ajax.process(url, parameter);
	}

}

function ChangePassword() {
	var password = document.getElementById("newpassword").value.trim();
	if (password == null || password == "") {
		alert("Password Required");

	} else {
		var p = hex_sha512(password);

		var callback = function(res) {
			var response = res.responseText.trim();
			alert("Password Updated Successfully");
			document.getElementById("newpassword").value = "";
			location.reload();

		};

		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";

		url += "?p=" + p + "&REQUEST=CHANGE_USER_PASSOWRD";
		var process = ajax.process(url, parameter);
	}

}

function getJobRoleBySector() {
	var sector = encodeURIComponent(document.getElementById("jobsector").value);

	var callback = function(res) {
		var response = res.responseText;

		var d = res.responseText;

		var strl = d.length;
		var strarr = new Array();
		strarr = d.split("^");

		var x = document.getElementById('jobcategory');
		x.options.length = 0;
		for (var i = 0; i < strarr.length; i++) {
			var optNew = document.createElement('option');
			if (strarr[i] != '') {
				var cat = strarr[i].split('~');
				for (var j = 0; j < cat.length; j++) {
					var text = cat[1];
					var value = cat[0];
					//alert(cat[i]);
					optNew.text = text;
					optNew.value = value;
					try {
						x.add(optNew, null);
						// standards compliant; doesn't work in IE

					} catch(ex) {

						x.appendChild(optNew);
						// IE only

					}
				}
			}
		}

	};
	var ajax = new Ajax(callback);
	var url = "admin/application/ajax.php";
	var parameter = "";
	url += "?sector=" + sector + "&REQUEST=GET_JOBS_ROLE_BY_SECTOR_ID";
	var process = ajax.process(url, parameter);

}

function getDistrictByStateId() {
	var sector = encodeURIComponent(document.getElementById("state").value);

	var callback = function(res) {
		var response = res.responseText;

		var d = res.responseText;

		var strl = d.length;
		var strarr = new Array();
		strarr = d.split("^");

		var x = document.getElementById('district');
		x.options.length = 0;
		for (var i = 0; i < strarr.length; i++) {
			var optNew = document.createElement('option');
			if (strarr[i] != '') {
				var cat = strarr[i].split('~');
				for (var j = 0; j < cat.length; j++) {
					var text = cat[1];
					var value = cat[0];
					//alert(cat[i]);
					optNew.text = text;
					optNew.value = value;
					try {
						x.add(optNew, null);
						// standards compliant; doesn't work in IE

					} catch(ex) {

						x.appendChild(optNew);
						// IE only

					}
				}
			}
		}

	};
	var ajax = new Ajax(callback);
	var url = "admin/application/ajax.php";
	var parameter = "";
	url += "?states=" + states + "&REQUEST=GET_DISTTRICT_BY_STATE_ID";
	var process = ajax.process(url, parameter);

}

function UploadVideo() {
	if (document.getElementById("youtube").value == "" && document.getElementById("filename").value == "") {
		alert("Please upload video");
		return false;
	} else {
		document.videoform.submit();
		return true;
	}

}

function Login() {
	var category = document.getElementById("category").value.trim();
	var username = document.getElementById("username").value.trim();
	var password = document.getElementById("password").value.trim();
	if (username == null || username == "") {
		alert("Username Required");

	} else if (password == null || password == "") {
		alert("Password Required");

	} else {
		var p = hex_sha512(password);
		var callback = function(res) {
			var response = res.responseText;
			response = response.trim();
			var obj = JSON.parse(response);
			if (obj.msg == "Success") {
				if (category == "Candidate") {
					window.location.href = "candidate.php";
				} else if (category == "Employer") {
					window.location.href = "employer.php";
				} else {
					alert("Invalid Login Details");
				}

			} else {
				alert("Invalid Login Details");
			}
		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?u=" + username + "&p=" + p + "&cat=" + category + "&REQUEST=CHECK_AUTHENTICATION";
		console.log(url);
		var process = ajax.process(url, parameter);

	}
}

function validateCandidate() {
	var name = document.getElementById("name").value.trim();
	var mobile = document.getElementById("mobile").value.trim();
	var aadhaar = document.getElementById("aadhaar").value.trim();
	var pincode = document.getElementById("pincode").value.trim();
	var jobsector = document.getElementById("jobsector").value.trim();
	var jobcategory = document.getElementById("jobcategory").value;
	var terms = document.getElementById("terms").checked;
	if (name == "" || name == null) {
		alert("Please enter name!");
		regdfrm.name.focus();
	} else if (!(/^[A-Za-z \\s]+$/).test(name)) {
		regdfrm.name.focus();
		alert("Please enter alphabets only!");
		return false;
	} else if (mobile == "" || mobile == null || isNaN(mobile) || mobile.length != 10) {
		alert("Please provide 10 digit mobile number!");
		regdfrm.mobile.focus();
	} else if (aadhaar == "" || aadhaar == null || isNaN(aadhaar) || aadhaar.length != 12) {
		alert("Please enter 12 digit aadhar number!");
		regdfrm.aadhaar.focus();
	} else if (isNaN(pincode)) {
		regdfrm.pincode.focus();
		alert("Please enter digits only in pincode!");
		return false;
	} else if (pincode == "" || pincode == null || pincode.length != 6) {
		alert("Please provide 6 digits pincode!");
		regdfrm.pincode.focus();
	} else if (jobsector == "" || jobsector == null) {
		alert("Please select job sector!");
		regdfrm.jobsector.focus();
	} else if (jobcategory == "0") {
		alert("Please select job role!");
		regdfrm.jobcategory.focus();
	} else if (terms == "" || terms == null) {
		alert("Please indicate that you accept the Terms and condition!");
		regdfrm.terms.focus();
	} else {
		var callback = function(res) {
			var response = res.responseText.trim();
			var arr = response.split(",");
			if (arr[0] == "NOTEXIST" && arr[1] == "NOTEXIST") {
				document.regdfrm.submit();
			} else if (arr[0] == "EXIST") {
				alert("Mobile Number already registered.");
			} else if (arr[1] == "EXIST") {
				alert("Aadhar Number already registered.");
			}
		};

		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?id=0&u=" + mobile + "&a=" + aadhaar + "&REQUEST=CHECK_USERNAME";
		var process = ajax.process(url, parameter);

	}
}

function validateEmployer() {
	var name = document.getElementById("name").value.trim();
	var company_name = document.getElementById("company_name").value.trim();
	var phone = document.getElementById("phone").value.trim();
	var email = document.getElementById("email").value.trim();
	var pincode = document.getElementById("pincode").value.trim();
	var terms = document.getElementById("terms").checked;
	if (name == "" || name == null) {
		alert("Please provide contact person name");
		regdfrm.name.focus();
	} else if (!(/^[A-Za-z \\s]+$/).test(name)) {
			regdfrm.name.focus();
			alert("Please enter alphabets only!");
			return false;
	} else if (company_name == "" || company_name == null) {
		alert("Please enter company name");
		regdfrm.company_name.focus();
	} else if (!(/^[A-Za-z \\s]+$/).test(company_name)) {	
			regdfrm.company_name.focus();
			alert("Please enter alphabets only!");
			return false;
	} else if (phone == "" || phone == null || isNaN(phone) || phone.length != 10) {
		alert("Please provide 10 digit mobile number");
		regdfrm.phone.focus();
	} else if (email == "" || email == null) {
		alert("Please enter email id");
		regdfrm.email.focus();
	} else if (!validateEmail(email)) {
		alert("Please enter valid email id");
		regdfrm.email.focus();
	} else if (isNaN(pincode)) {
		regdfrm.pincode.focus();
		alert("Please enter digits only in pincode!");
		return false;
	} else if (pincode == "" || pincode == null || pincode.length != 6) {
		alert("Please enter 6 digit pincode!");
		regdfrm.pincode.focus();
	} else if (terms == "" || terms == null) {
		alert("Please indicate that you accept the Terms us condition");
		regdfrm.terms.focus();
	} else {
		var callback = function(res) {
			var response = res.responseText.trim();
			var arr = response.split(",");
			if (arr[0] == "NOTEXIST") {
				document.regdfrm.submit();

			} else {
				alert("Mobile already registered.");
			}
		};

		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?id=0&u=" + phone + "&a=" + "&REQUEST=CHECK_USERNAME";
		var process = ajax.process(url, parameter);

	}

}
function validateEmail(email) {
				var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				return re.test(String(email).toLowerCase());
			}
