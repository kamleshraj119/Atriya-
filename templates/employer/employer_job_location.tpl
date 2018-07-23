{literal} <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBzK712U1ci_ZxJrbLt7O4iGdxBQJeEbE0"></script>

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

	var map;
	function initialize(latitude, longitude) {
		var myLatlng = new google.maps.LatLng(latitude, longitude);

		var myOptions = {
			zoom : 18,
			center : myLatlng,
			mapTypeId : google.maps.MapTypeId.ROADMAP
		};
		map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

		var marker = new google.maps.Marker({
			draggable : true,
			position : myLatlng,
			map : map,
			title : "Your location"
		});

		google.maps.event.addListener(marker, 'dragend', function(event) {
			document.getElementById("lat").value = event.latLng.lat();
			document.getElementById("lng").value = event.latLng.lng();
			infoWindow.open(map, marker);
		});
	}

	function GetLocation() {
		var geocoder = new google.maps.Geocoder();
		var address = document.getElementById("address1").value;
		geocoder.geocode({
			'address' : address
		}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var latitude = results[0].geometry.location.lat();
				var longitude = results[0].geometry.location.lng();
				document.getElementById("lat").value = latitude;
				document.getElementById("lng").value = longitude;
				initialize(latitude, longitude);
			} else {
				alert("Request failed.")
			}
		});
	};
</script>
{/literal}
<div class="work-exp resp-work-exp col-md-12">
	<div class="msg-con" >
		{if $MSG!=""}
		<div>
			{$MSG}
		</div>
		{/if}
	</div>

	<div class="row">
		<form name="frmAvail" id="frmAvail" action="" class="form-horizontal" method="post">

			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<div  style="margin-bottom:20px;">
							<h4>Add/Update Job Location</h4>
						</div>
					</div>

					<div  class="col-md-12">
						<div class="col-xl-4 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group">
								<div class="col-sm-12">
									<b>Address*</b>
								</div>
								<div class="col-md-12">
									<textarea name="address1" id="address1" class="def-input"></textarea>
									<input type="hidden" class="def-input" name="eid" id="eid"  value="{$EMP_ID}">
									<input type="hidden" class="def-input" name="t3id" id="t3id">
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-12">
									<b>Latitude*</b>
								</div>
								<div class="col-md-12">
									<input  type="text" id="lat" name="lat"   class="def-input"/>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<b>Longitude*</b>
								</div>
								<div class="col-md-12">
									<input  type="text" id="lng" name="lng"  class="def-input"/>
								</div>
							</div>
							<div class="form-group">
								<input  type="button" class="get-loc" value="Get Location" name="btnGetLatLong" id="btnGetLatLong" onclick="GetLocation()" style="margin-left:15px;">
							</div>
						</div>
						<div class="col-xl-4 col-md-6 col-sm-6 col-xs-12">
							<div id="map_canvas" style="500px; height: 250px;"></div>
						</div>
					</div>

				</div>
			</div>
			<div  class="col-md-12">
				<div class="col-xl-4 col-md-6 col-sm-6 col-xs-12">
					<div class="form-group">
						<div class="col-md-12">
							<strong>State*</strong>
						</div>
						<div class="col-md-12">
							<select id="state" name="state" class="def-input" onchange="getDistrictByStateIdNew(this)">
								<option value=""> Select State </option>
								{foreach from=$STATES item=r key=key}
								<option value="{$r.id}">{$r.state_name}</option>
								{/foreach}
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12">
							<strong>Area*</strong>
						</div>

						<div class="col-md-12" id="q">
							<select id="area" name="area" class="def-input" >
								<option value=""> Select Area</option>

							</select>

						</div>

					</div>

				</div>
				<div class="col-md-6 col-sm-6">
					<div class="form-group">
						<div class="col-md-12">
							<strong>District*</strong>
						</div>

						<div class="col-md-12" id="s">
							<select id="district" name="district" class="def-input" >
								<option value="">Select District </option>

							</select>
						</div>

					</div>
					<div class="form-group" >
						<div class="col-md-12">
							<strong>Locality</strong>
						</div>
						<div class="col-md-12" id="m" style="float: left;max-height: 95px;overflow-y: auto;max-width: 744px;" >

						</div>
					</div>

				</div>

			</div>
	</div>
</div><!--/.personal-data -->

<div class="col-md-12 ">
	<input  type="button" class="get-loc" value="SUBMIT" name="btnSubmit " id="btnSubmit" onclick="submitForm()" style="margin-left:15px;">
</div>

</form>
<div class="col-md-12 body" style="margin-top:20px;">
	<div style="margin-bottom:20px;">
		<h4>Posted Job Locations</h4>
	</div>
	<div class="my-bookmark" style="margin-top:10px; overflow-x: scroll; width: 100%;">

		<table class=" table-hover js-basic-example dataTable large-table">

			<thead style="border-bottom:3px solid #fcc512 !important;">
				<tr style="background: #eee;">
					<th style="width:5%;"><a href="javascript:void(0);" class="row-head">S.no<b class="caret"></b></a></th>
					<th style="width:10%;"><a href="javascript:void(0);" class="row-head">Address<b class="caret"></b></a></th>
					<th style="width:10%;"><a href="javascript:void(0);" class="row-head">State<b class="caret"></b></a></th>
					<th style="width:10%;"><a href="javascript:void(0);" class="row-head">District<b class="caret"></b></a></th>
					<th style="width:10%;"><a href="javascript:void(0);" class="row-head">Area<b class="caret"></b></a></th>
					<th style="width:10%;"><a href="javascript:void(0);" class="row-head">Locality<b class="caret"></b></a></th>
					<th style="width:10%;"><a href="javascript:void(0);" class="row-head">Action<b class="caret"></b></a></th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$DATA item=r key=key}
				<tr>
					<td >{$key+1}</td>
					<td>{$r.address}</td>
					<td>{$r.state_name}</td>
					<td>{$r.district_name}</td>
					<td>{$r.area_name}</td>
					<td>{$r.multilocal}</td>
					<td><a href="javascript:void(0)" onclick="getEmpJobLocById('{$r.t3id}')" class="get-loc" style="color:#fff; float:left; margin-right:5px"><i class="material-icons">create</i></a><a href="javascript:void(0)" onclick="DeleteEmpJobs('{$r.t3id}')" class="get-loc" style="color:#fff; float:left; margin-right:5px"><i class="material-icons">delete</i></a></td>
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
	function getEmpJobLocById(empjoblocid) {
		var callback = function(res) {
			$(document).scrollTop(0);
			var response = res.responseText;
			var obj = JSON.parse(response)[0];
			document.getElementById("address1").value = obj.address;
			document.getElementById("eid").value = obj.eid;
			document.getElementById("t3id").value = obj.t3id;
			document.getElementById("lat").value = obj.latitude;
			document.getElementById("lng").value = obj.longitude;
			document.getElementById("state").value = obj.state;
			getDistrictByStateIdWithSelctedItem(obj.city, obj.state);
			getAreaByDistrictIdWithSelctedItem(obj.area, obj.city);
			getLocalityByAreaIdWithSelctedItem(obj.locality, obj.area);
		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?id=" + empjoblocid + "&REQUEST=GET_EMP_JOB_LOCATION_BY_ID";
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
				document.getElementById("frmAvail").action = "employer.php?action=save_employer_job_loc";
				document.getElementById("frmAvail").submit();
			} else {
				document.getElementById("frmAvail").action = "employer.php?action=update_employer_job_loc";
				document.getElementById("frmAvail").submit();
			}

		}
	}

	function validateForm() {

		var chk_arr_locality = document.getElementsByName("locality[]");
		var localCount = 0;
		for (var i = 0; i < chk_arr_locality.length; i++) {
			if (chk_arr_locality[i].checked == true)
				localCount++;
		}

		if (document.getElementById("address1").value == "") {
			frmAvail.address1.focus();
			alert("Please enter address");
			return false;
		} else if (document.getElementById("state").value.trim() == "") {
			frmAvail.state.focus();
			alert("Please enter state");
			return false;
		} else if (document.getElementById("district").value == "0") {
			frmAvail.district.focus();
			alert("Please enter district");
			return false;
		} else if (document.getElementById("area").value == "0") {
			frmAvail.area.focus();
			alert("Please enter area");
			return false;
		} else if (localCount == 0) {
			chk_arr_locality[0].focus();
			alert("Please enter locality");
			return false;
		} else if (document.getElementById("lat").value == '' || document.getElementById("lng").value == '') {
			alert("Please click on get location.");
			return false;
		} else
			return true;
	}

	function DeleteEmpJobs(id) {
		var where_to = confirm("Do you really want to Delete this??");
		if (where_to == true) {
			window.location.href = "employer.php?action=delete_employer_job_loc&id=" + id;

		}

	}

	function getAreaByDistrictIdWithSelctedItem(area_id, district_id) {
		var sector = district_id;

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

			x.options.length = 0;
			for (var i = 0; i < strarr.length; i++) {
				var optNew = document.createElement('option');
				if (strarr[i] != '') {
					var cat = strarr[i].split('~');
					var text = cat[1];
					var value = cat[0];
					optNew.text = text;
					optNew.value = value;
					if (area_id == value)
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
			myDiv.className = 'col-sm-12';

		};
		var ajax = new Ajax(callback);
		var url = "admin/application/ajax.php";
		var parameter = "";
		url += "?district=" + sector + "&REQUEST=GET_AREA_BY_DISTRICT_ID";
		var process = ajax.process(url, parameter);

	}

	function getDistrictByStateIdWithSelctedItem(district_id, state) {
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
					if (district_id == value)
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
		url += "?state=" + state + "&REQUEST=GET_DISTRICT_BY_STATE_ID";
		var process = ajax.process(url, parameter);

	}

	function getLocalityByAreaIdWithSelctedItem(locality_id, area_id) {
		var sector = area_id;
		var localArr = locality_id.split(",");
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
					var flag = false;
					for (var j = 0; j < localArr.length; j++) {
						if (value == localArr[j]) {
							flag = true;
						}
					}

					var label = document.createElement('label');
					label.htmlFor = "locality" + i;
					label.appendChild(document.createTextNode(text + " "));

					divTemp.appendChild(checkbox);
					if (flag) {
						var replacement = 'checked>';
						divTemp.innerHTML = divTemp.innerHTML.replace(/>([^>]*)$/, replacement + '$1');
					}
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

</script>

{/literal}

