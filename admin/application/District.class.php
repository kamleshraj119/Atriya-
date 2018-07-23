<?php

class District {

	function District() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}

	function getDistrict($dbHelper, $mysqli, $id) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getDistrict', array($id));
		return $data;
	}


 function getDistrictByStateId ($dbHelper, $mysqli, $id) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getDistrictByStateId', array($id));
		return $data;
	}

	function insertDistrict($dbHelper, $mysqli) {
		$state = $this -> clean($_REQUEST["state"]);
		$name = $this -> clean($_REQUEST["name"]);
		$dbHelper -> performOperation($mysqli, 'sp_insertDistrict', array($state, $name));
		header('Location: admin.php?action=master_district');
	}

	function updateDistrict($dbHelper, $mysqli) {
		$id = $this -> clean($_REQUEST["id"]);
		$state = $this -> clean($_REQUEST["state"]);
		$name = $this -> clean($_REQUEST["name"]);
		$dbHelper -> performOperation($mysqli, 'sp_updateDistrict', array($id, $state, $name));
		header('Location: admin.php?action=master_district');
	}

	function deleteDistrict($dbHelper, $mysqli, $id) {
		$dbHelper -> performOperation($mysqli, 'sp_deleteDistrict', array($id));
		header('Location: admin.php?action=master_district');
	}

	function uploadDistrict($dbHelper, $mysqli) {
		$state = $this -> clean($_REQUEST["state"]);
		$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
		if (!empty($_FILES['file']['tmp_name']) && in_array($_FILES['file']['type'], $csvMimes)) {

			$csvFile = fopen($_FILES["file"]["tmp_name"], 'r');

			//skip first line
			fgetcsv($csvFile);
			$count = 0;
			//parse data from csv file line by line
			while (($line = fgetcsv($csvFile)) !== FALSE) {
				$name = $line[0];
				$data = array();
				$data = $dbHelper -> getData($mysqli, 'sp_getDistrictByName', array($name));
				if (count($data) < 1) {
					$dbHelper -> performOperation($mysqli, 'sp_insertDistrict', array($state, $name));
					$count++;
				}

			}
			if ($count < 1) {
				echo "No District uploaded.";
			} else if ($count == 1) {
				echo $count . " District uploaded successfully.";
			} else {
				echo $count . " District uploaded successfully.";
			}
		} else
			echo "Please upload csv file.";

	}

	function clean($data) {
		$data = stripslashes($data);
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}

}
?>