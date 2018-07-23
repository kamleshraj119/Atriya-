<?php

class Locality {

	function Locality() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}

	function getLocality($dbHelper, $mysqli, $id) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getLocality', array($id));
		return $data;
	}

	function insertLocality($dbHelper, $mysqli) {
		$area = $this -> clean($_REQUEST["area"]);
		$name = $this -> clean($_REQUEST["name"]);
		$pincode = $this -> clean($_REQUEST["pincode"]);
		$dbHelper -> performOperation($mysqli, 'sp_insertLocality', array($area, $name, $pincode));
		header('Location: admin.php?action=master_locality');
	}

	function updateLocality($dbHelper, $mysqli) {
		$id = $this -> clean($_REQUEST["id"]);
		$area = $this -> clean($_REQUEST["area"]);
		$name = $this -> clean($_REQUEST["name"]);
		$pincode = $this -> clean($_REQUEST["pincode"]);
		$dbHelper -> performOperation($mysqli, 'sp_updateLocality', array($id, $area, $name, $pincode));
		header('Location: admin.php?action=master_locality');
	}

	function deleteLocality($dbHelper, $mysqli, $id) {
		$dbHelper -> performOperation($mysqli, 'sp_deleteLocality', array($id));
		header('Location: admin.php?action=master_locality');
	}

	function uploadLocality($dbHelper, $mysqli) {
		$area = $this -> clean($_REQUEST["area"]);
		$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
		if (!empty($_FILES['file']['tmp_name']) && in_array($_FILES['file']['type'], $csvMimes)) {

			$csvFile = fopen($_FILES["file"]["tmp_name"], 'r');

			//skip first line
			fgetcsv($csvFile);
			$count = 0;
			//parse data from csv file line by line
			while (($line = fgetcsv($csvFile)) !== FALSE) {
				$name = $line[0];
				$pincode = $line[1];
				$data = array();
				$data = $dbHelper -> getData($mysqli, 'sp_getLocalityByNameAndPin', array($name, $pincode));
				if (count($data) < 1) {
					$dbHelper -> performOperation($mysqli, 'sp_insertLocality', array($area, $name, $pincode));
					$count++;
				}

			}
			if ($count < 1) {
				echo "No Locality uploaded.";
			} else if ($count == 1) {
				echo $count . " Locality uploaded successfully.";
			} else {
				echo $count . " Locality uploaded successfully.";
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