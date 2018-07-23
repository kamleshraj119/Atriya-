<?php
class CandidateDoc {

	function CandidateDoc() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}

	function getCandidateDoc($dbHelper, $mysqli, $cid, $id) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getCandidateDoc', array($id,$cid));
		return $data;
	}
    
    function insertCandidateDocAdmin($dbHelper, $mysqli) {
        $cid = $_REQUEST["cid"];
        $type=$this -> clean($_REQUEST["type"]);
        $filename = $_FILES['filename']['tmp_name'];
        if (!is_dir("../docs/" . $cid)) {
            mkdir("../docs/" . $cid, 0777);
        }
        $target_path = "../docs/" . $cid . "/";
        $result="";
        $target_path = $target_path . $filename;
        if (!move_uploaded_file($_FILES['filename']['tmp_name'], $target_path)) {
            $result=$dbHelper -> performOperation($mysqli, 'sp_insertCandidateDoc', array($cid, $type, $filename));
        }
        header('Location: admin.php?action=candidate_doc&id='.$cid);
    }
  
	
	function insertCandidateDocForFront($dbHelper, $mysqli) {
	    $cid = $_REQUEST["cid"];
        $type=$this -> clean($_REQUEST["type"]);
        $filename = $_FILES['filename']['name'];
        if (!is_dir("../docs/" . $cid)) {
            mkdir("../docs/" . $cid, 0777);
        }
        $target_path = "../docs/" . $cid . "/";
        $result="";
        $target_path = $target_path . $filename;
        if (move_uploaded_file($_FILES['filename']['tmp_name'], $target_path)) {
            $result=$dbHelper -> performOperation($mysqli, 'sp_insertCandidateDoc', array($cid, $type, $filename));
        }
        header('Location: candidate.php?action=candidate_doc');
	}

	
    function updateCandidateDocForFront($dbHelper, $mysqli) {
        $cid = $_REQUEST["cid"];
        $type=$this -> clean($_REQUEST["type"]);
        $filename = $_FILES['filename']['tmp_name'];
        if (!is_dir("../docs/" . $cid)) {
            mkdir("../docs/" . $cid, 0777);
        }
        $target_path = "../docs/" . $cid . "/";
        $result="";
        $target_path = $target_path . $filename;
        if (!move_uploaded_file($_FILES['filename']['tmp_name'], $target_path)) {
            $result=$dbHelper -> performOperation($mysqli, 'sp_updateCandidateDoc', array($cid, $type, $filename));
        }
		header('Location: candidate.php?action=candidate_doc');
	}
    
    function updateCandidateDocAdmin($dbHelper, $mysqli) {
        $cid = $_REQUEST["cid"];
        $type=$this -> clean($_REQUEST["type"]);
        $filename = $_FILES['filename']['tmp_name'];
        if (!is_dir("../docs/" . $cid)) {
            mkdir("../docs/" . $cid, 0777);
        }
        $target_path = "../docs/" . $cid . "/";
        $result="";
        $target_path = $target_path . $filename;
        if (!move_uploaded_file($_FILES['filename']['tmp_name'], $target_path)) {
            $result=$dbHelper -> performOperation($mysqli, 'sp_updateCandidateDoc', array($cid, $type, $filename));
        }
        header('Location: admin.php?action=candidate_doc&id='.$cid);
    }
    
    function deleteDoc($dbHelper, $mysqli, $id, $cid) {
        $dbHelper -> performOperation($mysqli, 'sp_deleteCandidateDoc', array($id));
        header('Location: admin.php?action=candidate_doc&id='.$cid);
    }
    
    function upadteCandidateDocSkillMitraFront($dbHelper, $mysqli) {
        $comment = $this -> clean($_REQUEST["doc_comment"]);
        $id=$this -> clean($_REQUEST["doc_id"]);
        $status=$this -> clean($_REQUEST["doc_status"]);
        $this->upadteCandidateDocSkillMitra($dbHelper, $mysqli, $id, $status, $comment);
        header('Location: skill-mitra.php?action=documents&status='.$status);
    }
    
    function upadteCandidateDocGuruFront($dbHelper, $mysqli) {
        $comment=$this -> clean($_REQUEST["doc_comment"]);
        $id=$this -> clean($_REQUEST["doc_id"]);
        $status=$this -> clean($_REQUEST["doc_status"]);
        $this->upadteCandidateDocGuru($dbHelper, $mysqli, $id, $status, $comment);
        header('Location: guru.php?action=documents&status='.$status);
    }

	function upadteCandidateDocSkillMitra($dbHelper, $mysqli, $id, $status, $comment) {
		return $dbHelper -> performOperation($mysqli, 'sp_upadteCandidateDocSkillMitra', array( $id, $status, $comment));		
	}
    
    function upadteCandidateDocGuru($dbHelper, $mysqli, $id, $status, $comment) {
       return $dbHelper -> performOperation($mysqli, 'sp_upadteCandidateDocGuru', array($id, $status, $comment));
    }

    function getDocumentSkillmitra($dbHelper, $mysqli, $skid, $status){
        $data = array();
        $data = $dbHelper -> getData($mysqli, 'sp_getDocumentSkillmitra', array($skid,$status));
        return $data;
    }
    
    function getDocumentGuru($dbHelper, $mysqli, $gid, $status){
        $data = array();
        $data = $dbHelper -> getData($mysqli, 'sp_getDocumentGuru', array($gid,$status));
        return $data;
    }
	
	function deleteDocForFront($dbHelper, $mysqli, $id) {
		$dbHelper -> performOperation($mysqli, 'sp_deleteCandidateDoc', array($id));
		header('Location: candidate.php?action=candidate_doc');
	}
    
    function getPendingDocCountBySkillmitra($dbHelper,$mysqli,$skid){
        $data=array();
        $data=$dbHelper->getDataFromQuery($mysqli, "select count(*) as num from candidate_doc left outer join member_details on candidate_doc.cid=member_details.uid 
        where candidate_doc.sk_approve_status='Pending' AND member_details.skc='".$skid."'");
        return $data[0]["num"];
    }
    
     function getPendingDocCountByGuru($dbHelper,$mysqli,$gid){
        $data=array();
        $data=$dbHelper->getDataFromQuery($mysqli, "select count(*) as num from candidate_doc where candidate_doc.guru_approve_status='Pending' AND candidate_doc.gid='".$gid."'");
        return $data[0]["num"];
    }

	function clean($data) {
		$data = stripslashes($data);
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}
    
   

}
?>