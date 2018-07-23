<?php

class Message {

	function Message() {

		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		//echo date('d-m-Y H:i:s');
		error_reporting(E_ALL ^ E_NOTICE);
		//$cid = $_REQUEST["cid"];

	}

	//////////////////////////START//////////////////////

	function getSubject($dbHelper, $mysqli, $id) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, "sp_getMessageSubject", array($id));
		return $data;
	}

	function getGroup($dbHelper, $mysqli, $id) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, "sp_getGroup", array($id));
		return $data;
	}

	function insertSubject($dbHelper, $mysqli) {
		$id = $_REQUEST["id"];
		$subject = $this -> clean($_REQUEST["subject"]);
		$dbHelper -> performOperation($mysqli, "sp_insertMessageSubject", array($id, $subject));
		header('Location: admin.php?action=message_subject');
	}

	function updateSubject($mysqli, $dbHelper) {
		$id = $_REQUEST["id"];
		$subject = $this -> clean($_REQUEST["subject"]);
		$dbHelper -> performOperation($mysqli, "sp_updateMessageSubject", array($id, $subject));
		header('Location: admin.php?action=message_subject');
	}

	function deleteSubject($mysqli, $dbHelper, $id) {
		$dbHelper -> performOperation($mysqli, "sp_deleteMessageSubject", array($id));
		header('Location: admin.php?action=message_subject');
	}

	function adminNewMessage($dbHelper, $mysqli, $msgfrom, $redirect) {
		$msgto = $this -> clean($_REQUEST["msg_to"]);
		$msg = $this -> clean($_REQUEST["msg"]);
		$msg_subject = $this -> clean($_REQUEST["msg_subject"]);
		if ($msg_subject == "Other")
			$msg_subject = $this -> clean($_REQUEST["sub_other"]);
		$uids = $_REQUEST["uids"];
		if ($uids != "")
			$msgto = $uids;
		echo $msgto;
		$dbHelper -> performOperation($mysqli, "sp_sendMessage", array($msgfrom, $msg_subject, $msg, $msgto));
		$data = $dbHelper -> getDataFromQuery($mysqli, "select mobile from member_details where mobile IS NOT NULL AND uid IN ('" . $msgto . "')");
		for ($i = 0; $i < count($data); $i++)
			$this -> newMessage($data[$i]["mobile"]);
		header('Location: admin.php?action=' . $redirect);
	}

	function adminBroadcastMessage($dbHelper, $mysqli) {
		$groupId = $_REQUEST['grp_id'];
		$fcm = trim($_REQUEST["uids"]);
		$keywords = preg_split("/[\s,]+/", $fcm);
		$filterd = array_filter($keywords);
		$fcm = implode(",", $filterd);
		$response = "";
		if ($fcm != "") {
			$title = $_REQUEST['title'];
			$msg = $this -> clean($_REQUEST['msg']);
			$image = $_FILES["promo"]["name"];
			$Candidate = $this -> clean($_REQUEST['Candidate']);
			$action1 = $this -> clean($_REQUEST['action1']);
			$action_des = $this -> clean($_REQUEST['action_destination']);
			$dbHelper -> performOperation($mysqli, "sp_insertAdminBroadcastMessage", array($groupId, "", $title, $msg, "", $image, $action1, $action_des));

			if (!is_dir("images/broadcast/")) {
				mkdir("images/broadcast/", 0777);
			}
			if ($image != '') {
				move_uploaded_file($_FILES["promo"]["tmp_name"], "images/broadcast/" . $image);
			}

			$response = $this -> sendPushNotification($fcm, $payload, $title, $msg, $image, $action1, $action_des);
		}

		header('Location: admin.php?action=broadcast_message&response=' . $response);
	}

	function adminResendBroadcastMessage($dbHelper, $mysqli, $id) {
		$data = $dbHelper -> getData($mysqli, 'sp_getAdminBroadcastMessageByID', array($id));
		$groupId = $data[0]["group_id"];
		$fcm = trim($data[0]["users"]);
		$keywords = preg_split("/[\s,]+/", $fcm);
		$filterd = array_filter($keywords);
		$fcm = implode(",", $filterd);
		$response = "";
		if ($fcm != "") {
			$title = $data[0]['title'];
			$msg = $data[0]['message'];
			$image = $data[0]["image"];
			$payload = $data[0]["payload"];
			$action1 = $data[0]['action1'];
			$action_des = $data[0]['action_destination'];
			$response = $this -> sendPushNotification($fcm, $payload, $title, $msg, $image, $action1, $action_des);
		}

		header('Location: admin.php?action=broadcast_message&response=' . $response);
	}

	function sendPushNotification($fcm, $payload, $title, $message, $image, $action1, $action_des) {
		$firebase = new Firebase();
		$push = new Push();
		$push -> setTitle($title);
		$push -> setMessage($message);
		$push -> setImage($image);
		$push -> setIsBackground(FALSE);
		$push -> setPayload($payload);
		$push -> setAction($action);
		$push -> setActionDestination($actionDestination);
		$regIds = explode(',', $fcm);
		$count = count($regIds);
		$json = $push -> getPush();
		$response = "";
		if ($count > 1) {
			$response = $firebase -> sendMultiple($regIds, $json);
		} else {
			$response = $firebase -> send($fcm, $json);
		}
		//echo json_encode($json);
		//echo json_encode($response);
		return $response;
	}

	function skillmitraBroadcastMessage($dbHelper, $mysqli, $msgfrom) {
		$msgsubject = $this -> clean($_REQUEST['msg_subject']);
		$msg = $this -> clean($_REQUEST['msg']);
		$dbHelper -> performOperation($mysqli, "sp_insertSkillmitraBroadcastMessage", array($msgfrom, $msgsubject, $msg));
		header('Location: skill-mitra.php?action=messages');
	}

	function getAdminBroadcastMessage($dbHelper, $mysqli) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, "sp_getAdminBroadcastMessage", array());
		return $data;
	}

	function updateAdminBroadcastMessage($dbHelper, $mysqli) {
		$msgid = $_REQUEST['msg_id'];
		$msgsubject = $this -> clean($_REQUEST['msg_subject']);
		$msg = $this -> clean($_REQUEST['msg']);
		$Candidate = $this -> clean($_REQUEST['Candidate']);
		$sm = $_REQUEST['sm'];
		$tp = $_REQUEST['tp'];
		$guru = $_REQUEST['guru'];
		$emp = $_REQUEST['emp'];
		$dbHelper -> performOperation($mysqli, "sp_updateAdminBroadcastMessage", array($msgid, $msgsubject, $msg, $Candidate, $sm, $tp, $guru, $emp));
		header('Location: admin.php?action=broadcast_message');
	}

	function deleteBroadcastMessage($dbHelper, $mysqli, $id) {
		$dbHelper -> performOperation($mysqli, "sp_deleteAdminBroadcastMessage", array($id));
		header('Location: admin.php?action=broadcast_message');
	}

	function getInbox($dbHelper, $mysqli, $id, $mid) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getInbox', array($id, $mid));
		return $data;
	}

	function getAllMsg($dbHelper, $mysqli) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getAllMsg', array());
		return $data;
	}

	function getMessagesWithReply($dbHelper, $mysqli, $mid) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_readMessage', array($mid));
		return $data;
	}

	function getSentMessage($mysqli, $id) {
		$data = array();
		$sql = "";

		$query = "SELECT *
                        FROM messages
                        left outer join member_details
                        on messages.msg_from =member_details.uid 
                        
                        where messages.msg_from = '" . $id . "'
                        
                        
                         order by messages.msg_id DESC
                        ";

		$result = $mysqli -> query($query);
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			array_push($data, $row);
		}

		return $data;
	}

	function getReplies($mysqli, $mid) {
		$data = array();
		$sql = "";

		$query = "SELECT *
                        FROM message_replies
                        left outer join member_details
                        on message_replies.reply_from =member_details.uid 
                        where mid = '" . $mid . "'
                        
                        
                         order by mr_id DESC
                        ";

		$result = $mysqli -> query($query);
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			array_push($data, $row);
		}

		return $data;
	}

	function insertGroup($dbHelper, $mysqli, $name) {
		$result = $dbHelper -> performOperation($mysqli, 'sp_insertGroup', array($name));
		return $result;
	}

	function insertUserGroup($dbHelper, $mysqli, $grpId, $uid) {
		$result = $dbHelper -> performOperation($mysqli, 'sp_insertUserGroup', array($grpId, $uid));
		return $result;
	}

	function addUserGroup($dbHelper, $mysqli, $name, $uids, $delim) {
		$result = $dbHelper -> performOperation($mysqli, 'sp_addUserGroup', array($name, $uids, $delim));
		return $result;
	}

	function saveUsersToGroup($dbHelper, $mysqli, $grpId, $uid, $user_role) {
		$result = $this -> insertUserGroup($dbHelper, $mysqli, $grpId, $uid);
		header("location:admin.php?action=add_user_to_group&grp_id=$grpId&user_role=$user_role");
	}

	function getUsersByRoleNotInGroup($dbHelper, $mysqli, $user_role, $grp_id) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, "sp_getUsersByRoleNotInGroup", array($grp_id, $user_role));
		return $data;
	}

	function getAddedUsersByGroup($dbHelper, $mysqli, $grp_id) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, "sp_getAddedUsersByGroup", array($grp_id));
		return $data;
	}

	function updateGroup($dbHelper, $mysqli, $grp_id, $grp_name) {
		$result = $dbHelper -> performOperation($mysqli, 'sp_updateGroup', array($grp_id, $grp_name));
		return $result;
	}

	function updateGroupAdmin($dbHelper, $mysqli) {
		$grp_id = $_REQUEST['grp_id'];
		$grp_name = $this -> clean($_REQUEST['grp_name']);
		$this -> updateGroup($dbHelper, $mysqli, $grp_id, $grp_name);
		header("Location: admin.php?action=master_group");
	}

	function insertGroupAdmin($dbHelper, $mysqli) {
		$name = $this -> clean($_REQUEST['grp_name']);
		$this -> insertGroup($dbHelper, $mysqli, $name);
		header("Location: admin.php?action=master_group");
	}

	function deleteGroup($dbHelper, $mysqli, $grp_id) {
		$dbHelper -> performOperation($mysqli, "sp_deleteGroup", array($grp_id));
		header("Location: admin.php?action=master_group");
	}

	function removeUserFromGroup($dbHelper, $mysqli, $grp_id, $uid) {
		$dbHelper -> performOperation($mysqli, "sp_removeUserFromGroup", array($uid, $grp_id));
		header("Location: admin.php?action=remove_user_from_group&grp_id=$grp_id");
	}

	function addUserGroupAdmin($dbHelper, $mysqli, $redirect) {
		$ids = $_REQUEST["id"];
		$uids = implode(", ", $ids);
		$name = $this -> clean($_REQUEST["groupName"]);
		$delim = ",";
		$result = $dbHelper -> performOperation($mysqli, 'sp_addUserGroup', array($name, $uids, $delim));
		header('Location:?action=' . $redirect);
	}

	function insertRecipient($dbHelper, $mysqli, $mid, $uid) {
		$result = $dbHelper -> performOperation($mysqli, 'sp_insertRecipient', array($mid, $uid));
		return $result;
	}

	function updateMsgReadStatus($dbHelper, $mysqli, $mid, $uid, $status) {
		$result = $dbHelper -> performOperation($mysqli, 'sp_updateMsgReadStatus', array($mid, $uid, $status));
		return $result;
	}

	function sendMessageApi($dbHelper, $mysqli, $id, $subject, $msg, $msgto) {
		$result = $dbHelper -> performOperation($mysqli, 'sp_sendMessage', array($id, $subject, $msg, $msgto));
		return $result;
	}

	function sendMessageReplyApi($dbHelper, $mysqli, $id, $mid, $msg, $status) {
		$result = $dbHelper -> performOperation($mysqli, 'sp_sendReply', array($mid, $id, $msg, $status));
		return $result;
	}

	function send_message($dbHelper, $mysqli, $msg_from) {
		$msg_subject = $this -> clean($_REQUEST["msg_subject"]);
		$msg = $this -> clean($_REQUEST["msg"]);
		$msgto = $this -> clean($_REQUEST["msgto"]);
		if ($msg_subject == "Other")
			$msg_subject = $this -> clean($_REQUEST["sub_other"]);
		$this -> sendMessageApi($dbHelper, $mysqli, $msg_from, $msg_subject, $msg, $msgto);
		header('Location:?action=messages');
	}

	/* Send Messages To Hired candidate */
	function send_message_to_hired($dbHelper, $mysqli, $msg_from) {
		$msg_subject = $this -> clean($_REQUEST["msg_subject"]);
		$msg = $this -> clean($_REQUEST["msg"]);
		$msgto = $this -> clean($_REQUEST["msgto"]);
		if ($msg_subject == "Other")
			$msg_subject = $this -> clean($_REQUEST["sub_other"]);
		$this -> sendMessageApi($dbHelper, $mysqli, $msg_from, $msg_subject, $msg, $msgto);
		$data = $dbHelper -> getDataFromQuery($mysqli, "select mobile from member_details where mobile IS NOT NULL AND uid IN ('" . $msgto . "')");
		for ($i = 0; $i < count($data); $i++)
			$this -> newMessage($data[$i]["mobile"]);
		header('Location:?action=messages');
	}

	/*  End Send Messages  */
	function send_reply($dbHelper, $mysqli, $msg_from, $redirect) {
		$mid = $_REQUEST["mid"];
		$replied_status = $this -> clean($_REQUEST["replied_status"]);
		$replied_msg = $this -> clean($_REQUEST["replied_msg"]);
		$reply_from = $msg_from;
		$dbHelper -> performOperation($mysqli, 'sp_sendReply', array($mid, $msg_from, $replied_msg, $replied_status));
		$q = "select member_details.mobile from messages left outer join member_details on messages.msg_to=member_details.uid where  messages.msg_to>0 and member_details.mobile IS NOT NULL and messages.msg_id='" . $mid . "'";
		$r = mysqli_query($mysqli, $q);
		$v = mysqli_fetch_assoc($r);
		$v["mobile"];
		$this -> newMessage($v["mobile"]);
		header('Location:?action=' . $redirect);
	}

	function seoName($string) {
		$string = str_replace(array('[\', \']'), '', $string);
		$string = preg_replace('/\[.*\]/U', '', $string);
		$string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
		$string = htmlentities($string, ENT_COMPAT, 'utf-8');
		$string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string);
		$string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/'), '-', $string);
		return strtolower(trim($string, '-'));
	}

	function clean($data) {
		$data = stripslashes($data);
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}

	function newMessage($varPhNo) {
		$message = "You%20have%20one%20new%20message.%20Please%20login%20Skillchamps%20to%20view.";
		$varUserName = "t1cybssapi";
		$varPWD = "55200745";
		$varSenderID = "CHAMPS";
		$varMSG = $message;
		$url = "http://nimbusit.co.in/api/swsendSingle.asp";
		$data = "username=" . $varUserName . "&password=" . $varPWD . "&sender=" . $varSenderID . "&sendto=" . $varPhNo . "&message=" . $varMSG;
		$this -> postData($url, $data);
	}

	function postdata($url, $data) {
		//The function uses CURL for posting data to
		$objURL = curl_init($url);
		curl_setopt($objURL, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($objURL, CURLOPT_POST, 1);
		curl_setopt($objURL, CURLOPT_POSTFIELDS, $data);
		$retval = trim(curl_exec($objURL));
		curl_close($objURL);
		return $retval;
	}

}
