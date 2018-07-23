<?php
class SkillchampsCredit {

	function SkillchampsCredit() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}
    
    
    function getSkillchampsCredit($dbHelper, $mysqli,$id,$uid) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getSkillchampsCredit', array($id,$uid));
		return $data;
	}
    
    function getSkillchampsCreditBalanceByUid($dbHelper, $mysqli,$uid) {
        $data = array();
        $data = $dbHelper -> getData($mysqli, 'sp_getSkillchampsCreditBalanceByUid', array($uid));
        return $data;
    }
    
    function insertSkillchampsCredit($dbHelper, $mysqli, $uid, $point,$type,$creditType,$debitType) {
        return $dbHelper -> performOperation($mysqli, 'sp_insertSkillchampsCredit', array($uid, $point,$type,$creditType,$debitType));
    }
    
    function updateSkillchampsCredit($dbHelper, $mysqli,$id, $point,$type,$creditType,$debitType) {
        return $dbHelper -> performOperation($mysqli, 'sp_updateSkillchampsCredit', array($id, $point,$type,$creditType,$debitType));
    }
    
    function deleteSkillchampsCredit($dbHelper, $mysqli, $id) {
        return $dbHelper -> performOperation($mysqli, 'sp_deleteSkillchampsCredit', array($id));
    }
    
    
    function insertSkillchampsCreditAdmin($dbHelper, $mysqli) {
        $uid = $_REQUEST["uid"];			
        $point = $_REQUEST["point"];
        $type= $_REQUEST["type"];
        $debitType = $_REQUEST["debit_type"];
        $creditType = $_REQUEST["credit_type"];
        $this->insertSkillchampsCredit($dbHelper, $mysqli, $uid, $point, $type, $creditType, $debitType);
        header('Location: admin.php?action=skillchamps_credit&uid='.$uid);
    }
  
	
	function updateSkillchampsCreditAdmin($dbHelper, $mysqli) {
	    $id = $_REQUEST["id"];
		$uid = $_REQUEST["uid"];
	    $point = $_REQUEST["point"];
        $type= $_REQUEST["type"];
        $debitType = $_REQUEST["debit_type"];
        $creditType = $_REQUEST["credit_type"];
        $this->updateSkillchampsCredit($dbHelper, $mysqli, $id, $point, $type, $creditType, $debitType);
        header('Location: admin.php?action=skillchamps_credit&uid='.$uid);
	}
    
    function deleteSkillchampsCreditAdmin($dbHelper, $mysqli, $id,$uid) {
        $this->deleteSkillchampsCredit($dbHelper, $mysqli, $id);
        header('Location: admin.php?action=skillchamps_credit&uid='.$uid);
    }

    function clean($data) {
		$data = stripslashes($data);
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}
    
   

}
?>