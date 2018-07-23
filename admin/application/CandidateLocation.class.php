<?php
class CandidateLocation {

	function CandidateLocation() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}

	function getCandidateLocation($dbHelper, $mysqli, $cid, $id) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getCandidateLoc', array($id,$cid));
		return $data;
	}
    
    function insertCandidateLocationAdmin($dbHelper, $mysqli) {
        $cid = $_REQUEST["cid"];
        $this->insertCandidateLocation($dbHelper, $mysqli);       
        header('Location: admin.php?action=candidate_loc&id='.$cid);
    }
  
		

	function insertCandidateLocation($dbHelper, $mysqli) {
		$cid = $_REQUEST["cid"];
        $state=$this -> clean($_REQUEST["state"]);
        $district=$this -> clean($_REQUEST["district"]);
        $area=$this -> clean($_REQUEST["area"]);
        $locality=implode(",", $_REQUEST["locality"]);
        $result="";
        $result=$dbHelper -> performOperation($mysqli, 'sp_insertCandidateLoc', array($cid, $state, $district, $area, $locality));
        return $result;
	}

	function insertCandidateLocationForFront($dbHelper, $mysqli) {
	    $this->insertCandidateLocation($dbHelper, $mysqli);		
		header('Location: candidate.php?action=candidate_loc');
	}

	function updateCandidateLocation($dbHelper, $mysqli) {
		$id = $this -> clean($_REQUEST["t3id"]);
		$state=$this -> clean($_REQUEST["state"]);
        $district=$this -> clean($_REQUEST["district"]);
        $area=$this -> clean($_REQUEST["area"]);
        $locality=implode(",", $_REQUEST["locality"]);
        $result="";
        $result=$dbHelper -> performOperation($mysqli, 'sp_updateCandidateLoc', array($id, $state, $district, $area, $locality));
        return $result;
	}


    function updateCandidateLocationForFront($dbHelper, $mysqli) {
        $this->updateCandidateLocation($dbHelper, $mysqli);
		header('Location: candidate.php?action=candidate_loc');
	}
    
    function updateCandidateLocationAdmin($dbHelper, $mysqli) {
        $cid = $_REQUEST["cid"];
        $this->updateCandidateLocation($dbHelper, $mysqli);
        header('Location: admin.php?action=candidate_loc&id='.$cid);
    }

	function deleteCandidateLocation($dbHelper, $mysqli, $id, $cid) {
		$dbHelper -> performOperation($mysqli, 'sp_deleteCandidateLoc', array($id));
		header('Location: admin.php?action=candidate_loc&id='.$cid);
	}
	
	function deleteCandidateLocationForFront($dbHelper, $mysqli, $id) {
		$dbHelper -> performOperation($mysqli, 'sp_deleteCandidateLoc', array($id));
		header('Location: candidate.php?action=candidate_loc');
	}

	function clean($data) {
		$data = stripslashes($data);
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}
    
}
?>