<?php
include ('Mailer.class.php');
include_once '../include/psl-config.php';
include_once '../include/functions.php';
require_once ('DBHelper.class.php');
require_once 'HireCandidate.class.php';
require_once 'RefundCalculator.class.php';
require_once 'LocationTracker.class.php';
require_once 'google-calendar-api.php';
require_once 'User.class.php';

sec_session_start();
error_reporting(E_ALL);
$mailer = new Mailer;
$request = $_REQUEST["REQUEST"];
switch($request) {
	case 'CHECK_USERNAME' :
		checkUsername();
		break;
	case 'CHECK_AUTHENTICATION' :
		checkAuthentication();
		break;
	case 'CHANGE_PASSWORD' :
		change_password();
		break;
	case 'AssignSkillMitra' :
		AssignSkillMitra();
		break;
	case 'UpdateUserStatus' :
		UpdateUserStatus();
		break;
	case 'UPDATE_ENTRPRISE_STATUS' :
		UpdateEnterpriseStatus();
		break;
	case 'UpdateVideoStatus' :
		UpdateVideoStatus();
		break;
	case 'SHORTLIST_CANDIDATES' :
		shortlistCandidates();
		break;
	case 'ADD_TO_CART_CANDIDATES' :
		addToCartCandidate();
		break;
	case 'GET_CANDIDATE_VIDEO' :
		getCandidateVideo();
		break;
	case 'getCandidateNextVideo' :
		getCandidateNextVideo();
		break;
	case 'getCandidatePrevVideo' :
		getCandidatePrevVideo();
		break;
	case 'GET_JOBS_ROLE_BY_SECTOR' :
		getJobsRoleBySector();
		break;
	case 'GET_JOBS_ROLE_BY_SECTOR_ID' :
		getJobsRoleBySectorId();
		break;
	case 'GET_DISTRICT_BY_STATE_ID' :
		getDistrictByStateId();
		break;
	case 'GET_AREA_BY_DISTRICT_ID' :
		getAreaByDistrictId();
		break;
	case 'GET_LOCALITY_BY_AREA_ID' :
		getLocalityByAreaId();
		break;
	case 'GET_SKILLS_BY_JOBROLE_ID' :
		getSkillsByJobRoleId();
		break;
	case 'CHANGE_USER_PASSOWRD' :
		change_user_password();
		break;
	case 'FORGOT_USER_PASSOWRD' :
		forgotUserPassword();
		break;
	case 'HIRE_CANDIDATE' :
		hireCandidate();
		break;
	case 'REHIRE_CANDIDATE' :
		rehireCandidate();
		break;
	case 'GET_AVAILABILITY_BY_ID' :
		get_availability_by_id();
		break;
	case'GET_EMP_JOBS_BY_ID' :
		get_emp_jobs_by_id();
		break;
	case 'DELETE_SHORTLISTED_CANDIDATE' :
		deleteShortlistedCandidate();
		break;
	case 'DELETE_CART_CANDIDATE' :
		deleteCartCandidate();
		break;
	case 'GET_LOCAL_PAGE' :
		getLocalPage();
		break;
	case 'GET_BLOG_PAGE' :
		getBlogPage();
		break;
	case 'GET_COUNT' :
		getCount();
		break;
	case 'CANDIDATE_BANK_DETAILS' :
		getCandidateBankDetails();
		break;
	case 'EMPLOYEMENT_HISTORY_DETAILS' :
		getEmployementHistory();
		break;
	case 'ADD_EMPLOYEMENT_HISTORY' :
		addEmployementHistory();
		break;
	case 'UPDATE_EMPLOYEMENT_HISTORY' :
		updateEmployementHistory();
		break;
	case 'EMPLOYEMENT_HISTORY_POPUP' :
		getAllEmployementHistory();
		break;
	case'GET_EMP_JOB_LOCATION_BY_ID' :
		getEmpJobLocationById();
		break;
	case 'REJECT_JOB' :
		rejectJob();
		break;
	case 'START_JOB' :
		startJob();
		break;
	case 'TERMINATE_JOB' :
		terminateJob();
		break;
	case 'COMPLETE_JOB' :
		completeJob();
		break;
	case 'TOOGLE_SERVICE_CHARGE' :
		toogleServiceCharge();
		break;
	case 'CANCEL_ORDER' :
		cancelOrder();
		break;
	case'GET_CANDIDATE_LOCATION' :
		getCandidateLocation();
		break;
	case'GET_CANDIDATE_SKILL' :
		getCandidateSkill();
		break;
	case 'GET_LOCATION_TRACK' :
		getLocationTrack();
		break;
	case 'GET_ALERT_LOCATION_TRACK' :
		getAlertLocationTrack();
		break;
	case 'GET_USER_PROFILE' :
		getUserProfile();
		break;
	case 'GET_USER_DOC' :
		getUserDoc();
		break;
	case'GET_CANDIDATE_EDUCATION' :
		getCandidateEducation();
		break;
	case'GET_CURRENT_LOC_SKILLMITRA' :
		getCurrentLocationTrackSkillmitra();
		break;
	case'GET_REVIEW_PARAM' :
		getReviewParams();
		break;
	case'SCHEDULE_HANGOUT_MEET' :
		scheduleVideoMeeting();
		break;
	case 'GET_CANDIDATE_VIDEO_INTERVIEW' :
		getCandidateVideoInterview();
		break;
	case 'GET_CANDIDATE_DAILY_DELIVERY_REPORT_BY_ID' :
		getCandidateDailyDeliveryReportById();
		break;
	case 'SEND_VERIFICATION_LINK' :
		sendVerificationLink();
		break;
	case 'SEND_OTP' :
		sendOTP();
		break;
	case 'VERIFY_OTP' :
		verifyOTP();
		break;
	case 'SEND_REMINDER_MAIL' :
		sendReminderMail();
		break;
	case 'SET_TARGET_JOB' :
		setTargetJob();
		break;
	case 'GET_DELIVERY_RATE' :
		getDeliveryRate();
		break;
	case 'GET_YTD_REPORT' :
		getYtdReport();
		break;
	case 'GET_DAILY_DELIVERY_PAGE' :
		getDailyDeliveryPage();
		break;
	case 'GET_ATTENDANCE_PAGE' :
		getAttendancePage();
		break;
}

function getYtdReport() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$date = $_REQUEST["date"];
	$dbHelper = new DBHelper;
	$data = array();
	$data = $dbHelper -> getData($mysqli, 'sp_YTDReport', array($date));
	echo json_encode($data);
}

function getDeliveryRate() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$id = $_REQUEST["id"];
	$dbHelper = new DBHelper;
	$data = array();
	$data = $dbHelper -> getData($mysqli, 'sp_getDeliveryRateEmp', array($id, ''));
	echo json_encode($data);
}

function setTargetJob() {
	$empJobId = $_REQUEST["emp_job_id"];
	$target = clean($_REQUEST["target"]);
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$result = $dbHelper -> performOperation($mysqli, "sp_insertEmpJobTarget", array($empJobId, $target));
	echo $result;
}

function sendReminderMail() {
	$email = clean($_REQUEST["email"]);
	$orderNum = clean($_REQUEST["order_num"]);
	$dueDate = clean($_REQUEST["due_date"]);
	$date = clean($_REQUEST["date"]);
	$total = clean($_REQUEST["total"]);
	$message = "Dear Sir/mam,<br> Greeting from Flexihire.The bill for order number " . $orderNum . " dated " . $date . " for an amount of Rs, " . $total . " is due on " . $dueDate . ". Please pay ontime to avoid late fee. 
    Please ignore if already Paid.<br><br>Team Flexihire";
	sendEmail("FLEXIHIRE - Due date alert", $message, $email);
	echo "Reminder mail sent successfully.";
}

function verifyOTP() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$uid = $_REQUEST["uid"];
	$otp = $_REQUEST["otp"];
	$dbHelper = new DBHelper;
	$data = array();
	$ret = array();
	$hash = md5(rand(0, 1000));
	$data = $dbHelper -> getDataFromQuery($mysqli, "select count(*) as c from members where id='" . $uid . "' and mcode='" . $otp . "'");
	if ((int)$data[0]["c"] > 0) {
		$q = "update members set mobile_verification='YES' where id='" . $uid . "'";
		$dbHelper -> performFromQuery($mysqli, $q);
		$ret = "Success";
	} else {
		$ret = "NO";
	}
	echo $ret;
}

function sendVerificationLink() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$uid = $_REQUEST["uid"];
	$email = clean($_REQUEST["email"]);
	$dbHelper = new DBHelper;
	$data = array();
	$ret = array();
	$hash = md5(rand(0, 1000));
	$data = $dbHelper -> performFromQuery($mysqli, "update members set email_verification_code='" . $hash . "' where id='" . $uid . "'");
	if (count($data) > 0) {
		$emailfrom = "admin@flexihire.co.in";
		$fromname = "FLEXIHIRE";
		$to = "admin@flexihire.co.in";
		$headers = 'Return-Path: ' . $emailfrom . "\r\n" . 'From: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 'X-Priority: 3' . "\r\n" . 'X-Mailer: PHP ' . phpversion() . "\r\n" . 'Reply-To: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Transfer-Encoding: 8bit' . "\r\n" . 'Content-Type: text/html; charset=utf-8' . "\r\n";
		$subject1 = "Flexihire - Email Varification: ";
		$message1 = "Dear Sir/Mam,<br>Please click on following link to verify email. <br>
        " . " http://flexihire.co.in/index.php?action=verifylink&id=" . $uid . "&hash=" . $hash . "
        <br>
        Team<br>
        Flexihire";
		$mailer = new Mailer;
		$mailer -> sendMail($email, $emailfrom, $subject1, $message1, "", "");
		$ret = "Success";
	} else {
		$ret = "NO";
	}
	echo $ret;
}

function sendOTP() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$uid = $_REQUEST["uid"];
	$msisdn = $_REQUEST["mobile"];
	$dbHelper = new DBHelper;
	$data = array();
	$ret = "";
	$mobilecode = sprintf("%06d", mt_rand(200000, 999999));
	$q2 = "update members set mcode='" . $mobilecode . "' where id='" . $uid . "' ";
	$mysqli -> query($q2);
	$message = "Verification%20code%20from%20www.flexihire.co.in%20-%20$mobilecode.";
	$varUserName = "t1cybssapi";
	$varPWD = "55200745";
	$varSenderID = "CHAMPS";
	$varPhNo = $msisdn;
	$varMSG = $message;
	$url = "http://nimbusit.co.in/api/swsendSingle.asp";
	$data = "username=" . $varUserName . "&password=" . $varPWD . "&sender=" . $varSenderID . "&sendto=" . $varPhNo . "&message=" . $varMSG;
	postData($url, $data);
	if (count($data) > 0) {
		$ret = "Success";
	} else {
		$ret = "NO";
	}
	echo $ret;
}

function getCandidateDailyDeliveryReportById() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$id = $_REQUEST["id"];
	$dbHelper = new DBHelper;
	$data = array();
	$ret = "";
	$data = $dbHelper -> getData($mysqli, 'sp_getDailyDeliveryReport', array('', $id));
	if (count($data) > 0) {
		$ret = json_encode($data);
	} else {
		$ret = "NO";
	}
	echo $ret;
}

function getCandidateVideoInterview() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$id = $_REQUEST["cid"];
	$ssid = "";
	if (isset($_REQUEST["ssid"]))
		$ssid = clean($_REQUEST["ssid"]);
	$seq = clean($_REQUEST["seq"]);
	$dbHelper = new DBHelper;
	$data = array();
	$ret = "";
	$data = $dbHelper -> getData($mysqli, 'sp_getApprovedVideoSessionCandidate', array($id, $ssid, $seq));
	if (count($data) > 0) {
		$deriveUrl = explode("=", $data[0]["video_url"]);
		$url = "https://drive.google.com/uc?export=download&id=" . $deriveUrl[1];
		$ret = $ret . "<div class='col-md-7' style='padding-top: 10px;'>" . "   <video height='150px'  width='100%' controls>" . "       <source src='" . $url . "' type='video/webm'>" . "       Your browser does not support the video tag." . "   </video>" . "</div>";
		$ret = $ret . "<div class='col-md-5' style='padding: 10px; line-height: 20px;'>" . "   <h4 style='font-size: 12px;'>Ratings</h4>";
		for ($i = 0; $i < count($data); $i++) {
			$ret = $ret . "  <p style='font-size: 12px;'>" . $data[$i]["param_name"] . "   </p>" . "   <p style='font-size: 12px;'>";
			$rating = (int)$data[$i]["param_value"];
			for ($j = 0; $j < $rating; $j++) {
				$ret = $ret . "<span class='fa fa-star checked'></span>";
			}
			$ret = $ret . " </p>";
		}
		$ret = $ret . "</div>" . "<div class='col-md-12' style='border-top: 1px solid #e2e1e1; padding-top: 5px;'>" . "<input type='hidden' name='vssid' id='vssid' value='" . $data[0]["session_id"] . "'/>" . "<input type='hidden' name='vcid' id='vcid' value='" . $data[0]["reviewee_id"] . "'/>" . "   <h6 style='text-align: center; padding: 10px;'>Added Date: " . $data[0]["added_date"] . "</h6>" . "</div>";
	} else {
		$ret = "NO";
	}
	echo $ret;
}

function scheduleVideoMeeting() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$id = clean($_REQUEST["sessionId"]);
	$dbHelper = new DBHelper;
	$data = array();
	$reviewer = "";
	if (isset($_SESSION['google_access_token'])) {
		$data = $dbHelper -> getData($mysqli, 'sp_getVideoSessionById', array($id));
		$startTime = str_replace(" ", "T", $data[0]["from_date"]);
		$endTime = str_replace(" ", "T", $data[0]["to_date"]);
		$attendees = array( array('email' => 'prashant@skillchamps.in', 'displayName' => 'Admin'));
		for ($i = 0; $i < count($data); $i++) {
			array_push($attendees, array('email' => $data[$i]["gmail_id"], 'displayName' => $data[$i]["name"]));
			if ($data[$i]["interviewer"] == "NO" && $data[$i]["guest_user_role"] == "500") {
				$reviewer = $reviewer . $data[$i]["gmail_id"] . ",";
			}
		}
		try {
			$capi = new GoogleCalendarApi();

			// Get user calendar timezone
			$_SESSION['google_access_token'];
			$user_timezone = $capi -> GetUserCalendarTimezone($_SESSION['google_access_token']);

			// Create event on primary calendar
			$event_id = $capi -> CreateCalendarEvent('primary', $data[0]["title"], $startTime, $endTime, $user_timezone, $_SESSION['google_access_token'], $attendees);
			$dbHelper -> performOperation($mysqli, 'sp_sheduleVideoSession', array($id, $event_id));
			echo json_encode(array('error' => 0, 'message' => 'Video meet created successfully.'));
			if (substr($reviewer, -1) == ",")
				$reviewer = substr($reviewer, 0, -1);
			sendReviewerInstruction($reviewer);
		} catch(Exception $e) {
			echo json_encode(array('error' => 1, 'message' => $e -> getMessage() . " Please Autherize."));
		}
	} else {
		echo json_encode(array('error' => 1, 'message' => "Please Autherize."));
	}

}

function sendReviewerInstruction($email) {
	$subject1 = "Flexihire - Video Interview Reviewer Guideline";
	$message1 = "Dear Sir/Mam,<br>You have been assigned as reviwer of a video interview on Google Hangout Meet.
    After joining the meet you are expected to do the following:<br>1.Please mute your mic by presing mute button so that other participant can not see you.<br>
    2.Please disable your video so that other participant can not see you.<br>3.Please provide 
    your rating through Flexihire during the sheduled time because it will be disabled once its over.<br>" . "<br><br>Team<br>FLEXIHIRE";
	$emailfrom = "admin@flexihire.co.in";
	$mailer -> sendMail($email, $emailfrom, $subject1, $message1, "", "");
}

function getCandidateEducation() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$id = $_REQUEST["id"];
	$dbHelper = new DBHelper;
	$data = array();
	$data = $dbHelper -> getData($mysqli, 'sp_getUserEducationById', array($id));
	echo json_encode($data);
}

function getReviewParams() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$sessionId = $_REQUEST["sessionId"];
	$guestId = $_REQUEST["guestId"];
	$dbHelper = new DBHelper;
	$data = array();
	$data = $dbHelper -> getData($mysqli, 'sp_getVideoSessionReviewParam', array($sessionId, $guestId));
	$html = "";
	if (count($data) > 0) {
		$html = $html . "<input type='hidden' id='sid' name='sid' value='" . $sessionId . "'/>" . "<input type='hidden' id='gid' name='gid' value='" . $guestId . "'/>";

		for ($i = 0; $i < count($data); $i++) {
			$html = $html . "<label style='float: left;'>" . $data[$i]["param_name"] . "</label>" . "<select class='form-control' id='sl" . $data[$i]["param_id"] . "' name='sl" . $data[$i]["param_id"] . "'>" . "<option value='0'>0</option>" . "<option value='1'>1</option>" . "<option value='2'>2</option>" . "<option value='3'>3</option>" . "<option value='4'>4</option>" . "<option value='5'>5</option>" . "<option value='6'>6</option>" . "<option value='7'>7</option>" . "<option value='8'>8</option>" . "<option value='9'>9</option>" . "<option value='10'>10</option>" . "</select>" . "</hr>";
		}
	}
	echo $html;
}

function getUserDoc() {
	$uid = $_REQUEST["id"];
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$data = array();
	$data = $dbHelper -> getData($mysqli, 'sp_getCandidateDoc', array('', $uid));
	if (count($data) > 0) {
		$ret = "
         <div class='modal-header'>
             <button type='button' class='close' data-dismiss='modal'>&times;</button>
             <h4 class='modal-title'>Documents</h4>
           </div>
           <div class='modal-body' >
             
              <div class='row'>
               <div style='text-align: center;' class='col-md-2'>
               <p><b>Sl No.</b></p>";
		for ($i = 0; $i < count($data); $i++) {
			if ($data[$i]["sk_approve_status"] == "Approved" && $data[$i]["guru_approve_status"] == "Approved")
				$ret = $ret . "<p>" . ($i + 1) . "</p>";
		}
		$ret = $ret . "</div>
               <div style='text-align: center;' class='col-md-5'>
                <p><b>Documents</b></p>";
		for ($i = 0; $i < count($data); $i++) {
			if ($data[$i]["sk_approve_status"] == "Approved" && $data[$i]["guru_approve_status"] == "Approved")
				$ret = $ret . "<p>" . $data[$i]["type"] . "</p>";
		}
		$ret = $ret . "</div>
               <div style='text-align: center;' class='col-md-5'>
                <p><b>Download</b></p>";
		for ($i = 0; $i < count($data); $i++) {
			if ($data[$i]["sk_approve_status"] == "Approved" && $data[$i]["guru_approve_status"] == "Approved")
				$ret = $ret . "<p style='font-size:12px;'><a target='_blank' href='docs/" . $data[$i]["cid"] . "/" . $data[$i]["file_name"] . "'>" . $data[$i]["file_name"] . "</a></p>";
		}
		$ret = $ret . "</div>
              </div>
            
           </div>
           <div class='modal-footer'>
           </div>";

	} else
		$ret = "NO";
	echo $ret;
}

function getUserProfile() {
	$uid = $_REQUEST["id"];
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$data = array();
	$query = "SELECT *
                        FROM member_details
                        inner join members
                        on member_details.uid = members.id
                        where members.id!='' and members.id='" . $uid . "'";
	$data = $dbHelper -> getDataFromQuery($mysqli, $query);
	if (count($data) > 0) {
		$ret = "
         <div class='modal-content'>
          <div class='modal-header'>
             <button type='button' class='close' data-dismiss='modal'>&times;</button>
             <h4 class='modal-title'>Candidate Profile</h4>
           </div>
           <div class='modal-body'>
             <div class='row'>
              
              <div class='col-md-3'>

               <img style='width:100px; height:100px; float:right;' src='http://skillchamps.in/admin/images/candidate/" . $data[0]["uid"] . "/" . $data[0]["profile_pic"] . "' />
              
              </div>
              <div class='col-md-9'>
               
               <p><b>" . $data[0]["name"] . "</b></p>
               <p>" . $data[0]["dob"] . "&nbsp;" . $data[0]["gender"] . "&nbsp;" . $data[0]["marital_status"] . "</p>
               <p><b>Father Name : </b>" . $data[0]["father_name"] . "</p>
             
              </div>
             
             </div>
             <br>
             <div class='row'>
              <div class='col-md-12'>
             
               <p><b>Mobile :</b>" . $data[0]["mobile"] . "&nbsp;<b>Email :</b>" . $data[0]["email"] . "</p>
              </div>
             </div>
             
             <div class='row'>
              <div class='col-md-12'>
             
               <p><b>Aadhaar :</b>" . $data[0]["aadhaar"] . "</p>
              </div>
             </div>  
              
                <div class='row'>
               <div class='col-md-12'>
                <p><b>Address :</b>" . $data[0]["address"] . "(" . $data[0]["pincode"] . ")</p>
               
               </div>
                  </div>
      
             </div>




           </div>
           <div class='modal-footer'>
           </div></div>";

	} else
		$ret = "NO";
	echo $ret;
}

function getAlertLocationTrack() {
	$alertId = $_REQUEST["id"];
	$dbHelper = new DBHelper;
	$locTrack = new LocationTracker;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$data = array();
	$data = $locTrack -> getLocatinDetailsByAlert($dbHelper, $mysqli, $alertId);
	echo json_encode($data);
}

function getCurrentLocationTrackSkillmitra() {
	$skid = $_REQUEST["skid"];
	$dbHelper = new DBHelper;
	$locTrack = new LocationTracker;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$data = array();
	$data = $locTrack -> getConnectedCandidateLocSkillmitra($dbHelper, $mysqli, $skid);
	echo json_encode($data);
}

function getLocationTrack() {
	$id = $_REQUEST["id"];
	$date = $_REQUEST["date"];
	$dbHelper = new DBHelper;
	$locTrack = new LocationTracker;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$data = array();
	$data = $locTrack -> getLocationTrackingDetailByCidAndDate($dbHelper, $mysqli, $id, $date);
	echo json_encode($data);
}

function cancelOrder() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$id = $_REQUEST["id"];
	$result = RefundCalculator::cancelOrderEmployer($dbHelper, $mysqli, $id);
	if ($result == "Success") {
		$result = $dbHelper -> performFromQuery($mysqli, "UPDATE manpower_order SET manpower_order.canceled='YES' WHERE manpower_order.id='" . $id . "'");
		$result = $dbHelper -> performFromQuery($mysqli, "UPDATE hired_candidates SET hired_candidates.job_status='Canceled' WHERE hired_candidates.order_id='" . $id . "'");
		if ($result == "Success")
			echo "Order canceled successfully.";
		else
			echo $result;
	} else
		echo $result;
}

function getCandidateSkill() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$id = $_REQUEST["id"];
	$dbHelper = new DBHelper;
	$data = array();
	$data = $dbHelper -> getData($mysqli, 'sp_getCandidateSkill', array($id, ""));
	echo json_encode($data);
}

function getCandidateLocation() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$id = $_REQUEST["id"];
	$dbHelper = new DBHelper;
	$data = array();
	$data = $dbHelper -> getData($mysqli, 'sp_getCandidateLoc', array($id, ""));
	echo json_encode($data);
}

function toogleServiceCharge() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$id = $_REQUEST["id"];
	$applied = clean($_REQUEST["status"]);
	$result = $dbHelper -> performOperation($mysqli, 'sp_toggleServiceCharge', array($id, $applied));
	if ($result == "Success")
		echo "Service charge updated successfully.";
	else
		echo $result;
}

function rejectJob() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$id = $_REQUEST["id"];
	$reason = clean($_REQUEST["reason"]);
	$result = $dbHelper -> performOperation($mysqli, 'sp_updateHiredCanidateJobStatus', array($id, "Rejected", $reason));
	if ($result == "Success") {
		RefundCalculator::cancelationAgainstCandidateRejection($dbHelper, $mysqli, $id);
		echo "Job rejected successfully.";
	} else
		echo $result;
}

function startJob() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$id = $_REQUEST["id"];
	$mcode = clean($_REQUEST["mcode"]);
	$data = $dbHelper -> getData($mysqli, 'sp_verifyJobOtp', array($id, $mcode));
	if ((int)$data[0]["num"] > 0) {
		$result = $dbHelper -> performOperation($mysqli, 'sp_updateHiredCanidateJobStatus', array($id, "Joined", ''));
	} else {
		$result = "OTP not verified";
	}
	if ($result == "Success")
		echo "Job started successfully.";
	else
		echo $result;
}

function terminateJob() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$id = $_REQUEST["id"];
	$reason = clean($_REQUEST["reason"]);
	$result = $dbHelper -> performOperation($mysqli, 'sp_updateHiredCanidateJobStatus', array($id, "Terminated", $reason));
	if ($result == "Success") {
		RefundCalculator::cancelationAgainstTermination($dbHelper, $mysqli, $id);
		echo "Job terminated successfully.";
	} else
		echo $result;
}

function completeJob() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$id = $_REQUEST["id"];
	$result = $dbHelper -> performOperation($mysqli, 'sp_updateHiredCanidateJobStatus', array($id, "Completed", ''));
	if ($result == "Success")
		echo "Job completed successfully.";
	else
		echo $result;
}

function getAllEmployementHistory() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$dbHelper = new DBHelper;
	$cid = $_REQUEST["cid"];
	$data = array();
	$dataHiredCandidate = array();
	$dataHiredCandidate = $dbHelper -> getData($mysqli, "sp_getHiredCandidateByCid", array($cid));
	for ($i = 0; $i < count($dataHiredCandidate); $i++) {
		$datetime1 = new DateTime($dataHiredCandidate[$i]["from_date"]);
		$datetime2 = new DateTime($dataHiredCandidate[$i]["to_date"]);
		$interval = $datetime1 -> diff($datetime2);
		$dataHiredCandidate[$i]["exp"] = $interval -> format('%y years %m months and %d days');
		array_push($data, array("from_date" => $datetime1 -> format('Y-m-d'), "to_date" => $datetime2 -> format('Y-m-d'), "company_name" => $dataHiredCandidate[$i]["company_name"], "exp" => $dataHiredCandidate[$i]["exp"]));
	}
	$dataOld = array();
	$dataOld = $dbHelper -> getData($mysqli, "sp_getOldEmpHistoryBycid", array($cid));
	for ($i = 0; $i < count($dataOld); $i++) {
		$datetime1 = new DateTime($dataOld[$i]["start_date"]);
		$datetime2 = new DateTime($dataOld[$i]["end_date"]);
		$interval = $datetime1 -> diff($datetime2);
		$dataOld[$i]["exp"] = $interval -> format('%y years %m months and %d days');
		array_push($data, array("from_date" => $datetime1 -> format('Y-m-d'), "to_date" => $datetime2 -> format('Y-m-d'), "company_name" => $dataOld[$i]["comp_name"], "exp" => $dataOld[$i]["exp"]));
	}
	$ret = "<div style='margin-bottom: 10px;' class='row'>";
	if (count($data) > 0) {
		if (count($data) == 1 && $data[0]["company_name"] == 'NA')
			echo "NO";
		else {
			for ($i = 0; $i < count($data); $i++) {
				if ($data[$i]["company_name"] != 'NA') {
					$ret = $ret . "<div class='col-lg-3 col-md-3 col-sm-4 col-xs-12 box-in-popup'>
                            <div class='row'>
                                <div class='col-lg-12 col-sm-12 col-sm-12 col-xs-12'>
                                    <h5>" . $data[$i]["company_name"] . "</h5>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                                    <p>" . $data[$i]["from_date"] . " TO " . $data[$i]["to_date"] . "</p>
                                    <p>" . $data[$i]["exp"] . "</p>
                                </div>
                            </div>
                        </div>";
				}
			}
			$ret = $ret . "</div>";
			echo $ret;
		}

	} else
		echo "NO";

}

function addEmployementHistory() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$cid = $_REQUEST["cid"];
	$compName = clean($_REQUEST["comp_name"]);
	$compAddress = clean($_REQUEST["comp_address"]);
	$position = clean($_REQUEST["position"]);
	$contactPerson = clean($_REQUEST["contact_person"]);
	$pincode = clean($_REQUEST["pincode"]);
	$start_date = $_REQUEST["start_date"];
	$end_date = $_REQUEST["end_date"];
	$dbHelper = new DBHelper;
	$result = $dbHelper -> performOperation($mysqli, 'sp_insertOldEmpHistory', array($cid, $compName, $compAddress, $position, $contactPerson, $pincode, $start_date, $end_date));
	echo $result;
}

function updateEmployementHistory() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$id = $_REQUEST["id"];
	$cid = $_REQUEST["cid"];
	$compName = clean($_REQUEST["comp_name"]);
	$compAddress = clean($_REQUEST["comp_address"]);
	$position = clean($_REQUEST["position"]);
	$contactPerson = clean($_REQUEST["contact_person"]);
	$pincode = clean($_REQUEST["pincode"]);
	$start_date = $_REQUEST["start_date"];
	$end_date = $_REQUEST["end_date"];
	$dbHelper = new DBHelper;
	$result = $dbHelper -> performOperation($mysqli, 'sp_updateOldEmpHistory', array($id, $cid, $compName, $compAddress, $position, $contactPerson, $pincode, $start_date, $end_date));
	echo $result;
}

function getEmployementHistory() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$id = $_REQUEST["id"];
	$dbHelper = new DBHelper;
	$data = array();
	$data = $dbHelper -> getData($mysqli, 'sp_getOldEmpHistory', array($id));
	echo json_encode($data);
}

function getCandidateBankDetails() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$cid = $_REQUEST["cid"];
	$dbHelper = new DBHelper;
	$data = array();
	$data = $dbHelper -> getData($mysqli, 'sp_getBankDetails', array($cid));
	echo json_encode($data);
}

function getCount($name) {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$dbManager = new DBHelper;
	$data = array();
	$data = $dbManager -> getData($mysqli, 'sp_getCount', array($name));
	return $data[0]["num"];
}

function getLocalPage() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$dbManager = new DBHelper;
	$requestData = $_REQUEST;
	$columns = array(
	// datatable column index  => database column name
	0 => 'locality_name', 1 => 'pincode', 2 => 'area_name', 3 => 'district_name', 4 => 'state_name', 5 => 'locality_id', 6 => 'area_id', 7 => 'district_id', 8 => 'state_id');

	$totalData = getCount("locality");
	$totalFiltered = $totalData;
	$start = $requestData['start'];
	$end = $requestData['length'];
	$search = '';
	if (!empty($requestData['search']['value'])) {
		$search = $requestData['search']['value'];
	}
	$order = $columns[$requestData['order'][0]['column']];
	$orderDir = $requestData['order'][0]['dir'];

	$data = array();
	$data = $dbManager -> getData($mysqli, 'sp_getLocalityPaging', array($start, $end, $search, $order, $orderDir));
	if (!empty($requestData['search']['value']))
		$totalFiltered = count($data);
	$retData = array();
	for ($i = 0; $i < count($data); $i++) {
		$nestedData = array();
		$nestedData[] = $i + 1;
		$nestedData[] = isset($data[$i]["locality_name"]) ? $data[$i]["locality_name"] : '';
		$nestedData[] = isset($data[$i]["pincode"]) ? $data[$i]["pincode"] : '';
		$nestedData[] = isset($data[$i]["area_name"]) ? $data[$i]["area_name"] : '';
		$nestedData[] = isset($data[$i]["district_name"]) ? $data[$i]["district_name"] : '';
		$nestedData[] = isset($data[$i]["state_name"]) ? $data[$i]["state_name"] : '';
		$id = isset($data[$i]["locality_id"]) ? $data[$i]["locality_id"] : '';
		$nestedData[] = "<a href='admin.php?action=edit_locality&id=" . $id . "' class='col-teal'><i class='material-icons'>create</i></a>&nbsp; <a href='javascript:void(0)' onclick='DeleteDistrict('" . $id . "') class='col-teal'><i class='material-icons'>delete</i></a>";
		$retData[] = $nestedData;
	}
	$json_data = array("draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
	"recordsTotal" => intval($totalData), // total number of records
	"recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
	"data" => $retData // total data array
	);

	echo json_encode($json_data);

}

function getAttendancePage() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$dbManager = new DBHelper;
	$requestData = $_REQUEST;
	$columns = array(
	// datatable column index  => database column name
	0 => 't1date', 1 => 't1date', 2 => 'title', 3 => 't3name', 4 => 't3skillmitra', 5 => 't2date', 6 => 't1date', 7 => 't1date', 8 => 't1date');

	$query = "SELECT count(*) as num  FROM
    candidate_attendance
    WHERE candidate_attendance.type='IN'";

	$countData = $dbManager -> getDataFromQuery($mysqli, $query);
	$totalData = $countData[0]["num"];
	$totalFiltered = $totalData;
	$start = $requestData['start'];
	$end = $requestData['length'];

	$search = '';
	if (!empty($requestData['search']['value'])) {
		$search = $requestData['search']['value'];
	}
	$order = $columns[$requestData['order'][0]['column']];
	$orderDir = $requestData['order'][0]['dir'];

	$data = array();
	$data = $dbManager -> getData($mysqli, 'sp_getAttendancePaging', array($start, $end, $search, $order, $orderDir));
	if (!empty($requestData['search']['value']))
		$totalFiltered = count($data);
	$retData = array();
	for ($i = 0; $i < count($data); $i++) {
		$t1lat = isset($data[$i]["t1lat"]) ? $data[$i]["t1lat"] : '';
		$t1long = isset($data[$i]["t1long"]) ? $data[$i]["t1long"] : '';
		$t2lat = isset($data[$i]["t2lat"]) ? $data[$i]["t2lat"] : '';
		$t2long = isset($data[$i]["t2long"]) ? $data[$i]["t2long"] : '';
		$valid = isset($data[$i]["valid"]) ? $data[$i]["valid"] : '';
		$t1date = isset($data[$i]["t1date"]) ? $data[$i]["t1date"] : '';
		$t1cid = isset($data[$i]["t1cid"]) ? $data[$i]["t1cid"] : '';
		$nestedData = array();
		$nestedData[] = "<input type='checkbox' value='" . $t1cid . "_" . $t1date . "' class='new-ckeck' name='id[]' id='check' />";
		$nestedData[] = $i + 1;
		$nestedData[] = (isset($data[$i]["title"]) ? $data[$i]["title"] : '') . '<br />' . (isset($data[$i]["address"]) ? $data[$i]["address"] : '');
		$nestedData[] = isset($data[$i]["t3name"]) ? $data[$i]["t3name"] : '';
		$nestedData[] = isset($data[$i]["t3skillmitra"]) ? $data[$i]["t3skillmitra"] : '';
		$nestedData[] = (isset($data[$i]["t1date"]) ? $data[$i]["t1date"] : '') . '<br />' . "<a href='https://maps.googleapis.com/maps/api/staticmap?center=" . $t1lat . "," . $t1long . "&markers=color:red%7Clabel:C%7C" . $t1lat . "," . $t1long . "&zoom=12&size=600x400&key=AIzaSyBzK712U1ci_ZxJrbLt7O4iGdxBQJeEbE0' class='col-teal' target='_blank'>View on map</a>";
		$nestedData[] = (isset($data[$i]["t2date"]) ? $data[$i]["t2date"] : '') . '<br />' . "<a href='https://maps.googleapis.com/maps/api/staticmap?center=" . $t2lat . "," . $t2long . "&markers=color:red%7Clabel:C%7C" . $t2lat . "," . $t2long . "&zoom=12&size=600x400&key=AIzaSyBzK712U1ci_ZxJrbLt7O4iGdxBQJeEbE0' class='col-teal' target='_blank'>View on map</a>";
		$validityString = "<i class='material-icons' style='color: green;'>done</i>";
		if ($valid == "NO")
			$validityString = "<i class='material-icons' style='color: red;'>close</i>";
		$nestedData[] = $validityString;
		$attString = "";
		$q = "SELECT COUNT(*) AS 'num' FROM daily_delivery WHERE date(daily_delivery.added_date)=date('" . $t1date . "')";
		$r = mysqli_query($mysqli, $q);
		$v = mysqli_fetch_assoc($r);
		if (intval($v["num"]) > 0)
			$attString = "<i class='material-icons' style='color: green;'>done</i>";
		else {
			$attString = "<i class='material-icons' style='color: red;'>close</i>";
		}
		$nestedData[] = $attString;
		$retData[] = $nestedData;
	}
	$json_data = array("draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
	"recordsTotal" => intval($totalData), // total number of records
	"recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
	"data" => $retData // total data array
	);

	echo json_encode($json_data);

}

function getDailyDeliveryPage() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$dbManager = new DBHelper;
	$requestData = $_REQUEST;
	$columns = array(
	// datatable column index  => database column name
	0 => 'title', 1 => 'mem_name', 2 => 'shift', 3 => 'type', 4 => 'total_pkt', 5 => 'done_pkt', 6 => 'attempt_pkt', 7 => 'reject_pkt', 8 => 'eff_pkt', 9 => 'rate_per_pkt', 10 => 'sub_pkt', 11 => 'open_km', 12 => 'close_km', 13 => 'run_km', 14 => 'rate_km', 15 => 'sub_km', 16 => 'incentive', 17 => 'total', 18 => 'status', 19 => 'delivery_date', 20 => 'delivery_date', 21 => 'delivery_date');
	$uid = $requestData['uid'];
	$query = "Select count(*) as num from daily_delivery ";
	if ($uid != "")
		$query = $query . "where uid='" . $uid . "'";
	$countData = $dbManager -> getDataFromQuery($mysqli, $query);
	$totalData = $countData[0]["num"];
	$totalFiltered = $totalData;
	$start = $requestData['start'];
	$end = $requestData['length'];

	$search = '';
	if (!empty($requestData['search']['value'])) {
		$search = $requestData['search']['value'];
	}
	$order = $columns[$requestData['order'][0]['column']];
	$orderDir = $requestData['order'][0]['dir'];

	$data = array();
	$data = $dbManager -> getData($mysqli, 'sp_getDailyDeliveryPaging', array($start, $end, $search, $order, $orderDir, $uid));
	if (!empty($requestData['search']['value']))
		$totalFiltered = count($data);
	$retData = array();
	for ($i = 0; $i < count($data); $i++) {
		$nestedData = array();
		$nestedData[] = $i + 1;
		$nestedData[] = (isset($data[$i]["title"]) ? $data[$i]["title"] : '') . '<br />' . (isset($data[$i]["address"]) ? $data[$i]["address"] : '');
		$nestedData[] = isset($data[$i]["mem_name"]) ? $data[$i]["mem_name"] : '';
		$nestedData[] = isset($data[$i]["shift"]) ? $data[$i]["shift"] : '';
		$nestedData[] = isset($data[$i]["type"]) ? $data[$i]["type"] : '';
		$nestedData[] = isset($data[$i]["total_pkt"]) ? $data[$i]["total_pkt"] : '';

		$nestedData[] = isset($data[$i]["done_pkt"]) ? $data[$i]["done_pkt"] : '';
		$nestedData[] = isset($data[$i]["attempt_pkt"]) ? $data[$i]["attempt_pkt"] : '';
		$nestedData[] = isset($data[$i]["reject_pkt"]) ? $data[$i]["reject_pkt"] : '';
		$nestedData[] = isset($data[$i]["eff_pkt"]) ? $data[$i]["eff_pkt"] : '';

		$nestedData[] = isset($data[$i]["rate_per_pkt"]) ? $data[$i]["rate_per_pkt"] : '';
		$nestedData[] = isset($data[$i]["sub_pkt"]) ? $data[$i]["sub_pkt"] : '';
		$nestedData[] = isset($data[$i]["open_km"]) ? $data[$i]["open_km"] : '';
		$nestedData[] = isset($data[$i]["close_km"]) ? $data[$i]["close_km"] : '';

		$nestedData[] = isset($data[$i]["run_km"]) ? $data[$i]["run_km"] : '';
		$nestedData[] = isset($data[$i]["rate_km"]) ? $data[$i]["rate_km"] : '';
		$nestedData[] = isset($data[$i]["sub_km"]) ? $data[$i]["sub_km"] : '';
		$nestedData[] = isset($data[$i]["incentive"]) ? $data[$i]["incentive"] : '';

		$nestedData[] = isset($data[$i]["total"]) ? $data[$i]["total"] : '';
		$nestedData[] = isset($data[$i]["status"]) ? $data[$i]["status"] : '';
		$nestedData[] = isset($data[$i]["delivery_date"]) ? $data[$i]["delivery_date"] : '';
		$id = isset($data[$i]["id"]) ? $data[$i]["id"] : '';
		$status = isset($data[$i]["status"]) ? $data[$i]["status"] : '';
		$actionString = "<a href='admin.php?action=edit_daily_delivery&id=" . $id . "&uid=" . $uid . "' class='col-teal'><i class='material-icons'>create</i></a>&nbsp; <a href='javascript:void(0)' onclick='Delete(" . $id . "," . $uid . ")' class='col-teal'><i class='material-icons'>delete</i></a>";
		if ($status == "Rejected" || $status == "Pending")
			$actionString = $actionString . "<a href='admin.php?action=status_daily_delivery&id=" . $id . "&status=Approved&uid=" . $uid . "'  class='col-teal'>Approve</a>";
		else if ($status == "Approved" || $status == "Pending")
			$actionString = $actionString . "<a href='admin.php?action=status_daily_delivery&id=" . $id . "&status=Rejected&uid=" . $uid . "'  class='col-teal'>Reject</a>";
		$nestedData[] = $actionString;
		$retData[] = $nestedData;
	}
	$json_data = array("draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
	"recordsTotal" => intval($totalData), // total number of records
	"recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
	"data" => $retData // total data array
	);

	echo json_encode($json_data);

}

function getBlogPage() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$dbManager = new DBHelper;
	$pageNum = $_REQUEST["page_no"];
	$pageSize = $_REQUEST["page_size"];
	$role = $_REQUEST['role'];
	$data = array();
	$data = $dbManager -> getData($mysqli, 'sp_getBlogWithPaging', array($pageNum, $pageSize, $role));

	for ($i = 0; $i < count($data); $i++) {
		$data[$i]["title"] = html_entity_decode($data[$i]["title"]);
		$data[$i]["content"] = html_entity_decode($data[$i]["content"]);

		preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $data[$i]["content"], $image);
		if (!isset($image[1])) {
			$image[1] = null;
		}
		$data[$i]["img_path"] = "http://skillchamps.in/admin/" . $image[1];
		$data[$i]["content"] = "";
	}

	if (count($data) > 0)
		echo json_encode($data);
	else
		echo "NO";

}

function deleteShortlistedCandidate() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$avId = $_REQUEST["av_id"];
	$hireCandidate = new HireCandidate;
	$dbHelper = new DBHelper;
	$result = $hireCandidate -> deleteShortlitedCandidateByAv($dbHelper, $mysqli, $avId);
	echo $result;
}

function deleteCartCandidate() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$avId = $_REQUEST["av_id"];
	$hireCandidate = new HireCandidate;
	$dbHelper = new DBHelper;
	$result = $hireCandidate -> deleteCartCandidateByAv($dbHelper, $mysqli, $avId);
	echo $result;
}

function get_availability_by_id() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$avId = $_REQUEST["av_id"];
	$dbHelper = new DBHelper;
	$data = array();
	$data = $dbHelper -> getData($mysqli, 'sp_getAvailabilityById', array($avId));
	echo json_encode($data);
}

function get_emp_jobs_by_id() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$empjobid = $_REQUEST["emp_job_id"];
	$dbHelper = new DBHelper;
	$data = array();
	$data = $dbHelper -> getData($mysqli, 'sp_getEmpJobsbyId', array($empjobid));
	echo json_encode($data);
}

function getEmpJobLocationById() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$id = $_REQUEST["id"];
	$dbHelper = new DBHelper;
	$data = array();
	$data = $dbHelper -> getData($mysqli, 'sp_getEmpJobLocation', array('', $id));
	echo json_encode($data);
}

function hireCandidate() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$empJobId = $_REQUEST["emp_job_id"];
	$avId = $_REQUEST["av_id"];
	$mobilecode = sprintf("%06d", mt_rand(200000, 999999));
	$hireCandidate = new HireCandidate;
	$dbHelper = new DBHelper;
	$availability = array();
	$availability = $dbHelper -> getData($mysqli, 'sp_getAvailabilityById', array($avId));
	$job = array();
	$job = $dbHelper -> getData($mysqli, 'sp_getEmpJobsbyId', array($empJobId));
	$params = array($availability[0]["cid"], $availability[0]["from_date"], $availability[0]["to_date"], $availability[0]["from_time"], $availability[0]["to_time"], $availability[0]["period"], $availability[0]["job_type_id"], $availability[0]["exp_sal"], $job[0]["t1id"], $job[0]["eid"], $job[0]["from_date"], $job[0]["to_date"], $job[0]["from_time"], $job[0]["to_time"], $job[0]["period"], $job[0]["job_type_id"], $job[0]["sal"], $avId, $availability[0]["state"], $availability[0]["district"], $availability[0]["area"], $availability[0]["locality"], $availability[0]["job_sector"], $availability[0]["job_role"], $availability[0]["skill"], $mobilecode, $job[0]["emp_job_loc_id"]);
	$result = $dbHelper -> multiquery($mysqli, 'trs_hireCandidate', $params, "Select @fromdate,@toDate,@mobile,@comp,@address;", array('@fromdate', '@toDate', '@mobile', '@comp', '@address'));
	if ($result[0] == "Success") {
		echo "Candidate hired successfully.";
		$mobile = $result[3];
		$compName = urlencode($result[4]);
		$address = urlencode($result[5]);
		$message = "You%20have%20been%20hired%20for%20period%20$result[1]%20to%20$result[2]%20by%20$compName.%20Reporting%20address%20is%20$address.%20OTP%20for%20joining%20is%20:%20$mobilecode.";
		sendSms($mobile, $message);
	} else
		echo $result[0];
}

function rehireCandidate() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$empJobId = $_REQUEST["emp_job_id"];
	$candidateId = $_REQUEST["cid"];
	$mobilecode = sprintf("%06d", mt_rand(200000, 999999));
	$dbHelper = new DBHelper;
	$job = array();
	$job = $dbHelper -> getData($mysqli, 'sp_getEmpJobsbyId', array($empJobId));
	$availability = array();
	$availability = $dbHelper -> getData($mysqli, 'sp_getAvailabilityForRehire', array($candidateId, $job[0]["from_date"], $job[0]["to_date"], $job[0]["job_type_id"]));

	if (count($availability) > 0) {
		$params = array($availability[0]["cid"], $availability[0]["from_date"], $availability[0]["to_date"], $availability[0]["from_time"], $availability[0]["to_time"], $availability[0]["period"], $availability[0]["job_type_id"], $availability[0]["exp_sal"], $job[0]["t1id"], $job[0]["eid"], $job[0]["from_date"], $job[0]["to_date"], $job[0]["from_time"], $job[0]["to_time"], $job[0]["period"], $job[0]["job_type_id"], $job[0]["sal"], $availability[0]["id"], $availability[0]["state"], $availability[0]["district"], $availability[0]["area"], $availability[0]["locality"], $availability[0]["job_sector"], $availability[0]["job_role"], $availability[0]["skill"], $mobilecode, $job[0]["emp_job_loc_id"]);
		$result = $dbHelper -> multiquery($mysqli, 'trs_hireCandidate', $params, "Select @fromdate,@toDate,@mobile,@comp,@address;", array('@fromdate', '@toDate', '@mobile', '@comp', '@address'));
		if ($result[0] == "Success") {
			echo "Candidate hired successfully.";
			$mobile = $result[3];
			$compName = urlencode($result[4]);
			$address = urlencode($result[5]);
			$message = "You%20have%20been%20hired%20for%20period%20$result[1]%20to%20$result[2]%20by%20$compName.%20Reporting%20address%20is%20$address.%20OTP%20for%20joining%20is%20:%20$mobilecode.";
			//echo $message;
			sendSms($mobile, $message);
		} else
			echo $result[0];
	} else
		echo "Candidate is not available for rehire.";
}

function forgotUserPassword() {
	$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$msisdn = $_REQUEST["mobile"];
	$q = "select id from members where username='" . $msisdn . "'";
	$r = $link -> query($q);
	if ($r -> num_rows > 0) {
		$password = random_password(6);
		$message = "Your%20 new %20Password:%20" . $password;
		$varUserName = "t1cybssapi";
		$varPWD = "55200745";
		$varSenderID = "CHAMPS";
		$varPhNo = $msisdn;
		$varMSG = $message;
		$url = "http://nimbusit.co.in/api/swsendSingle.asp";
		$data = "username=" . $varUserName . "&password=" . $varPWD . "&sender=" . $varSenderID . "&sendto=" . $varPhNo . "&message=" . $varMSG;
		$password = hash('sha512', $password);
		$random_salt = hash('sha512', uniqid(rand(1, 10000000), TRUE));
		$password = hash('sha512', $password . $random_salt);
		$q = "update members set password = '" . $password . "', salt = '" . $random_salt . "' where username = '" . $msisdn . "'";
		mysqli_query($link, $q);
		postData($url, $data);
		echo "Password sent";
	} else {
		echo "Invalid Mobile";
	}
}

function change_user_password() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$uid = $_SESSION["flexihire_user_id"];
	$password = $_REQUEST["p"];
	$random_salt = hash('sha512', uniqid(rand(1, 10000000), TRUE));
	$password = hash('sha512', $password . $random_salt);
	$q = "update members set password = '" . $password . "', salt = '" . $random_salt . "' where id = '" . $uid . "'";
	$mysqli -> query($q);
}

function getJobsRoleBySector() {
	$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$sector = $_REQUEST["sector"];
	$q = "select * from courses
			 where sector='" . $sector . "'
			    order by course_name ASC";
	$r = mysqli_query($link, $q) or die(mysqli_error());
	$str = "0~ Select Job Role ";
	while ($v = mysqli_fetch_assoc($r)) {
		$str .= "^" . $v["course_id"] . "~" . $v['course_name'];
	}
	echo $str;
}

function getJobsRoleBySectorId() {
	$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$sector = clean($_REQUEST["sector"]);
	$q = "call sp_getCourseBySectorId('" . $sector . "')";
	$r = mysqli_query($link, $q) or die(mysqli_error($link));
	$str = "0~  Select Job Role  ";
	while ($v = mysqli_fetch_assoc($r)) {
		$str .= "^" . $v["course_id"] . "~" . $v['course_name'];
	}
	echo $str;
}

function getDistrictByStateId() {
	$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$state = clean($_REQUEST["state"]);
	$dbManager = new DBHelper;
	$r = $dbManager -> getData($link, 'sp_getDistrictByStateId', array($state));
	$str = "0~  Select District ";
	for ($i = 0; $i < count($r); $i++) {
		$str .= "^" . $r[$i]["district_id"] . "~" . $r[$i]['district_name'];
	}
	echo $str;
}

function getAreaByDistrictId() {
	$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$district = clean($_REQUEST["district"]);
	//echo $district;
	$dbManager = new DBHelper;
	$r = $dbManager -> getData($link, 'sp_getAreaByDistrictId', array($district));
	$str = "0~ Select Area ";
	for ($i = 0; $i < count($r); $i++) {
		$str .= "^" . $r[$i]["area_id"] . "~" . $r[$i]['area_name'];
	}
	echo $str;
}

function getLocalityByAreaId() {
	$str = "";
	$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$area = clean($_REQUEST["area"]);
	$dbManager = new DBHelper;
	$r = $dbManager -> getData($link, 'sp_getLocalityByAreaId', array($area));
	for ($i = 0; $i < count($r); $i++) {
		$str .= $r[$i]["locality_id"] . "~" . $r[$i]['locality_name'] . "(" . $r[$i]['pincode'] . ")" . "^";
	}
	$str = str_replace_last("^", "", $str);
	echo $str;
}

function getSkillsByJobRoleId() {
	$str = "";
	$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$sector = clean($_REQUEST["course"]);
	$q = "call sp_getSkillByCourseId('" . $sector . "')";
	$r = mysqli_query($link, $q) or die(mysqli_error($link));
	while ($v = mysqli_fetch_assoc($r)) {
		$str .= $v["skill_id"] . "~" . $v['skill_name'] . "^";
	}
	$str = str_replace_last("^", "", $str);
	echo $str;
}

function getCandidateVideo() {
	$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$cid = $_REQUEST["cid"];
	$q = "select * from videos where uid='" . $cid . "' and status='Approved' order by vid asc limit 0,1";
	$r = $link -> query($q);
	if ($r -> num_rows > 0) {
		$v = $r -> fetch_array(MYSQLI_ASSOC);
		if ($v["vtype"] == "mp4")
			echo '<video width="100%" height="auto" controls>
          <source src="videos/' . $v["uid"] . '/' . $v["video"] . '" type="video/mp4">
             Your browser does not support the video tag.
          </video>
          <input type="hidden" id="cvid" value="' . $v["vid"] . '">
                     <input type="hidden" id="cid" value="' . $v["uid"] . '">';
		else if ($v["vtype"] == "drive")
			echo '<video width="100%" height="auto" controls>
          <source src="https://drive.google.com/uc?export=download&id=' . $v["video"] . '" type="video/mp4">
             Your browser does not support the video tag.
          </video>
          <input type="hidden" id="cvid" value="' . $v["vid"] . '">
                     <input type="hidden" id="cid" value="' . $v["uid"] . '">';
		else
			echo '<iframe width="100%" height="auto" src="https://www.youtube.com/embed/' . $v["video"] . '" frameborder="0" allowfullscreen></iframe>
               <input type="hidden" id="cvid" value="' . $v["vid"] . '">
             <input type="hidden" id="cid" value="' . $v["uid"] . '">';
	} else {
		echo "NO";
	}

}

function getCandidateNextVideo() {
	$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$cid = $_REQUEST["cid"];
	$vid = $_REQUEST["vid"];
	$q = "select * from videos where uid='" . $cid . "' and vid > '" . $vid . "' and status='Approved' order by vid asc limit 0,1";
	$r = $link -> query($q);
	if ($r -> num_rows > 0) {
		$v = $r -> fetch_array(MYSQLI_ASSOC);
		if ($v["vtype"] == "mp4")
			echo '<video width="100%" height="auto" controls>
              <source src="videos/' . $v["uid"] . '/' . $v["video"] . '" type="video/mp4">
                 Your browser does not support the video tag.
              </video>
              <input type="hidden" id="cvid" value="' . $v["vid"] . '">
                 <input type="hidden" id="cid" value="' . $v["uid"] . '">
              ';
		else if ($v["vtype"] == "drive")
			echo '<video width="100%" height="auto" controls>
          <source src="https://drive.google.com/uc?export=download&id=' . $v["video"] . '" type="video/mp4">
             Your browser does not support the video tag.
          </video>
          <input type="hidden" id="cvid" value="' . $v["vid"] . '">
                     <input type="hidden" id="cid" value="' . $v["uid"] . '">';
		else
			echo '<iframe width="100%" height="auto" src="https://www.youtube.com/embed/' . $v["video"] . '" frameborder="0" allowfullscreen></iframe>
                   <input type="hidden" id="cvid" value="' . $v["vid"] . '">
                 <input type="hidden" id="cid" value="' . $v["uid"] . '">';
	} else {
		echo "NO";
	}
}

function getCandidatePrevVideo() {
	$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$cid = $_REQUEST["cid"];
	$vid = $_REQUEST["vid"];
	$q = "select * from videos where uid='" . $cid . "' and vid < '" . $vid . "' and status='Approved' order by vid desc limit 0,1";
	$r = $link -> query($q);
	if ($r -> num_rows > 0) {
		$v = $r -> fetch_array(MYSQLI_ASSOC);
		if ($v["vtype"] == "mp4")
			echo '<video width="100%" height="auto" controls>
              <source src="videos/' . $v["uid"] . '/' . $v["video"] . '" type="video/mp4">
                 Your browser does not support the video tag.
              </video>
              <input type="hidden" id="cvid" value="' . $v["vid"] . '">
                 <input type="hidden" id="cid" value="' . $v["uid"] . '">
              ';
		else if ($v["vtype"] == "drive")
			echo '<video width="100%" height="auto" controls>
          <source src="https://drive.google.com/uc?export=download&id=' . $v["video"] . '" type="video/mp4">
             Your browser does not support the video tag.
          </video>
          <input type="hidden" id="cvid" value="' . $v["vid"] . '">
                     <input type="hidden" id="cid" value="' . $v["uid"] . '">';
		else
			echo '<iframe width="100%" height="auto" src="https://www.youtube.com/embed/' . $v["video"] . '" frameborder="0" allowfullscreen></iframe>
                   <input type="hidden" id="cvid" value="' . $v["vid"] . '">
                 <input type="hidden" id="cid" value="' . $v["uid"] . '">';

	} else {
		echo "NO";
	}

}

function checkAuthentication() {
	$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$u = $_REQUEST["u"];
	$p = $_REQUEST["p"];
	$cat = $_REQUEST["cat"];
	$user_role = "";
	$ret;
	if ($cat == "Candidate") {
		$user_role = "200";
	} else if ($cat == "Trainee") {
		$user_role = "300";
	} else if ($cat == "Employer") {
		$user_role = "400";
	} else if ($cat == "Guru") {
		$user_role = "500";
	} else if ($cat == "SkillMitra") {
		$user_role = "700";
	} else if ($cat == "TrainingCenter") {
		$user_role = "600";
	}
	if ($user_role == "400") {
		$q = "SELECT id, username, password, salt ,user_role,user_status
            FROM members WHERE username = '" . $u . "' and (user_role='" . $user_role . "' or user_role='800')";
		$r = mysqli_query($link, $q);
		if (mysqli_num_rows($r) > 0) {
			$v = mysqli_fetch_assoc($r);
			$status = $v["user_status"];
			$user_role = $v["user_role"];
			if (($user_role != '800' && $status == 'Active') || $user_role == '800') {
				$salt = $v["salt"];
				$db_password = $v["password"];
				$p = hash('sha512', $p . $salt);
				$user_id = $v["id"];
				$username = $v["username"];
				if ($db_password == $p) {
					$user_browser = $_SERVER['HTTP_USER_AGENT'];
					// XSS protection as we might print this value
					$user_id = preg_replace("/[^0-9]+/", "", $user_id);
					$_SESSION["flexihire_user_id"] = $user_id;
					$_SESSION["flexihire_user_role"] = $user_role;
					$_SESSION['timeout'] = time();
					// XSS protection as we might print this value
					$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);
					$_SESSION['flexihire_user_name'] = $username;
					// Login successful.
					$_SESSION['timeout'] = time();
					$q1 = "SELECT * FROM member_details WHERE uid = '" . $user_id . "' limit 0,1";
					$r1 = mysqli_query($link, $q1);
					$v1 = mysqli_fetch_assoc($r1);
					echo json_encode(array("msg" => "Success", "user_role" => $user_role, "status" => $status));
				} else {
					echo json_encode(array("msg" => "Invalid User", "user_role" => "", "status" => ""));
				}
			} else {
				echo json_encode(array("msg" => "Invalid User", "user_role" => "", "status" => ""));
			}
		} else {
			echo json_encode(array("msg" => "Invalid User", "user_role" => "", "status" => ""));
		}
	} else {
		$q = "SELECT id, username, password, salt ,user_role,user_status
            FROM members WHERE username = '" . $u . "' and user_role='" . $user_role . "'  and user_status='Active'";
		$r = mysqli_query($link, $q);
		if (mysqli_num_rows($r) > 0) {
			$v = mysqli_fetch_assoc($r);
			$salt = $v["salt"];
			$status = $v["user_status"];
			$db_password = $v["password"];
			$p = hash('sha512', $p . $salt);
			$user_id = $v["id"];
			$user_role = $v["user_role"];
			$username = $v["username"];
			if ($db_password == $p) {
				$user_browser = $_SERVER['HTTP_USER_AGENT'];
				// XSS protection as we might print this value
				$user_id = preg_replace("/[^0-9]+/", "", $user_id);
				$_SESSION["flexihire_user_id"] = $user_id;
				$_SESSION["flexihire_user_role"] = $user_role;
				$_SESSION['timeout'] = time();
				// XSS protection as we might print this value
				$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);
				$_SESSION['flexihire_user_name'] = $username;
				// Login successful.
				$_SESSION['timeout'] = time();
				$q1 = "SELECT * FROM member_details WHERE uid = '" . $user_id . "' limit 0,1";
				$r1 = mysqli_query($link, $q1);
				$v1 = mysqli_fetch_assoc($r1);
				echo json_encode(array("msg" => "Success", "user_role" => $user_role, "status" => $status));
			} else {
				echo json_encode(array("msg" => "Invalid User", "user_role" => "", "status" => ""));
			}
		} else {
			echo json_encode(array("msg" => "Invalid User", "user_role" => "", "status" => ""));
		}
	}
}

function shortlistCandidates() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$cid = $_REQUEST["cid"];
	$eid = $_REQUEST["eid"];
	$empJobId = $_REQUEST["emp_job_id"];
	$avId = $_REQUEST["av_id"];
	$hireCandidate = new HireCandidate;
	$dbHelper = new DBHelper;
	$result = $hireCandidate -> shortlistCandidateAdmin($dbHelper, $mysqli, $cid, $eid, $empJobId, $avId);
	if ($result == "Success")
		echo "Candidate shortlisted successfully.";
	else
		echo $result;
}

function addToCartCandidate() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$cid = $_REQUEST["cid"];
	$eid = $_REQUEST["eid"];
	$empJobId = $_REQUEST["emp_job_id"];
	$avId = $_REQUEST["av_id"];
	$hireCandidate = new HireCandidate;
	$user = new User;
	$dbHelper = new DBHelper;
	if ($user -> checkSubscription($dbHelper, $mysqli, $eid, $_REQUEST["REQUEST"], "temp_cart", "added_date", "cart_eid")) {
		$check = $hireCandidate -> checkCandidateAvailabilityForAddToCart($dbHelper, $mysqli, $empJobId, $avId);
		if ($check[1] == "0") {
			$result = $hireCandidate -> addToCartCandidateAdmin($dbHelper, $mysqli, $cid, $eid, $empJobId, $avId, $check[2], $check[3], $check[5], $check[6], $check[4], $check[7]);
			if ($result == "Success")
				echo "Candidate addedd to cart successfully.";
			else
				echo $result;
		} else
			echo $check[0];
	} else {
		echo 'Please upgrade your subscription plan.';
	}

}

function UpdateVideoStatus() {
	$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$vid = $_REQUEST["vid"];
	$status = clean($_REQUEST["status"]);
	$q = "update videos set status = '" . $status . "' where video_id = '" . $vid . "'";
	mysqli_query($link, $q);
	echo "Status updated successfully";
}

function UpdateUserStatus() {
	$mailer = new Mailer;
	$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$uid = $_REQUEST["uid"];
	$status = clean($_REQUEST["status"]);
	if ($status == "Active") {
		$status = "Inactive";
	} else {
		$status = "Active";
	}
	$q = "update members set user_status = '" . $status . "' where id = '" . $uid . "'";
	mysqli_query($link, $q);
	if ($status == "Active") {
		$q1 = "select members.user_role,member_details.name,member_details.mobile,member_details.email from member_details left outer join members on member_details.uid=members.id where member_details.uid='" . $uid . "'";
		$r1 = mysqli_query($link, $q1);
		$v1 = mysqli_fetch_assoc($r1);
		$msisdn = $v1["mobile"];
		$password = random_password(6);
		$message = "Login Details - Username: " . $msisdn . " and Password: " . $password;
		$varUserName = "t1cybssapi";
		$varPWD = "55200745";
		$varSenderID = "CHAMPS";
		$varPhNo = $msisdn;
		$varMSG = $message;
		$url = "http://nimbusit.co.in/api/swsendSingle.asp";
		$data = "username=" . $varUserName . "&password=" . $varPWD . "&sender=" . $varSenderID . "&sendto=" . $varPhNo . "&message=" . $varMSG;
		$pwd = $password;
		$password = hash('sha512', $password);
		$random_salt = hash('sha512', uniqid(rand(1, 10000000), TRUE));
		$password = hash('sha512', $password . $random_salt);
		$q = "update members set password = '" . $password . "', salt = '" . $random_salt . "' where id = '" . $uid . "'";
		mysqli_query($link, $q);
		postData($url, $data);
		if ($v1["user_role"] == "700") {
			sendEmailSkillMitra($v1["email"], $v1["name"], $msisdn, $pwd);
		} else {
			$subject1 = "Flexihire - Account Activated";
			$message1 = "Dear Sir/Mam,<br>Your account has been successfully activated.<br><br>" . $message . "
            <br><br>Team<br>
            FLEXIHIRE";
			$emailfrom = "admin@flexihire.co.in";
			$mailer -> sendMail($v1["email"], $emailfrom, $subject1, $message1, "", "");
		}

	}
	echo "Status updated successfully";
}

function UpdateEnterpriseStatus() {
	$mailer = new Mailer;
	$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$uid = $_REQUEST["uid"];
	$status = clean($_REQUEST["status"]);
	$creditLimit = clean($_REQUEST["credit"]);
	$payCycle = clean($_REQUEST["pcycle"]);
	$dbHelper = new DBHelper;
	if ($status == "Active") {
		$status = "Inactive";
	} else {
		$status = "Active";
	}
	$q1 = "select members.user_role,member_details.name,member_details.mobile,member_details.email from member_details left outer join members on member_details.uid=members.id where member_details.uid='" . $uid . "'";
	$r1 = mysqli_query($link, $q1);
	$v1 = mysqli_fetch_assoc($r1);
	$msisdn = $v1["mobile"];
	$sql = "";
	if ($creditLimit == "")
		$creditLimit = 0;
	if ($payCycle == "")
		$payCycle = 0;
	$q = "update members set user_status = '" . $status . "' where id = '" . $uid . "'";
	$result = $dbHelper -> performFromQuery($link, $q);
	$q1 = "update member_details set credit_limit = '" . $creditLimit . "' , pay_cycle='" . $payCycle . "' where uid = '" . $uid . "'";
	$result = $dbHelper -> performFromQuery($link, $q1);
	if ($result == "Success" && $status == "Active") {
		echo "Status updated successfully";
		$varUserName = "t1cybssapi";
		$varPWD = "55200745";
		$varSenderID = "CHAMPS";
		$varPhNo = $msisdn;
		$varMSG = "Your%20account%20has%20been%20successfully%20activated.Your%20credit%20limit%20is%20Rs." . $creditLimit . "%20and%20pay%20cycle%20is%20" . $payCycle . "%20days.";
		$url = "http://nimbusit.co.in/api/swsendSingle.asp";
		$data = "username=" . $varUserName . "&password=" . $varPWD . "&sender=" . $varSenderID . "&sendto=" . $varPhNo . "&message=" . $varMSG;
		postData($url, $data);
		$subject1 = "Flexihire - Account Activated";
		$message1 = "Dear Sir/Mam,<br>Your account has been successfully activated.Your credit limit is Rs." . $creditLimit . " and pay cycle is " . $payCycle . " days. 
        <br><br>Team<br>
        FLEXIHIRE";
		$emailfrom = "admin@flexihire.co.in";
		$mailer -> sendMail($v1["email"], $emailfrom, $subject1, $message1, "", "");
	} else {
		echo "Please try again";
	}

}

function sendEmailSkillMitra($email, $name, $msisdn, $password) {
	$mailer = new Mailer;
	$emailfrom = "admin@flexihire.co.in";
	$fromname = "FLEXIHIRE";
	$subject = "Flexihire - Account Activated";
	$hello = "Hi " . $name . ",";
	$text = "Your account has been successfully activated.Your Login details is Username: " . $msisdn . " and Password: " . $password . ".";
	$message = "<table style='width: 100%;' cellpadding='0' cellspacing='0'>" . "        <tr>" . "            <td style='background: #fff; height: 100px;' align='center'><img width='400px;' src='http://flexihire.co.in/assets/images/mailer/logo.png'></td>" . "        </tr>" . "        <tr>" . "            <td style='background:#4d4d4d;'><img width='100%;' src='http://flexihire.co.in/assets/images/mailer/banner.jpg'></td>" . "        </tr>" . "        <tr>" . "            <td style='background:radial-gradient(#757474 5%, #4d4d4d 60%); padding:150px 100px 150px 100px;'>" . "                <h1 style='color: #fff;'>" . $hello . "</h1>" . "                <br>" . "                <p style='color: #fff; font-size: 38px; text-align: justify;'>" . $text . "</p>" . "                <br>" . "                <br>" . "                <p style='color: #fff; font-size: 38px;'>Regards<br>FLEXIHIRE TEAM</p>" . "            </td>" . "        </tr>" . "        <tr>" . "            <td style=''>" . "                <a href='http://flexihire.co.in/index.php?action=register-candidate' target='_blank'>" . "                           <img width='100%' src='http://flexihire.co.in/assets/images/mailer/mobilize.png'>" . "                           </a>" . "            </td>" . "        </tr>" . "        <tr>" . "            <td style=''>" . "                <a href='http://flexihire.co.in/skill-mitra.php?action=videos&status=Pending' target='_blank'>" . "                           <img width='100%' src='http://flexihire.co.in/assets/images/mailer/verify.png'>" . "                           </a>" . "            </td>" . "        </tr>" . "        <tr>" . "            <td style=''>" . "                <a href='http://flexihire.co.in/skill-mitra.php?action=connected-candidates' target='_blank'>" . "                           <img width='100%' src='http://flexihire.co.in/assets/images/mailer/profile-completion.png'>" . "                           </a>" . "            </td>" . "        </tr>" . "        <tr style='background-color: #fcc512;'>" . "            <td style='padding: 50px;' align='center'>" . "                <a href='http://flexihire.co.in/skill-mitra.php' target='_blank'>" . "                           <img style='width: 250px;' src='http://flexihire.co.in/assets/images/mailer/start-btn.png'>" . "                           </a>" . "            </td>" . "        </tr>" . "    </table>";
	$mailer -> sendMail($email, $emailfrom, $subject, $message, "", "");
}

function AssignSkillMitra() {
	$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$cid = $_REQUEST["cid"];
	$sid = $_REQUEST["sid"];
	$q = "update member_details set skillmitra = '" . $sid . "' where uid = '" . $cid . "'";
	mysqli_query($link, $q);
	echo "Skill Mitra assigned successfully";
}

function change_password() {
	$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$uid = $_REQUEST["uid"];
	$password = $_REQUEST["p"];
	$random_salt = hash('sha512', uniqid(rand(1, 10000000), TRUE));
	$password = hash('sha512', $password . $random_salt);
	$q = "update members set password = '" . $password . "', salt = '" . $random_salt . "' where id = '" . $uid . "'";
	mysqli_query($link, $q);
	echo "Password changed successfully";
}

function checkUsername() {
	$result = '';
	$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$sql = "";
	$id = $_REQUEST["id"];
	$u = clean($_REQUEST["u"]);
	$a = clean($_REQUEST["a"]);
	$sql = "";
	if ($id != "0") {
		$sql = "   and id!='" . $id . "'";
	}
	$q = "select * from members where username='" . $u . "' $sql ";
	$r = mysqli_query($link, $q);
	if (mysqli_num_rows($r) > 0) {
		$result = "EXIST";
	} else {
		$result = "NOTEXIST";
	}
	$q = "select * from member_details where aadhaar='" . $a . "' $sql ";
	$r = mysqli_query($link, $q);
	if (mysqli_num_rows($r) > 0) {
		$result = $result . ",EXIST";
	} else {
		$result = $result . ",NOTEXIST";
	}
	echo $result;
}

function random_password($length = 6) {
	$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
	$password = substr(str_shuffle($chars), 0, $length);
	return $password;
}

function str_replace_last($search, $replace, $str) {
	if (($pos = strrpos($str, $search)) !== false) {
		$search_length = strlen($search);
		$str = substr_replace($str, $replace, $pos, $search_length);
	}
	return $str;
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

function sendSms($varPhNo, $varMSG) {
	$varUserName = "t1cybssapi";
	$varPWD = "55200745";
	$varSenderID = "CHAMPS";
	$url = "http://nimbusit.co.in/api/swsendSingle.asp";
	$data = "username=" . $varUserName . "&password=" . $varPWD . "&sender=" . $varSenderID . "&sendto=" . $varPhNo . "&message=" . $varMSG;
	postData($url, $data);
}

function sendEmail($subject, $message, $to) {
	$emailfrom = "admin@flexihire.co.in";
	$fromname = "FLEXIHIRE";
	$headers = 'Return-Path: ' . $emailfrom . "\r\n" . 'From: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 'X-Priority: 3' . "\r\n" . 'X-Mailer: PHP ' . phpversion() . "\r\n" . 'Reply-To: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Transfer-Encoding: 8bit' . "\r\n" . 'Content-Type: text/html; charset=utf-8' . "\r\n";
	$mailer = new Mailer;
	$mailer -> sendMail($to, $emailfrom, $subject, $message, "", "");
}

function createOrder($dbHelper, $mysqli, $orderNumber, $eid, $manPowerCharge, $serviceCharge, $gst, $total) {
	$result = $dbHelper -> multiquery($mysqli, 'sp_insertManpowerOrder', array($orderNumber, $eid, $manPowerCharge, $serviceCharge, $gst, $total), "Select @orderid;", array('@orderid'));
	return $result;
}

function updateOrder($dbHelper, $mysqli, $orderId, $tranId, $tranStatus, $manPowerCharge, $serviceCharge, $gst, $total) {
	$result = $dbHelper -> performOperation($mysqli, 'sp_updateManpowerOrder', array($orderId, $tranId, $tranStatus, $manPowerCharge, $serviceCharge, $gst, $total));
	return $result;
}

function updateHired($dbHelper, $mysqli, $hid, $orderId) {
	$result = $dbHelper -> performOperation($mysqli, 'sp_updateHiredCanidateOrder', array($hid, $orderId));
	return $result;
}

function hireCandidateCart($dbHelper, $mysqli, $empJobId, $avId, $orderId) {
	$mobilecode = sprintf("%06d", mt_rand(200000, 999999));
	$hireCandidate = new HireCandidate;
	$availability = array();
	$availability = $dbHelper -> getData($mysqli, 'sp_getAvailabilityById', array($avId));
	$job = array();
	$job = $dbHelper -> getData($mysqli, 'sp_getEmpJobsbyId', array($empJobId));
	$params = array($availability[0]["cid"], $availability[0]["from_date"], $availability[0]["to_date"], $availability[0]["from_time"], $availability[0]["to_time"], $availability[0]["period"], $availability[0]["job_type_id"], $availability[0]["exp_sal"], $job[0]["t1id"], $job[0]["eid"], $job[0]["from_date"], $job[0]["to_date"], $job[0]["from_time"], $job[0]["to_time"], $job[0]["period"], $job[0]["job_type_id"], $job[0]["sal"], $avId, $availability[0]["state"], $availability[0]["district"], $availability[0]["area"], $availability[0]["locality"], $availability[0]["job_sector"], $availability[0]["job_role"], $availability[0]["skill"], $mobilecode, $job[0]["emp_job_loc_id"]);
	$result = $dbHelper -> multiquery($mysqli, 'trs_hireCandidate', $params, "Select @fromdate,@toDate,@mobile,@comp,@address,@outId;", array('@fromdate', '@toDate', '@mobile', '@comp', '@address', '@outId'));
	return $result;
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

function calulateGst($totalAmount) {
	return $totalAmount * 18 / 100;
}

function clean($data) {
	$data = stripslashes($data);
	$data = htmlentities($data, ENT_QUOTES);
	return $data;
}
?>

