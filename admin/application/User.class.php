<?php

class User {

	function User() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}

	function checkSubscription($dbHelper, $mysqli, $uid, $request, $tableName, $fieldName, $uidFieldName) {
		if ($uid == "" || $request == "" || $tableName == "" || $fieldName == "" || $uidFieldName == "")
			return false;
		else {
			$data = $dbHelper -> getData($mysqli, 'sp_getSubscriptionFeatureByAction', array($uid, $request));

			if (count($data) > 0) {
				$status = $data[0]["sf_status"];
				$numRecordStatus = $data[0]["num_record_status"];
				$numRecord = $data[0]["num_record"];
				$subUnit = $data[0]["sub_unit"];
				if ($status == "DISABLE")
					return false;
				elseif ($status == 'ENABLE' && ($numRecordStatus == 'NA' || $numRecordStatus == 'UNLIMITED'))
					return true;
				else {
					$dc = $dbHelper -> getData($mysqli, "sp_getNumRecordBySubscription", array($uid, $tableName, $fieldName, $subUnit, $uidFieldName));
					
					$count = $dc[0]["num"];
					if ($count < $numRecord)
						return true;
					else
						return false;
				}
			} else {
				return true;
			}
		}
	}

	function getCountUsersByRole($dbHelper, $mysqli) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, "sp_getCountUsersByRole", array());
		return $data;

	}

	function getUserByAuth($dbHelper, $mysqli, $auth) {
		$data = array();
		$id = '';
		$data = $dbHelper -> getData($mysqli, "sp_getUserByAuthToken", array($auth));
		if (count($data) > 0)
			$id = $data[0]["id"];
		return $id;
	}

	function getMembers($mysqli, $urole, $id) {
		$data = array();
		$sql = "";
		if ($id != "") {
			$sql .= " and uid='" . $id . "'";
		}
		if ($urole != "") {
			$sql .= " and members.user_role = '" . $urole . "'";
		}

		$query = "SELECT *
						FROM member_details
						inner join members
						on member_details.uid = members.id
						where members.id!=''
						
						
						 $sql order by members.id DESC
						";

		$result = $mysqli -> query($query);
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			array_push($data, $row);
		}

		return $data;
	}

	function getMembersWithJobRole($dbHelper, $mysqli, $urole, $id) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getMemberDeatilsWithJobRole', array($id, $urole));
		return $data;
	}

	function change_password($mysqli) {
		$uid = $_SESSION["skill_champs_user_id"];
		$password = $this->clean($_REQUEST["newpassword"]);
		$random_salt = hash('sha512', uniqid(rand(1, 10000000), TRUE));
		$password = hash('sha512', $password . $random_salt);
		$q = "update members set password = '" . $password . "', salt = '" . $random_salt . "' where id = '" . $uid . "'";
		$mysqli -> query($q);
	}

	function update_password($mysqli) {
		$uid = $_REQUEST["uid"];
		$page = $_REQUEST["page"];
		$password = $this->clean($_REQUEST["password"]);
		$random_salt = hash('sha512', uniqid(rand(1, 10000000), TRUE));
		$password = hash('sha512', $password . $random_salt);
		$q = "update members set password = '" . $password . "', salt = '" . $random_salt . "' where id = '" . $uid . "'";
		$mysqli -> query($q);
		header('Location: admin.php?action=' . $page);
	}

	function postdata($msisdn, $message) {
		$varUserName = "t1cybssapi";
		$varPWD = "55200745";
		$varSenderID = "CHAMPS";
		$varPhNo = $msisdn;
		$varMSG = $message;
		$url = "http://nimbusit.co.in/api/swsendSingle.asp";
		$data = "username=" . $varUserName . "&password=" . $varPWD . "&sender=" . $varSenderID . "&sendto=" . $varPhNo . "&message=" . $varMSG;

		//The function uses CURL for posting data to
		$objURL = curl_init($url);
		curl_setopt($objURL, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($objURL, CURLOPT_POST, 1);
		curl_setopt($objURL, CURLOPT_POSTFIELDS, $data);
		$retval = trim(curl_exec($objURL));
		curl_close($objURL);
		return $retval;
	}

	function getfieldsbypincode($dbHelper, $mysqli, $cid) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getFieldsByPincode', array($cid));
		return $data;
	}

	function getfieldsbycourse($dbHelper, $mysqli, $cid) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getFieldsByCourse', array($cid));
		return $data;
	}

	function getJobtype($dbHelper, $mysqli, $id) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_Jobtype', array($id));
		return $data;
	}

	function candidateAttendance($dbHelper, $mysqli) {
		$data = $dbHelper -> getData($mysqli, 'sp_getCandidateAtttendanceAdmin', array());
		return $data;
	}

	function getNewMessageCount($dbHelper, $mysqli) {
		$query = "SELECT count(*) as num from messages LEFT OUTER JOIN message_recipient ON messages.msg_id=message_recipient.mid WHERE message_recipient.ruid='1' AND message_recipient.is_read='NO'";
		$data = $dbHelper -> getDataFromQuery($mysqli, $query);
		return $data[0]["num"];
	}

	/*  Notification   */
	function getNotificationForUser($dbHelper, $mysqli, $cid) {
		$data = array();
		if ($cid) {
			$data = $dbHelper -> getData($mysqli, 'sp_getNotificationForUser', array($cid));
		}
		return $data;
	}

	/*  End Notification */
	function clean($data) {
		$data = stripslashes($data);
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}

}
?>