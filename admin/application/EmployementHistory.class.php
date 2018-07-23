<?php

class EmployementHistory {

	function EmployementHistory() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}

	function addEmployementHistoryFront($mysqli, $dbHelper, $cid) {
		addEmployementHistory($mysqli, $dbHelper, $cid);
		header('Location: guru.php');
	}

	function updateEmployementHistoryFront($mysqli, $dbHelper, $cid) {
		updateEmployementHistory($mysqli, $dbHelper, $cid);
		header('Location: guru.php');
	}

	function deleteEmployementHistoryFront($mysqli, $dbHelper, $id) {
		deleteEmployementHistory($mysqli, $dbHelper, $id);
		header('Location: guru.php');
	}

	function addEmployementHistoryAdmin($mysqli, $dbHelper, $cid) {
		$result = "";
		$cid = $_REQUEST["cid"];
		$compName = $this->clean($_REQUEST["comp_name"]);
		$compAddress = $this->clean($_REQUEST["comp_address"]);
		$position = $this->clean($_REQUEST["position"]);
		$contactPerson = $this->clean($_REQUEST["contact_person"]);
		$pincode = $this->clean($_REQUEST["pincode"]);
		$start_date = $_REQUEST["start_date"];
		$end_date = $_REQUEST["end_date"];
		$result = $dbHelper -> performOperation($mysqli, 'sp_insertOldEmpHistory', array($cid, $compName, $compAddress, $position, $contactPerson, $pincode, $start_date, $end_date));
		header('Location:admin.php?action=candidate_employement_history&cid='.$cid);
	}

	function updateEmployementHistoryAdmin($mysqli, $dbHelper) {
		$result = "";
		$id = $_REQUEST["id"];
        $cid=$_REQUEST["cid"];
		$compName = $this->clean($_REQUEST["comp_name"]);
		$compAddress = $this->clean($_REQUEST["comp_address"]);
		$position = $this->clean($_REQUEST["position"]);
		$contactPerson = $this->clean($_REQUEST["contact_person"]);
		$pincode = $this->clean($_REQUEST["pincode"]);
		$start_date = $_REQUEST["start_date"];
		$end_date = $_REQUEST["end_date"];
		$result = $dbHelper -> performOperation($mysqli, 'sp_updateOldEmpHistory', array($id, $cid, $compName, $compAddress, $position, $contactPerson, $pincode, $start_date, $end_date));
		header('Location:admin.php?action=candidate_employement_history&cid='.$cid);
	}

	function deleteEmployementHistoryAdmin($mysqli, $dbHelper,$id,$cid) {
		$result = "";
		$result = $dbHelper -> performOperation($mysqli, 'sp_deleteOldEmpHistory', array($id));
		header('Location:admin.php?action=candidate_employement_history&cid='.$cid);
	}

	function addEmployementHistory($mysqli, $dbHelper) {
		$result = "";
		$cid = $_REQUEST["cid"];
		$compName = $this->clean($_REQUEST["comp_name"]);
		$compAddress = $this->clean($_REQUEST["comp_address"]);
		$position = $this->clean($_REQUEST["position"]);
		$contactPerson = $this->clean($_REQUEST["contact_person"]);
		$pincode = $this->clean($_REQUEST["pincode"]);
		$start_date = $_REQUEST["start_date"];
		$end_date = $_REQUEST["end_date"];
		$result = $dbHelper -> performOperation($mysqli, 'sp_insertOldEmpHistory', array($cid, $compName, $compAddress, $position, $contactPerson, $pincode, $start_date, $end_date));
		header('Location:candidate.php?action=history');
	}

	function updateEmployementHistory($mysqli, $dbHelper, $cid) {
		$result = "";
		$dbHelper = new DBHelper;
		$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
		$authtoken = $_REQUEST["authtoken"];
		$id = $_REQUEST["id"];
		$compName = $this->clean($_REQUEST["comp_name"]);
		$compAddress = $this->clean($_REQUEST["comp_address"]);
		$position = $this->clean($_REQUEST["position"]);
		$contactPerson = $this->clean($_REQUEST["contact_person"]);
		$pincode = $this->clean($_REQUEST["pincode"]);
		$start_date = $_REQUEST["start_date"];
		$end_date = $_REQUEST["end_date"];
		$result = $dbHelper -> performOperation($mysqli, 'sp_updateOldEmpHistory', array($id, $cid, $compName, $compAddress, $position, $contactPerson, $pincode, $start_date, $end_date));
		header('Location:candidate.php?action=history');
	}

	function deleteEmployementHistory($mysqli, $dbHelper, $id) {
		$result = "";
		$authtoken = $_REQUEST["authtoken"];
		$id = $_REQUEST["id"];
		$result = $dbHelper -> performOperation($mysqli, 'sp_deleteOldEmpHistory', array($id));
		header('Location:candidate.php?action=history');
	}

	function getEmployementHistory($mysqli, $dbHelper, $cid) {
		$data = array();
		$datetime2='';
		$dataHiredCandidate = array();
		$dataHiredCandidate = $dbHelper -> getData($mysqli, "sp_getHiredCandidateByCid", array($cid));
		for ($i = 0; $i < count($dataHiredCandidate); $i++) {
			$datetime1 = new DateTime($dataHiredCandidate[$i]["from_date"]);
			if($dataHiredCandidate[$i]["from_date"] == $dataHiredCandidate[$i]["to_date"]){
				$datetime2 = new DateTime($dataHiredCandidate[$i]["to_date"].'+1 day');
			}else{
				$datetime2 = new DateTime($dataHiredCandidate[$i]["to_date"]);
			}
			$interval = $datetime1 -> diff($datetime2);
			$dataHiredCandidate[$i]["exp"] = $interval -> format('%y years %m months and %d days');
		}
		$dataOld = array();
		$dataOld = $dbHelper -> getData($mysqli, "sp_getOldEmpHistoryBycid", array($cid));
		for ($i = 0; $i < count($dataOld); $i++) {
			$datetime1 = new DateTime($dataOld[$i]["start_date"]);
			if($dataOld[$i]["start_date"] == $dataOld[$i]["end_date"]){
				$datetime2 = new DateTime($dataOld[$i]["end_date"].'+1 day');
			}else{
				$datetime2 = new DateTime($dataOld[$i]["end_date"]);
			}				
			$interval = $datetime1 -> diff($datetime2);			
	   		$dataOld[$i]["exp"] = $interval -> format('%y years %m months and %d days');				
		}
		$data["old"] = $dataOld;
		$data["site"] = $dataHiredCandidate;
		return $data;
	}

	function getEmployementHistoryById($mysqli, $dbHelper, $id) {
		$dataOld = array();
		$datetime2='';
		$dataOld = $dbHelper -> getData($mysqli, "sp_getOldEmpHistory", array($id));
		for ($i = 0; $i < count($dataOld); $i++) {
			$datetime1 = new DateTime($dataOld[$i]["start_date"]);
			if($dataOld[$i]["start_date"] == $dataOld[$i]["end_date"]){
				$datetime2 = new DateTime($dataOld[$i]["end_date"].'+1 day');
			}else{
				$datetime2 = new DateTime($dataOld[$i]["end_date"]);
			}
			$interval = $datetime1 -> diff($datetime2);
			$dataOld[$i]["exp"] = $interval -> format('%y years %m months and %d days');
		}
		$data = $dataOld;
		return $data;

	}
	function clean($data) {
		$data = stripslashes($data);
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}

}
?>