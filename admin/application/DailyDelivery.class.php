<?php
class DailyDelivery {
	function DailyDelivery() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}
    
   
    function getTotalDailyDeliveryReport($dbHelper, $mysqli, $uid) {
        $data = array();
        $data = $dbHelper -> getData($mysqli, 'sp_getTotalDailyDeliveryReport', array($uid));
        return $data;
    }
    
	function getDailyDeliveryReport($dbHelper, $mysqli, $uid,$id) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getDailyDeliveryReport', array($uid,$id));
		return $data;
	}

	function insertDailyDeliveryReport($dbHelper, $mysqli,$uid,$shift,$totalPkt,$donePkt,$attemptPkt,$rejectPkt,$ratePkt,$openKm,$closeKm,$rateKm,$lid,$empJobId) {
		return $dbHelper -> performOperation($mysqli, 'sp_insertDailyDeliveryReport', array($uid,$shift,$totalPkt,$donePkt,$attemptPkt,$rejectPkt,$ratePkt,$openKm,$closeKm,$rateKm,$lid,$empJobId));
	}
	
    function insertDailyDeliveryReportWithDate($dbHelper, $mysqli,$uid,$shift,$totalPkt,$donePkt,$attemptPkt,$rejectPkt,$ratePkt,$openKm,$closeKm,$rateKm,$lid,$empJobId,$date) {
        return $dbHelper -> performOperation($mysqli, 'sp_insertDailyDeliveryReportWithDate', array($uid,$shift,$totalPkt,$donePkt,$attemptPkt,$rejectPkt,$ratePkt,$openKm,$closeKm,$rateKm,$lid,$empJobId,$date));
    }
    
    function insertDailyDeliveryReportAdmin($dbHelper, $mysqli) {
        $lid=$_REQUEST["lid"];
        $uid=$_REQUEST["uid"];
        $shift=$_REQUEST["shift"]; 
        $totalPkt=$_REQUEST["totalPkt"];
        $donePkt=$_REQUEST["donePkt"];
        $attemptPkt=$_REQUEST["attemptPkt"];
        $rejectPkt=$_REQUEST["rejectPkt"];
        $openKm=$_REQUEST["openKm"];
        $closeKm=$_REQUEST["closeKm"];
        $data=$this->getCurrentDeliveryRate($dbHelper, $mysqli,$lid);
        $ratePkt=$data[0]["rate_pkt"];
        $rateKm=$data[0]["rate_km"];
        $data=$dbHelper->getData($mysqli, "sp_getEmpJobByCid", array($uid));
        $empJobId=$data[0]["emp_job_id"];
        $this->insertDailyDeliveryReport($dbHelper, $mysqli, $uid, $shift, $totalPkt, $donePkt, $attemptPkt, $rejectPkt, $ratePkt, $openKm, $closeKm, $rateKm,$lid,$empJobId);
        header('Location: admin.php?action=daily_delivery&uid='.$uid);
    }
    
    function insertDailyDeliveryReportFront($dbHelper, $mysqli) {
        $lid=$_REQUEST["lid"];
        $uid=$_REQUEST["uid"];
        $shift=$_REQUEST["shift"]; 
        $totalPkt=$_REQUEST["totalPkt"];
        $donePkt=$_REQUEST["donePkt"];
        $attemptPkt=$_REQUEST["attemptPkt"];
        $rejectPkt=$_REQUEST["rejectPkt"];
        $openKm=$_REQUEST["openKm"];
        $closeKm=$_REQUEST["closeKm"];
        $data=$this->getCurrentDeliveryRate($dbHelper, $mysqli,$lid);
        $ratePkt=$data[0]["rate_pkt"];
        $rateKm=$data[0]["rate_km"];
        $data=$dbHelper->getData($mysqli, "sp_getEmpJobByCid", array($uid));
        $empJobId=$data[0]["emp_job_id"];
        $this->insertDailyDeliveryReport($dbHelper, $mysqli, $uid, $shift, $totalPkt, $donePkt, $attemptPkt, $rejectPkt, $ratePkt, $openKm, $closeKm, $rateKm,$lid,$empJobId);
        header('Location: candidate.php?action=daily_delivery');
    }

	function updateDailyDeliveryReport($dbHelper, $mysqli,$id,$totalPkt,$donePkt,$attemptPkt,$rejectPkt,$ratePkt,$openKm,$closeKm,$rateKm,$status,$lid,$incentive) {
	    return $dbHelper -> performOperation($mysqli, 'sp_updateDailyDeliveryReport', array($id,$totalPkt,$donePkt,$attemptPkt,$rejectPkt,$ratePkt,$openKm,$closeKm,$rateKm,$status,$lid,$incentive));
	}
    
    function updateDailyDeliveryReportAdmin($dbHelper, $mysqli) {
        $uid=$_REQUEST["uid"];
        $id=$_REQUEST["id"];
        $lid=$_REQUEST["lid"];
        $shift=$_REQUEST["shift"]; 
        $totalPkt=$_REQUEST["totalPkt"];
        $donePkt=$_REQUEST["donePkt"];
        $attemptPkt=$_REQUEST["attemptPkt"];
        $rejectPkt=$_REQUEST["rejectPkt"];
        $openKm=$_REQUEST["openKm"];
        $closeKm=$_REQUEST["closeKm"];
        $data=$this->getCurrentDeliveryRate($dbHelper, $mysqli,$lid);
        $ratePkt=$data[0]["rate_pkt"];
        $rateKm=$data[0]["rate_km"];
        $data1=$this->getDailyDeliveryReport($dbHelper, $mysqli, '', $id);
        $status=$data1[0]["status"];
        $incentive=$_REQUEST["incentive"];
        $this->updateDailyDeliveryReport($dbHelper, $mysqli, $id, $totalPkt, $donePkt, $attemptPkt, $rejectPkt, $ratePkt, $openKm, $closeKm, $rateKm, $status,$lid,$incentive);
        header('Location: admin.php?action=daily_delivery&uid='.$uid);
    }
    
    function updateDailyDeliveryReportFront($dbHelper, $mysqli) {
        $uid=$_REQUEST["uid"];
        $id=$_REQUEST["id"];
        $lid=$_REQUEST["lid"];
        $shift=$_REQUEST["shift"]; 
        $totalPkt=$_REQUEST["totalPkt"];
        $donePkt=$_REQUEST["donePkt"];
        $attemptPkt=$_REQUEST["attemptPkt"];
        $rejectPkt=$_REQUEST["rejectPkt"];
        $openKm=$_REQUEST["openKm"];
        $closeKm=$_REQUEST["closeKm"];
        $data=$this->getCurrentDeliveryRate($dbHelper, $mysqli,$lid);
        $ratePkt=$data[0]["rate_pkt"];
        $rateKm=$data[0]["rate_km"];
        $data1=$this->getDailyDeliveryReport($dbHelper, $mysqli, '', $id);
        $status=$data1[0]["status"];
        $incentive=-1;
        $this->updateDailyDeliveryReport($dbHelper, $mysqli, $id, $totalPkt, $donePkt, $attemptPkt, $rejectPkt, $ratePkt, $openKm, $closeKm, $rateKm, $status,$lid,$incentive);
        header('Location: candidate.php?action=daily_delivery');
    }
    
    function updateDailyDeliveryStatus($dbHelper, $mysqli, $id,$status) {
        return $dbHelper -> performOperation($mysqli, 'sp_updateDailyDeliveryStatus', array($id,$status));
    }
    
    function updateDailyDeliveryStatusAdmin($dbHelper, $mysqli, $id,$status,$uid) {
        $this->updateDailyDeliveryStatus($dbHelper, $mysqli, $id, $status);
        header('Location: admin.php?action=daily_delivery&uid='.$uid);
    }
    
    function deleteDailyReport($dbHelper, $mysqli, $id) {
		return $dbHelper -> performOperation($mysqli, 'sp_deleteDailyReport', array($id));
	}
    
    function deleteDailyReportAdmin($dbHelper, $mysqli, $id,$uid) {
        $this->deleteDailyReport($dbHelper, $mysqli, $id);
        header('Location: admin.php?action=daily_delivery&uid='.$uid);
    }
    
    function deleteDailyReportFront($dbHelper, $mysqli, $id) {
        $this->deleteDailyReport($dbHelper, $mysqli, $id);
        header('Location: candidate.php?action=daily_delivery');
    }
    
    
    function getCurrentDeliveryRate($dbHelper, $mysqli,$lid) {
        $data = array();
        $data = $dbHelper -> getData($mysqli, 'sp_getCurrentDeliveryRate', array($lid));
        return $data;
    }
    
    function getCurrentDeliveryRateByName($dbHelper, $mysqli,$name) {
        $data = array();
        $data = $dbHelper -> getData($mysqli, 'sp_getCurrentDeliveryRateByName', array($name));
        return $data;
    }
     
    function getDeliveryRate($dbHelper, $mysqli,$id) {
        $data = array();
        $data = $dbHelper -> getData($mysqli, 'sp_getDeliveryRate', array($id));
        return $data;
    }
    
    function getDeliveryRateEmp($dbHelper, $mysqli,$id,$eid) {
        $data = array();
        $data = $dbHelper -> getData($mysqli, 'sp_getDeliveryRateEmp', array($id,$eid));
        return $data;
    }

    function insertDeliveryRate($dbHelper, $mysqli,$ratePkt,$rateKm,$lid) {
        return $dbHelper -> performOperation($mysqli, 'sp_insertDeliveryRate', array($ratePkt,$rateKm,$lid));
    }
    
    function insertDeliveryRateEmp($dbHelper, $mysqli,$ratePkt,$rateKm,$lid,$eid) {
        return $dbHelper -> performOperation($mysqli, 'sp_insertDeliveryRateEmp', array($ratePkt,$rateKm,$lid,$eid));
    }

    function updateDeliveryRate($dbHelper, $mysqli,$id,$ratePkt,$rateKm,$lid) {
        return $dbHelper -> performOperation($mysqli, 'sp_updateDeliveryRate', array($ratePkt,$rateKm,$id,$lid));
    }
    
    function updateDeliveryRateEmp($dbHelper, $mysqli,$id,$ratePkt,$rateKm,$lid) {
        return $dbHelper -> performOperation($mysqli, 'sp_updateDeliveryRateEmp', array($ratePkt,$rateKm,$id,$lid));
    }
    
    function deleteDeliveryRate($dbHelper, $mysqli, $id) {
        return $dbHelper -> performOperation($mysqli, 'sp_deleteDeliveryRate', array($id));
    }
    
    function deleteDeliveryRateEmp($dbHelper, $mysqli, $id) {
        return $dbHelper -> performOperation($mysqli, 'sp_deleteDeliveryRateEmp', array($id));
    }

    function insertDeliveryRateAdmin($dbHelper, $mysqli){
        $lid=$_REQUEST["lid"];
        $ratePkt=$_REQUEST["ratePkt"];
        $rateKm=$_REQUEST["rateKm"];
        $this->insertDeliveryRate($dbHelper, $mysqli, $ratePkt, $rateKm,$lid);
        header('Location: admin.php?action=master_delivery_rate');
    }
    
    function updateDeliveryRateAdmin($dbHelper, $mysqli){
        $id=$_REQUEST["id"];
        $lid=$_REQUEST["lid"];
        $ratePkt=$_REQUEST["ratePkt"];
        $rateKm=$_REQUEST["rateKm"];
        $this->updateDeliveryRate($dbHelper, $mysqli,$id, $ratePkt, $rateKm, $lid);
        header('Location: admin.php?action=master_delivery_rate');
    }
    
     function deleteDeliveryRateAdmin($dbHelper, $mysqli,$id) {
        $this->deleteDeliveryRate($dbHelper, $mysqli, $id);
        header('Location: admin.php?action=master_delivery_rate');
    }
     
     
    function insertDeliveryRateFront($dbHelper, $mysqli){
        $lid=$_REQUEST["lid"];
        $ratePkt=$_REQUEST["ratePkt"];
        $rateKm=$_REQUEST["rateKm"];
        $eid=$_REQUEST["eid"];
        $this->insertDeliveryRateEmp($dbHelper, $mysqli, $ratePkt, $rateKm, $lid, $eid);
        header('Location: comp.php?action=master_delivery_rate');
    }
    
    function updateDeliveryRateFront($dbHelper, $mysqli){
        $id=$_REQUEST["vid"];
        $lid=$_REQUEST["lid"];
        $ratePkt=$_REQUEST["ratePkt"];
        $rateKm=$_REQUEST["rateKm"];
        $this->updateDeliveryRateEmp($dbHelper, $mysqli,$id, $ratePkt, $rateKm, $lid);
        header('Location: comp.php?action=master_delivery_rate');
    }
    
     function deleteDeliveryRateFront($dbHelper, $mysqli,$id) {
        $this->deleteDeliveryRateEmp($dbHelper, $mysqli, $id);
        header('Location: comp.php?action=master_delivery_rate');
    } 

	function clean($data) {
		$data = stripslashes($data);
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}

	function uploadDailyDelivery($dbHelper, $mysqli) {
	    $empJobId=$_REQUEST["emp_job_id"];
		$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
		if (!empty($_FILES['file']['tmp_name']) && in_array($_FILES['file']['type'], $csvMimes)) {
          $csvFile = fopen($_FILES["file"]["tmp_name"], 'r');
            //skip first line
			fgetcsv($csvFile);
			$count = 0;
            
			//parse data from csv file line by line
			while (($line = fgetcsv($csvFile)) !== FALSE) {
				$mobile = $line[0];
                $shift = $line[1];
                $PktType = $line[2];
                $totalPkt = $line[3];
                $donePkt = $line[4];
                $attemptPkt = $line[5];
                $rejectPkt = $line[6];
                $openKm = $line[7];
                $closeKm = $line[8];
                $date = $line[9];
                $data=$this->getCurrentDeliveryRateByName($dbHelper, $mysqli,$PktType);
                $ratePkt=$data[0]["rate_pkt"];
                $rateKm=$data[0]["rate_km"];
                $lid = $data[0]["lid"];
                $tot= $donePkt+$attemptPkt+$rejectPkt;
                if($totalPkt==$tot){
                    $data = array();
                    $data = $dbHelper -> getDataFromQuery($mysqli, "Select id from members where username='".$mobile."'");
                    $uid=$data[0]["id"];
                    $this->insertDailyDeliveryReportWithDate($dbHelper, $mysqli, $uid, $shift, $totalPkt, $donePkt, $attemptPkt, $rejectPkt, $ratePkt, $openKm, $closeKm, $rateKm,$lid,$empJobId,$date);
                    $count++;
                }	
            }
			if ($count < 1) {
				echo "No record uploaded.";
			} else if ($count == 1) {
				echo $count . " Record uploaded successfully.";
			} else {
				echo $count . " Records uploaded successfully.";
			}
		} else
			echo "Please upload csv file.";

	}

}
?>