<?php

class HireCandidate {

	function HireCandidate() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}

	function shortlistCandidate($dbHelper, $mysqli, $cid) {
		$eid = $_SESSION["skill_champs_user_id"];
		$empJobId = $_REQUEST[emp_job_id];
		$dbHelper -> performOperation($mysqli, 'sp_shortlistCandidateEmp', array($cid, $eid, $empJobId));
		header('Location: admin.php?action=get_available_candidate_for_job');
	}

	function addToCartCandidate($dbHelper, $mysqli, $cid) {
		$eid = $_SESSION["skill_champs_user_id"];
		$empJobId = $_REQUEST[emp_job_id];
		$dbHelper -> performOperation($mysqli, 'sp_addToCartCandidateEmp', array($cid, $eid, $empJobId));
		header('Location: admin.php?action=get_available_candidate_for_job');
	}

	function addToCartCandidateAdmin($dbHelper, $mysqli, $cid, $eid, $empJobId, $avId, $fromDate, $toDate, $fromTime, $toTime, $period, $sal) {
		$result = $dbHelper -> performOperation($mysqli, 'sp_addToCartCandidateEmp', array($cid, $eid, $empJobId, $avId, $fromDate, $toDate, $fromTime, $toTime, $period, $sal));
		return $result;
	}

	function updateToCartCandidateAdmin($dbHelper, $mysqli, $id, $cid, $eid, $empJobId, $avId, $fromDate, $toDate, $fromTime, $toTime, $period, $sal) {
		$result = $dbHelper -> performOperation($mysqli, 'sp_updateToCartCandidateEmp', array($id, $cid, $eid, $empJobId, $avId, $fromDate, $toDate, $fromTime, $toTime, $period, $sal));
		return $result;
	}

	function shortlistCandidateAdmin($dbHelper, $mysqli, $cid, $eid, $empJobId, $avId) {
		$result = $dbHelper -> performOperation($mysqli, 'sp_shortlistCandidateEmp', array($cid, $eid, $empJobId, $avId));
		return $result;
	}

	function getAvailableCandidateForJob($dbHelper, $mysqli, $empJobId) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getAvailableCandidateForJob', array($empJobId));
		return $data;
	}

	function getCurrentlyHired($dbHelper, $mysqli, $cid) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getCurrentlyHiredByCid', array($cid));
		return $data;
	}

	function candidateHire($dbHelper, $mysqli, $empJobId, $avId) {
		$empJobId = $_REQUEST["emp_job_id"];
		$avId = $_REQUEST["av_id"];
		$availability = array();
		$mobilecode = sprintf("%06d", mt_rand(200000, 999999));
		$availability = $dbHelper -> getData($mysqli, 'sp_getAvailabilityById', array($avId));
		$job = array();
		$job = $dbHelper -> getData($mysqli, 'sp_getEmpJobsbyId', array($empJobId));
		$params = array($availability[0]["cid"], $availability[0]["from_date"], $availability[0]["to_date"], $availability[0]["from_time"], $availability[0]["to_time"], $availability[0]["period"], $availability[0]["job_type_id"], $availability[0]["exp_sal"], $job[0]["t1id"], $job[0]["eid"], $job[0]["from_date"], $job[0]["to_date"], $job[0]["from_time"], $job[0]["to_time"], $job[0]["period"], $job[0]["job_type_id"], $job[0]["sal"], $avId, $availability[0]["state"], $availability[0]["district"], $availability[0]["area"], $availability[0]["locality"], $availability[0]["job_sector"], $availability[0]["job_role"], $availability[0]["skill"], $mobilecode);
		$result = $dbHelper -> performOperation($mysqli, 'trs_hireCandidate', $params);
		if ($result == "Success")
			echo "Candidate hired successfully.";
		else
			echo $result;
	}

	function checkCandidateAvailabilityForAddToCart($dbHelper, $mysqli, $empJobId, $avId) {
		$availability = array();
		$availability = $dbHelper -> getData($mysqli, 'sp_getAvailabilityById', array($avId));
		$job = array();
		$job = $dbHelper -> getData($mysqli, 'sp_getEmpJobsbyId', array($empJobId));
		$params = array($availability[0]["cid"], $availability[0]["from_date"], $availability[0]["to_date"], $availability[0]["from_time"], $availability[0]["to_time"], $availability[0]["period"], $availability[0]["job_type_id"], $job[0]["from_date"], $job[0]["to_date"], $job[0]["period"]);
		$result = $dbHelper -> multiquery($mysqli, 'sp_checkCandidateAvailability', $params, "Select @outStatus,@fromDate,@toDate,@period;", array('@outStatus', '@fromDate', '@toDate', '@period'));
		if ($result[1] == "0") {
			array_push($result, $availability[0]["from_time"], $availability[0]["to_time"], $availability[0]["exp_sal"]);
		}
		return $result;
	}

	function rehireCandidate($dbHelper, $mysqli, $empJobId, $candidateId) {
		$job = array();
		$job = $dbHelper -> getData($mysqli, 'sp_getEmpJobsbyId', array($empJobId));
		$mobilecode = sprintf("%06d", mt_rand(200000, 999999));
		$availability = array();
		$availability = $dbHelper -> getData($mysqli, 'sp_getAvailabilityForRehire', array($candidateId, $job[0]["from_date"], $job[0]["to_date"], $job[0]["job_type_id"]));
		if (count($availability) > 0) {
			$params = array($availability[0]["cid"], $availability[0]["from_date"], $availability[0]["to_date"], $availability[0]["from_time"], $availability[0]["to_time"], $availability[0]["period"], $availability[0]["job_type_id"], $availability[0]["exp_sal"], $job[0]["t1id"], $job[0]["eid"], $job[0]["from_date"], $job[0]["to_date"], $job[0]["from_time"], $job[0]["to_time"], $job[0]["period"], $job[0]["job_type_id"], $job[0]["sal"], $availability[0]["id"], $availability[0]["state"], $availability[0]["district"], $availability[0]["area"], $availability[0]["locality"], $availability[0]["job_sector"], $availability[0]["job_role"], $availability[0]["skill"], $mobilecode);
			$result = $dbHelper -> performOperation($mysqli, 'trs_hireCandidate', $params);
			if ($result == "Success")
				echo "Candidate hired successfully.";
			else
				echo $result;
		} else
			echo "Candidate is not available for rehire.";

	}

	function deleteShortlitedCandidateByAv($dbHelper, $mysqli, $avId) {
		$result = $dbHelper -> performOperation($mysqli, 'sp_deleteShortlistedCandidateByAv', array($avId));
		return $result;
	}

	function deleteCartCandidateByAv($dbHelper, $mysqli, $avId) {
		$result = $dbHelper -> performOperation($mysqli, 'sp_deleteTempCartCandidateByAv', array($avId));
		return $result;
	}

	function calculatePeriod($dbHelper, $mysqli, $fromDate, $toDate, $fromTime, $toTime, $jobTypeId) {
		$fromDate = $this -> clean($_REQUEST["from_date"]);
		$toDate = $this -> clean($_REQUEST["to_date"]);
		$fromTime = $this -> clean($_REQUEST["from_time"]);
		$toTime = $this -> clean($_REQUEST["to_time"]);
		$jobTypeId = $this -> clean($_REQUEST["job_type_id"]);
		$dbHelper -> performOperation($mysqli, 'sp_calculatePeriodByJobType', array($fromDate, $toDate, $fromTime, $toTime, $jobTypeId));
	}

	function getShortiltsedCandidateByEmp($dbHelper, $mysqli, $eid) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getShortlistedCandidateByEmp', array($eid));
		return $data;
	}

	function getCartCandidateByEmp($dbHelper, $mysqli, $eid, $userRole = '400') {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getTempCartCandidateByEmp', array($eid));
		$count = 0;
		if ($userRole == '800')
			$count = 10;
		else
			$count = intval($this -> getHiredCandidatesByEmployerCount($mysqli, $data[0][cart_eid]));
		$remain = 10 - $count;
		if (count($data) > 0) {
			for ($i = 0; $i < count($data); $i++) {
				$result = $this -> updateToCartCandidate($dbHelper, $mysqli, $data[$i]["id"], $data[$i]["cid"], $data[$i]["cart_eid"], $data[$i]["cart_emp_job_id"], $data[$i]["t3id"]);
				if ($result[0] == 'Success') {
					$data[$i]["available"] = "YES";
					$data[$i]["from_date"] = $result[1];
					$data[$i]["to_date"] = $result[2];
					$data[$i]["from_time"] = $result[3];
					$data[$i]["to_time"] = $result[4];
					$data[$i]["period"] = $result[5];
					$data[$i]["exp_sal"] = $result[6];
				} else {
					$data[$i]["available"] = "NO";
				}
				if ($data[$i]["job_type_id"] == "5") {
					$data[$i]["service_charge"] = 0;
					$data[$i]["gst"] = 0;
					$data[$i]["total_pay"] = 0;
				} else {

					$totalNum = 1;
					$totalAmount = 0;
					$totalAmount = $totalAmount + ($data[$i]["period"] * $data[$i]["exp_sal"]);
					$data[$i]["total_am"] = $totalAmount;
					if ($remain > 0) {
						$data[$i]["service_charge"] = $this -> calculateServiceChargeForFirstTen($totalAmount);
						$remain--;
					} else
						$data[$i]["service_charge"] = $this -> calulateServiceCharge($dbHelper, $mysqli, $totalAmount, $totalNum, $data[$i]["cart_emp_job_id"]);

					$data[$i]["gst"] = $this -> calulateGst($data[0]["total_am"] + $data[0]["service_charge"]);
					$data[$i]["total_pay"] = $data[0]["total_am"] + $data[0]["service_charge"] + $data[0]["gst"];
				}

				$data[$i]["service_charge"];

			}
		}
		return $data;
	}

	function updateToCartCandidate($dbHelper, $mysqli, $id, $cid, $eid, $empJobId, $avId) {
		$data = array();
		$check = $this -> checkCandidateAvailabilityForAddToCart($dbHelper, $mysqli, $empJobId, $avId);
		if ($check[1] == "0") {
			$result = $this -> updateToCartCandidateAdmin($dbHelper, $mysqli, $id, $cid, $eid, $empJobId, $avId, $check[2], $check[3], $check[5], $check[6], $check[4], $check[7]);
			if ($result == "Success") {
				array_push($data, $result, $check[2], $check[3], $check[5], $check[6], $check[4], $check[7]);
			} else
				array_push($data, $result);
		} else
			array_push($data, $check[0]);
		return $data;
	}

	function getSearchCandidate($dbHelper, $mysqli, $pin, $jobCat) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_searchCandidate', array($this->clean($pin), $this->clean($jobCat)));
		return $data;
	}

	function getShortlistedCandidateByJob($dbHelper, $mysqli, $empJobId) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getShortleitedCandidateByJob', array($empJobId));
		return $data;
	}

	function getRecentOrderByEmp($dbHelper, $mysqli, $empId) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getRecentOrderByEmp', array($empId));
		return $data;
	}

	function getOrderByEmpAdmin($dbHelper, $mysqli, $empId) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getOrderByEmpAdmin', array($empId));
		return $data;
	}

	function getOrderByEmp($dbHelper, $mysqli, $eid) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getOrderByEmp', array($eid));
		for ($i = 0; $i < count($data); $i++) {
			$data1 = array();
			$data1 = $dbHelper -> getData($mysqli, 'sp_getJobStartDateByOrderId', array($data[$i]["id"]));
			$startDate = strtotime($data1[0]["min_date"]);
			$today = strtotime(date("Y-m-d"));
			if ($startDate > $today)
				$data[$i]["show"] = "YES";
			else
				$data[$i]["show"] = "NO";
			$data[$i]["am"] = $data[$i]["sal"] * $data[$i]["period"];
		}
		return $data;
	}

	function getCartCandidateByJob($dbHelper, $mysqli, $empJobId, $userRole = '400') {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getTempCartCandidateByJob', array($empJobId));
		$totalNum = count($data);
		$cartIdList = "";
		$empJobIdList = "";
		$avIdList = "";
		$count = 0;
		if ($userRole == '800')
			$count = 10;
		else
			$count = intval($this -> getHiredCandidatesByEmployerCount($mysqli, $data[0][cart_eid]));
		$remain = 10 - $count;
		if ($totalNum > 0) {
			$data[0]["checkout"] = "true";
			$discountCount = 0;
			$regularCount = 0;
			if ($remain == $totalNum) {
				$discountCount = $remain;
				$regularCount = 0;
			} else if ($remain > $totalNum) {
				$discountCount = $totalNum;
				$regularCount = 0;
			} else if ($remain < $totalNum) {
				$discountCount = $remain;
				$regularCount = $totalNum - $remain;
			}
			$totalAmount1 = 0;
			for ($i = 0; $i < $discountCount; $i++) {
				$result = $this -> updateToCartCandidate($dbHelper, $mysqli, $data[$i]["id"], $data[$i]["cid"], $data[$i]["cart_eid"], $data[$i]["cart_emp_job_id"], $data[$i]["t3id"]);
				if ($result[0] == 'Success') {
					$data[$i]["available"] = "YES";
					$data[$i]["from_date"] = $result[1];
					$data[$i]["to_date"] = $result[2];
					$data[$i]["from_time"] = $result[3];
					$data[$i]["to_time"] = $result[4];
					$data[$i]["period"] = $result[5];
					$data[$i]["exp_sal"] = $result[6];
				} else {
					$data[$i]["available"] = "NO";
					$data[0]["checkout"] = "false";
				}
				$totalAmount1 = $totalAmount1 + ($data[$i]["period"] * $data[$i]["exp_sal"]);
			}
			$serviceChaarge1 = $this -> calculateServiceChargeForFirstTen($totalAmount1);
			$totalAmount = 0;
			for ($i = 0; $i < $regularCount; $i++) {
				$result = $this -> updateToCartCandidate($dbHelper, $mysqli, $data[$i]["id"], $data[$i]["cid"], $data[$i]["cart_eid"], $data[$i]["cart_emp_job_id"], $data[$i]["t3id"]);
				if ($result[0] == 'Success') {
					$data[$i]["available"] = "YES";
					$data[$i]["from_date"] = $result[1];
					$data[$i]["to_date"] = $result[2];
					$data[$i]["from_time"] = $result[3];
					$data[$i]["to_time"] = $result[4];
					$data[$i]["period"] = $result[5];
					$data[$i]["exp_sal"] = $result[6];
				} else {
					$data[$i]["available"] = "NO";
					$data[0]["checkout"] = "false";
				}
				$totalAmount = $totalAmount + ($data[$i]["period"] * $data[$i]["exp_sal"]);
			}
			if ($data[0]["job_type_id"] == "5") {
				$data[0]["total_am"] = 0;
				$data[0]["service_charge"] = 0;
				$data[0]["gst"] = 0;
				$data[0]["total_pay"] = 0;
			} else {
				$data[0]["total_am"] = $totalAmount + $totalAmount1;
				$data[0]["service_charge"] = $this -> calulateServiceCharge($dbHelper, $mysqli, $totalAmount, $totalNum, $data[0]["cart_emp_job_id"]) + $serviceChaarge1;
				$data[0]["gst"] = $this -> calulateGst($data[0]["total_am"] + $data[0]["service_charge"]);
				$data[0]["total_pay"] = $data[0]["total_am"] + $data[0]["service_charge"] + $data[0]["gst"];
			}

		}
		//print_r($data);
		return $data;
	}

	function getSuccessfullHiredCandiadte($dbHelper, $mysqli, $success) {
		$data = array();
		$successHid = json_decode($success);
		for ($i = 0; $i < count($successHid); $i++) {
			$tempData = array();
			$tempData = $dbHelper -> getData($mysqli, 'sp_getHiredCandidateById', array($successHid[$i]));
			if (count($tempData) > 0)
				array_push($data, $tempData[0]);
		}
		return $data;
	}

	function getFailedHiredCandiadte($dbHelper, $mysqli, $failed) {
		$data = array();
		$failedId = json_decode($failed);
		for ($i = 0; $i < count($failedId); $i++) {
			$tempData = array();
			$tempData = $dbHelper -> getData($mysqli, 'sp_getInprocessTempCartById', array($failedId[$i]));
			if (count($tempData) > 0)
				array_push($data, $tempData[0]);
		}
		return $data;
	}

	/*	Updated Hired Candidates List on 2018-06-16	*/
	function getHiredCandidateByEmp($dbHelper, $mysqli, $eid, $period) {
		$data = array();
		if ($period == "TotalHired") {
			$data = $dbHelper -> getData($mysqli, 'sp_getHiredCandidateByEmpByAvail', array($eid, 'false'));
		} else {
			$data = $dbHelper -> getData($mysqli, 'sp_getHiredCandidateByEmpByAvail', array($eid, 'true'));
		}
		return $data;
	}

	/* End Updates */

	function getHiredCandidateByJob($dbHelper, $mysqli, $empJobId) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'getHiredCandidateByJob', array($empJobId));
		return $data;
	}

	function calulateServiceCharge($dbHelper, $mysqli, $totalAmount, $totalNum, $empJobId = 0) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getServiceChargeApplied', array($empJobId));
		$serviceChargeFromPerHire = $data[0]["amount_per_hire"] * $totalNum;
		$serviceChargeFromPercetnatge = $data[0]["percentage_on_hire"] * $totalAmount / 100;

		if ($serviceChargeFromPerHire == $serviceChargeFromPercetnatge)
			return $serviceChargeFromPerHire;
		else if ($data[0]["rule_applied"] == "MinOfTwo")
			return $serviceChargeFromPerHire < $serviceChargeFromPercetnatge ? $serviceChargeFromPerHire : $serviceChargeFromPercetnatge;
		else
			return $serviceChargeFromPerHire > $serviceChargeFromPercetnatge ? $serviceChargeFromPerHire : $serviceChargeFromPercetnatge;
	}

	function calculateServiceChargeForFirstTen($totalAmount) {
		return $totalAmount * 2.5 / 100;
	}

	function calulateGst($totalAmount) {
		return $totalAmount * 18 / 100;
	}

	function getHiredCandidatesByEmployerCount($mysqli, $employer) {
		$data = array();

		$query = "SELECT count(*) as count
                        FROM member_details
                        inner join members
                        on member_details.uid = members.id
                        inner join hired_candidates
                        on hired_candidates.hcid = member_details.uid
                        where members.user_role='200'
                        and hired_candidates.heid='" . $employer . "'
                        
                        
                         $sql order by members.id DESC
                        ";

		$result = $mysqli -> query($query);
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			array_push($data, $row);
		}

		return $data[0]["count"];
	}
  function clean($data) {
		$data = stripslashes($data);
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}
}
?>