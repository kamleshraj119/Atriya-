<?php
class CandidateSkill {

	function CandidateSkill() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}

	function getCandidateSkill($dbHelper, $mysqli, $cid, $id) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getCandidateSkill', array($id,$cid));
		return $data;
	}
    
    function insertCandidateSkillAdmin($dbHelper, $mysqli) {
        $cid = $_REQUEST["cid"];
        $this->insertCandidateSkill($dbHelper, $mysqli);       
        header('Location: admin.php?action=candidate_skill&id='.$cid);
    }
  
		

	function insertCandidateSkill($dbHelper, $mysqli) {
		$cid = $_REQUEST["cid"];
        $sector=$this -> clean($_REQUEST["sector"]);
        $jobRole=$this -> clean($_REQUEST["course"]);
        $skill=implode(",", $_REQUEST["skill"]);
        $result="";
        $result=$dbHelper -> performOperation($mysqli, 'sp_insertCandidateSkill', array($cid, $sector, $jobRole, $skill));
      	return $result;
	}

	function insertCandidateSkillForFront($dbHelper, $mysqli) {
	    $this->insertCandidateSkill($dbHelper, $mysqli);		
		header('Location: candidate.php?action=candidate_skill');
	}

	function updateCandidateSkill($dbHelper, $mysqli) {

		$id = $this -> clean($_REQUEST["t3id"]);
		$sector=$this -> clean($_REQUEST["sector"]);
        $jobRole=$this -> clean($_REQUEST["course"]);
        $skill=implode(",", $_REQUEST["skill"]);
        $result="";
        $result=$dbHelper -> performOperation($mysqli, 'sp_updateCandidateSkill', array($id,$sector, $jobRole, $skill));
        return $result;
	}


    function updateCandidateSkillForFront($dbHelper, $mysqli) {
        $this->updateCandidateSkill($dbHelper, $mysqli);
		header('Location: candidate.php?action=candidate_skill');
	}
    
    function updateCandidateSkillAdmin($dbHelper, $mysqli) {
        $cid = $_REQUEST["cid"];
        $this->updateCandidateSkill($dbHelper, $mysqli);
        header('Location: admin.php?action=candidate_skill&id='.$cid);
    }

	function deleteCandidateSkill($dbHelper, $mysqli, $id, $cid) {
		$dbHelper -> performOperation($mysqli, 'sp_deleteCandidateSkill', array($id));
		header('Location: admin.php?action=candidate_skill&id='.$cid);
	}
	
	function deleteCandidateSkillForFront($dbHelper, $mysqli, $id) {
		$dbHelper -> performOperation($mysqli, 'sp_deleteCandidateSkill', array($id));
		header('Location: candidate.php?action=candidate_skill');
	}

	function clean($data) {
		$data = stripslashes($data);
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}
    
}
?>