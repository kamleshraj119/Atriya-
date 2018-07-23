<?php
class Area {
	function Area() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}

	function getArea($dbHelper, $mysqli, $id) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getArea', array($id));
		return $data;
	}

	function insertArea($dbHelper, $mysqli) {
		$district = $this -> clean($_REQUEST["district"]);
		$name = $this -> clean($_REQUEST["name"]);
		$dbHelper -> performOperation($mysqli, 'sp_insertArea', array($district, $name));
		header('Location: admin.php?action=master_area');
	}

	function updateArea($dbHelper, $mysqli) {
		$id = $this -> clean($_REQUEST["id"]);
		$district = $this -> clean($_REQUEST["district"]);
		$name = $this -> clean($_REQUEST["name"]);
		$dbHelper -> performOperation($mysqli, 'sp_updateArea', array($id, $district, $name));
		header('Location: admin.php?action=master_area');
	}

	function deleteArea($dbHelper, $mysqli, $id) {
		$dbHelper -> performOperation($mysqli, 'sp_deleteArea', array($id));
		header('Location: admin.php?action=master_area');
	}

	function clean($data) {
		$data = stripslashes($data);
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}

	function uploadArea($dbHelper, $mysqli) {
		$district = $this -> clean($_REQUEST["district"]);
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
				$data = $dbHelper -> getData($mysqli, 'sp_getAreaByName', array($name));
				if (count($data) < 1) {
					$dbHelper -> performOperation($mysqli, 'sp_insertArea', array($district, $name));
					$count++;
				}
               }
			if ($count < 1) {
				echo "No Area uploaded.";
			} else if ($count == 1) {
				echo $count . " Area uploaded successfully.";
			} else {
				echo $count . " Area uploaded successfully.";
			}
		} else
			echo "Please upload csv file.";

	}

}
?>