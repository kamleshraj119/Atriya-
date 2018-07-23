<?php
date_default_timezone_set('Asia/Kolkata');
error_reporting(0);
include ('../admin/application/Mailer.class.php');
include "../include/psl-config.php";
require_once ('ResponseCreator.php');
require_once ("lib/config_paytm.php");
require_once ("lib/encdec_paytm.php");
require_once ('../admin/application/Message.class.php');
require_once ('../admin/application/DBHelper.class.php');
require_once ('../admin/application/User.class.php');
require_once ('../admin/application/Version.class.php');
require_once ('../admin/application/VideoStream.class.php');
require_once ('../admin/application/HireCandidate.class.php');
require_once ('../admin/application/RefundCalculator.class.php');
require_once ('../admin/application/LocationTracker.class.php');
require_once ('../admin/application/CandidateDoc.class.php');
require_once ('../admin/application/UserEducation.class.php');
require_once ('../admin/application/VideoSession.class.php');
require_once ('../admin/application/Guru.class.php');
require_once ('../admin/application/DailyDelivery.class.php');
require_once ('../admin/application/LogisticPKT.class.php');

$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

set_time_limit(0);
session_start();

$request = $_REQUEST["action"];
switch($request) {
	case 'AUTHENTICATE_SKILL_CHAMPS' :
		authenticateUser();
		break;
	case 'CANDIDATE_ATTENDANCE' :
		candidateAttendance();
		break;
	case 'SEARCH_CANDIDATES' :
		searchCandidates();
		break;
	case 'GET_SECTORS' :
		getSectors();
		break;
	case 'GET_STATES' :
		getStates();
		break;
	case 'GET_DISTRICT' :
		getDistrict();
		break;
	case 'GET_AREA' :
		getArea();
		break;
	case 'GET_LOCAL' :
		getLocal();
		break;
	case 'GET_COURSES' :
		getCourses();
		break;
	case 'GET_SKILL' :
		getSkill();
		break;
	case 'REGISTER_USER' :
		registerUser();
		break;
	case 'VERIFY_MOBILE' :
		verifyMobile();
		break;
	case 'RESEND_CODE' :
		resendCode();
		break;
	case 'UPLOAD_VIDEO' :
		uploadVideo();
		break;
	case 'GET_VIDEO' :
		getVideo();
		break;
/* Update Profile */		
	case 'UPDATE_PROFILE' :
		updateProfile();
		break;
/* End Update Profile */		
/* Update profile pic */		
	case 'UPDATE_PROFILE_PIC' :
		updateProfilePic();
		break;
/* End Profile Pic */		
	case 'CHANGE_PASSWORD' :
		changePassword();
		break;
	case 'FORGOT_PASSWORD' :
		forgotPassword();
		break;
	case 'GET_SHORTLISTED' :
		getShortlisted();
		break;
	case 'SHORTLIST_CANDIDATE' :
		shortlistCandidate();
		break;
	case 'GET_HIRED' :
		getHired();
		break;
	case 'HIRE_CANDIDATE' :
		hireCandidate();
		break;
	case 'INBOX' :
		getMssages();
		break;
	case 'SEND_MESSAGE' :
		sendMessage();
		break;
	case 'READ_MESSAGE' :
		readMessage();
		break;
	case 'REPLY_MESSAGE' :
		replyMessage();
		break;
	case 'GET_LATEST_VERSION' :
		getLatestVersion();
		break;
	case 'PLAY_VIDEO' :
		playVideo();
		break;
	case 'GET_AVAILABILITY' :
		getAvailability();
		break;
	case 'GET_JOBS' :
		getJobs();
		break;
	case 'GET_AVAILABLE_CANDIDATES' :
		getAvailableCandidates();
		break;
	case 'REJECT_CANDIDATE' :
		rejectCandidate();
		break;
	case 'GET_BANK_DETAIL' :
		getBankDetail();
		break;
	case 'SAVE_BANK_DETAIL' :
		saveBankDetail();
		break;
	case 'DELETE_BANK_DETAIL' :
		deleteBankDetail();
		break;
	case 'GET_HIRED_CANDIDATE_PAY_REPORT' :
		getHiredCandidatePayReport();
		break;
	case 'GET_CANDIDATE_PASSBOOK' :
		getCandidatePassbook();
		break;
	case 'ADD_AVAILABILITY' :
		addAvailability();
		break;
	case 'UPDATE_AVAILABILITY' :
		updateAvailability();
		break;
	case 'DELETE_AVAILABILITY' :
		deleteAvailability();
		break;
	case 'ADD_JOB' :
		addJob();
		break;
	case 'UPDATE_JOB' :
		updateJob();
		break;
	case 'DELETE_JOB' :
		deleteJob();
		break;
	case 'GET_EMPLOYEMENT_HISTORY' :
		getEmployementHistory();
		break;
	case 'ADD_EMPLOYEMENT_HISTORY' :
		addEmployementHistory();
		break;
	case 'UPDATE_EMPLOYEMENT_HISTORY' :
		updateEmployementHistory();
		break;
	case 'DELETE_EMPLOYEMENT_HISTORY' :
		deleteEmployementHistory();
		break;
	case 'GET_EMP_JOB_LOCATION' :
		getEmpJobLocation();
		break;
	case 'ADD_EMP_JOB_LOCATION' :
		addEmpJobLocation();
		break;
	case 'UPDATE_EMP_JOB_LOCATION' :
		updateEmpJobLocation();
		break;
	case 'DELETE_EMP_JOB_LOCATION' :
		deleteEmpJobLocation();
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
	case 'GET_CURRENTLY_HIRED' :
		getCurrentlyHired();
		break;
	case 'REHIRE_CANDIDATE' :
		rehireCandidate();
		break;
	case 'UPLOAD_DOC' :
		uploadDoc();
		break;
	case 'UPLOAD_ENTERPRISE_DOC' :
		uploadEnterpriseDoc();
		break;
	case 'DELETE_DOC' :
		deleteDoc();
		break;
	case 'GET_DOC' :
		getDoc();
		break;
	case 'GET_PREF_JOB_LOC' :
		getPreferedJobLocation();
		break;
	case 'ADD_PREF_JOB_LOC' :
		addPreferedJobLocation();
		break;
	case 'UPDATE_PREF_JOB_LOC' :
		updatePreferedJobLocation();
		break;
	case 'DELETE_PREF_JOB_LOC' :
		deletePreferedJobLocation();
		break;
	case 'GET_PREF_SKILL' :
		getPreferedSkill();
		break;
	case 'ADD_PREF_SKILL' :
		addPreferedSkill();
		break;
	case 'UPDATE_PREF_SKILL' :
		updatePreferedSkill();
		break;
	case 'DELETE_PREF_SKILL' :
		deletePreferedSkill();
		break;
	case 'GET_CART' :
		getCart();
		break;
	case 'ADD_TO_CART' :
		addToCartCandidate();
		break;
	case 'DELETE_FROM_CART' :
		deleteCartCandidate();
		break;
	case 'MY_ODER' :
		getOrder();
		break;
	case 'CANCEL_ORDER' :
		cancelOrder();
		break;
	case 'GET_ACTIVE_ALERT' :
		getActiveAlert();
		break;
	case 'ACTIVATE_ALERT' :
		activateAlert();
		break;
	case 'DEACTIVATE_ALERT' :
		deactivateAlert();
		break;
	case 'ALERT_LOCATION_TRACK' :
		alertLocationTrack();
		break;
	case 'LOCATION_TRACK' :
		locationTrack();
		break;
	case 'UPDATE_ALERT_TYPE' :
		updateAlertType();
		break;
	case 'GET_CONNECTED_CONDIDATE_SKILLMITRA' :
		getConnectedCandidateSkillmitra();
		break;
	case 'GET_CONNECTED_CONDIDATE_LOC_SKILLMITRA' :
		getConnectedCandidateLocSkillmitra();
		break;

	case 'GET_CONNECTED_CONDIDATE_ACTIVE_ALERT_SKILLMITRA' :
		getConnectedCandidateActiveAlertSkillmitra();
		break;

	case 'GET_CONNECTED_CONDIDATE_ACTIVE_ALERT_LOC_SKILLMITRA' :
		getConnectedCandidateActiveAlertLocSkillmitra();
		break;
	case 'GET_CONNECTED_CONDIDATE_DOC_SKILLMITRA' :
		getConnectedCandidateDocSkillMitra();
		break;
	case 'APPROVE_REJECT_DOC_SKILLMITRA' :
		approveRejectDocSkillMitra();
		break;
	case 'GET_CONNECTED_CONDIDATE_VIDEO_SKILLMITRA' :
		getConnectedCandidateVideoSkillMitra();
		break;
	case 'APPROVE_REJECT_VIDEO_SKILLMITRA' :
		approveRejectVideoSkillMitra();
		break;
	case 'GET_EDUCATION' :
		getEducation();
		break;
	case 'ADD_EDUCATION' :
		addEducation();
		break;
	case 'UPDATE_EDUCATION' :
		updateEducation();
		break;
	case 'DELETE_EDUCATION' :
		deleteEducation();
		break;
	case 'GET_NOTIFICATIONS' :
		getNotifications();
		break;
	case 'GET_VIDEO_SESSION_CANDIDATE' :
		getVideoSessionCandidate();
		break;
	case 'REQUEST_VIDEO_SESSION_CANDIDATE' :
		requestVideoSessionCandidate();
		break;
	case 'GET_APPROVED_VIDEO_SESSION_CANDIDATE' :
		getApprovedVideoSessionCandidate();
		break;
	case 'GET_VIDEO_SESSION_REVIEWER' :
		getVideoSessionReviewer();
		break;
	case 'UPDATE_GAMIL_VIDEO_SESSION' :
		updateGamilVideoSession();
		break;
	case 'GET_CREDIT_USER' :
		getTotalCreditByUser();
		break;
	case 'GET_CREDIT_LIST_USER' :
		getCreditByUser();
		break;
	case 'GET_GURU_VIDEO' :
		getGuruVideo();
		break;
	case 'REVIEW_CAN_VIDEO_GURU' :
		reviewCanVideoGuru();
		break;
	case 'GET_GURU_DOC' :
		getGuruDoc();
		break;
	case 'UPDATE_CAN_DOC_GURU' :
		updateCanDocGuru();
		break;
	case 'UPDATE_CAN_VID_MEET' :
		updateCanVidMeet();
		break;

	case 'GET_DAILY_DELIVERY' :
		getDailyDelivery();
		break;
	case 'ADD_DAILY_DELIVERY' :
		addDailyDelivery();
		break;
	case 'UPDATE_DAILY_DELIVERY' :
		updateDailyDelivery();
		break;
	case 'DELETE_DAILY_DELIVERY' :
		deleteDailyDelivery();
		break;
	case 'GET_LOGISTICS_PKT_TYPE' :
		getLogisticsPktType();
		break;
	case 'BROADCAST_MESSAGE_SKILLMITRA' :
		broadcastMessageSkillmitra();
		break;
	case 'LEADERBOARD' :
		getLeaderBoard();
		break;
	case 'CANDIDATE_HOME' :
		candidateHome();
		break;
	case 'UPDATE_FCM_ID' :
		updateFCMID();
		break;
	case 'GET_NOTICATION_CANDIDATE' :
		getNotifactionCandidate();
		break;
	case 'GET_SUBSCRIPTION_RATE' :
		getSubscriptionRate();
		break;
	case 'SUBSCIBE_USER_CREDIT' :
		subscribeUserCredit();
		break;
	case 'EMPLOYER_HOME' :
		employerHome();
		break;
	case 'HIRED_CANDIDATE_ATTENDANCE' :
		getHiredCandidatesAttendance();
		break;
	case 'HIRED_CANDIDATE_DAILY_DELIVERY_REPORT' :
		getHiredCandidateDailyDeliveryReport();
		break;
	/* get  Sectors job role */
	case 'GET_SECTORS_JOB_ROLE' :
		getSectorsJobRole();
		break;
	/*  end sectors job role */
	/* Search All Posted Jobs By Job Role and pincode */
	case 'GET_POSTED_JOBS' :
		getPostedJobs();
		break;
	/* End Search All Posted Jobs */
}

/* Search All Posted Jobs By Job Role and pincode */
function getPostedJobs() {
	$dbHelper = new DBHelper;
	$data = array();
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$res = new ResponseCreator();
	$sql = "";
	$pincode = isset($_REQUEST['pincode']) ? $_REQUEST['pincode'] : "";
	$jobcategory = isset($_REQUEST['jobcategory']) ? $_REQUEST['jobcategory'] : "";
	$result = $dbHelper -> getData($mysqli, 'sp_getPostedJobs', array($pincode, $jobcategory));
	// echo "<pre>";  print_r($result);exit;
	for ($i = 0; $i < count($result); $i++) {
		$rowArr = array('eid' => $result[$i]['uid'], 'title' => $result[$i]['job_title'], 'desc' => $result[$i]['job_desc'], 'sector' => $result[$i]['sector_name'], 'company' => $result[$i]['company_name'], 'job_role' => $result[$i]['job_role'], 'company_image' => $result[$i]['company_image'], 'job_type' => $result[$i]['job_type_name'], 'location' => $result[$i]['job_location'], 'from_date' => $result[$i]['from_date'], 'to_date' => $result[$i]['to_date'], 'from_time' => $result[$i]['from_time'], 'to_time' => $result[$i]['to_time'], 'state' => $result[$i]['job_loc_state_name'], 'district' => $result[$i]['district_name'], 'area' => $result[$i]['area_name'], 'locality' => $result[$i]['loc_pincode'], 'sal' => $result[$i]['hired_salary'], 'skills' => $result[$i]['multiskill'], 'job_image' => $result[$i]['job_role_image']);
		array_push($data, $rowArr);
	}
	if (sizeof($data) > 0) {
		// format success response
		$res -> status = ResponseCreator::$RESPONSE_OK;
		$res -> message = "Success";
	} else {
		// format fail response
		$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
		$res -> message = "No data available";
	}
	//  echo "<pre>";  print_r($data);exit;
	$res -> data = $data;

	echo json_encode($res);

	//echo json_encode($json);
	mysqli_close($mysqli);
}

/* End Search All Posted Jobs */

/* get sector job role added by kamlesh*/
function getSectorsJobRole() {
	$dbHelper = new DBHelper;
	$data = array();
	$data1 = array();
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$res = new ResponseCreator();
	$sql = "";
	$course_id = '';
	$job_image = '';
	$course_name = '';

	$q = "select sector.id as sector_id,sector.name as sector_name,GROUP_CONCAT(DISTINCT courses.course_id 
                        ORDER BY courses.course_id SEPARATOR ',') as course_id,
                        GROUP_CONCAT( courses.job_role_image 
                        ORDER BY courses.job_role_image SEPARATOR ',') as job_image ,GROUP_CONCAT(DISTINCT courses.course_name 
                        ORDER BY courses.course_name SEPARATOR ',') as course_name from sector 
                        left outer join courses on sector.id=courses.sector_id GROUP BY sector.name";
	$dataSector = $dbHelper -> getDataFromQuery($mysqli, $q);
	$courseNameArr = array();

	for ($i = 0; $i < count($dataSector); $i++) {
		$rowArr = array('sector_id' => $dataSector[$i]['sector_id'], 'sector_name' => $dataSector[$i]['sector_name'], 'courses' => array());
		$courseNameArr['course_id'] = explode(",", $dataSector[$i]['course_id']);
		$courseNameArr['job_image'] = explode(",", $dataSector[$i]['job_image']);
		$courseNameArr['course_name'] = explode(",", $dataSector[$i]['course_name']);

		for ($j = 0; $j < sizeof($courseNameArr['course_name']); $j++) {
			if ($courseNameArr['course_id'][$j] != "" || $courseNameArr['course_id'][$j] != null) {
				$course_id = array("course_id" => $courseNameArr['course_id'][$j], "job_image" => $courseNameArr['job_image'][$j], "course_name" => $courseNameArr['course_name'][$j]);
				array_push($rowArr['courses'], $course_id);
			}
		}
		array_push($data, $rowArr);
	}
	if (sizeof($data) > 0) {
		// format success response
		$res -> status = ResponseCreator::$RESPONSE_OK;
		$res -> message = "Success";
	} else {
		// format fail response
		$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
		$res -> message = "No data available";
	}
	$res -> data = $data;
	echo json_encode($res);

	//echo json_encode($json);
	mysqli_close($mysqli);
}

/* get sector job role end */
function getHiredCandidatesAttendance() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$fromDate = $_REQUEST["from_date"];
	$toDate = $_REQUEST["to_date"];
	$user = new User;
	$eid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($eid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $dbHelper -> getData($mysqli, "sp_getHiredCandidateAttByEmp", array($eid, $fromDate, $toDate));
		for ($i = 0; $i < count($data); $i++) {
			$t1Date = isset($data[$i]["t1date"]) ? $data[$i]["t1date"] : '';
			$q = "SELECT COUNT(*) AS 'num' FROM daily_delivery WHERE date(daily_delivery.added_date)=date('" . $t1date . "')";
			$r = mysqli_query($mysqli, $q);
			$v = mysqli_fetch_assoc($r);
			if (intval($v["num"]) > 0)
				$data[$i]["daily_report"] = "YES";
			else {
				$data[$i]["daily_report"] = "NO";
			}
		}
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}
	$res -> data = $data;
	echo json_encode($res);
}

function getHiredCandidateDailyDeliveryReport() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$fromDate = $_REQUEST["from_date"];
	$toDate = $_REQUEST["to_date"];
	$user = new User;
	$eid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($eid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $dbHelper -> getData($mysqli, "sp_getHiredCandidateDailyReport", array($eid, $fromDate, $toDate));
		for ($i = 0; $i < count($data); $i++) {
			$t1Date = isset($data[$i]["t1date"]) ? $data[$i]["t1date"] : '';
			$q = "SELECT COUNT(*) AS 'num' FROM daily_delivery WHERE date(daily_delivery.added_date)=date('" . $t1date . "')";
			$r = mysqli_query($mysqli, $q);
			$v = mysqli_fetch_assoc($r);
			if (intval($v["num"]) > 0)
				$data[$i]["daily_report"] = "YES";
			else {
				$data[$i]["daily_report"] = "NO";
			}
		}
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}
	$res -> data = $data;
	echo json_encode($res);
}

function employerHome() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$user = new User;
	$eid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($eid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {

		$creditData = $dbHelper -> getData($mysqli, 'sp_getSkillchampsCreditBalanceByUid', array($eid));
		$q1 = "SELECT fcm_id,user_role FROM members WHERE id='" . $eid . "'";
		$dataFcm = $dbHelper -> getDataFromQuery($mysqli, $q1);
		$userRole = $dataFcm[0]["user_role"];
		$dataActiveSubsciptionStatus = $dbHelper -> getData($mysqli, 'sp_getUserSubsciption', array($eid));
		$dataSubDefData = $dbHelper -> getData($mysqli, 'sp_getSubscriptionCountByRole', array($userRole));
		$subDefCount = $dataSubDefData[0]["num"];
		$subCount = count($dataActiveSubsciptionStatus);
		$suscribed = 'NO';
		$dataSubF = array();
		if ($subCount > 0) {
			$suscribed = 'YES';
			$prv = "";
			$cur = "";
			for ($i = 0; $i < $subCount; $i++) {
				$cur = $dataActiveSubsciptionStatus[$i]["sd_id"];
				if ($cur != $prv) {
					$tempR = array('name' => $dataActiveSubsciptionStatus[$i]["name"], 'sf_status' => $dataActiveSubsciptionStatus[$i]["sf_status"], 'num_record_status' => $dataActiveSubsciptionStatus[$i]["num_record_status"], 'num_record' => $dataActiveSubsciptionStatus[$i]["num_record"], 'sub_unit' => $dataActiveSubsciptionStatus[$i]["sub_unit"]);
					$tempS = array('sd_id' => $dataActiveSubsciptionStatus[$i]["sd_id"], 'start_date' => $dataActiveSubsciptionStatus[$i]["start_date"], 'end_date' => $dataActiveSubsciptionStatus[$i]["end_date"], 'features' => array());
					array_push($dataSubF, $tempS);
					$c = count($dataSubF);
					$c = $c - 1;
					array_push($dataSubF[$c]["features"], $tempR);
				} else {
					$tempR = array('name' => $dataActiveSubsciptionStatus[$i]["name"], 'sf_status' => $dataActiveSubsciptionStatus[$i]["sf_status"], 'num_record_status' => $dataActiveSubsciptionStatus[$i]["num_record_status"], 'num_record' => $dataActiveSubsciptionStatus[$i]["num_record"], 'sub_unit' => $dataActiveSubsciptionStatus[$i]["sub_unit"]);
					$c = count($dataSubF);
					$c = $c - 1;
					array_push($dataSubF[$c]["features"], $tempR);
				}
				$prv = $cur;
			}
		}
		$data = array('fcm_id' => $dataFcm[0]["fcm_id"], 'user_role' => $userRole, 'credit' => $creditData[0]["credit"], 'sub_def_count' => $subDefCount, 'subscribed' => $suscribed, 'subscription' => $dataSubF);
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}
	$res -> data = $data;
	echo json_encode($res);
}

function subscribeUserCredit() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$srId = $_REQUEST["sr_id"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	$result = "";
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$dataSubscriptionRate = $dbHelper -> getData($mysqli, 'sp_getSubscriptionRate', array($srId));
		$sdId = $dataSubscriptionRate[0]['sd_id'];
		$value = ceil($dataSubscriptionRate[0]['rate']);
		$period = $dataSubscriptionRate[0]['period'];
		$unit = $dataSubscriptionRate[0]['unit'];
		$q = "select member_details.mobile,member_details.name,member_details.company_name,member_details.address,member_details.gstin,states.state_name,states.code,members.user_role from member_details Left outer join members on member_details.uid=members.id LEFT outer join states on member_details.uid=states.id where member_details.uid='" . $cid . "'";
		$memberDetails = $dbHelper -> getDataFromQuery($mysqli, $q);
		$mobile = $memberDetails[0]['mobile'];
		$mode = "CREDIT";
		$startDate = date('Y-m-d');
		$result = $dbHelper -> performOperation($mysqli, "sp_insertUserSubscription", array($sdId, $cid, $value, $period, $unit, $mode));
		if ($result == "Success") {
			$message = "Thank%20you%20for%20choosing%20us.%20Your%20services%20is%20start%20from%20" . $startDate . "%20and%20will%20be%20available%20for%20next%20" . $period . "%20" . $unit . ".";
			sendSms($mobile, $message);
		}
		$res -> status = ResponseCreator::$RESPONSE_OK;
		$res -> message = $result;
	}
	$res -> data = $data;
	echo json_encode($res);
}

function getSubscriptionRate() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	//$cid='2676';
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$q1 = "SELECT fcm_id,user_role FROM members WHERE id='" . $cid . "'";
		$dataFcm = $dbHelper -> getDataFromQuery($mysqli, $q1);
		$userRole = $dataFcm[0]["user_role"];
		$dataS = $dbHelper -> getData($mysqli, 'sp_getSubscriptionRateByUserRole', array($userRole));
		$dataAs = $dbHelper -> getData($mysqli, "sp_getActiveSubscriptionUser", array($cid));
		$activeSdId = $dataAs[0]["sd_id"];
		if (count($dataS) > 0) {
			$prv = "";
			$cur = "";
			for ($i = 0; $i < count($dataS); $i++) {
				$cur = $dataS[$i]["sd_id"];
				$rate = $dataS[$i]["rate"];
				$gst = ($rate * 18) / 100;
				$total = $rate + $gst;
				if ($cur != $prv) {
					$tempR = array('sr_id' => $dataS[$i]["sr_id"], 'st_id' => $dataS[$i]["st_id"], 'rate' => $rate, 'gst' => $gst, 'total' => $total, 'st_name' => $dataS[$i]["st_name"], 'period' => $dataS[$i]["period"], 'unit' => $dataS[$i]["unit"]);
					if ($activeSdId == $dataS[$i]["sd_id"])
						$tempS = array('sd_id' => $dataS[$i]["sd_id"], 'name' => $dataS[$i]["name"], 'des' => $dataS[$i]["des"], 'rates' => array(), 'active' => 'YES', 'start_date' => $dataAs[0]["start_date"], 'end_date' => $dataAs[0]["end_date"]);
					else
						$tempS = array('sd_id' => $dataS[$i]["sd_id"], 'name' => $dataS[$i]["name"], 'des' => $dataS[$i]["des"], 'rates' => array(), 'active' => 'NO', 'start_date' => '', 'end_date' => '');
					array_push($data, $tempS);
					$c = count($data);
					$c = $c - 1;
					array_push($data[$c]["rates"], $tempR);
				} else {
					$tempR = array('sr_id' => $dataS[$i]["sr_id"], 'st_id' => $dataS[$i]["st_id"], 'rate' => $rate, 'gst' => $gst, 'total' => $total, 'st_name' => $dataS[$i]["st_name"], 'period' => $dataS[$i]["period"], 'unit' => $dataS[$i]["unit"]);
					$c = count($data);
					$c = $c - 1;
					array_push($data[$c]["rates"], $tempR);
				}
				$prv = $cur;
			}
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}
	$res -> data = $data;
	echo json_encode($res);
}

function getNotifactionCandidate() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	//$cid='2676';
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $dbHelper -> getData($mysqli, 'sp_getNotificationForUser', array($cid));
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}
	$res -> data = $data;
	echo json_encode($res);
}

function updateFCMID() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$fcmId = $_REQUEST["fcm_id"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	$result = "";
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$result = $dbHelper -> performOperation($mysqli, 'sp_updateFcmId', array($cid, $fcmId));
		$res -> status = ResponseCreator::$RESPONSE_OK;
		$res -> message = $result;
	}
	$res -> data = $data;
	echo json_encode($res);
}


/* Check Null */
function checkNull($data) {
	$res = '';
	if ($data == null || $data == "") {
		$res = 0;
	} else {
		$res = $data;
	}
	//echo $res;exit;
	return $res;
}
/*  End Check Null */

function candidateHome() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = isset($_REQUEST["authtoken"])?$_REQUEST["authtoken"]:"";
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	//$cid='2782';
	$data = array();
	$res = new ResponseCreator;
	$version = new Version;
	$dataVersion = $version -> getLatestVersion($mysqli, $dbHelper);
	if ($cid == '' || $authtoken == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$att = array();
		$attendence = 'NA';
		$att = $dbHelper -> getData($mysqli, 'sp_getCandidateAtttendance', array($cid));
		if (count($att) > 0)
			$attendence = $att[0]["type"];
		 //$dataTop5 = $dbHelper -> getData($mysqli, "sp_getTopFiveEarner", array());
		 $dataTop5 = $dbHelper -> getData($mysqli, "sp_getTopFiveEarnerNew", array());
		
		 //$dataRocket = $dbHelper -> getData($mysqli, "sp_getRocket", array($cid));
		 $dataRocket = $dbHelper -> getData($mysqli, "sp_getRocketNew", array($cid));
		 
		 //$dataPockect = $dbHelper -> getData($mysqli, "sp_getPocket", array($cid));
		 $dataPockect = $dbHelper -> getData($mysqli, "sp_getPocketNew", array($cid));
		 
		 $creditData = $dbHelper -> getData($mysqli, 'sp_getSkillchampsCreditBalanceByUid', array($cid));
		 $work_hard = array('cash' => checkNull($dataPockect[0]["total"]), 'points' => 0, 'credits' => checkNull($creditData[0]["credit"]));
		 $feel_good = array('incentive' => checkNull($dataPockect[0]["in_incentive"]), 'awards' => 0, 'loylty' => 0);
		 $compliance = array('tarining' => 'No Data', 'counselling' => 'No Data', 'Bench' => 'No Data');
		 $growing_old = array('earned' => checkNull($dataPockect[0]["ytd"]), 'lost' => 0, 'opportunity' => 0);
		 $feel_young = array('earned' => checkNull($dataPockect[0]["mtd"]), 'lost' => 0, 'opportunity' => 0);
		 $pockect = array('work_hard' => $work_hard, 'feel_good' => $feel_good, 'compliance' => $compliance, 'growing_old' => $growing_old, 'feel_young' => $feel_young); 

		$q1 = "SELECT fcm_id,user_role FROM members WHERE id='" . $cid . "'";
		$dataFcm = $dbHelper -> getDataFromQuery($mysqli, $q1);
		$userRole = $dataFcm[0]["user_role"];
		$dataSubDefData = $dbHelper -> getData($mysqli, 'sp_getSubscriptionCountByRole', array($userRole));
		$subDefCount = $dataSubDefData[0]["num"];
		$dataP = getNotificationsForHome($dbHelper, $mysqli, $cid);
		$dataHired = $dbHelper -> getData($mysqli, 'sp_getCurrentlyHiredByCid', array($cid));
		$locTrack = new LocationTracker;
		$dataAlert = $locTrack -> getActiveAlertByCandidate($dbHelper, $mysqli, $cid);
		$dataActiveSubsciptionStatus = $dbHelper -> getData($mysqli, 'sp_getUserSubsciption', array($cid));
		$subCount = count($dataActiveSubsciptionStatus);
		$suscribed = 'NO';
		$dataSubF = array();
		if ($subCount > 0) {
			$suscribed = 'YES';
			$prv = "";
			$cur = "";
			for ($i = 0; $i < $subCount; $i++) {
				$cur = $dataActiveSubsciptionStatus[$i]["sd_id"];
				if ($cur != $prv) {
					$tempR = array('name' => $dataActiveSubsciptionStatus[$i]["name"], 'sf_status' => $dataActiveSubsciptionStatus[$i]["sf_status"], 'num_record_status' => $dataActiveSubsciptionStatus[$i]["num_record_status"], 'num_record' => $dataActiveSubsciptionStatus[$i]["num_record"], 'sub_unit' => $dataActiveSubsciptionStatus[$i]["sub_unit"]);
					$tempS = array('sd_id' => $dataActiveSubsciptionStatus[$i]["sd_id"], 'start_date' => $dataActiveSubsciptionStatus[$i]["start_date"], 'end_date' => $dataActiveSubsciptionStatus[$i]["end_date"], 'features' => array());
					array_push($dataSubF, $tempS);
					$c = count($dataSubF);
					$c = $c - 1;
					array_push($dataSubF[$c]["features"], $tempR);
				} else {
					$tempR = array('name' => $dataActiveSubsciptionStatus[$i]["name"], 'sf_status' => $dataActiveSubsciptionStatus[$i]["sf_status"], 'num_record_status' => $dataActiveSubsciptionStatus[$i]["num_record_status"], 'num_record' => $dataActiveSubsciptionStatus[$i]["num_record"], 'sub_unit' => $dataActiveSubsciptionStatus[$i]["sub_unit"]);
					$c = count($dataSubF);
					$c = $c - 1;
					array_push($dataSubF[$c]["features"], $tempR);
				}
				$prv = $cur;
			}
		}
	$data = array('fcm_id' => $dataFcm[0]["fcm_id"], 'att' => $attendence, 'top_five' => $dataTop5, 'rocket' => $dataRocket, 'pocket' => $pockect, 'version' => $dataVersion, 'notification' => $dataP, 'hired' => $dataHired, 'active_alert' => $dataAlert, 'sub_def_count' => $subDefCount, 'subscribed' => $suscribed, 'subscription' => $dataSubF);
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}
	$res -> data = $data;
	echo json_encode($res);
}

function getLeaderBoard() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		//$data = $dbHelper -> getData($mysqli, "sp_getLeaderBoard", array());
		$data = $dbHelper -> getData($mysqli, "sp_getLeaderBoardNew", array());
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}
	$res -> data = $data;
	echo json_encode($res);
}

function broadcastMessageSkillmitra() {
	$authtoken = $_REQUEST["authtoken"];
	$subject = clean($_REQUEST["subject"]);
	$msg = clean($_REQUEST["msg"]);
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$message = new Message;
	$user = new User;
	$id = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($id == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = array();
		$result = $dbHelper -> performOperation($mysqli, "sp_insertSkillmitraBroadcastMessage", array($id, $subject, $msg));
		if ($result == "Success") {
			$res -> data = $data;
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = $result;
		} else {
			$res -> data = $data;
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$res -> message = $result;
		}
	}
	echo json_encode($res);
}

function getLogisticsPktType() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$id = $_REQUEST["id"];
	$logPkt = new LogisticPKT;
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $logPkt -> getLogisticPktType($dbHelper, $mysqli, $id);
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}
	$res -> data = $data;
	echo json_encode($res);
}

function getDailyDelivery() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$id = $_REQUEST["id"];
	$dailyDel = new DailyDelivery;
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $dailyDel -> getDailyDeliveryReport($dbHelper, $mysqli, $cid, $id);
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}
	$res -> data = $data;
	echo json_encode($res);
}

function addDailyDelivery() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$shift = $_REQUEST["shift"];
	$lid = $_REQUEST["lid"];
	$totalPkt = $_REQUEST["totalPkt"];
	$donePkt = $_REQUEST["donePkt"];
	$attemptPkt = $_REQUEST["attemptPkt"];
	$rejectPkt = $_REQUEST["rejectPkt"];
	$openKm = $_REQUEST["openKm"];
	$closeKm = $_REQUEST["closeKm"];
	$dailyDel = new DailyDelivery;
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $dbHelper -> getData($mysqli, "sp_getEmpJobByCid", array($cid));
		$empJobId = $data[0]["emp_job_id"];
		$data = $dailyDel -> getCurrentDeliveryRate($dbHelper, $mysqli, $lid);
		$ratePkt = $data[0]["rate_pkt"];
		$rateKm = $data[0]["rate_km"];
		$result = $dailyDel -> insertDailyDeliveryReport($dbHelper, $mysqli, $cid, $shift, $totalPkt, $donePkt, $attemptPkt, $rejectPkt, $ratePkt, $openKm, $closeKm, $rateKm, $lid, $empJobId);
		if ($result == "Success") {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Record added successfully.";
		} else {
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$res -> message = $result;
		}
	}
	echo json_encode($res);
}

function updateDailyDelivery() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$id = $_REQUEST["id"];
	$lid = $_REQUEST["lid"];
	$totalPkt = $_REQUEST["totalPkt"];
	$donePkt = $_REQUEST["donePkt"];
	$attemptPkt = $_REQUEST["attemptPkt"];
	$rejectPkt = $_REQUEST["rejectPkt"];
	$openKm = $_REQUEST["openKm"];
	$closeKm = $_REQUEST["closeKm"];
	$dailyDel = new DailyDelivery;
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$incentive = -1;
		$data = $dailyDel -> getCurrentDeliveryRate($dbHelper, $mysqli, $lid);
		$ratePkt = $data[0]["rate_pkt"];
		$rateKm = $data[0]["rate_km"];
		$data1 = $dailyDel -> getDailyDeliveryReport($dbHelper, $mysqli, '', $id);
		$status = $data1[0]["status"];
		$result = $dailyDel -> updateDailyDeliveryReport($dbHelper, $mysqli, $id, $totalPkt, $donePkt, $attemptPkt, $rejectPkt, $ratePkt, $openKm, $closeKm, $rateKm, $status, $lid, $incentive);
		if ($result == "Success") {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Record updated successfully.";
		} else {
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$res -> message = $result;
		}
	}
	echo json_encode($res);
}

function deleteDailyDelivery() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$id = $_REQUEST["id"];
	$dailyDel = new DailyDelivery;
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$result = $dailyDel -> deleteDailyReport($dbHelper, $mysqli, $id);
		if ($result == "Success") {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Record deleted successfully.";
		} else {
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$res -> message = $result;
		}
	}
	echo json_encode($res);
}

function updateCanVidMeet() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$sessionId = $_REQUEST["sid"];
	$guestId = $_REQUEST["gid"];
	$videoSession = new VideoSession;
	$user = new User;
	$guru = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	$canDoc = new CandidateDoc;
	if ($guru == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $videoSession -> getVideoSessionReviewParam($dbHelper, $mysqli, $sessionId, $guestId);
		if (count($data) > 0) {
			for ($i = 0; $i < count($data); $i++) {
				$selId = "sl" . $data[$i]["param_id"];
				$pval = $_REQUEST[$selId];
				$result = $dbHelper -> performOperation($mysqli, 'sp_updateVideoReviewParamValue', array($data[$i]["param_id"], $pval));
			}
		}
		if ($result == "Success") {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Review updated successfully.";
		} else {
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$res -> message = $result;
		}
	}
	echo json_encode($res);
}

function updateCanDocGuru() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$comment = $_REQUEST["doc_comment"];
	$id = $_REQUEST["doc_id"];
	$status = $_REQUEST["doc_status"];
	$user = new User;
	$guru = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	$canDoc = new CandidateDoc;
	if ($guru == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$result = $canDoc -> upadteCandidateDocGuru($dbHelper, $mysqli, $id, $status, $comment);
		if ($result == "Success") {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Document status updated successfully.";
		} else {
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$res -> message = $result;
		}
	}
	echo json_encode($res);
}

function getGuruDoc() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$status = $_REQUEST["status"];
	$canDoc = new CandidateDoc;
	$user = new User;
	$guru = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($guru == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $canDoc -> getDocumentGuru($dbHelper, $mysqli, $guru, $status);
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}
	$res -> data = $data;
	echo json_encode($res);
}

function reviewCanVideoGuru() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$vid = $_REQUEST["vid"];
	$personality = $_REQUEST["personality"];
	$skills = $_REQUEST["skills"];
	$qualifications = $_REQUEST["qualifications"];
	$experience = $_REQUEST["experience"];
	$type = $_REQUEST["type"];
	$comment = $_REQUEST["comment"];
	$user = new User;

	$guru = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($guru == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$result = $dbHelper -> performOperation($mysqli, 'sp_guruVideoReview', array($guru, $vid, $personality, $skills, $qualifications, $experience, $type, $comment));
		$res -> status = ResponseCreator::$RESPONSE_OK;
	}
	if ($result == "Success")
		$res -> message = "Video updated successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function getGuruVideo() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$status = $_REQUEST["status"];
	$vid = $_REQUEST["vid"];
	$user = new User;
	$guru = new Guru;
	$gid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($gid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $guru -> getGuruReviews($mysqli, $gid, $status, $vid);
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}

	$res -> data = $data;
	echo json_encode($res);
}

function getCreditByUser() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$user = new User;
	$skid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($skid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $dbHelper -> getData($mysqli, 'sp_getCreditByToUid', array($skid));
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}

	$res -> data = $data;
	echo json_encode($res);
}

function getTotalCreditByUser() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$user = new User;
	$skid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($skid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $dbHelper -> getData($mysqli, 'sp_getTotalCreditByToUid', array($skid));
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}

	$res -> data = $data[0];
	echo json_encode($res);
}

function updateGamilVideoSession() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$guestId = $_REQUEST["guest_id"];
	$email = $_REQUEST["gmail"];
	$user = new User;
	$videoSession = new VideoSession;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$result = $videoSession -> updateVideoSessionGuest($dbHelper, $mysqli, $guestId, $email);
		$res -> status = ResponseCreator::$RESPONSE_OK;
	}
	if ($result == "Success")
		$res -> message = "Email updated successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function getVideoSessionReviewer() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$videoSession = new VideoSession;
	$user = new User;
	$sid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($sid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $videoSession -> getVideoSessionByReviewer($dbHelper, $mysqli, $sid);
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}

	$res -> data = $data;
	echo json_encode($res);
}

function getApprovedVideoSessionCandidate() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$cid = $_REQUEST["cid"];
	$videoSession = new VideoSession;
	$user = new User;
	$eid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($eid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $videoSession -> getAllApprovedVideoSessionCandidate($dbHelper, $mysqli, $cid);
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}

	$res -> data = $data;
	echo json_encode($res);
}

function requestVideoSessionCandidate() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$title = $_REQUEST["title"];
	$email = $_REQUEST["gmail"];
	$from = $_REQUEST["from"];
	$to = $_REQUEST["to"];
	$skill = explode(",", $_REQUEST["skill_name"]);
	$user = new User;
	$videoSession = new VideoSession;
	$uid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($uid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		if (checkSubscription($dbHelper, $mysqli, $uid, $_REQUEST["action"], "video_session_request", "added_date", "posted_by")) {
			$result = $videoSession -> insertVideoSessionReq($dbHelper, $mysqli, $from, $to, $location, $description, $uid, $title);
			if ($result[0] == "Success") {
				$sessionId = $result[1];
				$interviewer = "NO";
				$videoSession -> addVideoSessionGuest($dbHelper, $mysqli, $sessionId, $uid, "200", $email, "0", $interviewer);
				$skmResult = $dbHelper -> getDataFromQuery($mysqli, "Select sector.name,member_details.skc,skm_member_dertails.email from member_details left outer join member_details skm_member_dertails on member_details.skc=skm_member_dertails.uid LEFT OUTER JOIN courses ON member_details.jobcategory=courses.course_id 
                            LEFT OUTER JOIN sector ON courses.sector_id=sector.id where member_details.uid='" . $uid . "'");
				$videoSession -> addVideoSessionGuest($dbHelper, $mysqli, $sessionId, $skmResult[0]["skc"], "700", $skmResult[0]["email"], $uid, $interviewer);
				$q1 = "SELECT guru_jobs_cat.guru,member_details.email from guru_jobs_cat left outer join member_details on guru_jobs_cat.guru=member_details.uid where jobs = '" . $skmResult[0]["name"] . "' order by rand() limit 0,3;";
				$dataGuru = $dbHelper -> getDataFromQuery($mysqli, $q1);
				for ($j = 0; $j < count($dataGuru); $j++) {
					if ($j == 0)
						$interviewer = "YES";
					else
						$interviewer = "NO";
					$resultGuest = $videoSession -> addVideoSessionGuest($dbHelper, $mysqli, $sessionId, $dataGuru[$j]["guru"], "500", $dataGuru[$j]["email"], $uid, $interviewer);
					for ($i = 0; $i < count($skill); $i++) {
						$videoSession -> addVideoReviewParam($dbHelper, $mysqli, $resultGuest[1], $skill[$i]);
					}
				}
				$res -> status = ResponseCreator::$RESPONSE_OK;
			} else {
				$res -> status = ResponseCreator::$OTHER_ERROR;
			}
		} else {
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$result = "Please upgrade your subscription plan.";
		}
	}
	if ($result[0] == "Success")
		$res -> message = "Interview request sent successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function getVideoSessionCandidate() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$videoSession = new VideoSession;
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $videoSession -> getVideoSessionByReviewee($dbHelper, $mysqli, $cid);
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}

	$res -> data = $data;
	echo json_encode($res);
}

function getNotifications() {
	$dataP = array();
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$dataP = $dbHelper -> getData($mysqli, 'sp_getCandidateProfile', array($cid));
		if (count($dataP) > 0) {
			for ($i = 0; $i < count($dataP); $i++) {
				$count = 0;
				$docCount = 0;
				$profilePer = 0;
				$overallPer = 0;
				$docPer = 0;
				$remainPer = 0;
				if ($dataP[$i]["name"] != '')
					$count++;
				if ($dataP[$i]["father_name"] != '')
					$count++;
				if ($dataP[$i]["mobile"] != '')
					$count++;
				if ($dataP[$i]["email"] != '')
					$count++;
				if ($dataP[$i]["pincode"] != '')
					$count++;
				if ($dataP[$i]["jobcategory"] > 0)
					$count++;
				if ($dataP[$i]["dob"] != '')
					$count++;
				if ($dataP[$i]["gender"] != '')
					$count++;
				if ($dataP[$i]["marital_status"] != '')
					$count++;
				if ($dataP[$i]["aadhaar"] != '')
					$count++;
				if ($dataP[$i]["address"] != '')
					$count++;
				if ($dataP[$i]["state"] != '')
					$count++;
				if ($dataP[$i]["city"] != '')
					$count++;
				if ($dataP[$i]["facebook"] != '')
					$count++;
				if ($dataP[$i]["linkedin"] != '')
					$count++;
				if ($dataP[$i]["profile_pic"] != '')
					$remainPer++;
				if ($dataP[$i]["exp_count"] > 0)
					$remainPer++;
				if ($dataP[$i]["ac_count"] > 0)
					$remainPer++;
				if ($dataP[$i]["vid_count"] > 0)
					$remainPer++;
				if ($dataP[$i]["edu_count"] > 0)
					$remainPer++;
				$remainPer = ($remainPer * 100) / 5;
				$profilePer = ($count * 100) / 15;
				$docPer = $dataP[$i]["doc_count"] + $dataP[$i]["cv_count"] + $dataP[$i]["cert_count"];
				if ($docPer > 3)
					$docPer = 3;
				$docPer = ($docPer * 100) / 3;
				$overallPer = ($profilePer + $docPer + $remainPer) / 3;
				$dataP[$i]["profile_per"] = round($profilePer, 0);
				$dataP[$i]["doc_per"] = round($docPer, 0);
				$dataP[$i]["overall_per"] = round($overallPer, 0);
				$dbHelper -> performOperation($mysqli, 'sp_updateOverallPer', array($dataP[$i]["uid"], $dataP[$i]["overall_per"]));
			}
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
			$res -> data = $dataP;
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
			$res -> data = $dataP;
		}
	}
	echo json_encode($res);
}

function getNotificationsForHome($dbHelper, $mysqli, $cid) {
	$dataP = array();
	$dataP = $dbHelper -> getData($mysqli, 'sp_getCandidateProfile', array($cid));
	if (count($dataP) > 0) {
		for ($i = 0; $i < count($dataP); $i++) {
			$count = 0;
			$docCount = 0;
			$profilePer = 0;
			$overallPer = 0;
			$docPer = 0;
			$remainPer = 0;
			if ($dataP[$i]["name"] != '')
				$count++;
			if ($dataP[$i]["father_name"] != '')
				$count++;
			if ($dataP[$i]["mobile"] != '')
				$count++;
			if ($dataP[$i]["email"] != '')
				$count++;
			if ($dataP[$i]["pincode"] != '')
				$count++;
			if ($dataP[$i]["jobcategory"] > 0)
				$count++;
			if ($dataP[$i]["dob"] != '')
				$count++;
			if ($dataP[$i]["gender"] != '')
				$count++;
			if ($dataP[$i]["marital_status"] != '')
				$count++;
			if ($dataP[$i]["aadhaar"] != '')
				$count++;
			if ($dataP[$i]["address"] != '')
				$count++;
			if ($dataP[$i]["state"] != '')
				$count++;
			if ($dataP[$i]["city"] != '')
				$count++;
			if ($dataP[$i]["facebook"] != '')
				$count++;
			if ($dataP[$i]["linkedin"] != '')
				$count++;
			if ($dataP[$i]["profile_pic"] != '')
				$remainPer++;
			if ($dataP[$i]["exp_count"] > 0)
				$remainPer++;
			if ($dataP[$i]["ac_count"] > 0)
				$remainPer++;
			if ($dataP[$i]["vid_count"] > 0)
				$remainPer++;
			if ($dataP[$i]["edu_count"] > 0)
				$remainPer++;
			$remainPer = ($remainPer * 100) / 5;
			$profilePer = ($count * 100) / 15;
			$docPer = $dataP[$i]["doc_count"] + $dataP[$i]["cv_count"] + $dataP[$i]["cert_count"];
			if ($docPer > 3)
				$docPer = 3;
			$docPer = ($docPer * 100) / 3;
			$overallPer = ($profilePer + $docPer + $remainPer) / 3;
			$dataP[$i]["profile_per"] = round($profilePer, 0);
			$dataP[$i]["doc_per"] = round($docPer, 0);
			$dataP[$i]["overall_per"] = round($overallPer, 0);
			$dbHelper -> performOperation($mysqli, 'sp_updateOverallPer', array($dataP[$i]["uid"], $dataP[$i]["overall_per"]));
		}
	}
	return $dataP;
}

function addEducation() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$course = $_REQUEST["course"];
	$school = $_REQUEST["school"];
	$board = $_REQUEST["board"];
	$year = $_REQUEST["year"];
	$grade = $_REQUEST["grade"];
	$docid = $_REQUEST["docid"];
	$user = new User;
	$userEdu = new UserEducation;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$result = $userEdu -> insertUserEducation($dbHelper, $mysqli, $cid, $school, $board, $year, $grade, $docid, $course);
		$res -> status = ResponseCreator::$RESPONSE_OK;
	}
	if ($result == "Success")
		$res -> message = "Education saved successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function updateEducation() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$id = $_REQUEST["id"];
	$course = $_REQUEST["course"];
	$school = $_REQUEST["school"];
	$board = $_REQUEST["board"];
	$year = $_REQUEST["year"];
	$grade = $_REQUEST["grade"];
	$docid = $_REQUEST["docid"];
	$user = new User;
	$userEdu = new UserEducation;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$result = $userEdu -> updateUserEducation($dbHelper, $mysqli, $id, $cid, $school, $board, $year, $grade, $docid, $course);
		$res -> status = ResponseCreator::$RESPONSE_OK;
	}
	if ($result == "Success")
		$res -> message = "Education saved successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function deleteEducation() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$id = $_REQUEST["id"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$result = $dbHelper -> performOperation($mysqli, 'sp_deleteUserEducation', array($id));
		$res -> status = ResponseCreator::$RESPONSE_OK;
	}
	if ($result == "Success")
		$res -> message = "Education deleted successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function getEducation() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = isset($_REQUEST["authtoken"]) ? $_REQUEST["authtoken"] : '-1';
	$id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : "";
	$userEdu = new UserEducation;
	$user = new User;
	$wa = isset($_REQUEST["wa"]) ? $_REQUEST["wa"] : "";
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;

	if ($cid == '' && $wa != "true") {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		if ($id != '')
			$cid = $id;
		$data = $userEdu -> getUserEducationByUser($dbHelper, $mysqli, $cid);
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}

	$res -> data = $data;
	echo json_encode($res);
}

function approveRejectVideoSkillMitra() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$comment = $_REQUEST["v_comment"];
	$id = $_REQUEST["v_id"];
	$status = $_REQUEST["v_status"];
	$user = new User;
	$skid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($skid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$result = $dbHelper -> performOperation($mysqli, 'sp_upadteCandidateVideoSkillMitra', array($id, $status, $comment));
		if ($result == "Success") {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Video status updated successfully.";
		} else {
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$res -> message = $result;
		}
	}
	echo json_encode($res);
}

function getConnectedCandidateVideoSkillMitra() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$status = $_REQUEST["status"];
	$user = new User;
	$skid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($skid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $dbHelper -> getData($mysqli, 'sp_getVideoSkillmitra', array($skid, $status));
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}
	$res -> data = $data;
	echo json_encode($res);
}

function approveRejectDocSkillMitra() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$comment = $_REQUEST["doc_comment"];
	$id = $_REQUEST["doc_id"];
	$status = $_REQUEST["doc_status"];
	$user = new User;
	$skid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	$canDoc = new CandidateDoc;
	if ($skid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$result = $canDoc -> upadteCandidateDocSkillMitra($dbHelper, $mysqli, $id, $status, $comment);
		if ($result == "Success") {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Document status updated successfully.";
		} else {
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$res -> message = $result;
		}
	}
	echo json_encode($res);
}

function getConnectedCandidateDocSkillMitra() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$status = $_REQUEST["status"];
	$canDoc = new CandidateDoc;
	$user = new User;
	$skid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($skid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $canDoc -> getDocumentSkillmitra($dbHelper, $mysqli, $skid, $status);
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}
	$res -> data = $data;
	echo json_encode($res);
}

function getConnectedCandidateActiveAlertLocSkillmitra() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$alertId = $_REQUEST["alert_id"];
	$locTrack = new LocationTracker;
	$user = new User;
	$skid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($skid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $locTrack -> getLocatinDetailsByAlert($dbHelper, $mysqli, $alertId);
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}
	$res -> data = $data;
	echo json_encode($res);
}

function getConnectedCandidateActiveAlertSkillmitra() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$locTrack = new LocationTracker;
	$user = new User;
	$skid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($skid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $locTrack -> getAlertsBySkillmitra($dbHelper, $mysqli, $skid, 'Active');
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}
	$res -> data = $data;
	echo json_encode($res);
}

function getConnectedCandidateLocSkillmitra() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$locTrack = new LocationTracker;
	$user = new User;
	$skid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($skid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $locTrack -> getConnectedCandidateLocSkillmitra($dbHelper, $mysqli, $skid);
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}
	$res -> data = $data;
	echo json_encode($res);
}

function getConnectedCandidateSkillmitra() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$user = new User;
	$skid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($skid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $dbHelper -> getData($mysqli, 'sp_getConnectedCandidateSkillMitra', array($skid));
		for ($i = 0; $i < count($data); $i++) {
			$count = 0;
			$docCount = 0;
			$profilePer = 0;
			$overallPer = 0;
			$docPer = 0;
			$remainPer = 0;
			if ($data[$i]["name"] != '')
				$count++;
			if ($data[$i]["father_name"] != '')
				$count++;
			if ($data[$i]["mobile"] != '')
				$count++;
			if ($data[$i]["email"] != '')
				$count++;
			if ($data[$i]["pincode"] != '')
				$count++;
			if ($data[$i]["jobcategory"] > 0)
				$count++;
			if ($data[$i]["dob"] != '')
				$count++;
			if ($data[$i]["gender"] != '')
				$count++;
			if ($data[$i]["marital_status"] != '')
				$count++;
			if ($data[$i]["aadhaar"] != '')
				$count++;
			if ($data[$i]["address"] != '')
				$count++;
			if ($data[$i]["state"] != '')
				$count++;
			if ($data[$i]["city"] != '')
				$count++;
			if ($data[$i]["facebook"] != '')
				$count++;
			if ($data[$i]["linkedin"] != '')
				$count++;
			if ($data[$i]["profile_pic"] != '')
				$remainPer++;
			if ($data[$i]["exp_count"] > 0)
				$remainPer++;
			if ($data[$i]["ac_count"] > 0)
				$remainPer++;
			if ($data[$i]["vid_count"] > 0)
				$remainPer++;
			if ($data[$i]["edu_count"] > 0)
				$remainPer++;
			$remainPer = ($remainPer * 100) / 5;
			$profilePer = ($count * 100) / 15;
			$docPer = $data[$i]["doc_count"] + $data[$i]["cv_count"] + $data[$i]["cert_count"];
			if ($docPer > 3)
				$docPer = 3;
			$docPer = ($docPer * 100) / 3;
			$overallPer = ($profilePer + $docPer + $remainPer) / 3;
			$data[$i]["profile_per"] = round($profilePer, 0);
			$data[$i]["doc_per"] = round($docPer, 0);
			$data[$i]["overall_per"] = round($overallPer, 0);
			$dbHelper -> performOperation($mysqli, 'sp_updateOverallPer', array($data[$i]["uid"], $data[$i]["overall_per"]));
		}
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}
	$res -> data = $data;
	echo json_encode($res);
}

function getActiveAlert() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$locTrack = new LocationTracker;
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $locTrack -> getActiveAlertByCandidate($dbHelper, $mysqli, $cid);
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}
	$res -> data = $data;
	echo json_encode($res);
}

function activateAlert() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$type = $_REQUEST["type"];
	$lat = $_REQUEST["lat"];
	$long = $_REQUEST["long"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	$mob = "";
	$can = "";
	$data = array();
	$locTrack = new LocationTracker;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$result = $locTrack -> insertAlert($dbHelper, $mysqli, $cid, $type);
		if ($result[0] == "Success") {
			$alertId = $result[1];
			$mob = $result[2];
			$can = $result[3];
			$result1 = $locTrack -> insertAlertLocationDetail($dbHelper, $mysqli, $alertId, $lat, $long);

			if ($result[0] == "Success") {
				$res -> status = ResponseCreator::$RESPONSE_OK;
				$res -> message = "Alert activated successfully.";
				$res -> data = $locTrack -> getActiveAlertByCandidate($dbHelper, $mysqli, $cid);
			} else {
				$res -> status = ResponseCreator::$OTHER_ERROR;
				$res -> message = $result;
			}
		} else {
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$res -> message = $result;
		}
	}
	echo json_encode($res);
	if ($result[0] == "Success") {
		$message = "";
		if ($type == "Battery Low") {
			$message = "$can%20battery%20is%20low.";
		} else {
			$message = "$can%20need%20immediate%20help.%20For%20details%20plaese%20login%20to%20your%20skillchamps%20account.";
		}
		if ($mob != '')
			sendSms($mob, $message);
		sendSms("9873775077", $message);
	}
}

function deactivateAlert() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$alertId = $_REQUEST["id"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	$locTrack = new LocationTracker;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$result = $locTrack -> deactivateAlert($dbHelper, $mysqli, $alertId);
		if ($result == "Success") {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Alert deactivated successfully.";
		} else {
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$res -> message = $result;
		}
	}
	echo json_encode($res);
}

function alertLocationTrack() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$alertId = $_REQUEST["id"];
	$lat = $_REQUEST["lat"];
	$long = $_REQUEST["long"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	$locTrack = new LocationTracker;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$result = $locTrack -> insertAlertLocationDetail($dbHelper, $mysqli, $alertId, $lat, $long);
		if ($result == "Success") {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Location added successfully.";
		} else {
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$res -> message = $result;
		}
	}
	echo json_encode($res);
}

function locationTrack() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$lat = $_REQUEST["lat"];
	$long = $_REQUEST["long"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	$locTrack = new LocationTracker;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$result = $locTrack -> insertLocationTracking($dbHelper, $mysqli, $cid, $lat, $long);
		if ($result == "Success") {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Location added successfully.";
		} else {
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$res -> message = $result;
		}
	}
	echo json_encode($res);
}

function updateAlertType() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$alertId = $_REQUEST["id"];
	$type = $_REQUEST["type"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	$locTrack = new LocationTracker;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$result = $locTrack -> updateAlertType($dbHelper, $mysqli, $alertId, $type);
		if ($result == "Success") {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Alert updated successfully.";
		} else {
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$res -> message = $result;
		}
	}
	echo json_encode($res);
}

function getOrder() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = isset($_REQUEST["authtoken"])?$_REQUEST["authtoken"]:'-1';
	$hireCandidate = new HireCandidate;
	$user = new User;
	$eid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($eid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $hireCandidate -> getOrderByEmp($dbHelper, $mysqli, $eid);
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}
	$res -> data = $data;
	echo json_encode($res);
}

function cancelOrder() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$id = $_REQUEST["id"];
	$user = new User;
	$eid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($eid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$result = RefundCalculator::cancelOrderEmployer($dbHelper, $mysqli, $id);
		if ($result == "Success") {
			$result = $dbHelper -> performFromQuery($mysqli, "UPDATE manpower_order SET manpower_order.canceled='YES' WHERE manpower_order.id='" . $id . "'");
			$result = $dbHelper -> performFromQuery($mysqli, "UPDATE hired_candidates SET hired_candidates.job_status='Canceled' WHERE hired_candidates.order_id='" . $id . "'");
			if ($result == "Success") {
				$res -> status = ResponseCreator::$RESPONSE_OK;
				$res -> message = "Order canceled successfully.";
			} else {
				$res -> status = ResponseCreator::$OTHER_ERROR;
				$res -> message = $result;
			}
		} else {
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$res -> message = $result;
		}
	}
	echo json_encode($res);

}

function getCart() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$empJobId = $_REQUEST["emp_job_id"];
	$user = new User;
	$eid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	$hireCandidate = new HireCandidate;
	if ($eid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		if ($empJobId != '') {
			$data = $hireCandidate -> getCartCandidateByJob($dbHelper, $mysqli, $empJobId);
		} else {
			$data = $hireCandidate -> getCartCandidateByEmp($dbHelper, $mysqli, $eid);
		}
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}
	$res -> data = $data;
	echo json_encode($res);
}

function addToCartCandidate() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$cid = $_REQUEST["cid"];
	$empJobId = $_REQUEST["ejid"];
	$avId = $_REQUEST["avid"];
	$user = new User;
	$eid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($eid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$q = "select user_role from members where id='" . $eid . "'";
		$memberDetails = $dbHelper -> getDataFromQuery($mysqli, $q);
		$userRole = $memberDetails[0]['user_role'];
		if (checkSubscription($dbHelper, $mysqli, $eid, $_REQUEST["action"], "hired_candidates", "hired_posted_on", "heid") || $userRole == '800') {
			$hireCandidate = new HireCandidate;
			$check = $hireCandidate -> checkCandidateAvailabilityForAddToCart($dbHelper, $mysqli, $empJobId, $avId);
			if ($check[1] == "0") {
				$result = $hireCandidate -> addToCartCandidateAdmin($dbHelper, $mysqli, $cid, $eid, $empJobId, $avId, $check[2], $check[3], $check[5], $check[6], $check[4], $check[7]);
				$res -> status = ResponseCreator::$RESPONSE_OK;
			} else {
				$res -> status = ResponseCreator::$OTHER_ERROR;
				$result = $check[0];
			}
			if ($result == "Success")
				$res -> message = "Candidate added successfully.";
			else
				$res -> message = $result;
		} else {
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$res -> message = "Please update your subscription plan.";
		}
	}

	echo json_encode($res);
}

function deleteCartCandidate() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$avId = $_REQUEST["avid"];
	$user = new User;
	$eid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($eid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$result = $dbHelper -> performOperation($mysqli, 'sp_deleteTempCartCandidateByAv', array($avId));
		$res -> status = ResponseCreator::$RESPONSE_OK;
	}
	if ($result == "Success")
		$res -> message = "Candidate removed successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function getPreferedJobLocation() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $dbHelper -> getData($mysqli, 'sp_getCandidateLoc', array("", $cid));
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}

	$res -> data = $data;
	echo json_encode($res);
}

function addPreferedJobLocation() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$state = $_REQUEST["state"];
	$district = $_REQUEST["district"];
	$area = $_REQUEST["area"];
	$locality = $_REQUEST["locality"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		if (checkSubscription($dbHelper, $mysqli, $cid, $_REQUEST["action"], "candidate_loc", "added_date", "cid")) {
			$result = $result = $dbHelper -> performOperation($mysqli, 'sp_insertCandidateLoc', array($cid, $state, $district, $area, $locality));
			$res -> status = ResponseCreator::$RESPONSE_OK;
		} else {
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$result = "Please upgrade your subscription plan.";
		}

	}
	if ($result == "Success")
		$res -> message = "Job location added successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function updatePreferedJobLocation() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$id = $_REQUEST["id"];
	$state = $_REQUEST["state"];
	$district = $_REQUEST["district"];
	$area = $_REQUEST["area"];
	$locality = $_REQUEST["locality"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$result = $result = $dbHelper -> performOperation($mysqli, 'sp_updateCandidateLoc', array($id, $state, $district, $area, $locality));
		$res -> status = ResponseCreator::$RESPONSE_OK;
	}
	if ($result == "Success")
		$res -> message = "Job location updated successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function deletePreferedJobLocation() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$id = $_REQUEST["id"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$result = $dbHelper -> performOperation($mysqli, 'sp_deleteCandidateLoc', array($id));
		$res -> status = ResponseCreator::$RESPONSE_OK;
	}
	if ($result == "Success")
		$res -> message = "Job location deleted successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function getPreferedSkill() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $dbHelper -> getData($mysqli, 'sp_getCandidateSkill', array("", $cid));
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}

	$res -> data = $data;
	echo json_encode($res);
}

function addPreferedSkill() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$sector = $_REQUEST["sector"];
	$jobRole = $_REQUEST["course"];
	$skill = $_REQUEST["skill"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		if (checkSubscription($dbHelper, $mysqli, $cid, $_REQUEST["action"], "candidate_skill", "added_date", "cid")) {
			$result = $result = $dbHelper -> performOperation($mysqli, 'sp_insertCandidateSkill', array($cid, $sector, $jobRole, $skill));
			$res -> status = ResponseCreator::$RESPONSE_OK;
		} else {
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$result = "Please upgrade your subscription plan.";
		}
	}
	if ($result == "Success")
		$res -> message = "Job skill added successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function updatePreferedSkill() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$id = $_REQUEST["id"];
	$sector = $_REQUEST["sector"];
	$jobRole = $_REQUEST["course"];
	$skill = $_REQUEST["skill"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$result = $dbHelper -> performOperation($mysqli, 'sp_updateCandidateSkill', array($id, $sector, $jobRole, $skill));
		$res -> status = ResponseCreator::$RESPONSE_OK;
	}
	if ($result == "Success")
		$res -> message = "Job skill updated successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function deletePreferedSkill() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$id = $_REQUEST["id"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$result = $dbHelper -> performOperation($mysqli, 'sp_deleteCandidateSkill', array($id));
		$res -> status = ResponseCreator::$RESPONSE_OK;
	}
	if ($result == "Success")
		$res -> message = "Job skill deleted successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function getDoc() {
	$id = '';
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = isset($_REQUEST["authtoken"]) ? $_REQUEST["authtoken"] : '-1';
	$id = isset($_REQUEST['cid']) ? $_REQUEST['cid'] : "";
	$user = new User;
	$wa = isset($_REQUEST["wa"]) ? $_REQUEST["wa"] : "";

	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($cid == '' && $wa != "true") {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		if ($id != "") {
			$cid = $id;
		}
		$data = $dbHelper -> getData($mysqli, 'sp_getCandidateDoc', array("", $cid));
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}

	$res -> data = $data;
	echo json_encode($res);
}

function deleteDoc() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$id = $_REQUEST["id"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$result = $dbHelper -> performOperation($mysqli, 'sp_deleteCandidateDoc', array($id));
		$res -> status = ResponseCreator::$RESPONSE_OK;
	}
	if ($result == "Success")
		$res -> message = "Document deleted successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function uploadDoc() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$type = $_REQUEST["type"];
	$filename = $_FILES['filename']['name'];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		if (!is_dir("../../docs/" . $cid)) {
			mkdir("../../docs/" . $cid, 0777);
		}
		$target_path = "../../docs/" . $cid . "/";
		$result = "";
		$target_path = $target_path . $filename;
		if (!move_uploaded_file($_FILES['filename']['tmp_name'], $target_path)) {
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$result = "Could not upload file.";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$result = $dbHelper -> performOperation($mysqli, 'sp_insertCandidateDoc', array($cid, $type, $filename));
		}
	}
	if ($result == "Success")
		$res -> message = "Document uploaded successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function uploadEnterpriseDoc() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$panPic = isset($_FILES["panpic"]["name"]) ? $_FILES["panpic"]["name"] : "";
	$gstinCer = isset($_FILES["gstpic"]["name"]) ? $_FILES["gstpic"]["name"] : "";
	$agrement = isset($_FILES["agrement"]["name"]) ? $_FILES["agrement"]["name"] : "";
	$authl = isset($_FILES["authl"]["name"]) ? $_FILES["authl"]["name"] : "";
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$data = $dbHelper -> getDataFromQuery($mysqli, "select aggrement_doc,auth_doc,pan_pic,gstin_cer from member_details where uid='" . $cid . "'");
		if (!is_dir("../../admin/images/candidate/" . $uid)) {
			mkdir("../../admin/images/candidate/" . $uid, 0777);
		}
		$target_path = "../../admin/images/candidate/" . $cid . "/";
		if ($agrement != '') {
			$target_path = $target_path . $agrement;
			move_uploaded_file($_FILES["agrement"]["tmp_name"], $target_path);
		} else
			$agrement = $data[0]["aggrement_doc"];
		if ($authl != '') {
			$target_path = $target_path . $authl;
			move_uploaded_file($_FILES["authl"]["tmp_name"], $target_path);
		} else
			$authl = $data[0]["auth_doc"];
		if ($panPic != '') {
			$target_path = $target_path . $panPic;
			move_uploaded_file($_FILES["panpic"]["tmp_name"], $target_path);
		} else
			$panPic = $data[0]["pan_pic"];
		if ($gstinCer != '') {
			$target_path = $target_path . $gstinCer;
			move_uploaded_file($_FILES["gstpic"]["tmp_name"], $target_path);
		} else
			$gstinCer = $data[0]["gstin_cer"];
		$result = $dbHelper -> performFromQuery($mysqli, "update member_details set aggrement_doc='" . $agrement . "', auth_doc='" . $authl . "'
         , pan_pic='" . $panPic . "',gstin_cer='" . $gstinCer . "' where uid='" . $cid . "'");
		$data = $dbHelper -> getDataFromQuery($mysqli, "select aggrement_doc,auth_doc,pan_pic,gstin_cer from member_details where uid='" . $cid . "'");
		$res -> status = ResponseCreator::$RESPONSE_OK;
		$res -> data = $data;
	}
	if ($result == "Success")
		$res -> message = "Documents uploaded successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function getCurrentlyHired() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $dbHelper -> getData($mysqli, 'sp_getCurrentlyHiredByCid', array($cid));
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}

	$res -> data = $data;
	echo json_encode($res);
}

function rejectJob() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$id = $_REQUEST["id"];
	$reason = $_REQUEST["reason"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$result = $dbHelper -> performOperation($mysqli, 'sp_updateHiredCanidateJobStatus', array($id, "Rejected", $reason));
		$res -> status = ResponseCreator::$RESPONSE_OK;
	}
	if ($result == "Success") {
		RefundCalculator::cancelationAgainstCandidateRejection($dbHelper, $mysqli, $id);
		$res -> message = "Job rejected successfully.";
	} else
		$res -> message = $result;
	echo json_encode($res);
}

function startJob() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$id = $_REQUEST["id"];
	$mcode = $_REQUEST["mcode"];
	$user = new User;
	$eid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	$data = array();
	if ($eid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$data = $dbHelper -> getData($mysqli, 'sp_verifyJobOtp', array($id, $mcode));
		if ((int)$data[0]["num"] > 0) {
			$result = $dbHelper -> performOperation($mysqli, 'sp_updateHiredCanidateJobStatus', array($id, "Joined", ''));
			$res -> status = ResponseCreator::$RESPONSE_OK;
		} else {
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$result = "OTP not verified";
		}

	}
	if ($result == "Success")
		$res -> message = "Job started successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function terminateJob() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$id = $_REQUEST["id"];
	$reason = $_REQUEST["reason"];
	$user = new User;
	$eid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($eid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$result = $dbHelper -> performOperation($mysqli, 'sp_updateHiredCanidateJobStatus', array($id, "Terminated", $reason));
		$res -> status = ResponseCreator::$RESPONSE_OK;
	}
	if ($result == "Success") {
		RefundCalculator::cancelationAgainstTermination($dbHelper, $mysqli, $id);
		$res -> message = "Job terminated successfully.";
	} else
		$res -> message = $result;
	echo json_encode($res);
}

function completeJob() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$id = $_REQUEST["id"];
	$user = new User;
	$eid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($eid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$result = $dbHelper -> performOperation($mysqli, 'sp_updateHiredCanidateJobStatus', array($id, "Completed", ''));
		$res -> status = ResponseCreator::$RESPONSE_OK;
	}
	if ($result == "Success")
		$res -> message = "Job completed successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function getEmpJobLocation() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$user = new User;
	$eid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($eid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $dbHelper -> getData($mysqli, 'sp_getEmpJobLocation', array($eid, ''));
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}

	$res -> data = $data;
	echo json_encode($res);
}

function addEmpJobLocation() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$state = $_REQUEST["state"];
	$district = $_REQUEST["district"];
	$area = $_REQUEST["area"];
	$locality = $_REQUEST["locality"];
	$address = $_REQUEST["address"];
	$latitude = $_REQUEST["lat"];
	$longitude = $_REQUEST["lng"];
	$user = new User;
	$eid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($eid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		if (checkSubscription($dbHelper, $mysqli, $eid, $_REQUEST["action"], "emp_job_loc", "added_date", "emp_id")) {
			$result = $dbHelper -> performOperation($mysqli, 'sp_InsertEmpJobLocation', array($address, $latitude, $longitude, $state, $district, $area, $locality, $eid));
			$res -> status = ResponseCreator::$RESPONSE_OK;
			if ($result == "Success")
				$res -> message = "Job location saved successfully.";
			else
				$res -> message = $result;
		} else {
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$res -> message = "Please upgrade your subscription plan.";
		}
	}

	echo json_encode($res);
}

function updateEmpJobLocation() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$id = $_REQUEST["id"];
	$state = $_REQUEST["state"];
	$district = $_REQUEST["district"];
	$area = $_REQUEST["area"];
	$locality = $_REQUEST["locality"];
	$address = $_REQUEST["address"];
	$latitude = $_REQUEST["lat"];
	$longitude = $_REQUEST["lng"];
	$user = new User;
	$eid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($eid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$result = $dbHelper -> performOperation($mysqli, 'sp_updateEmpJobLocation', array($id, $address, $latitude, $longitude, $state, $district, $area, $locality));
		$res -> status = ResponseCreator::$RESPONSE_OK;
	}
	if ($result == "Success")
		$res -> message = "Job location saved successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function deleteEmpJobLocation() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$id = $_REQUEST["id"];
	$user = new User;
	$eid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($eid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$result = $dbHelper -> performOperation($mysqli, 'sp_deleteEmpJobLocation', array($id));
		$res -> status = ResponseCreator::$RESPONSE_OK;
	}
	if ($result == "Success")
		$res -> message = "Job location deleted successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function addEmployementHistory() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$compName = $_REQUEST["comp_name"];
	$compAddress = $_REQUEST["comp_address"];
	$position = $_REQUEST["position"];
	$contactPerson = $_REQUEST["contact_person"];
	$pincode = $_REQUEST["pincode"];
	$start_date = $_REQUEST["start_date"];
	$end_date = $_REQUEST["end_date"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$result = $dbHelper -> performOperation($mysqli, 'sp_insertOldEmpHistory', array($cid, $compName, $compAddress, $position, $contactPerson, $pincode, $start_date, $end_date));
		$res -> status = ResponseCreator::$RESPONSE_OK;
	}
	if ($result == "Success")
		$res -> message = "Employement history saved successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function updateEmployementHistory() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$id = $_REQUEST["id"];
	$compName = $_REQUEST["comp_name"];
	$compAddress = $_REQUEST["comp_address"];
	$position = $_REQUEST["position"];
	$contactPerson = $_REQUEST["contact_person"];
	$pincode = $_REQUEST["pincode"];
	$start_date = $_REQUEST["start_date"];
	$end_date = $_REQUEST["end_date"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$result = $dbHelper -> performOperation($mysqli, 'sp_updateOldEmpHistory', array($id, $cid, $compName, $compAddress, $position, $contactPerson, $pincode, $start_date, $end_date));
		$res -> status = ResponseCreator::$RESPONSE_OK;
	}
	if ($result == "Success")
		$res -> message = "Employement history saved successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function deleteEmployementHistory() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$id = $_REQUEST["id"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$result = $dbHelper -> performOperation($mysqli, 'sp_deleteOldEmpHistory', array($id));
		$res -> status = ResponseCreator::$RESPONSE_OK;
	}
	if ($result == "Success")
		$res -> message = "Employement history deleted successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function getEmployementHistory() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = isset($_REQUEST["authtoken"]) ? $_REQUEST["authtoken"] : "-1";
	$id = isset($_REQUEST["cid"]) ? $_REQUEST["cid"] : "";
	$wa = isset($_REQUEST["wa"]) ? $_REQUEST["wa"] : "";
	$datetime2='';
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($cid == '' && $wa != "true") {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		if ($id != '') {
			$cid = $id;
		}
		$dataHiredCandidate = array();
		$dataHiredCandidate = $dbHelper -> getData($mysqli, "sp_getHiredCandidateByCid", array($cid));
		for ($i = 0; $i < count($dataHiredCandidate); $i++) {
			$datetime1 = new DateTime($dataHiredCandidate[$i]["from_date"]);
			if($dataHiredCandidate[$i]["from_date"] == $dataHiredCandidate[$i]["to_date"]){
				$datetime2 = new DateTime($dataHiredCandidate[$i]["to_date"].'+1 day');
			}else{
				$datetime2 = new DateTime($dataHiredCandidate[$i]["to_date"]);
			}
			$interval = $datetime1 -> diff($datetime2);
			$dataHiredCandidate[$i]["exp"] = $interval -> format('%y years %m months and %d days');
		}
		$dataOld = array();
		$dataOld = $dbHelper -> getData($mysqli, "sp_getOldEmpHistoryBycid", array($cid));		
		for ($i = 0; $i < count($dataOld); $i++) {
			$datetime1 = new DateTime($dataOld[$i]["start_date"]);
			if($dataOld[$i]["start_date"] == $dataOld[$i]["end_date"]){
				$datetime2 = new DateTime($dataOld[$i]["end_date"].'+1 day');
			}else{
				$datetime2 = new DateTime($dataOld[$i]["end_date"]);
			}
			$interval = $datetime1 -> diff($datetime2);
			$dataOld[$i]["exp"] = $interval -> format('%y years %m months and %d days');
		}
		$data["old"] = $dataOld;
		$data["site"] = $dataHiredCandidate;
		if (count($dataOld) || count($dataHiredCandidate) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}

	$res -> data = $data;
	echo json_encode($res);
}

function addJob() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$title = $_REQUEST["title"];
	$des = $_REQUEST["des"];
	$from_date = $_REQUEST["from_date"];
	$to_date = $_REQUEST["to_date"];
	$job_type_id = $_REQUEST["job_type_id"];
	$from_time = $_REQUEST["from_time"];
	$to_time = $_REQUEST["to_time"];
	$period = $_REQUEST["period"];
	$empJobLocId = $_REQUEST["ejlcid"];
	$sal = $_REQUEST["sal"];
	$job_sector = $_REQUEST["sector"];
	$job_role = $_REQUEST["course"];
	$skill = $_REQUEST["skill"];
	$vr = $_REQUEST["vr"];
	$user = new User;
	$eid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($eid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		if (checkSubscription($dbHelper, $mysqli, $eid, $_REQUEST["action"], "emp_jobs", "to_date", "eid")) {
			$data = array();
			$data = $dbHelper -> getData($mysqli, 'sp_getEmpJobLocation', array('', $empJobLocId));
			$state = $data[0]["state"];
			$district = $data[0]["city"];
			$area = $data[0]["area"];
			$locality = $data[0]["locality"];
			$result = $dbHelper -> performOperation($mysqli, 'sp_insertEmpJobs', array($eid, $title, $des, $from_date, $to_date, $job_type_id, $from_time, $to_time, $state, $district, $area, $locality, $sal, $job_sector, $job_role, $skill, $empJobLocId, $vr));
			$res -> status = ResponseCreator::$RESPONSE_OK;
			if ($result == "Success")
				$res -> message = "Job details saved successfully.";
			else
				$res -> message = $result;
		} else {
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$res -> message = "Please upgrade your subscription.";
		}
	}

	echo json_encode($res);
}

function updateJob() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$id = $_REQUEST["id"];
	$title = $_REQUEST["title"];
	$des = $_REQUEST["des"];
	$from_date = $_REQUEST["from_date"];
	$to_date = $_REQUEST["to_date"];
	$job_type_id = $_REQUEST["job_type_id"];
	$from_time = $_REQUEST["from_time"];
	$to_time = $_REQUEST["to_time"];
	$period = $_REQUEST["period"];
	$empJobLocId = $_REQUEST["ejlcid"];
	$sal = $_REQUEST["sal"];
	$job_sector = $_REQUEST["sector"];
	$job_role = $_REQUEST["course"];
	$skill = $_REQUEST["skill"];
	$user = new User;
	$eid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($eid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getEmpJobLocation', array('', $empJobLocId));
		$state = $data[0]["state"];
		$district = $data[0]["city"];
		$area = $data[0]["area"];
		$locality = $data[0]["locality"];
		$result = $dbHelper -> performOperation($mysqli, 'sp_updateEmpJobs', array($id, $eid, $title, $des, $from_date, $to_date, $job_type_id, $from_time, $to_time, $state, $district, $area, $locality, $sal, $job_sector, $job_role, $skill, $empJobLocId));
		$res -> status = ResponseCreator::$RESPONSE_OK;
	}
	if ($result == "Success")
		$res -> message = "Job details saved successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function deleteJob() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$id = $_REQUEST["id"];
	$user = new User;
	$eid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($eid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$result = $dbHelper -> performOperation($mysqli, 'sp_deleteEmpJobs', array($id));
		$res -> status = ResponseCreator::$RESPONSE_OK;
	}
	if ($result == "Success")
		$res -> message = "Job details deleted successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function addAvailability() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$from_date = $_REQUEST["from_date"];
	$to_date = $_REQUEST["to_date"];
	$job_type_id = $_REQUEST["job_type_id"];
	$from_time = $_REQUEST["from_time"];
	$to_time = $_REQUEST["to_time"];
	$period = $_REQUEST["period"];
	$exp_sal = $_REQUEST["exp_sal"];
	$locId = $_REQUEST["loc_id"];
	$skillId = $_REQUEST["skill_id"];

	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		if (checkSubscription($dbHelper, $mysqli, $cid, $_REQUEST["action"], "candidate_availability", "to_date", "cid")) {
			$dataLoc = array();
			$dataLoc = $dbHelper -> getData($mysqli, 'sp_getCandidateLoc', array($locId, ""));
			$state = $dataLoc[0]["state"];
			$district = $dataLoc[0]["district"];
			$area = $dataLoc[0]["area"];
			$locality = $dataLoc[0]["locality"];

			$dataSkill = array();
			$dataSkill = $dbHelper -> getData($mysqli, 'sp_getCandidateSkill', array($skillId, ""));
			$job_sector = $dataSkill[0]["sector"];
			$job_role = $dataSkill[0]["job_role"];
			$skill = $dataSkill[0]["skill"];
			$result = $dbHelper -> performOperation($mysqli, 'sp_insertCandidateAvailability', array($cid, $from_date, $to_date, $job_type_id, $from_time, $to_time, $state, $district, $area, $locality, $exp_sal, $job_sector, $job_role, $skill));
			$res -> status = ResponseCreator::$RESPONSE_OK;
		} else {
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$result = "Please upgrade your subscription plan.";
		}
	}
	if ($result == "Success")
		$res -> message = "Availability details saved successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function updateAvailability() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$id = $_REQUEST["id"];
	$authtoken = $_REQUEST["authtoken"];
	$from_date = $_REQUEST["from_date"];
	$to_date = $_REQUEST["to_date"];
	$job_type_id = $_REQUEST["job_type_id"];
	$from_time = $_REQUEST["from_time"];
	$to_time = $_REQUEST["to_time"];
	$period = $_REQUEST["period"];
	$exp_sal = $_REQUEST["exp_sal"];
	$locId = $_REQUEST["loc_id"];
	$skillId = $_REQUEST["skill_id"];

	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$dataLoc = array();
		$dataLoc = $dbHelper -> getData($mysqli, 'sp_getCandidateLoc', array($locId, ""));
		$state = $dataLoc[0]["state"];
		$district = $dataLoc[0]["district"];
		$area = $dataLoc[0]["area"];
		$locality = $dataLoc[0]["locality"];

		$dataSkill = array();
		$dataSkill = $dbHelper -> getData($mysqli, 'sp_getCandidateSkill', array($skillId, ""));
		$job_sector = $dataSkill[0]["sector"];
		$job_role = $dataSkill[0]["job_role"];
		$skill = $dataSkill[0]["skill"];
		$result = $dbHelper -> performOperation($mysqli, 'sp_updateAvailabilityById', array($id, $cid, $from_date, $to_date, $job_type_id, $from_time, $to_time, $state, $district, $area, $locality, $exp_sal, $job_sector, $job_role, $skill));
		$res -> status = ResponseCreator::$RESPONSE_OK;
	}
	if ($result == "Success")
		$res -> message = "Availability details saved successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function deleteAvailability() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$id = $_REQUEST["id"];
	$authtoken = $_REQUEST["authtoken"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$result = $dbHelper -> performOperation($mysqli, 'sp_deleteCandidateAvailability ', array($id));
		$res -> status = ResponseCreator::$RESPONSE_OK;
	}
	if ($result == "Success")
		$res -> message = "Availability details deleted successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function getCandidatePassbook() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$dataHiredCandidate = array();
		$dataHiredCandidate = $dbHelper -> getData($mysqli, "sp_getHiredCandidateByCid", array($cid));
		for ($i = 0; $i < count($dataHiredCandidate); $i++) {
			$jobTypeId = $dataHiredCandidate[$i]["job_type_id"];
			$sal = $dataHiredCandidate[$i]["sal"];
			$period = $dataHiredCandidate[$i]["period"];
			$data[$i]["hid"] = $dataHiredCandidate[$i]["hid"];
			$data[$i]["hcid"] = $dataHiredCandidate[$i]["hcid"];
			$data[$i]["job_type_id"] = $dataHiredCandidate[$i]["job_type_id"];
			$data[$i]["from_date"] = $dataHiredCandidate[$i]["from_date"];
			$data[$i]["to_date"] = $dataHiredCandidate[$i]["to_date"];
			$data[$i]["from_time"] = $dataHiredCandidate[$i]["from_time"];
			$data[$i]["to_time"] = $dataHiredCandidate[$i]["to_time"];
			$dataHiredCandidate[$i]["period"] = calculateTotalPeriod($jobTypeId, $period);
			$data[$i]["period"] = $dataHiredCandidate[$i]["period"];
			$dataHiredCandidate[$i]["sal"] = calculateSalery($jobTypeId, $sal);
			$data[$i]["sal"] = $dataHiredCandidate[$i]["sal"];
			$data[$i]["status"] = $dataHiredCandidate[$i]["status"];
			$data[$i]["modified_date"] = $dataHiredCandidate[$i]["modified_date"];
			$data[$i]["company_name"] = $dataHiredCandidate[$i]["company_name"];
			$data[$i]["job_type"] = $dataHiredCandidate[$i]["job_type"];
			$dataAttendence = array();
			$dataAttendence = $dbHelper -> getData($mysqli, "sp_getAttendenceReport", array($jobTypeId, $dataHiredCandidate[$i]["from_date"], $dataHiredCandidate[$i]["to_date"], $dataHiredCandidate[$i]["to_time"], $dataHiredCandidate[$i]["hcid"]));
			$data[$i]["payable_period"] = isset($dataAttendence[0]["payable_period"]) ? $dataAttendence[0]["payable_period"] : "0";
			$data[$i]["absent"] = abs($data[$i]["period"] - $data[$i]["payable_period"]);
			$data[$i]["amount_payable"] = $dataAttendence[0]["payable_period"] * $dataHiredCandidate[$i]["sal"];

		}
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}

	$res -> data = $data;
	echo json_encode($res);
}

function getHiredCandidatePayReport() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$fromdate = $_REQUEST["fromdate"];
	$todate = $_REQUEST["todate"];
	$user = new User;
	$eid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($eid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$dataHiredCandidate = array();
		$dataHiredCandidate = $dbHelper -> getData($mysqli, "sp_getHiredCandidateBetweenDateByEmpJob", array($fromdate, $todate, $eid));
		for ($i = 0; $i < count($dataHiredCandidate); $i++) {
			$jobTypeId = $dataHiredCandidate[$i]["job_type_id"];
			$sal = $dataHiredCandidate[$i]["sal"];
			$period = $dataHiredCandidate[$i]["period"];
			$data[$i]["hid"] = $dataHiredCandidate[$i]["hid"];
			$data[$i]["hcid"] = $dataHiredCandidate[$i]["hcid"];
			$data[$i]["job_type_id"] = $dataHiredCandidate[$i]["job_type_id"];
			$data[$i]["from_date"] = $dataHiredCandidate[$i]["from_date"];
			$data[$i]["to_date"] = $dataHiredCandidate[$i]["to_date"];
			$data[$i]["from_time"] = $dataHiredCandidate[$i]["from_time"];
			$data[$i]["to_time"] = $dataHiredCandidate[$i]["to_time"];
			$dataHiredCandidate[$i]["period"] = calculateTotalPeriod($jobTypeId, $period);
			$data[$i]["period"] = $dataHiredCandidate[$i]["period"];
			$dataHiredCandidate[$i]["sal"] = calculateSalery($jobTypeId, $sal);
			$data[$i]["sal"] = $dataHiredCandidate[$i]["sal"];
			$data[$i]["status"] = $dataHiredCandidate[$i]["status"];
			$data[$i]["modified_date"] = $dataHiredCandidate[$i]["modified_date"];
			$data[$i]["account_number"] = $dataHiredCandidate[$i]["account_number"];
			$data[$i]["ifsc_code"] = $dataHiredCandidate[$i]["ifsc_code"];
			$data[$i]["name"] = $dataHiredCandidate[$i]["name"];
			$data[$i]["pancard"] = $dataHiredCandidate[$i]["pancard"];
			$data[$i]["hdfc"] = $dataHiredCandidate[$i]["hdfc"];
			$data[$i]["job_type"] = $dataHiredCandidate[$i]["job_type"];
			$dataAttendence = array();
			$dataAttendence = $dbHelper -> getData($mysqli, "sp_getAttendenceReport", array($jobTypeId, $dataHiredCandidate[$i]["from_date"], $dataHiredCandidate[$i]["to_date"], $dataHiredCandidate[$i]["to_time"], $dataHiredCandidate[$i]["hcid"]));
			$data[$i]["candidate_id"] = $dataAttendence[0]["candidate_id"];
			$data[$i]["payable_period"] = $dataAttendence[0]["payable_period"];
			$data[$i]["absent"] = abs($data[$i]["period"] - $data[$i]["payable_period"]);
			$data[$i]["amount_payable"] = $dataAttendence[0]["payable_period"] * $dataHiredCandidate[$i]["sal"];

		}
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}

	$res -> data = $data;
	echo json_encode($res);
}

function getBankDetail() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $dbHelper -> getData($mysqli, 'sp_getBankDetails', array($cid));
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}
	$res -> data = $data;
	echo json_encode($res);
}

function saveBankDetail() {
	$result = "";
	$chaque = '';
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = isset($_REQUEST["authtoken"]) ? $_REQUEST["authtoken"] : "-1";
	$bankname = $_REQUEST["bank_name"];
	$accountnumber = $_REQUEST["account_number"];
	$ifsc = $_REQUEST["ifsc_code"];
	$holdername = $_REQUEST["account_holder_name"];
	$hdfc = $_REQUEST["hdfc"];
	$chaque = isset($_FILES["chequepic"]["name"]) ? $_FILES["chequepic"]["name"] : "";
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		if (!is_dir("../../admin/images/candidate/" . $cid)) {
			mkdir("../../admin/images/candidate/" . $cid, 0777);
		}
		if ($chaque != '') {
			move_uploaded_file($_FILES["chequepic"]["tmp_name"], "../../admin/images/candidate/" . $cid . "/" . $chaque);
		} else {
			$data = $dbHelper -> getData($mysqli, 'sp_getBankDetails', array($cid));
			$chaque = $data[0]['chaque'];
		}
		$result = $dbHelper -> performOperation($mysqli, 'sp_saveBankDetails', array($cid, $bankname, $accountnumber, $ifsc, $holdername, $hdfc, $chaque));
		$res -> status = ResponseCreator::$RESPONSE_OK;
	}
	if ($result == "Success")
		$res -> message = "Bank Details saved successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function deleteBankDetail() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$user = new User;
	$cid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($cid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$result = $dbHelper -> performOperation($mysqli, 'sp_deleteBankDetails', array($cid));
		$res -> status = ResponseCreator::$RESPONSE_OK;
	}
	if ($result == "Success")
		$res -> message = "Bank Details deleted successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function getDistrict() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$id = $_REQUEST["id"];
	$res = new ResponseCreator;
	$data = $dbHelper -> getData($mysqli, 'sp_getDistrictByStateId', array($id));
	if (count($data) > 0) {
		$res -> status = ResponseCreator::$RESPONSE_OK;
		$res -> message = "Success";
	} else {
		$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
		$res -> message = "No data";
	}
	$res -> data = $data;
	echo json_encode($res);
}

function getArea() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$id = $_REQUEST["id"];
	$res = new ResponseCreator;
	$data = $dbHelper -> getData($mysqli, 'sp_getAreaByDistrictId', array($id));
	if (count($data) > 0) {
		$res -> status = ResponseCreator::$RESPONSE_OK;
		$res -> message = "Success";
	} else {
		$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
		$res -> message = "No data";
	}
	$res -> data = $data;
	echo json_encode($res);
}

function getLocal() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$id = $_REQUEST["id"];
	$res = new ResponseCreator;
	$data = $dbHelper -> getData($mysqli, 'sp_getLocalityByAreaId', array($id));
	if (count($data) > 0) {
		$res -> status = ResponseCreator::$RESPONSE_OK;
		$res -> message = "Success";
	} else {
		$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
		$res -> message = "No data";
	}
	$res -> data = $data;
	echo json_encode($res);
}

function getSkill() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$id = $_REQUEST["id"];
	$res = new ResponseCreator;
	$data = $dbHelper -> getData($mysqli, 'sp_getSkillByCourseId', array($id));
	if (count($data) > 0) {
		$res -> status = ResponseCreator::$RESPONSE_OK;
		$res -> message = "Success";
	} else {
		$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
		$res -> message = "No data";
	}
	$res -> data = $data;
	echo json_encode($res);
}

function rejectCandidate() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$avId = $_REQUEST["avid"];
	$user = new User;
	$eid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($eid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$result = $dbHelper -> performOperation($mysqli, 'sp_deleteShortlistedCandidateByAv', array($avId));
		$res -> status = ResponseCreator::$RESPONSE_OK;
	}
	if ($result == "Success")
		$res -> message = "Candidate rejected successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function getAvailability() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	if (isset($_REQUEST["cid"]))
		$cid = $_REQUEST["cid"];
	if (isset($_REQUEST["avid"]))
		$avid = $_REQUEST["avid"];
	$user = new User;
	$id = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($id == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		if ($cid == '') {
			if ($avid == '') {
				$data = $dbHelper -> getData($mysqli, 'sp_getAvailability', array($id));
			} else {
				$data = $dbHelper -> getData($mysqli, 'sp_getAvailabilityById', array($avid));
			}
		} else {
			if ($avid == '') {
				$data = $dbHelper -> getData($mysqli, 'sp_getAvailability', array($cid));
			} else {
				$data = $dbHelper -> getData($mysqli, 'sp_getAvailabilityById', array($avid));
			}
		}
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}
	$res -> data = $data;
	echo json_encode($res);
}

function getJobs() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	if (isset($_REQUEST["ejid"]))
		$ejid = $_REQUEST["ejid"];
	$user = new User;
	$id = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($id == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		if ($ejid == '')
			$data = $dbHelper -> getData($mysqli, 'sp_getEmpJobsByEid', array($id));
		else
			$data = $dbHelper -> getData($mysqli, 'sp_getEmpJobsbyId', array($ejid));
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}

	$res -> data = $data;
	echo json_encode($res);
}

function getAvailableCandidates() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$ejid = $_REQUEST["ejid"];
	$user = new User;
	$id = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($id == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $dbHelper -> getData($mysqli, 'sp_getAvailableCandidateForJob', array($ejid));
		if (count($data) > 0) {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}
	$res -> data = $data;
	echo json_encode($res);
}

function candidateAttendance() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$long = $_REQUEST["long"];
	$lat = $_REQUEST["lat"];
	$user = new User;
	$id = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($id == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {  					
		$data = $dbHelper -> getData($mysqli, "sp_getEmpJobByCid", array($id));
		$empJobId = $data[0]["emp_job_id"];
		$data = $dbHelper -> getData($mysqli, "sp_getLocationByEmpJob", array($empJobId));
		$distance = getMetersBetweenPoints($lat, $long, $data[0]["latitude"], $data[0]["longitude"]);
		$valid = "NO";
		if ($distance <= 50)
			$valid = "YES";
		$result = $dbHelper -> performOperation($mysqli, 'sp_insertCandidateAttandence', array($id, $lat, $long, $empJobId, $valid));
		if ($result == "Success") {
			$att = array();
			$att = $dbHelper -> getData($mysqli, 'sp_getCandidateAtttendance', array($id));
			if (count($att) > 0)
				$attendence = $att[0]["type"];
			/* added candidate earning */
				if($attendence == "OUT"){
				   	$result = $dbHelper -> performOperation($mysqli, 'sp_insertDailyEarningReport', array($id,'Approved'));
				}
			/* End candidate earning */	
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> data = array('att' => $attendence);

		} else {
			$res -> status = ResponseCreator::$OTHER_ERROR;
		}
		$res -> message = $result;
	}
	echo json_encode($res);

}

function playVideo() {
	$filePath = "../" . $_REQUEST["video"];
	//echo $filePath;
	$stream = new VideoStream($filePath);
	$stream -> start();
}

function getLatestVersion() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$version = new Version;
	$res = new ResponseCreator;
	$data = array();
	$data = $version -> getLatestVersion($mysqli, $dbHelper);
	if (count($data) > 0) {
		$res -> data = $data;
		$res -> status = ResponseCreator::$RESPONSE_OK;
		$res -> message = "success";
	} else {
		$res -> data = $data;
		$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
		$res -> message = "No Data";
	}
	echo json_encode($res);
}

function getMssages() {
	$authtoken = $_REQUEST["authtoken"];
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$message = new Message;
	$user = new User;
	$id = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($id == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = array();
		$data = $message -> getInbox($dbHelper, $mysqli, $id, '');
		if (count($data) > 0) {
			$res -> data = $data;
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "success";
		} else {
			$res -> data = $data;
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No Data";
		}
	}
	echo json_encode($res);
}

function sendMessage() {
	$authtoken = $_REQUEST["authtoken"];
	$subject = clean($_REQUEST["subject"]);
	$msg = clean($_REQUEST["msg"]);
	$msgto = clean($_REQUEST["msgto"]);
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$message = new Message;
	$user = new User;
	$id = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($id == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = array();
		$result = $message -> sendMessageApi($dbHelper, $mysqli, $id, $subject, $msg, $msgto);
		if ($result == "Success") {
			$res -> data = $data;
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = $result;
		} else {
			$res -> data = $data;
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$res -> message = $result;
		}
	}
	echo json_encode($res);
}

function readMessage() {
	$authtoken = $_REQUEST["authtoken"];
	$mid = clean($_REQUEST["mid"]);
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$message = new Message;
	$user = new User;
	$id = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($id == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$dbHelper -> performOperation($mysqli, 'sp_updateMsgReadStatus', array($mid, $id, "YES"));
		$data = array();
		$data = $message -> getMessagesWithReply($dbHelper, $mysqli, $mid);
		if (count($data) > 0) {
			$res -> data = $data;
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
		} else {
			$res -> data = $data;
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No Data";
		}
	}
	echo json_encode($res);
}

function replyMessage() {
	$authtoken = $_REQUEST["authtoken"];
	$mid = $_REQUEST["mid"];
	$status = $_REQUEST["status"];
	$msg = clean($_REQUEST["msg"]);
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$message = new Message;
	$user = new User;
	$id = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($id == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = array();
		$result = $message -> sendMessageReplyApi($dbHelper, $mysqli, $id, $mid, $msg, $status);
		if ($result == "Success") {
			$res -> data = $data;
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = $result;
		} else {
			$res -> data = $data;
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$res -> message = $data;
		}
	}
	echo json_encode($res);
}

function hireCandidate() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$empJobId = $_REQUEST["ejid"];
	$avId = $_REQUEST["avid"];
	$mobilecode = sprintf("%06d", mt_rand(200000, 999999));
	$user = new User;
	$id = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($id == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
		echo json_encode($res);
	} else {
		$availability = array();
		$availability = $dbHelper -> getData($mysqli, 'sp_getAvailabilityById', array($avId));
		$job = array();
		$job = $dbHelper -> getData($mysqli, 'sp_getEmpJobsbyId', array($empJobId));
		$params = array($availability[0]["cid"], $availability[0]["from_date"], $availability[0]["to_date"], $availability[0]["from_time"], $availability[0]["to_time"], $availability[0]["period"], $availability[0]["job_type_id"], $availability[0]["exp_sal"], $job[0]["t1id"], $job[0]["eid"], $job[0]["from_date"], $job[0]["to_date"], $job[0]["from_time"], $job[0]["to_time"], $job[0]["period"], $job[0]["job_type_id"], $job[0]["sal"], $avId, $availability[0]["state"], $availability[0]["district"], $availability[0]["area"], $availability[0]["locality"], $availability[0]["job_sector"], $availability[0]["job_role"], $availability[0]["skill"], $mobilecode, $job[0]["emp_job_loc_id"]);
		$result = $dbHelper -> multiquery($mysqli, 'trs_hireCandidate', $params, "Select @fromdate,@toDate,@mobile,@comp,@address;", array('@fromdate', '@toDate', '@mobile', '@comp', '@address'));
		if ($result[0] == "Success") {
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Candidate hired successfully.";
			echo json_encode($res);
			$mobile = $result[3];
			$compName = urlencode($result[4]);
			$address = urlencode($result[5]);
			$message = "You%20have%20been%20hired%20for%20period%20$result[1]%20to%20$result[2]%20by%20$compName.Reporting%20address%20is%20$address.OTP%20for%20joining%20is%20:%20$mobilecode.";
			sendSms($mobile, $message);
		} else {
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$res -> message = $result[0];
			echo json_encode($res);
		}
	}
}

function rehireCandidate() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$empJobId = $_REQUEST["emp_job_id"];
	$candidateId = $_REQUEST["cid"];
	$mobilecode = sprintf("%06d", mt_rand(200000, 999999));
	$dbHelper = new DBHelper;
	$user = new User;
	$id = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($id == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
		echo json_encode($res);
	} else {
		$job = array();
		$job = $dbHelper -> getData($mysqli, 'sp_getEmpJobsbyId', array($empJobId));
		$availability = array();
		$availability = $dbHelper -> getData($mysqli, 'sp_getAvailabilityForRehire', array($candidateId, $job[0]["from_date"], $job[0]["to_date"], $job[0]["job_type_id"]));

		if (count($availability) > 0) {
			$params = array($availability[0]["cid"], $availability[0]["from_date"], $availability[0]["to_date"], $availability[0]["from_time"], $availability[0]["to_time"], $availability[0]["period"], $availability[0]["job_type_id"], $availability[0]["exp_sal"], $job[0]["t1id"], $job[0]["eid"], $job[0]["from_date"], $job[0]["to_date"], $job[0]["from_time"], $job[0]["to_time"], $job[0]["period"], $job[0]["job_type_id"], $job[0]["sal"], $availability[0]["id"], $availability[0]["state"], $availability[0]["district"], $availability[0]["area"], $availability[0]["locality"], $availability[0]["job_sector"], $availability[0]["job_role"], $availability[0]["skill"], $mobilecode, $job[0]["emp_job_loc_id"]);
			$result = $dbHelper -> multiquery($mysqli, 'trs_hireCandidate', $params, "Select @fromdate,@toDate,@mobile,@comp,@address;", array('@fromdate', '@toDate', '@mobile', '@comp', '@address'));
			if ($result[0] == "Success") {
				$res -> status = ResponseCreator::$RESPONSE_OK;
				$res -> message = "Candidate hired successfully.";
				echo json_encode($res);
				$mobile = $result[3];
				$compName = urlencode($result[4]);
				$address = urlencode($result[5]);
				$message = "You%20have%20been%20hired%20for%20period%20$result[1]%20to%20$result[2]%20by%20$compName.Reporting%20address%20is%20$address.OTP%20for%20joining%20is%20:%20$mobilecode.";
				sendSms($mobile, $message);
			} else {
				$res -> status = ResponseCreator::$OTHER_ERROR;
				$res -> message = $result[0];
				echo json_encode($res);
			}

		} else {
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$res -> message = "Candidate is not available for rehire.";
			echo json_encode($res);
		}
	}

}

function getHired() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	if (isset($_REQUEST["ejid"]))
		$ejid = $_REQUEST["ejid"];
	$user = new User;
	$id = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($id == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		$data = $dbHelper -> getData($mysqli, 'sp_getHiredCandiadteWithSkillAndLocal', array($id, $ejid));
	}
	if (count($data) > 0) {
		for ($i = 0; $i < count($data); $i++) {
			if ($data[$i]["profile_pic"] != "") {
				$data[$i]["profile_pic"] = "admin/images/candidate/" . $data[$i]["uid"] . "/" . $data[$i]["profile_pic"];
			} else {
				$profile_pic = "NULL";
			}
		}
		$res -> status = ResponseCreator::$RESPONSE_OK;
		$res -> message = "Success";
		$res -> data = $data;
	} else {
		$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
		$res -> message = "No data";
	}
	$res -> data = $data;
	echo json_encode($res);

}

function shortlistCandidate() {
	$result = "";
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	$cid = $_REQUEST["cid"];
	$empJobId = $_REQUEST["ejid"];
	$avId = $_REQUEST["avid"];
	$user = new User;
	$eid = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$res = new ResponseCreator;
	if ($eid == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$result = "Invalid Access";
	} else {
		$result = $dbHelper -> performOperation($mysqli, 'sp_shortlistCandidateEmp', array($cid, $eid, $empJobId, $avId));
		$res -> status = ResponseCreator::$RESPONSE_OK;
	}
	if ($result == "Success")
		$res -> message = "Candidate shortlisted successfully.";
	else
		$res -> message = $result;
	echo json_encode($res);
}

function getShortlisted() {
	$dbHelper = new DBHelper;
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$authtoken = $_REQUEST["authtoken"];
	if (isset($_REQUEST["ejid"]))
		$ejid = $_REQUEST["ejid"];
	$user = new User;
	$id = $user -> getUserByAuth($dbHelper, $mysqli, $authtoken);
	$data = array();
	$res = new ResponseCreator;
	if ($id == '') {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	} else {
		if ($ejid == '') {
			$data = $dbHelper -> getData($mysqli, 'sp_getShortlistedCandidateByEmp', array($id));
		} else {
			$data = $dbHelper -> getData($mysqli, 'sp_getShortleitedCandidateByJob', array($ejid));
		}
		if (count($data) > 0) {
			for ($i = 0; $i < count($data); $i++) {
				if ($data[$i]["profile_pic"] != "") {
					$data[$i]["profile_pic"] = "admin/images/candidate/" . $data[$i]["cid"] . "/" . $data[$i]["profile_pic"];
				} else {
					$profile_pic = "NULL";
				}
			}
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Success";
			$res -> data = $data;
		} else {
			$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
			$res -> message = "No data";
		}
	}

	$res -> data = $data;
	echo json_encode($res);
}

function forgotPassword() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

	$mobile = $_REQUEST["mobile"];
	$user_role = $_REQUEST["user_role"];
	$rpassword = random_password(6);
	$res = new ResponseCreator();
	$q = "select id from members where username='" . $mobile . "' and user_role='" . $user_role . "'";
	$r = mysqli_query($mysqli, $q);
	if (mysqli_num_rows($r) > 0) {
		$data = array();
		$v = mysqli_fetch_assoc($r);
		$id = $v["id"];
		$password = hash('sha512', $rpassword);

		$random_salt = hash('sha512', uniqid(rand(1, 10000000), TRUE));
		$password = hash('sha512', $password . $random_salt);

		$q = "update members set password = '" . $password . "', salt = '" . $random_salt . "' where id = '" . $id . "'";
		mysqli_query($mysqli, $q);
		$msisdn = $mobile;
		$message = "Your%20new%20password%20is:%20" . $rpassword;
		$varUserName = "t1cybssapi";
		$varPWD = "55200745";
		$varSenderID = "CHAMPS";
		$varPhNo = $msisdn;
		$varMSG = $message;
		$url = "http://nimbusit.co.in/api/swsendSingle.asp";
		$data = "username=" . $varUserName . "&password=" . $varPWD . "&sender=" . $varSenderID . "&sendto=" . $varPhNo . "&message=" . $varMSG;
		postData($url, $data);
		$res -> status = ResponseCreator::$RESPONSE_OK;
		$res -> message = "success";

	} else {

		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	}
	echo json_encode($res);
}

function changePassword() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

	$authtoken = $_REQUEST["authtoken"];
	$user_role = $_REQUEST["user_role"];
	$password = $_REQUEST["password"];
	$res = new ResponseCreator();
	$q = "select id from members where authtoken='" . $authtoken . "'";
	$r = mysqli_query($mysqli, $q);
	if (mysqli_num_rows($r) > 0) {
		$data = array();
		$v = mysqli_fetch_assoc($r);
		$id = $v["id"];
		$password = hash('sha512', $password);

		$random_salt = hash('sha512', uniqid(rand(1, 10000000), TRUE));
		$password = hash('sha512', $password . $random_salt);

		$q = "update members set password = '" . $password . "', salt = '" . $random_salt . "' where id = '" . $id . "'";
		mysqli_query($mysqli, $q);
		$res -> status = ResponseCreator::$RESPONSE_OK;
		$res -> message = "success";

	} else {

		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	}
	echo json_encode($res);
}

/*  Update  Profile Pic */
function updateProfilePic() {
	$data = array();
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$res = new ResponseCreator();
	//$id='2782';
	$authtoken = isset($_REQUEST["authtoken"])?$_REQUEST["authtoken"]:"-1";
	$q = "select id from members where authtoken='" . $authtoken . "'";
	$r = mysqli_query($mysqli, $q);
	if (mysqli_num_rows($r) > 0) {
		//if($id){
		$v = mysqli_fetch_assoc($r);
		$id = $v["id"];
		if (!is_dir("../../admin/images/candidate/" . $id)) {
			mkdir("../../admin/images/candidate/" . $id, 0777);
		}
		$profile_pic = isset($_FILES["profile_pic"]["name"]);
		if ($profile_pic != '') {

			$filename = time() . ".jpg";
			$query = "update member_details set 
                            profile_pic='" . $filename . "'
                            where uid ='" . $id . "'
                ";
			$mysqli -> query($query);
			move_uploaded_file($_FILES["profile_pic"]["tmp_name"], "../../admin/images/candidate/" . $id . "/" . $filename);
		}

		$q1 = "SELECT * FROM member_details WHERE uid = '" . $id . "' limit 0,1";
		$r1 = mysqli_query($mysqli, $q1);
		$v1 = mysqli_fetch_assoc($r1);
		$profile_pic = "admin/images/candidate/" . $v1["uid"] . "/" . $v1["profile_pic"];
		$rowArr = array('id' => $v1["uid"],'profile_pic' => $profile_pic);
		array_push($data, $rowArr);
		$res -> data = $data;
		$res -> status = ResponseCreator::$RESPONSE_OK;
		$res -> message = "success";
	} else {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	}
	//	echo "<pre>";print_r($res);exit;
	echo json_encode($res);
}

/* End Profile Pic Update */
/* Update Profile */
function updateProfile() {
	$data = array();
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

	$authtoken = $_REQUEST["authtoken"];
	$user_role = $_REQUEST["user_role"];
	$res = new ResponseCreator();
	$q = "select id from members where authtoken='" . $authtoken . "'";
	$r = mysqli_query($mysqli, $q);

	if (mysqli_num_rows($r) > 0) {
		$data = array();
		$v = mysqli_fetch_assoc($r);
		$id = $v["id"];
		if ($user_role == "200" || $user_role == "700" || $user_role == "500") {

			$name = clean($_REQUEST["name"]);
			$father_name = clean($_REQUEST["father_name"]);
			$dob = clean($_REQUEST["dob"]);
			$gender = clean($_REQUEST["gender"]);
			$marital_status = clean($_REQUEST["marital_status"]);
			$email = clean($_REQUEST["email"]);
			$aadhaar = clean($_REQUEST["aadhaar"]);
			$address = clean($_REQUEST["address"]);
			$state = clean($_REQUEST["state"]);
			$city = clean($_REQUEST["city"]);
			$pincode = clean($_REQUEST["pincode"]);
			$facebook = clean($_REQUEST["facebook"]);
			$linkedin = clean($_REQUEST["linkedin"]);
			$q = "update member_details set
                    name='" . $name . "',
                    father_name='" . $father_name . "',
                    dob='" . $dob . "',
                    gender='" . $gender . "',
                    marital_status='" . $marital_status . "',
                    email='" . $email . "',
                    address='" . $address . "',
                    city='" . $city . "',
                    state='" . $state . "',
                    pincode='" . $pincode . "',
                    aadhaar='" . $aadhaar . "',
                    facebook='" . $facebook . "',
                    linkedin='" . $linkedin . "'
                    where uid='" . $id . "'
                    
                    ";
			$mysqli -> query($q);
		} else if ($user_role == "400") {
			$name = clean($_REQUEST["name"]);
			$company_name = clean($_REQUEST["company_name"]);
			$mobile = clean($_REQUEST["mobile"]);
			$landline = clean($_REQUEST["landline"]);
			$email = clean($_REQUEST["email"]);
			$aadhaar = clean($_REQUEST["aadhaar"]);
			$address = clean($_REQUEST["address"]);
			$pincode = clean($_REQUEST["pincode"]);
			$facebook = clean($_REQUEST["facebook"]);
			$linkedin = clean($_REQUEST["linkedin"]);
			$gstin = clean($_REQUEST["gstin"]);
			$pan_no = clean($_REQUEST["pan_no"]);
			$tan_no = clean($_REQUEST["tan_no"]);

			$q = "update member_details set
                    name='" . $name . "',
                    mobile='" . $mobile . "',
                    company_name='" . $company_name . "',
                    landline='" . $landline . "',
                    email='" . $email . "',
                    address='" . $address . "',
                    pincode='" . $pincode . "',
                    aadhaar='" . $aadhaar . "',
                    facebook='" . $facebook . "',
                    linkedin='" . $linkedin . "',
                    gstin='" . $gstin . "',
                    pan_no='" . $pan_no . "',
                    tan_no='" . $tan_no . "'
                    where uid='" . $id . "'
                    
                    ";
			$mysqli -> query($q);
		} else if ($user_role == "800") {
			$name = clean($_REQUEST["name"]);
			$company_name = clean($_REQUEST["company_name"]);
			$mobile = clean($_REQUEST["mobile"]);
			$landline = clean($_REQUEST["landline"]);
			$email = clean($_REQUEST["email"]);
			$aadhaar = clean($_REQUEST["aadhaar"]);
			$address = clean($_REQUEST["address"]);
			$pincode = clean($_REQUEST["pincode"]);
			$state = clean($_REQUEST["state"]);
			$city = clean($_REQUEST["city"]);
			$facebook = clean($_REQUEST["facebook"]);
			$linkedin = clean($_REQUEST["linkedin"]);
			$gstin = clean($_REQUEST["gstin"]);
			$pan_no = clean($_REQUEST["pan_no"]);
			$tan_no = clean($_REQUEST["tan_no"]);

			$q = "update member_details set
                    name='" . $name . "',
                    mobile='" . $mobile . "',
                    company_name='" . $company_name . "',
                    landline='" . $landline . "',
                    email='" . $email . "',
                    address='" . $address . "',
                    pincode='" . $pincode . "',
                    aadhaar='" . $aadhaar . "',
                    facebook='" . $facebook . "',
                    linkedin='" . $linkedin . "',
                    gstin='" . $gstin . "',
                    pan_no='" . $pan_no . "',
                    tan_no='" . $tan_no . "'
                    where uid='" . $id . "'
                    
                    ";
			$mysqli -> query($q);
		}
		if (!is_dir("../../admin/images/candidate/" . $id)) {
            mkdir("../../admin/images/candidate/" . $id, 0777);
        }
        $profile_pic = isset($_FILES["profile_pic"]["name"]);
        if ($profile_pic != '') {

            $filename = time() . ".jpg";
            $query = "update member_details set 
                            profile_pic='" . $filename . "'
                            where uid ='" . $id . "'
                ";
            $mysqli -> query($query);
            move_uploaded_file($_FILES["profile_pic"]["tmp_name"], "../../admin/images/candidate/" . $id . "/" . $filename);
        }
		
		$q1 = "SELECT * FROM member_details WHERE uid = '" . $id . "' limit 0,1";
		$r1 = mysqli_query($mysqli, $q1);
		$v1 = mysqli_fetch_assoc($r1);
		$rowArr = array('id' => $v1["uid"], 'authtoken' => $authtoken, 'name' => $v1["name"], 'company_name' => $v1["company_name"], 'aadhaar' => $v1["aadhaar"], 'mobile' => $v1["mobile"], 'email' => $v1["email"], 'address' => $v1["address"], 'pincode' => $v1["pincode"], 'user_role' => $user_role, 'father_name' => $v1["father_name"], 'jobcategory' => $v1["jobcategory"], 'phone' => $v1["phone"], 'dob' => $v1["dob"], 'gender' => $v1["gender"], 'marital_status' => $v1["marital_status"], 'alternate_id' => $v1["alternate_id"], 'alternate_id_no' => $v1["alternate_id_no"], 'state' => $v1["state"], 'city' => $v1["city"], 'facebook' => $v1["facebook"], 'linkedin' => $v1["linkedin"], 'twitter' => $v1["twitter"], 'instagram' => $v1["instagram"], 'pan_no' => $v1["pan_no"], 'tan_no' => $v1["tan_no"]);
		array_push($data, $rowArr);
		$res -> data = $data;
		$res -> status = ResponseCreator::$RESPONSE_OK;
		$res -> message = "success";

	} else {

		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	}
	echo json_encode($res);
}
/* End Update Profile */
function getVideo() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$res = new ResponseCreator();
	$authtoken = isset($_REQUEST["authtoken"]) ? $_REQUEST["authtoken"] : "-1";
	$wa = isset($_REQUEST["wa"]) ? $_REQUEST["wa"] : "";
	$cid = isset($_REQUEST["cid"]) ? $_REQUEST["cid"] : "";
	$q = "select id from members where authtoken='" . $authtoken . "'";
	$r = mysqli_query($mysqli, $q);
	if (mysqli_num_rows($r) > 0 && $wa != "true") {
		$data = array();
		$v = mysqli_fetch_assoc($r);
		$id = $v["id"];
		if ($cid != '')
			$id = $cid;
		$q1 = "SELECT * FROM videos where uid='" . $id . "' order by vid desc";
		$r1 = mysqli_query($mysqli, $q1);

		while ($values = mysqli_fetch_assoc($r1)) {

			if ($values["vtype"] == "mp4") {
				$videoURL = "videos/" . $id . "/" . $values["video"];
			} else {
				$videoURL = $values["video"];
			}
			$rowArr = array('vid' => $values["vid"], 'video' => $videoURL, 'status' => $values["status"], 'posted_on' => $values["posted_on"], 'approved_on' => $values["approved_on"], 'reason' => $values["reason"], 'vtype' => $values["vtype"], 'tag' => $values["tag"]);

			array_push($data, $rowArr);
		}
		$res -> data = $data;
		$res -> status = ResponseCreator::$RESPONSE_OK;
		$res -> message = "success";

	} else {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	}
	echo json_encode($res);
}

function uploadVideo() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$res = new ResponseCreator();
	$authtoken = $_REQUEST["authtoken"];
	$videoUrl = $_REQUEST["url"];
	$tag = $_REQUEST["tag"];
	$posted_on = date('Y-m-d H:i:s');
	$q = "select id,jobcategory from 
            members 
            inner join member_details
            on members.id = member_details.uid
            where authtoken='" . $authtoken . "'";
	$r = mysqli_query($mysqli, $q);
	if (mysqli_num_rows($r) > 0) {
		$v = mysqli_fetch_assoc($r);
		$id = $v["id"];
		$dbHelper = new DBHelper;
		if (checkSubscription($dbHelper, $mysqli, $id, $_REQUEST["action"], "videos", "posted_on", "uid")) {
			$query = "";
			if (strpos($videoUrl, 'youtube') !== false) {
				$youtube1 = explode("?", $videoUrl);
				$video = substr($youtube1[1], 2);
				$query = "insert into videos(tag,uid,youtube,video,posted_by,posted_on)
                        values('" . $tag . "','" . $id . "','" . $videoUrl . "','" . $video . "','" . $id . "','" . $posted_on . "')";
			} elseif (strpos($videoUrl, 'drive.google') !== false) {
				$youtube1 = explode("=", $videoUrl);
				$video = $youtube1[1];
				$query = "insert into videos(tag,drive,video,vtype,uid,posted_on)
                    values('" . $tag . "','" . $youtube . "','" . $video . "','drive','" . $id . "','" . $posted_on . "')";
			}
			mysqli_query($mysqli, $query);
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Video uploaded successfully";
		} else {
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$res -> message = "Please upgrade your subscription plan.";
		}
	} else {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Invalid Access";
	}
	echo json_encode($res);
}

function verifyMobile() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$mcode = $_REQUEST["mcode"];
	$res = new ResponseCreator();
	$authtoken = "";
	$q = "";
	$username = "";
	if (isset($_REQUEST["username"]))
		$username = $_REQUEST["username"];
	if (isset($_REQUEST["authtoken"]))
		$authtoken = $_REQUEST["authtoken"];
	if ($authtoken != "")
		$q = "select mcode,username from members where authtoken='" . $authtoken . "'";
	else
		$q = "select mcode,username from members where username='" . $username . "'";
	$r = mysqli_query($mysqli, $q);
	if (mysqli_num_rows($r) > 0) {
		$v = mysqli_fetch_assoc($r);
		$dbmcode = $v["mcode"];
		if ($mcode == $dbmcode) {
			$q = "update members set mobile_verification='YES' where authtoken='" . $authtoken . "'";
			mysqli_query($mysqli, $q);
			$res -> status = ResponseCreator::$RESPONSE_OK;
			$res -> message = "Mobile number verified successfully";
			$msisdn = $v["username"];
			$message = "Thanks%20for%20Registering%20with%20SkillChamps.";
			$varUserName = "t1cybssapi";
			$varPWD = "55200745";
			$varSenderID = "CHAMPS";
			$varPhNo = $msisdn;
			$varMSG = $message;
			$url = "http://nimbusit.co.in/api/swsendSingle.asp";
			$data = "username=" . $varUserName . "&password=" . $varPWD . "&sender=" . $varSenderID . "&sendto=" . $varPhNo . "&message=" . $varMSG;
			postData($url, $data);
		} else {
			$res -> status = ResponseCreator::$OTHER_ERROR;
			$res -> message = "Invalid Code";

		}
	} else {
		$res -> status = ResponseCreator::$OTHER_ERROR;
		$res -> message = "Invalid Code";

	}
	echo json_encode($res);
}

function resendCode() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$res = new ResponseCreator();
	$authtoken = "";
	$q = "";
	$username = "";
	if (isset($_REQUEST["username"]))
		$username = $_REQUEST["username"];
	if (isset($_REQUEST["authtoken"]))
		$authtoken = $_REQUEST["authtoken"];
	if ($authtoken != "")
		$q = "select mcode,username from members where authtoken='" . $authtoken . "'";
	else
		$q = "select mcode,username from members where username='" . $username . "'";
	$r = mysqli_query($mysqli, $q);
	if (mysqli_num_rows($r) > 0) {
		$v = mysqli_fetch_assoc($r);
		$mobilecode = $v["mcode"];
		$msisdn = $v["username"];
		$message = "Verification%20code%20from%20www.skillchamps.com%20-%20$mobilecode.";
		$varUserName = "t1cybssapi";
		$varPWD = "55200745";
		$varSenderID = "CHAMPS";
		$varPhNo = $msisdn;
		$varMSG = $message;
		$url = "http://nimbusit.co.in/api/swsendSingle.asp";
		$data = "username=" . $varUserName . "&password=" . $varPWD . "&sender=" . $varSenderID . "&sendto=" . $varPhNo . "&message=" . $varMSG;
		postData($url, $data);
		$res -> status = ResponseCreator::$RESPONSE_OK;
		$res -> message = "Success";
	} else {
		$res -> status = ResponseCreator::$OTHER_ERROR;
		$res -> message = "Invalid access";
	}
	echo json_encode($res);
}

function registerUser() {
	$mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$res = new ResponseCreator();
	$name = $_REQUEST["name"];
	$company_name = $_REQUEST["company_name"];
	$phone = $_REQUEST["phone"];
	$user_role = $_REQUEST["user_role"];
	$email = $_REQUEST["email"];
	$pincode = $_REQUEST["pincode"];
	$aadhaar = $_REQUEST["aadhaar"];
	$job = $_REQUEST["job"];
	$skillmitra = $_REQUEST["skillmitra"];
	$state = $_REQUEST["state"];
	$city = $_REQUEST["city"];
	$dob = $_REQUEST["dob"];
	$gender = $_REQUEST["gender"];
	$address = $_REQUEST["address"];
	$pan = isset($_REQUEST["pan"]) ? $_REQUEST["pan"] : "";
	$gstin = isset($_REQUEST["gstin"]) ? $_REQUEST["gstin"] : "";
	$password = isset($_REQUEST["password"]) ? $_REQUEST["password"] : "";
	$rowArr = array();
	$q = "select id from members where username='" . $phone . "'";
	$v = $mysqli -> query($q);
	if ($v -> num_rows > 0) {
		$res -> status = ResponseCreator::$OTHER_ERROR;
		$res -> message = "Mobile Number already registered";

	} else {
		$query = "";
		if ($user_role == "800") {
			$password = hash('sha512', $password);
			$random_salt = hash('sha512', uniqid(rand(1, 10000000), TRUE));
			$hash = md5(rand(0, 1000));
			$password = hash('sha512', $password . $random_salt);
			$query = "insert into members(username,password,salt,email_verification_code,user_role,user_status)
                    values('" . $phone . "','" . $password . "','" . $random_salt . "','" . $hash . "','800','Inactive')";
		} else {
			$query = "insert into members(username,user_role,user_status)
                values('" . $phone . "','" . $user_role . "','Inactive')";
		}
		$mysqli -> query($query);
		$uid = $mysqli -> insert_id;
		$q = "select * from states where state_name='" . $state . "'";
		$r = mysqli_query($mysqli, $q);
		$v = mysqli_fetch_assoc($r);

		$q1 = "select id from members where username='" . $skillmitra . "' and user_role='700'";
		$r1 = mysqli_query($mysqli, $q1);
		$v1 = mysqli_fetch_assoc($r1);

		$query1 = "insert into member_details(aadhaar,jobcategory,skc,regd_date,uid,name,company_name,pincode,mobile,email,state,city,dob,gender,address,pan_no,gstin)
                values('" . $aadhaar . "','" . $job . "','" . $v1["id"] . "','" . date('Y-m-d') . "','" . $uid . "','" . $name . "','" . $company_name . "','" . $pincode . "','" . $phone . "','" . $email . "','" . $v["id"] . "','" . $city . "','" . $dob . "','" . $gender . "','" . $address . "','" . $pan . "','" . $gstin . "')";
		$mysqli -> query($query1);
		$mobilecode = sprintf("%06d", mt_rand(200000, 999999));
		$length = 16;
		if (function_exists('random_bytes')) {
			$authtoken = bin2hex(random_bytes($length));
		}
		if (function_exists('mcrypt_create_iv')) {
			$authtoken = bin2hex(mcrypt_create_iv($length, MCRYPT_DEV_URANDOM));
		}
		if (function_exists('openssl_random_pseudo_bytes')) {
			$authtoken = bin2hex(openssl_random_pseudo_bytes($length));
		}
		//$authtoken = bin2hex(random_bytes(16));

		$q2 = "update members set mcode='" . $mobilecode . "',authtoken='" . $authtoken . "' where id='" . $uid . "' ";
		$mysqli -> query($q2);
		$msisdn = $_REQUEST["phone"];
		$message = "Verification%20code%20from%20www.skillchamps.com%20-%20$mobilecode.";
		$varUserName = "t1cybssapi";
		$varPWD = "55200745";
		$varSenderID = "CHAMPS";
		$varPhNo = $msisdn;
		$varMSG = $message;
		$url = "http://nimbusit.co.in/api/swsendSingle.asp";
		$data = "username=" . $varUserName . "&password=" . $varPWD . "&sender=" . $varSenderID . "&sendto=" . $varPhNo . "&message=" . $varMSG;
		postData($url, $data);
		$user = "";
		if ($user_role == "200") {
			$user = "Candidate";
		} else if ($user_role == "400") {
			$user = "Employer";
		} else if ($user_role == "300") {
			$user = "Trainee";
		} else if ($user_role == "500") {
			$user = "Guru";
		} else if ($user_role == "600") {
			$user = "Training Center";
		} else if ($user_role == "700") {
			$user = "Skill Mitra";
		} else if ($user_role == "800") {
			$user = "Enterprise";
		}
		$subject = "Skill Champs-New " . $user . " Registered: " . $name;
		$message = "New " . $user . " registered on Skill Champs
                <br>Name:" . $name . "
                <br>Mobile:" . $phone . "
                <br>Email:" . $email;
		$emailfrom = "admin@skillchamps.in";
		$fromname = "Skill Champs";
		$to = "cwarajivpandey@gmail.com,admin@skillchamps.in";
		$headers = 'Return-Path: ' . $emailfrom . "\r\n" . 'From: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 'X-Priority: 3' . "\r\n" . 'X-Mailer: PHP ' . phpversion() . "\r\n" . 'Reply-To: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Transfer-Encoding: 8bit' . "\r\n" . 'Content-Type: text/html; charset=utf-8' . "\r\n";
		$mailer = new Mailer;
		$mailer -> sendMail($to, $emailfrom, $subject, $message, "", "");
		$subject1 = "Skill Champs- Successfully Registered: " . $name;
		$message1 = "Dear Sir/Mam,<br>You have successfully registered with Skill Champs.";

		if ($user_role == "800")
			$message1 = $message1 . "Please login and update your details to start hiring. Please click on following link to verify email. <br>
        " . " http://localhost:8080/skillchamps_site/index.php?action=verifylink&id=" . $uid . "&hash=" . $hash;
		else
			$message1 = $message1 . "We will contact you soon.";
		$message1 = $message1 . " <br>
        Team<br>
        Skill Champs";
		if ($email != "")
			$mailer -> sendMail($email, $emailfrom, $subject1, $message1, "", "");
		$data = array();
		$rowArr = array('authtoken' => $authtoken);

		$res -> status = ResponseCreator::$RESPONSE_OK;
		$res -> message = "Success";
	}

	$res -> data = $rowArr;

	echo json_encode($res);
}

function getCourses() {
	$id = $_REQUEST["id"];
	$data = array();
	$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$res = new ResponseCreator();
	$q1 = "call sp_getCourseBySectorId('" . $id . "')";
	$result = mysqli_query($link, $q1);

	while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
		array_push($data, $row);
	}
	if (sizeof($data) > 0) {
		$res -> status = ResponseCreator::$RESPONSE_OK;
		$res -> message = "Success";
	} else {
		$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
		$res -> message = "No data available";
	}
	$res -> data = $data;
	echo json_encode($res);
	mysqli_close($link);
}

function getSectors() {
	$data = array();
	$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$res = new ResponseCreator;
	$q1 = "call sp_getSectors('')";
	$result = mysqli_query($link, $q1);

	while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
		array_push($data, $row);
	}

	if (sizeof($data) > 0) {
		// format success response
		$res -> status = ResponseCreator::$RESPONSE_OK;
		$res -> message = "Success";
	} else {
		// format fail response
		$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
		$res -> message = "No data available";
	}
	$res -> data = $data;
	echo json_encode($res);

	//echo json_encode($json);
	mysqli_close($link);
}

function getStates() {
	$data = array();
	$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$res = new ResponseCreator();
	$q1 = "call sp_getStates('')";
	$result = mysqli_query($link, $q1);

	while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
		array_push($data, $row);
	}

	if (sizeof($data) > 0) {
		// format success response
		$res -> status = ResponseCreator::$RESPONSE_OK;
		$res -> message = "Success";
	} else {
		// format fail response
		$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
		$res -> message = "No data available";
	}
	$res -> data = $data;
	echo json_encode($res);

	//echo json_encode($json);
	mysqli_close($link);
}

function authenticateUser() {
	$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$res = new ResponseCreator();
	$u = $_REQUEST["u"];
	$p = $_REQUEST["p"];
	$user_role = $_REQUEST["r"];
	$q = "SELECT id, username, password, salt ,user_role,user_status
            FROM members WHERE username = '" . $u . "' and (user_role='" . $user_role . "' or user_role='800')";
	$r = mysqli_query($link, $q);
	$rowArr = array();
	if (mysqli_num_rows($r) > 0) {
		$v = mysqli_fetch_assoc($r);
		$status = $v["user_status"];
		$user_role = $v["user_role"];
		if (($user_role != '800' && $status == 'Active') || $user_role == '800') {
			$salt = $v["salt"];
			$db_password = $v["password"];
			$p = hash('sha512', $p);
			$p = hash('sha512', $p . $salt);
			$user_id = $v["id"];
			$user_role = $v["user_role"];
			$username = $v["username"];
			if ($db_password == $p) {
				$q1 = "SELECT * FROM member_details WHERE uid = '" . $user_id . "' limit 0,1";
				$r1 = mysqli_query($link, $q1);
				$v1 = mysqli_fetch_assoc($r1);
				//$authtoken ="";
				$length = 16;
				if (function_exists('random_bytes')) {
					$authtoken = bin2hex(random_bytes($length));
				}
				if (function_exists('mcrypt_create_iv')) {
					$authtoken = bin2hex(mcrypt_create_iv($length, MCRYPT_DEV_URANDOM));
				}
				if (function_exists('openssl_random_pseudo_bytes')) {
					$authtoken = bin2hex(openssl_random_pseudo_bytes($length));
				}
				//$authtoken = bin2hex(random_bytes(16));
				$q2 = "update members set authtoken='" . $authtoken . "' where id='" . $v1["uid"] . "'";
				mysqli_query($link, $q2);
				$profile_pic = "NULL";
				if ($v1["profile_pic"] != "") {
					$profile_pic = "admin/images/candidate/" . $v1["uid"] . "/" . $v1["profile_pic"];
				} else {
					$profile_pic = "NULL";
				}
				$attendence = 'NA';
				$dbHelper = new DBHelper;
				if ($user_role == '200') {
					$att = array();
					$att = $dbHelper -> getData($link, 'sp_getCandidateAtttendance', array($user_id));
					if (count($att) > 0)
						$attendence = $att[0]["type"];

				}
				$rowArr = array('id' => $v1["uid"], 'authtoken' => $authtoken, 'name' => $v1["name"], 'profile_pic' => $profile_pic, 'company_name' => $v1["company_name"], 'aadhaar' => $v1["aadhaar"], 'mobile' => $v1["mobile"], 'email' => $v1["email"], 'address' => $v1["address"], 'pincode' => $v1["pincode"], 'user_role' => $user_role, 'father_name' => $v1["father_name"], 'jobcategory' => $v1["jobcategory"], 'phone' => $v1["phone"], 'dob' => $v1["dob"], 'gender' => $v1["gender"], 'marital_status' => $v1["marital_status"], 'alternate_id' => $v1["alternate_id"], 'alternate_id_no' => $v1["alternate_id_no"], 'state' => $v1["state"], 'city' => $v1["city"], 'facebook' => $v1["facebook"], 'linkedin' => $v1["linkedin"], 'twitter' => $v1["twitter"], 'instagram' => $v1["instagram"], 'gstin' => $v1["gstin"], 'pan_no' => $v1["pan_no"], 'tan_no' => $v1["tan_no"], 'skillmitra' => $v1["skc"], 'att' => $attendence, 'pan_pic' => $v1["pan_pic"], 'gstin_cer' => $v1["gstin_cer"], 'aggrement_doc' => $v1["aggrement_doc"], 'auth_doc' => $v1["auth_doc"], 'credit_limit' => $v1["credit_limit"], 'user_role' => $user_role, 'user_status' => $status);

				$res -> status = ResponseCreator::$RESPONSE_OK;
				$res -> message = "Login success.";
				$res -> data = $rowArr;
			} else {
				$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
				$res -> message = "Login failed.";
				$res -> data = $rowArr;
			}

		} else {
			$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
			$res -> message = "Login failed.";
			$res -> data = $rowArr;
		}
	} else {
		$res -> status = ResponseCreator::$RESPONSE_UNAUTHORISED;
		$res -> message = "Login failed.";
		$res -> data = $rowArr;
		$json['login'][] = $rowArr;
	}
	echo json_encode($res);

	mysqli_close($link);
}

function searchCandidates() {
	$data = array();
	$link = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
	$res = new ResponseCreator();
	$pincode = isset($_REQUEST["pincode"]) ? $_REQUEST["pincode"] : "";
	$category = isset($_REQUEST["category"]) ? $_REQUEST["category"] : "";
	$sql = "";
	if ($pincode != "NULL" && $pincode != "null" && $pincode != null) {
		$sql .= " and member_details.pincode='" . $pincode . "'";
	}
	if ($category != "NULL" && $category != "null" && $category != null) {
		$sql .= " and member_details.jobcategory = '" . $category . "'";
	}
	$q = "SELECT *,IFNULL(t1.ratings,0) as ratings from members 
                        inner join member_details
                            on member_details.uid=members.id 
                        left outer join (select uid_to,round(AVG(ratings),0) as ratings from user_ratings) as t1 
                            on t1.uid_to=member_details.uid
                        left outer join (SELECT daily_delivery.uid as d_uid,SUM(daily_delivery.total) AS 'total',round((SUM(daily_delivery.eff_pkt)*100/SUM(daily_delivery.total_pkt)),0) AS 'per' FROM daily_delivery 
                        WHERE daily_delivery.status='Approved' GROUP BY (daily_delivery.uid)) t2
                            on t2.d_uid=member_details.uid
                        left outer join (select * from hired_candidates where job_type_id in (1,2,3,4) group by hcid) t4
                            on t4.hcid=member_details.uid
                        left outer join (SELECT candidate_attendance.cid as candidate_id,COUNT(*) as payable_period FROM candidate_attendance where candidate_attendance.type='IN' group by candidate_attendance.cid) t3                        
                            on t3.candidate_id=member_details.uid
                        
                        where  members.user_status='Active' and members.user_role='200'  $sql  group by member_details.uid
                         order by members.id DESC
                        ";
	$r = mysqli_query($link, $q);

	while ($values = mysqli_fetch_assoc($r)) {
		$q1 = "SELECT * FROM videos WHERE uid = '" . $values["uid"] . "' order by vid desc";
		$r1 = mysqli_query($link, $q1);
		$videoArr = array();
		while ($v1 = mysqli_fetch_assoc($r1)) {
			if ($v1["video"] != "null") {
				array_push($videoArr, $v1["video"]);
			}

		}
		$totalEarn = ($values["payable_period"] * $values["sal"]) + $values["total"];
		$rowArr = array('candidate_id' => $values["uid"], 'name' => $values["name"], 'gender' => $values["gender"], 'dob' => $values["dob"], 'pincode' => $values["pincode"], 'instagram' => $values["instagram"], 'facebook' => $values["facebook"], 'youtube' => $v1["youtube"], 'video' => $videoArr, 'profile_pic' => $values["profile_pic"], 'user_rating' => $values["ratings"], 'performance' => $values["per"], 'total_earn' => $totalEarn);
		array_push($data, $rowArr);

		//$json['search'][]=$rowArr;
	}
	//  echo "<pre>";print_r($data);exit;
	if (sizeof($data) > 0) {
		// format success response
		$res -> status = ResponseCreator::$RESPONSE_OK;
		$res -> message = "Success";
	} else {
		// format fail response
		$res -> status = ResponseCreator::$RESPONSE_NO_DATA;
		$res -> message = "No data available";
	}
	$res -> data = $data;
	echo json_encode($res);

	//echo json_encode($json);
	mysqli_close($link);
}

function clean($data) {
	$data = stripslashes($data);
	$data = htmlentities($data, ENT_QUOTES);
	return $data;
}

function removeslashes($string) {
	$string = str_replace("\r\n", '', $string);
	$string = implode("", explode("\\", $string));
	$string = str_replace('\/"', '\"', $string);

	$string = str_replace("\r\n", '', $string);
	//$string=implode("",explode("rn",$string));
	return stripslashes(trim($string));
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

function random_password($length = 6) {
	$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
	$password = substr(str_shuffle($chars), 0, $length);
	return $password;
}

function calculateTotalPeriod($jobTypeId, $period) {
	switch($jobTypeId) {
		case 1 :
			return $period;
			break;
		case 2 :
			return $period;
			break;
		case 3 :
			return ($period * 7);
			break;
		case 4 :
			return ($period * 30);
			break;
		default :
			return $sal;
			break;
	}
}

function calculateSalery($jobTypeId, $sal) {
	switch($jobTypeId) {
		case 1 :
			return $sal;
			break;
		case 2 :
			return $sal;
			break;
		case 3 :
			return round($sal / 7);
			break;
		case 4 :
			return round($sal / 30);
			break;
		default :
			return $sal;
			break;
	}
}

function checkSubscription($dbHelper, $mysqli, $uid, $request, $tableName, $fieldName, $uidFieldName) {
	if ($uid == "" || $request == "" || $tableName == "" || $fieldName == "" || $uidFieldName == "")
		return false;
	else {
		$data = $dbHelper -> getData($mysqli, 'sp_getSubscriptionFeatureByRequest', array($uid, $request));
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

function getMetersBetweenPoints($latitude1, $longitude1, $latitude2, $longitude2) {
	if (($latitude1 == $latitude2) && ($longitude1 == $longitude2)) {
		return 0;
	}// distance is zero because they're the same point
	$p1 = deg2rad($latitude1);
	$p2 = deg2rad($latitude2);
	$dp = deg2rad($latitude2 - $latitude1);
	$dl = deg2rad($longitude2 - $longitude1);
	$a = (sin($dp / 2) * sin($dp / 2)) + (cos($p1) * cos($p2) * sin($dl / 2) * sin($dl / 2));
	$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
	$r = 6371008;
	// Earth's average radius, in meters
	$d = $r * $c;
	return $d;
	// distance, in meters
}

function sendSms($varPhNo, $varMSG) {
	$varUserName = "t1cybssapi";
	$varPWD = "55200745";
	$varSenderID = "CHAMPS";
	$url = "http://nimbusit.co.in/api/swsendSingle.asp";
	$data = "username=" . $varUserName . "&password=" . $varPWD . "&sender=" . $varSenderID . "&sendto=" . $varPhNo . "&message=" . $varMSG;
	postData($url, $data);
}
?>