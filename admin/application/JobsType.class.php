<?php

class JobsType {

	function JobsType() 
	{
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}

	function getjobtype($dbHelper, $mysqli, $id) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getJobType', array($id));
		return $data;
	}

	
	function clean($data) {
		$data = stripslashes($data);
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}

}
?>