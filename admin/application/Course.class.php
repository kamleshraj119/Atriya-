<?php

class Course {

	function Course() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}

	function getCourse($dbHelper, $mysqli, $id) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getCourses', array($id));
		return $data;
	}

	function getCourseBySector($dbHelper, $mysqli, $id) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getCourseBySectorId', array($id));
		return $data;
	}

	function insertCourse($dbHelper, $mysqli) {
		$sector = $this -> clean($_REQUEST["sector"]);
		$name = $this -> clean($_REQUEST["name"]);
		$dbHelper -> performOperation($mysqli, 'sp_insertCourses', array($sector, $name));
		header('Location: admin.php?action=master_courses');
	}

	function updateCourse($dbHelper, $mysqli) {
		$id = $this -> clean($_REQUEST["id"]);
		$sector = $this -> clean($_REQUEST["sector"]);
		$name = $this -> clean($_REQUEST["name"]);
		$dbHelper -> performOperation($mysqli, 'sp_upadateCourse', array($id, $sector, $name));
		header('Location: admin.php?action=master_courses');
	}

	function deleteCourse($dbHelper, $mysqli, $id) {
		$dbHelper -> performOperation($mysqli, 'sp_deleteCourses', array($id));
		header('Location: admin.php?action=master_courses');
	}

	function uploadCourse($dbHelper, $mysqli) {
		$sector = $this -> clean($_REQUEST["sector"]);
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
				$data = $dbHelper -> getData($mysqli, 'sp_getCourseByName', array($name));
				if (count($data) < 1) {
					$dbHelper -> performOperation($mysqli, 'sp_insertCourses', array($sector, $name));
					$count++;
				}

			}
			if ($count < 1) {
				echo "No Sector uploaded.";
			} else if ($count == 1) {
				echo $count . " Sector uploaded successfully.";
			} else {
				echo $count . " Sector uploaded successfully.";
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