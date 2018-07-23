<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>Alka Designers Studio | Admin Dashboard</title>
		<meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link href="../images/phoenix_favicon.png" rel="shortcut icon" />
		<!-- favicon -->

		<!-- bootstrap framework -->
		<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">

		<!-- icon sets -->
		<!-- elegant icons -->
		<link href="assets/icons/elegant/style.css" rel="stylesheet" media="screen">
		<!-- elusive icons -->
		<link href="assets/icons/elusive/css/elusive-webfont.css" rel="stylesheet" media="screen">
		<!-- flags -->
		<link rel="stylesheet" href="assets/icons/flags/flags.css">
		<!-- scrollbar -->
		<link rel="stylesheet" href="assets/lib/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">

		<!-- main stylesheet -->
		<link href="assets/css/main.min.css" rel="stylesheet" media="screen" id="mainCss">

		<!-- moment.js (date library) -->
		<script src="assets/js/moment-with-langs.min.js"></script>
		<script src="assets/js/forms.js"></script>
		<script src="assets/js/ajax.js"></script>
		<script type="text/javascript" src="assets/js/sha512.js"></script>
		<script type="text/javascript" src="assets/js/phoenix.js"></script>
		<script type="text/javascript" src="assets/js/delegates.js"></script>
		<script type="text/javascript" src="ckeditor.js"></script>
		<script type="text/javascript" src="jscolor/jscolor.js"></script>

		{literal}
		<style>
			.first_level a {
				color: #fff;
			}
		</style>
		{/literal}
	</head>
	<body class="side_menu_active side_menu_expanded">
		<div id="page_wrapper">

			<!-- header -->
			<header id="main_header">
				<div class="container-fluid">
					<div class="brand_section">
						<a href="admin.php"> <img src="../images/logo.jpg" alt="Alka Designers Studio"
						style="height:80px;"> </a>
					</div>

					<div class="header_user_actions dropdown">
						<div data-toggle="dropdown" class="dropdown-toggle user_dropdown">
							<div class="user_avatar">
								Welcome: {$smarty.session.msf_user_name} <img src="assets/img/orange-down.png" alt="" title="" height="32">
							</div>

						</div>
						<ul class="dropdown-menu dropdown-menu-right">

							<li>
								<a href="admin.php?action=change_password">Change Password</a>
							</li>
							<li>
								<a href="index.php?action=logout">Log Out</a>
							</li>
						</ul>
					</div>

				</div>
			</header>

			<!-- breadcrumbs -->

			<div style="padding-top:40px;">
				{include file = $PAGE}
			</div>

			<!-- main menu -->
			<nav id="main_menu" style="top:80px;">
				<div class="menu_toggle">
					<span class="icon_menu_toggle"> <i class="arrow_carrot-2left toggle_left"></i> <i class="arrow_carrot-2right toggle_right" style="display:none"></i> </span>
				</div>
				<div class="menu_wrapper" style="background-color:#231919">
					<ul>

						<li class="first_level">
							<a href="admin.php"> <span class="icon_house_alt first_level_icon"></span> <span class="menu-title">Dashboard</span> </a>
						</li>
						<li class="first_level">
							<a href="?action=banners"> <span class="icon_document_alt first_level_icon"></span> <span class="menu-title">Banners</span> </a>
						</li>
						<li class="first_level">
							<a href="?action=category"> <span class="icon_document_alt first_level_icon"></span> <span class="menu-title">Category</span> </a>
						</li>
						<li class="first_level">
							<a href="?action=products"> <span class="icon_document_alt first_level_icon"></span> <span class="menu-title">Products</span> </a>
						</li>

						<li class="first_level">
							<a href="index.php?action=logout"> <span class="icon_house_alt first_level_icon"></span> <span class="menu-title">Logout</span> </a>
						</li>

					</ul>
				</div>

			</nav>

		</div>

		<!-- jQuery -->

		<script src="assets/js/jquery.min.js"></script>
		<!-- jQuery Cookie -->
		<script src="assets/js/jqueryCookie.min.js"></script>
		<!-- Bootstrap Framework -->
		<script src="assets/bootstrap/js/bootstrap.min.js"></script>
		<!-- retina images -->
		<script src="assets/js/retina.min.js"></script>
		<!-- switchery -->
		<script src="assets/lib/switchery/dist/switchery.min.js"></script>
		<!-- typeahead -->
		<script src="assets/lib/typeahead/typeahead.bundle.min.js"></script>
		<!-- fastclick -->
		<script src="assets/js/fastclick.min.js"></script>
		<!-- match height -->
		<script src="assets/lib/jquery-match-height/jquery.matchHeight-min.js"></script>
		<!-- scrollbar -->
		<script src="assets/lib/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
		<!-- datepicker -->
		<script src="assets/lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<!-- date range picker -->
		<script src="assets/lib/bootstrap-daterangepicker/daterangepicker.js"></script>
		<!-- Yukon Admin functions -->
		<script src="assets/js/yukon_all.min.js"></script>

		<!-- page specific plugins -->

		<!-- c3 charts -->
		<script src="assets/lib/d3/d3.min.js"></script>
		<script src="assets/lib/c3/c3.min.js"></script>
		<!-- vector maps -->
		<script src="assets/lib/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
		<script src="assets/lib/jvectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
		<!-- datepicker -->
		<link href="assets/lib/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" media="screen">
		<!-- countUp animation -->
		<script src="assets/js/countUp.min.js"></script>
		<!-- easePie chart -->
		<script src="assets/lib/easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
		<script src="assets/lib/DataTables/media/js/jquery.dataTables.min.js"></script>
		<script src="assets/lib/DataTables/extensions/FixedHeader/js/dataTables.fixedHeader.min.js"></script>
		<script src="assets/lib/DataTables/media/js/dataTables.bootstrap.js"></script>

		<script type="text/javascript" src="assets/js/plugins/wysiwyg/jquery.wysiwyg.js"></script>
		<script type="text/javascript" src="assets/js/plugins/wysiwyg/wysiwyg.image.js"></script>
		<script type="text/javascript" src="assets/js/plugins/wysiwyg/wysiwyg.link.js"></script>
		<script type="text/javascript" src="assets/js/plugins/wysiwyg/wysiwyg.table.js"></script>
		<script src="assets/js/jquery.Jcrop.js"></script>
		<link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css" />
		{literal}
		<script>
			$(function() {
				$("#blog_date").datepicker();

			});

			$(function() {

				$('#cropbox').Jcrop({

					bgFade : true, // use fade effect
					bgOpacity : .3, // fade opacity
					onChange : updateCoords,
					onSelect : updateCoords,
					aspectRatio : $('#ratio').val()

				});

			});

			function updateCoords(c) {
				$('#x').val(c.x);
				$('#y').val(c.y);
				$('#w').val(c.w);
				$('#h').val(c.h);
			};

			function checkCoords() {
				if (parseInt($('#w').val()))
					return true;
				alert('Please select a crop region then press submit.');
				return false;
			};
			$(function() {

				yukon_datepicker.p_forms_extended();
				// date range picker
				yukon_datatables.p_plugins_tables_datatable();

			})
			function resetBookingSearch() {
				document.getElementById("booking_from_date").value = "";
				document.getElementById("booking_to_date").value = "";
			}

		</script>

		{/literal}
		<!-- style switcher -->

		<div class="modal fade" id="modalSmall" style="">
			<div class="modal-dialog modal-sm "  style="width:400px;position:fixed;left:550px;bottom:200px;">
				<div class="modal-content">
					<div class="modal-header" id="header">
						<button type="button" class="close" data-dismiss="modal" onclick="CloseSmallModal()">
							<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
						</button>
						<h4 class="modal-title" id="modalTitle">Booking Details</h4>
					</div>
					<div class="modal-body" id="booking_details">

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default btn-sm" data-dismiss="modal" onclick="CloseSmallModal()">
							Close
						</button>

					</div>
				</div>
			</div>
		</div>

	</body>

</html>
