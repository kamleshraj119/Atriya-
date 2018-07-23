<?php
class EmployerJobs {

	function EmployerJobs() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}

	function getEmpJobsByEmp($dbHelper, $mysqli, $eid) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getEmpJobsByEid', array($eid));
		return $data;
	}
    
    function getEmpJobWithLocationBTOB($dbHelper, $mysqli) {
        $data = array();
        $data = $dbHelper -> getData($mysqli, 'sp_getEmpJobWithLocationBTOB', array());
        return $data;
    }

	function getEmpJobsbyid($dbHelper, $mysqli, $id) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getEmpJobsbyId', array($id));
		return $data;
	}

	

	function insertEmpJobs($dbHelper, $mysqli) {

		$eid = $this -> clean($_REQUEST["eid"]);
		$title = $this -> clean($_REQUEST["title"]);
		$des = $this -> clean($_REQUEST["des"]);
		$from_date = $this -> clean($_REQUEST["from_date"]);
		$to_date = $this -> clean($_REQUEST["to_date"]);
		$job_type_id = $this -> clean($_REQUEST["job_type_id"]);
		$from_time = $this -> clean($_REQUEST["from_time"]);
		$to_time = $this -> clean($_REQUEST["to_time"]);
		$period = $this -> clean($_REQUEST["period"]);
		$empJobLocId= $this -> clean($_REQUEST["ejlcid"]);
		$sal = $this -> clean($_REQUEST["sal"]);
		$job_sector = $this -> clean($_REQUEST["sector"]);
		$job_role = $this -> clean($_REQUEST["course"]);
		$skill = implode(",", $_REQUEST["skill"]);
        $vr =isset($_REQUEST["vr"])?implode(",", $_REQUEST["vr"]):"";
        $data=array();
        $data=$dbHelper->getData($mysqli, 'sp_getEmpJobLocation', array('',$empJobLocId));
        $state=$data[0]["state"];
        $district=$data[0]["city"]; 
        $area=$data[0]["area"]; 
        $locality=$data[0]["locality"];
		$dbHelper -> performOperation($mysqli, 'sp_insertEmpJobs', array($eid, $title, $des, $from_date, $to_date, $job_type_id, $from_time, $to_time, $state, $district, $area, $locality, $sal, $job_sector, $job_role, $skill,$empJobLocId,$vr));

		header('Location: admin.php?action=empjob&id=' . $eid);
	}

	function insertEmployerJobsForFront($dbHelper, $mysqli) {

		$eid = $this -> clean($_REQUEST["eid"]);
		$title = $this -> clean($_REQUEST["title"]);
		$des = $this -> clean($_REQUEST["des"]);
		$from_date = $this -> clean($_REQUEST["from_date"]);
		$to_date = $this -> clean($_REQUEST["to_date"]);
		$job_type_id = $this -> clean($_REQUEST["job_type_id"]);
		$from_time = $this -> clean($_REQUEST["from_time"]);
		$to_time = $this -> clean($_REQUEST["to_time"]);
		$period = $this -> clean($_REQUEST["period"]);
        $empJobLocId= $this -> clean($_REQUEST["ejlcid"]);
		$sal = $this -> clean($_REQUEST["sal"]);
		$job_sector = $this -> clean($_REQUEST["sector"]);
		$job_role = $this -> clean($_REQUEST["course"]);
		$skill = implode(",", $_REQUEST["skill"]);
        $vr =isset($_REQUEST["vr"])?implode(",", $_REQUEST["vr"]):"";
        $data=array();
        $data=$dbHelper->getData($mysqli, 'sp_getEmpJobLocation', array('',$empJobLocId));
        $state=$data[0]["state"];
        $district=$data[0]["city"]; 
        $area=$data[0]["area"]; 
        $locality=$data[0]["locality"];
		$dbHelper -> performOperation($mysqli, 'sp_insertEmpJobs', array($eid, $title, $des, $from_date, $to_date, $job_type_id, $from_time, $to_time, $state, $district, $area, $locality, $sal, $job_sector, $job_role, $skill,$empJobLocId,$vr));

		header('Location: ?action=employer_jobs');
	}

	function updateEmpJobsById($dbHelper, $mysqli) {

		$id = $this -> clean($_REQUEST["id"]);
		$eid = $this -> clean($_REQUEST["eid"]);
		$title = $this -> clean($_REQUEST["title"]);
		$des = $this -> clean($_REQUEST["des"]);
		$from_date = $this -> clean($_REQUEST["from_date"]);
		$to_date = $this -> clean($_REQUEST["to_date"]);
		$job_type_id = $this -> clean($_REQUEST["job_type_id"]);
		$from_time = $this -> clean($_REQUEST["from_time"]);
		$to_time = $this -> clean($_REQUEST["to_time"]);
		$period = $this -> clean($_REQUEST["period"]);
		$empJobLocId= $this -> clean($_REQUEST["ejlcid"]);
		$sal = $this -> clean($_REQUEST["sal"]);
		$job_sector = $this -> clean($_REQUEST["sector"]);
		$job_role = $this -> clean($_REQUEST["course"]);
		$skill = implode(",", $_REQUEST["skill"]);
        $vr =isset($_REQUEST["vr"])?implode(",", $_REQUEST["vr"]):"";
        $data=array();
        $data=$dbHelper->getData($mysqli, 'sp_getEmpJobLocation', array('',$empJobLocId));
        $state=$data[0]["state"];
        $district=$data[0]["city"]; 
        $area=$data[0]["area"]; 
        $locality=$data[0]["locality"];
		$dbHelper -> performOperation($mysqli, 'sp_updateEmpJobs', array($id, $eid, $title, $des, $from_date, $to_date, $job_type_id, $from_time, $to_time, $state, $district, $area, $locality, $sal, $job_sector, $job_role, $skill,$empJobLocId,$vr));

		header('Location: admin.php?action=empjob&id=' . $eid);
	}


function updateEmployerJobsByIdForFront($dbHelper, $mysqli) {
		$id = $_REQUEST["t3id"];
		$eid = $this -> clean($_REQUEST["eid"]);
		$title = $this -> clean($_REQUEST["title"]);
		$des = $this -> clean($_REQUEST["des"]);
		$from_date = $this -> clean($_REQUEST["from_date"]);
		$to_date = $this -> clean($_REQUEST["to_date"]);
		$job_type_id = $this -> clean($_REQUEST["job_type_id"]);
		$from_time = $this -> clean($_REQUEST["from_time"]);
		$to_time = $this -> clean($_REQUEST["to_time"]);
		$period = $this -> clean($_REQUEST["period"]);
		$empJobLocId= $this -> clean($_REQUEST["ejlcid"]);
		$sal = $this -> clean($_REQUEST["sal"]);
		$job_sector = $this -> clean($_REQUEST["sector"]);
		$job_role = $this -> clean($_REQUEST["course"]);
		$skill = implode(",", $_REQUEST["skill"]);
        $vr =isset($_REQUEST["vr"])?implode(",", $_REQUEST["vr"]):"";
        $data=array();
        $data=$dbHelper->getData($mysqli, 'sp_getEmpJobLocation', array('',$empJobLocId));
        $state=$data[0]["state"];
        $district=$data[0]["city"]; 
        $area=$data[0]["area"]; 
        $locality=$data[0]["locality"];
		
		$dbHelper -> performOperation($mysqli, 'sp_updateEmpJobs', array($id, $eid, $title, $des, $from_date, $to_date, $job_type_id, $from_time, $to_time, $state, $district, $area, $locality, $sal, $job_sector, $job_role, $skill,$empJobLocId,$vr));

		header('Location: ?action=employer_jobs');
	}

	function deleteEmp($dbHelper, $mysqli, $id, $eid) {
		
		$dbHelper -> performOperation($mysqli, 'sp_deleteEmpJobs', array($id));
		header('Location: admin.php?action=empjob&id='.$eid);
	}
	
	function deleteEmployerForFront($dbHelper, $mysqli, $id) {
		$dbHelper -> performOperation($mysqli, 'sp_deleteEmpJobs', array($id));
		header('Location: ?action=employer_jobs');
	}

	function clean($data) {
		$data = stripslashes($data);
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}

}
?>