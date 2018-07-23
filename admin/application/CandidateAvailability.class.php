<?php

class CandidateAvailability {

	function CandidateAvailability() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}

	function getAvailability($dbHelper, $mysqli, $cid) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getAvailability', array($cid));
		return $data;
	}

	/*function getfieldsbypincode($dbHelper, $mysqli, $cid) {
	 $data = array();
	 $data = $dbHelper -> getData($mysqli, 'sp_getfieldsbypincode', array($cid));
	 return $data;
	 }
	 * */

	function insertCandidateAvailability($dbHelper, $mysqli) {

		$cid = $_REQUEST["cid"];
		$from_date = $_REQUEST["from_date"];
		$to_date = $_REQUEST["to_date"];
		$job_type_id = $_REQUEST["job_type_id"];
		$from_time = $_REQUEST["from_time"];
		$to_time = $_REQUEST["to_time"];
		$period = $this -> clean($_REQUEST["period"]);
		$exp_sal = $this -> clean($_REQUEST["exp_sal"]);
        $locId=$_REQUEST["loc_id"];
        $skillId=$_REQUEST["skill_id"];
        
        $dataLoc = array();
        $dataLoc = $dbHelper -> getData($mysqli, 'sp_getCandidateLoc', array($locId,""));
		$state = $dataLoc[0]["state"];
        $district = $dataLoc[0]["district"];
        $area = $dataLoc[0]["area"];
        $locality = $dataLoc[0]["locality"];
        
        $dataSkill = array();
        $dataSkill = $dbHelper -> getData($mysqli, 'sp_getCandidateSkill', array($skillId,""));
		$job_sector = $dataSkill[0]["sector"];
		$job_role = $dataSkill[0]["job_role"];
		$skill = $dataSkill[0]["skill"];
        
		$dbHelper -> performOperation($mysqli, 'sp_insertCandidateAvailability', array($cid, $from_date, $to_date, $job_type_id, $from_time, $to_time, $state, $district, $area, $locality, $exp_sal, $job_sector, $job_role, $skill));

		header('Location: admin.php?action=get_candidate_availability&uid=' . $cid);
	}

	function insertCandidateAvailabilityForFront($dbHelper, $mysqli) {

		$cid = $_REQUEST["cid"];
		$from_date = $_REQUEST["from_date"];
		$to_date = $_REQUEST["to_date"];
		$job_type_id = $_REQUEST["job_type_id"];
		$from_time = $_REQUEST["from_time"];
		$to_time = $_REQUEST["to_time"];
		$period = $this -> clean($_REQUEST["period"]);
		$exp_sal = $this -> clean($_REQUEST["exp_sal"]);
		$locId=$_REQUEST["loc_id"];
        $skillId=$_REQUEST["skill_id"];
        
        $locId=$_REQUEST["loc_id"];
        $skillId=$_REQUEST["skill_id"];
        
        $dataLoc = array();
        $dataLoc = $dbHelper -> getData($mysqli, 'sp_getCandidateLoc', array($locId,""));
        $state = $dataLoc[0]["state"];
        $district = $dataLoc[0]["district"];
        $area = $dataLoc[0]["area"];
        $locality = $dataLoc[0]["locality"];
        
        $dataSkill = array();
        $dataSkill = $dbHelper -> getData($mysqli, 'sp_getCandidateSkill', array($skillId,""));
        $job_sector = $dataSkill[0]["sector"];
        $job_role = $dataSkill[0]["job_role"];
        $skill = $dataSkill[0]["skill"];
		$dbHelper -> performOperation($mysqli, 'sp_insertCandidateAvailability', array($cid, $from_date, $to_date, $job_type_id, $from_time, $to_time, $state, $district, $area, $locality, $exp_sal, $job_sector, $job_role, $skill));

		header('Location:candidate.php?action=availability');
	}

	function getAvailabilitybyid($dbHelper, $mysqli, $id) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getAvailabilityById', array($id));
		return $data;
	}

	function updateCandidateAvailability($dbHelper, $mysqli) {
		$id = $_REQUEST["id"];
		$cid = $_REQUEST["cid"];
		$from_date = $_REQUEST["from_date"];
		$to_date = $_REQUEST["to_date"];
		$job_type_id = $_REQUEST["job_type_id"];
		$from_time = $_REQUEST["from_time"];
		$to_time = $_REQUEST["to_time"];
		$period = $this -> clean($_REQUEST["period"]);
        $locId=$_REQUEST["loc_id"];
        $skillId=$_REQUEST["skill_id"];
        $exp_sal = $this -> clean($_REQUEST["exp_sal"]);
		
		$dataLoc = array();
        $dataLoc = $dbHelper -> getData($mysqli, 'sp_getCandidateLoc', array($locId,""));
        $state = $dataLoc[0]["state"];
        $district = $dataLoc[0]["district"];
        $area = $dataLoc[0]["area"];
        $locality = $dataLoc[0]["locality"];
        
        $dataSkill = array();
        $dataSkill = $dbHelper -> getData($mysqli, 'sp_getCandidateSkill', array($skillId,""));
        $job_sector = $dataSkill[0]["sector"];
        $job_role = $dataSkill[0]["job_role"];
        $skill = $dataSkill[0]["skill"];
		$dbHelper -> performOperation($mysqli, 'sp_updateAvailabilityById', array($id, $cid, $from_date, $to_date, $job_type_id, $from_time, $to_time, $state, $district, $area, $locality, $exp_sal, $job_sector, $job_role, $skill));

		header('Location: admin.php?action=get_candidate_availability&uid=' . $cid);
	}

	function updateCandidateAvailabilityForFront($dbHelper, $mysqli) {
		$id = $_REQUEST["id"];
		$cid = $_REQUEST["cid"];
		$from_date = $_REQUEST["from_date"];
        $to_date = $_REQUEST["to_date"];
        $job_type_id = $_REQUEST["job_type_id"];
        $from_time = $_REQUEST["from_time"];
        $to_time = $_REQUEST["to_time"];
        $period = $this -> clean($_REQUEST["period"]);
        $locId=$_REQUEST["loc_id"];
        $skillId=$_REQUEST["skill_id"];
        $exp_sal = $this -> clean($_REQUEST["exp_sal"]);
        
        $dataLoc = array();
        $dataLoc = $dbHelper -> getData($mysqli, 'sp_getCandidateLoc', array($locId,""));
        $state = $dataLoc[0]["state"];
        $district = $dataLoc[0]["district"];
        $area = $dataLoc[0]["area"];
        $locality = $dataLoc[0]["locality"];
        
        $dataSkill = array();
        $dataSkill = $dbHelper -> getData($mysqli, 'sp_getCandidateSkill', array($skillId,""));
        $job_sector = $dataSkill[0]["sector"];
        $job_role = $dataSkill[0]["job_role"];
        $skill = $dataSkill[0]["skill"];
		$dbHelper -> performOperation($mysqli, 'sp_updateAvailabilityById', array($id, $cid, $from_date, $to_date, $job_type_id, $from_time, $to_time, $state, $district, $area, $locality, $exp_sal, $job_sector, $job_role, $skill));

		header('Location: candidate.php?action=availability');
	}

	function deleteCandidateAvailability($dbHelper, $mysqli, $id, $cid) {
		$dbHelper -> performOperation($mysqli, 'sp_deleteCandidateAvailability ', array($id));
		header('Location: admin.php?action=get_candidate_availability&uid=' . $cid);

	}

	function deleteCandidateAvailabilityForFront($dbHelper, $mysqli, $id) {
		$dbHelper -> performOperation($mysqli, 'sp_deleteCandidateAvailability ', array($id));
		header('Location: candidate.php?action=availability');

	}

	function getAvailabilityByCandidiate($dbHelper, $mysqli, $cid) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getAvailabilityByCandidiate', array($cid));
		return $data;
	}

	function clean($data) {
		$data = stripslashes($data);
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}

}
?>