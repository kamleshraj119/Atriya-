<?php

class UserEducation {

	function UserEducation() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}

	function getUserEducationByUser($dbHelper, $mysqli, $uid) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getUserEducationByUid', array($uid));
		return $data;
	}
    
    function getUserEducationById($dbHelper, $mysqli, $id) {
        $data = array();
        $data = $dbHelper -> getData($mysqli, 'sp_getUserEducationById', array($id));
        return $data;
    }

	function insertUserEducationAdmin($dbHelper, $mysqli) {
	    $uid = $this -> clean($_REQUEST["uid"]);
        $course= $this -> clean($_REQUEST["course"]);
        $school= $this -> clean($_REQUEST["school"]);
        $board = $this -> clean($_REQUEST["board"]);
        $year = $this -> clean($_REQUEST["year"]);
        $grade = $this -> clean($_REQUEST["grade"]);
        $docid= $this -> clean($_REQUEST["docid"]);
		$this->insertUserEducation($dbHelper, $mysqli, $uid, $school, $board, $year, $grade, $docid,$course);
		header('Location: admin.php?action=can_education&cid='.$uid);
	}
    
    function insertUserEducationFront($dbHelper, $mysqli) {
        $uid = $this -> clean($_REQUEST["uid"]);
        $school= $this -> clean($_REQUEST["school"]);
        $course= $this -> clean($_REQUEST["course"]);
        $board = $this -> clean($_REQUEST["board"]);
        $year = $this -> clean($_REQUEST["year"]);
        $grade = $this -> clean($_REQUEST["grade"]);
        $docid= $this -> clean($_REQUEST["docid"]);
        $this->insertUserEducation($dbHelper, $mysqli, $uid, $school, $board, $year, $grade, $docid,$course);
        header('Location: candidate.php?action=can_education');
    }
    
    function insertUserEducation($dbHelper, $mysqli,$uid,$school,$board,$year,$grade,$docid,$course) {
        return $result=$dbHelper -> performOperation($mysqli, 'sp_insertUserEducation', array($uid,$school,$board,$year,$grade,$docid,$course));      
    }
    
    function updateUserEducation($dbHelper, $mysqli,$id,$uid,$school,$board,$year,$grade,$docid,$course) {
        return $result=$dbHelper -> performOperation($mysqli, 'sp_updateUserEducation', array($id,$uid,$school,$board,$year,$grade,$docid,$course));      
    }

	function updateUserEducationAdmin($dbHelper, $mysqli) {
		$id = $this -> clean($_REQUEST["id"]);
        $uid = $this -> clean($_REQUEST["uid"]);
        $course= $this -> clean($_REQUEST["course"]);
        $school= $this -> clean($_REQUEST["school"]);
        $board = $this -> clean($_REQUEST["board"]);
        $year = $this -> clean($_REQUEST["year"]);
        $grade = $this -> clean($_REQUEST["grade"]);
        $docid= $this -> clean($_REQUEST["docid"]);
        $this->updateUserEducation($dbHelper, $mysqli, $id, $uid, $school, $board, $year, $grade, $docid,$course);
		header('Location: admin.php?action=can_education&cid='.$uid);
	}
    
    function updateUserEducationFront($dbHelper, $mysqli) {
        $id = $this -> clean($_REQUEST["id"]);
        $uid = $this -> clean($_REQUEST["uid"]);
        $course= $this -> clean($_REQUEST["course"]);
        $school= $this -> clean($_REQUEST["school"]);
        $board = $this -> clean($_REQUEST["board"]);
        $year = $this -> clean($_REQUEST["year"]);
        $grade = $this -> clean($_REQUEST["grade"]);
        $docid= $this -> clean($_REQUEST["docid"]);
        $this->updateUserEducation($dbHelper, $mysqli, $id, $uid, $school, $board, $year, $grade, $docid,$course);
        header('Location: candidate.php?action=can_education');
    }

	function deleteUserEducation($dbHelper, $mysqli, $id) {
		return $dbHelper -> performOperation($mysqli, 'sp_deleteUserEducation', array($id));
	}
    
    function deleteUserEducationAdmin($dbHelper, $mysqli, $cid,$id) {
        $dbHelper -> performOperation($mysqli, 'sp_deleteUserEducation', array($id));
        header('Location: admin.php?action=can_education&cid='.$cid);
    }
    
    function deleteUserEducationFront($dbHelper, $mysqli, $id) {
        $dbHelper -> performOperation($mysqli, 'sp_deleteUserEducation', array($id));
        header('Location: candidate.php?action=can_education');
    }

	function clean($data) {
		$data = stripslashes($data);
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}

}
?>