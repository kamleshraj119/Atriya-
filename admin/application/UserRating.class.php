<?php
class UserRating {
	function UserRating() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}

	function getUserRating($dbHelper, $mysqli, $id) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getUserRatings', array($id));
		return $data;
	}

	function saveUserRating($dbHelper, $mysqli) {
		$uidTo = $this -> clean($_REQUEST["uid_to"]);
		$uidFrom = $this -> clean($_REQUEST["uid_from"]);
		$rating = isset($_REQUEST["star"]) ? $_REQUEST["star"] : 0 ;
		$remark = $this -> clean($_REQUEST["remark"]);
		$redirectLocation=$_REQUEST["redirect"];
		$dbHelper -> performOperation($mysqli, 'sp_saveUserRating', array($uidTo, $uidFrom,$rating,$remark));
		header('Location: '.$redirectLocation);
	}

	

	function clean($data) {
		$data = stripslashes($data);
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}
}
?>