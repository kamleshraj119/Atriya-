<?php
class ServiceCharge {

	function ServiceCharge() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}

	function getServiceCharge($dbHelper, $mysqli, $id) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getServiceCharge', array($id));
		return $data;
	}

	function insertServiceCharge($dbHelper, $mysqli) {
	    $empJobId = $this -> clean($_REQUEST["emp_job_id"]);
		$amountPerHire = $this -> clean($_REQUEST["amount_per_hire"]);
		$percentageOnHire = $this -> clean($_REQUEST["percentage_on_hire"]);
		$ruleApp = $this -> clean($_REQUEST["rule_applied"]);
		$applied = $this -> clean($_REQUEST["applied"]);
		$dbHelper -> performOperation($mysqli, 'sp_insertServiceCharge', array($amountPerHire, $percentageOnHire, $ruleApp, $applied,$empJobId));
		header('Location: admin.php?action=master_service_charge');
	}

	function toggleServiceCharge($dbHelper, $mysqli) {
	    $id=$_REQUEST["id"];
        $applied = $this -> clean($_REQUEST["applied"]);
        $dbHelper -> performOperation($mysqli, 'sp_toggleServiceCharge', array($id,$applied));
        header('Location: admin.php?action=master_service_charge');
	}
    
    function updateServiceCharge($dbHelper, $mysqli) {
        $id=$_REQUEST["id"];
        $empJobId = $this -> clean($_REQUEST["emp_job_id"]);
        $amountPerHire = $this -> clean($_REQUEST["amount_per_hire"]);
        $percentageOnHire = $this -> clean($_REQUEST["percentage_on_hire"]);
        $ruleApp = $this -> clean($_REQUEST["rule_applied"]);
        $applied = $this -> clean($_REQUEST["applied"]);
        $dbHelper -> performOperation($mysqli, 'sp_updateServiceCharge', array($id,$amountPerHire, $percentageOnHire, $ruleApp, $applied,$empJobId));
        header('Location: admin.php?action=master_service_charge');
    }


	function deleteServiceCharge($dbHelper, $mysqli, $id) {
		$dbHelper -> performOperation($mysqli, 'sp_deleteServiceCharge', array($id));
		header('Location: admin.php?action=master_service_charge');
	}
	
	
	function clean($data) {
		$data = stripslashes($data);
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}
    
    function calulateServiceCharge($dbHelper, $mysqli,$totalAmount,$totalNum,$empJobId=0){
        $data = array();
        $data = $dbHelper -> getData($mysqli, 'sp_getServiceChargeApplied', array($empJobId));
        $serviceChargeFromPerHire=$data[0]["amount_per_hire"]*$totalNum;
        $serviceChargeFromPercetnatge=$data[0]["percentage_on_hire"]*$totalAmount/100;
        if($serviceChargeFromPerHire==$serviceChargeFromPercetnatge)
            return $serviceChargeFromPerHire;
        else if($data[0]["rule_applied"]=="MinOfTwo")
           return $serviceChargeFromPerHire<$serviceChargeFromPercetnatge ? $serviceChargeFromPerHire:$serviceChargeFromPercetnatge;
        else return $serviceChargeFromPerHire>$serviceChargeFromPercetnatge ? $serviceChargeFromPerHire:$serviceChargeFromPercetnatge;
    }

}
?>