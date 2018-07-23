<?php
class SubscriptionFeature {

	function SubscriptionFeature() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}
    
    
    function getUserSubsciption($dbHelper, $mysqli, $uid) {
        $data = array();
        $data = $dbHelper -> getData($mysqli, 'sp_getUserSubsciption', array($uid));
        return $data;
    }
    
   
	function getFeature($dbHelper, $mysqli, $id) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getFeatures', array($id));
		return $data;
	}


	function insertFeature($dbHelper, $mysqli, $name, $userRole,$api,$action) {
		return $dbHelper -> performOperation($mysqli, 'sp_insertFeature', array($name, $userRole,$api,$action));
	}

	/* add by kamlesh */
	function insertFeatureAdmin($dbHelper, $mysqli) {
		$name = $this->clean($_REQUEST['name']);
		$userRole = $this->clean($_REQUEST['user_role']);
		$api = $this->clean($_REQUEST['api']);
        $action = $this->clean($_REQUEST['feature_action']);
		$this -> insertFeature($dbHelper, $mysqli, $name, $userRole,$api,$action);
		header("location:admin.php?action=features");
	}

	function updateFeatureAdmin($dbHelper, $mysqli) {
		$id = $_REQUEST['id'];
		$name = $this->clean($_REQUEST['name']);
		$userRole = $this->clean($_REQUEST['user_role']);
		$api = $this->clean($_REQUEST['api']);
        $action = $this->clean($_REQUEST['feature_action']);
		$this -> updateFeature($dbHelper, $mysqli, $id, $name, $userRole,$api,$action);
		header("location:admin.php?action=features");
	}

	/*   end added */
	function updateFeature($dbHelper, $mysqli, $id, $name, $userRole,$api,$action) {
		return $dbHelper -> performOperation($mysqli, 'sp_updateFeature', array($id, $name, $userRole,$api,$action));
	}

	function deleteFeature($dbHelper, $mysqli, $id) {
		$dbHelper -> performOperation($mysqli, 'sp_deleteFeature', array($id));
		header("location:admin.php?action=features");
	}

	function getSubscriptionFeature($dbHelper, $mysqli, $id,$sd_id) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getSubscriptionFeatures', array($id,$sd_id));
		return $data;
	}

	function insertSubscriptionFeature($dbHelper, $mysqli,  $fid, $sfStatus, $recordStatus, $numRecords,$subUnit,$sdId) {
		return $dbHelper -> performOperation($mysqli, 'sp_insertSubscriptionFeature', array($fid, $sfStatus, $recordStatus, $numRecords,$subUnit,$sdId));
	}

	function updateSubscriptionFeature($dbHelper, $mysqli, $fid, $sfStatus, $recordStatus, $numRecords,$subUnit,$sfId,$sdId) {
		return $dbHelper -> performOperation($mysqli, 'sp_updateSubscriptionFeature', array($fid, $sfStatus, $recordStatus, $numRecords,$subUnit,$sfId,$sdId));
	}

	function deleteSubscriptionFeature($dbHelper, $mysqli, $id,$sd_id) {
		 $dbHelper -> performOperation($mysqli, 'sp_deleteSubscriptionFeaturs', array($id));
		 header("location:admin.php?action=subscription_features&id=$sd_id");
	}


	function clean($data) {
		$data = stripslashes($data);
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}

	/*  added by kamlesh   */
	function updateSubscriptionFeatureAdmin($dbHelper, $mysqli) {
		$sfId=$_REQUEST['sf_id'];
		$sdId=$_REQUEST['sd_id'];
		$fid = $_REQUEST['f_id'];
		$sfStatus = $this->clean($_REQUEST['sf_status']);
		$recordStatus=$this->clean($_REQUEST['record_status']);
		$numRecords=$this->clean($_REQUEST['num_record']);
		$subUnit =$this->clean($_REQUEST['sub_unit']);
		$result = $this->updateSubscriptionFeature($dbHelper, $mysqli, $fid, $sfStatus, $recordStatus, $numRecords,$subUnit,$sfId,$sdId);
		header("location:admin.php?action=subscription_features&id=$sdId");
		
	}
	function insertSubscriptionFeatureAdmin($dbHelper, $mysqli) {
		$sdId=$_REQUEST['sd_id'];
		$fid = $_REQUEST['f_id'];
		$sfStatus = $this->clean($_REQUEST['sf_status']);
		$recordStatus=$this->clean($_REQUEST['record_status']);
		$numRecords=$this->clean($_REQUEST['num_record']);
		$subUnit =$this->clean($_REQUEST['sub_unit']);
		$this->insertSubscriptionFeature($dbHelper, $mysqli, $fid, $sfStatus, $recordStatus, $numRecords,$subUnit,$sdId);
		header("location:admin.php?action=subscription_features&id=$sdId");
	}

	/*   end added */
}
?>