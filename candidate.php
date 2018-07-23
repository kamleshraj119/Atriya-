<?php
date_default_timezone_set('Europe/London');
include_once 'include/functions.php';
error_reporting(E_ALL ^ E_NOTICE);
sec_session_start();
require_once ("./libs.inc.php");
require_once 'config.php';
if ($_SESSION["flexihire_user_role"] != "200") {
	header('Location: index.php?action=logout');
}
$dataActiveSubsciptionStatus = $subscriptionFeature -> getUserSubsciption($dbHelper, $mysqli, $_SESSION["flexihire_user_id"]);
$smarty -> assign('SUBSCRIPTION_USER', $dataActiveSubsciptionStatus);
$subCount = count($dataActiveSubsciptionStatus);
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'home';
if ($subCount > 0 || $_action == 'insert_subscription' || $_action == "update_profile") {

} else {
	$_action = 'subscribed';
}

$smarty -> assign('SECTORS', $sector -> getSector($dbHelper, $mysqli, ''));
$smarty -> assign('JOB_CATEGORY', $course -> getCourse($dbHelper, $mysqli, ''));
$smarty -> assign('AREA', $area -> getArea($dbHelper, $mysqli, ''));
$smarty -> assign('DISTRICT', $district -> getDistrict($dbHelper, $mysqli, ''));
$smarty -> assign('LOCALITY', $locality -> getLocality($dbHelper, $mysqli, ''));
$smarty -> assign('SUBJECT', $message -> getSubject($dbHelper, $mysqli, ''));
$smarty -> assign('STATES', $state -> getState($dbHelper, $mysqli, ''));
$smarty -> assign('VIDEOS', $candidate -> getCandidatesVideos($mysqli, $_SESSION["flexihire_user_id"]));
$smarty -> assign('INBOX', $message -> getInbox($dbHelper, $mysqli, $_SESSION["flexihire_user_id"], ''));
$smarty -> assign('BLOGS', $blog -> getBlogsByJobrole($mysqli, '200'));
$smarty -> assign('ARTICLES', $article -> getArticlesByJobrole($mysqli, '200'));
$smarty -> assign('DETAILS', $user -> getMembers($mysqli, '200', $_SESSION["flexihire_user_id"]));
$smarty -> assign('JOBTYPE', $user -> getJobtype($dbHelper, $mysqli, ''));
$smarty -> assign('SKILL', $skill -> getSkill($dbHelper, $mysqli, ''));
$smarty -> assign('VAL', $candidateAvailability -> getAvailability($dbHelper, $mysqli, $_SESSION["flexihire_user_id"]));
$smarty -> assign('CANDIDATENOTIFICATION', $user -> getNotificationForUser($dbHelper, $mysqli, $_SESSION["flexihire_user_id"]));
switch($_action) {
	/*   SUBSCRIPTION  */
	case 'subscribed' :
		if ($_SESSION["flexihire_user_id"] != "") {
			$smarty -> assign('TYPE', CANDIDATE_USE_SUBSCRIPTION);
			$smarty -> assign('DATA', $subscription -> getSubscriptionRateFront($dbHelper, $mysqli, '200', $_SESSION["flexihire_user_id"]));
			$smarty -> assign('USERDETAILS', $user -> getMembers($mysqli, "200", $_SESSION["flexihire_user_id"]));
			$smarty -> assign('PAGE', 'candidate/subscription.tpl');
			$smarty -> display('candidate/layout.tpl');
		} else {
			header('Location: index.php');
		}
		break;
	/*  END SUBSCRIPTION  */
	case 'home' :
		if ($_SESSION["flexihire_user_id"] != "") {
			$smarty -> assign('MSG', $_REQUEST['msg']);
			$mailDetails = json_decode($_REQUEST["email_detail"]);
			$smarty -> assign('CANDIDATEHOME', $candidate -> candidateHome($dbHelper, $mysqli, $_SESSION["flexihire_user_id"]));
			$smarty -> assign('HIRED', $hireCandidate -> getCurrentlyHired($dbHelper, $mysqli, $_SESSION["flexihire_user_id"]));
			$smarty -> assign('DATA', $message -> getInbox($dbHelper, $mysqli, $_SESSION["flexihire_user_id"], ''));
			$smarty -> assign('PAGE', 'candidate/dashboard.tpl');
			if (count($mailDetails) > 0)
				GenerateInvoice::emailInvoices($mailDetails[0], $mailDetails[1], $mailDetails[2], $dbHelper, $mysqli, 'invoice/generated/');
			$smarty -> display('candidate/layout.tpl');
		} else {
			header('Location: index.php');
		}
		break;
	case 'update_profile' :
		if ($_SESSION["flexihire_user_id"] != "") {
			$candidate -> update_candidates_profile($mysqli);
		} else {
			header('Location: index.php');
		}
		break;
	case 'videos' :
		if ($_SESSION["flexihire_user_id"] != "") {
			$smarty -> assign('VIDEOS', $candidate -> getCandidatesVideos($mysqli, $_SESSION["flexihire_user_id"]));
			$smarty -> assign('VIDEO_SESSION', $videoSession -> getVideoSessionByReviewee($dbHelper, $mysqli, $_SESSION["flexihire_user_id"]));
			$tokenSessionKey = 'token-' . $client -> prepareScopes();
			if (isset($_GET['code'])) {
				if (strval($_SESSION['state']) !== strval($_GET['state'])) {
					die('The session state did not match.');
					//echo 'The session state did not match.';
				}

				$client -> authenticate($_GET['code']);
				$_SESSION[$tokenSessionKey] = $client -> getAccessToken();
				header('Location: ' . REDIRECT_URL);
			}

			if (isset($_SESSION[$tokenSessionKey])) {
				$client -> setAccessToken($_SESSION[$tokenSessionKey]);
			}
			$isAuthReq = "";
			$authUrl = "";
			if ($client -> getAccessToken())
				$isAuthReq = "NO";
			else {
				$isAuthReq = "YES";
				$state = mt_rand();
				$client -> setState($state);
				$_SESSION['state'] = $state;
				$authUrl = $client -> createAuthUrl();
			}
			$smarty -> assign('MSG', $_REQUEST["msg"]);
			$smarty -> assign('AUTH_REQ', $isAuthReq);
			$smarty -> assign('AUTH_URL', $authUrl);
			$smarty -> assign('PAGE', 'candidate/videos.tpl');
			$smarty -> display('candidate/layout.tpl');
		} else {
			header('Location: index.php');
		}
		break;
	/*  Video Meeting  */
	case 'video_meeting' :
		if ($_SESSION["flexihire_user_id"] != "") {
			$smarty -> assign('MSG', $_REQUEST["msg"]);
			$smarty -> assign('CID', $_SESSION["flexihire_user_id"]);
			$smarty -> assign('DATA', $videoSession -> getVideoSessionByReviewee($dbHelper, $mysqli, $_SESSION["flexihire_user_id"]));
			$smarty -> assign('SKILLS', $candidateSkill -> getCandidateSkill($dbHelper, $mysqli, $_SESSION["flexihire_user_id"], ""));
			$smarty -> assign('PAGE', 'candidate/video_meeting.tpl');
			$smarty -> display('candidate/layout.tpl');
		} else {
			header('Location: index.php');
		}
		break;

	case 'req_video_meeting' :
		if ($_SESSION["flexihire_user_id"] != "") {
			if ($user -> checkSubscription($dbHelper, $mysqli, $_SESSION["flexihire_user_id"], $_action, "video_session_request", "added_date", "posted_by")) {
				$videoSession -> requestVideoSession($dbHelper, $mysqli);
			} else {
				header('Location: ?action=video_meeting&msg=Please upgrade your subscription plan.');
			}
		} else {
			header('Location: index.php');
		}
		break;
	/* End Video Meeting  */
	case 'candidate_doc' :
		if ($_SESSION["flexihire_user_id"] != "") {
			$smarty -> assign('DATA', $candidateDocs -> getCandidateDoc($dbHelper, $mysqli, $_SESSION["flexihire_user_id"], ""));
			$smarty -> assign('CID', $_SESSION["flexihire_user_id"]);
			$smarty -> assign('PAGE', 'candidate/doc.tpl');
			$smarty -> display('candidate/layout.tpl');
		} else {
			header('Location: index.php');
		}
		break;
	case 'upload_doc' :
		if ($_SESSION["flexihire_user_id"] != "") {
			$candidateDocs -> insertCandidateDocForFront($dbHelper, $mysqli);
		} else {
			header('Location: index.php');
		}
		break;
	case 'upload_video' :
		if ($_SESSION["flexihire_user_id"] != "") {

			if ($user -> checkSubscription($dbHelper, $mysqli, $_SESSION["flexihire_user_id"], $_action, "videos", "posted_on", "uid")) {
				
				$tokenSessionKey = 'token-' . $client -> prepareScopes();
				if (isset($_GET['code'])) {
					if (strval($_SESSION['state']) !== strval($_GET['state'])) {
						die('The session state did not match.');
						//echo 'The session state did not match.';
					}

					$client -> authenticate($_GET['code']);
					$_SESSION[$tokenSessionKey] = $client -> getAccessToken();
					header('Location: ' . REDIRECT_URL);
				}

				if (isset($_SESSION[$tokenSessionKey])) {
					$client -> setAccessToken($_SESSION[$tokenSessionKey]);
				}
				$candidate -> upload_video($mysqli, $client, $youtube);
			} else {
				header('Location: ?action=videos&msg=Please upgrade your subscription plan.');
			}
		} else {
			header('Location: index.php');
		}
		break;
	case 'delete_video' :
		if ($_SESSION["flexihire_user_id"] != "") {
			$candidate -> delete_video($mysqli, $_SESSION["flexihire_user_id"], $_REQUEST["vid"]);
		} else {
			header('Location: index.php');
		}
		break;
	case 'delete_doc' :
		if ($_SESSION["flexihire_user_id"] != "") {
			$candidateDocs -> deleteDocForFront($dbHelper, $mysqli, $_REQUEST["id"]);
		} else {
			header('Location: index.php');
		}
		break;
	case 'history' :
		if ($_SESSION["flexihire_user_id"] != "") {
			$smarty -> assign('DATA', $employementHistory -> getEmployementHistory($mysqli, $dbHelper, $_SESSION["flexihire_user_id"]));
			$smarty -> assign('CID', $_SESSION["flexihire_user_id"]);
			$smarty -> assign('PAGE', 'candidate/employement-history.tpl');
			$smarty -> display('candidate/layout.tpl');
		} else {
			header('Location: index.php');
		}
		break;
	case 'blogs' :
		if ($_SESSION["flexihire_user_id"] != "") {
			$smarty -> assign('DATA', $blog -> ReplaceImageBlogsFrontEnd($mysqli, '200'));
			$smarty -> assign('PAGE', 'candidate/blogs.tpl');
			$smarty -> display('candidate/layout.tpl');
		} else {
			header('Location: index.php');
		}
		break;
	case 'readblog' :
		if ($_SESSION["flexihire_user_id"] != "") {
			$smarty -> assign('DATA', $blog -> getBlogsFrontEnd($mysqli, $_REQUEST['id']));
			$smarty -> assign('PAGE', 'candidate/read_blogs.tpl');
			$smarty -> display('candidate/layout.tpl');
		} else {
			header('Location: index.php');
		}
		break;
	case 'readarticles' :
		if ($_SESSION["flexihire_user_id"] != "") {
			$smarty -> assign('DATA', $article -> getArticleFrontEnd($mysqli, $_REQUEST['id']));
			$smarty -> assign('PAGE', 'candidate/read_articles.tpl');
			$smarty -> display('candidate/layout.tpl');
		} else {
			header('Location: index.php');
		}
		break;
	case 'articles' :
		if ($_SESSION["flexihire_user_id"] != "") {
			$smarty -> assign('DATA', $article -> ReplaceImageAricleFrontEnd($mysqli, '200'));
			$smarty -> assign('PAGE', 'candidate/articles.tpl');
			$smarty -> display('candidate/layout.tpl');
		} else {
			header('Location: index.php');
		}
		break;
	case 'messages' :
		if ($_SESSION["flexihire_user_id"] != "") {
			$m = $message -> getInbox($dbHelper, $mysqli, $_SESSION["flexihire_user_id"], '');
			$smarty -> assign('DATA', $m);
			$smarty -> assign('PAGE', 'candidate/messages.tpl');
			$smarty -> display('candidate/layout.tpl');
		} else {
			header('Location: index.php');
		}
		break;
	case 'availability' :
		if ($_SESSION["flexihire_user_id"] != "") {
			$smarty -> assign('MSG', $_REQUEST["msg"]);
			$smarty -> assign('DATA', $user -> getfieldsbypincode($dbHelper, $mysqli, $_SESSION["flexihire_user_id"]));
			$smarty -> assign('SKILLS', $candidateSkill -> getCandidateSkill($dbHelper, $mysqli, $_SESSION["flexihire_user_id"], ""));
			$smarty -> assign('LOCAL', $candidateLoc -> getCandidateLocation($dbHelper, $mysqli, $_SESSION["flexihire_user_id"], ""));
			$smarty -> assign('CID', $_SESSION["flexihire_user_id"]);
			$smarty -> assign('PAGE', 'candidate/availability.tpl');
			$smarty -> display('candidate/layout.tpl');
		} else {
			header('Location: index.php');
		}

		break;
	case 'save_availability' :
		if ($user -> checkSubscription($dbHelper, $mysqli, $_SESSION["flexihire_user_id"], $_action, "candidate_availability", "to_date", "cid")) {
			exit;
			$candidateAvailability -> insertCandidateAvailabilityForFront($dbHelper, $mysqli);
		} else {
			header('Location: ?action=availability&msg=Please upgrade your subscription plan.');
		}
		break;
	case 'edit_candidate_availability' :
		$smarty -> assign('ID', $_REQUEST["avid"]);
		$smarty -> assign('DATA', $candidateAvailability -> getAvailabilitybyid($dbHelper, $mysqli, $_REQUEST["avid"]));
		$smarty -> assign('SKILLS', $candidateSkill -> getCandidateSkill($dbHelper, $mysqli, $_SESSION["flexihire_user_id"], ""));
		$smarty -> assign('LOCAL', $candidateLoc -> getCandidateLocation($dbHelper, $mysqli, $_SESSION["flexihire_user_id"], ""));
		$smarty -> assign('PAGE', 'candidates/availability.tpl');
		$smarty -> display('candidate/layout.tpl');
		break;
	case 'update_candidate_availability' :
		$candidateAvailability -> updateCandidateAvailabilityForFront($dbHelper, $mysqli);
		break;
	case 'delete_candidate_availability' :
		$candidateAvailability -> deleteCandidateAvailabilityForFront($dbHelper, $mysqli, $_REQUEST["id"]);
		break;
	case 'compose' :
		if ($_SESSION["flexihire_user_id"] != "") {
			$smarty -> assign('DATA', $user -> getMembers($mysqli, "200", $_SESSION["flexihire_user_id"]));
			$smarty -> assign('PAGE', 'candidate/compose.tpl');
			$smarty -> display('candidate/layout.tpl');
		} else {
			header('Location: index.php');
		}
		break;
	case 'send_message' :
		$message -> send_message($dbHelper, $mysqli, $_SESSION["flexihire_user_id"]);
		break;
	case 'read_message' :
		if ($_SESSION["flexihire_user_id"] != "") {
			$smarty -> assign('DATA', $message -> getInbox($dbHelper, $mysqli, $_SESSION["flexihire_user_id"], $_REQUEST["id"]));
			$smarty -> assign('REPLY', $message -> getReplies($mysqli, $_REQUEST["id"]));
			$smarty -> assign('PAGE', 'candidate/read_message.tpl');
			$smarty -> display('candidate/layout.tpl');
		} else {
			header('Location: index.php');
		}
		break;
	case 'send_reply' :
		$mid = $_REQUEST["mid"];
		$message -> send_reply($dbHelper, $mysqli, $_SESSION["flexihire_user_id"], 'messages');
		header('Location:?action=read_message&id=' . $mid);
		break;
	case 'change_password' :
		if ($_SESSION["flexihire_user_id"] != "") {
			$user -> change_password($mysqli);
			header('Location: candidate.php');
		} else {
			header('Location: index.php');
		}
		break;
	case 'candidate_bank_details' :
		if ($_SESSION["flexihire_user_id"] != "") {
			$smarty -> assign('CID', $_SESSION["flexihire_user_id"]);
			$smarty -> assign('DATA', $bankDetails -> getBankDetails($dbHelper, $mysqli, $_SESSION["flexihire_user_id"]));
			$smarty -> assign('PAGE', 'candidate/bankdetails.tpl');
			$smarty -> display('candidate/layout.tpl');
		} else {
			header('Location: index.php');
		}
		break;
	case 'save_candidate_bank_details' :
		if ($_SESSION["flexihire_user_id"] != "") {
			$bankDetails -> saveBankDetailsFront($dbHelper, $mysqli, 'candidate_bank_details');
		} else {
			header('Location: index.php');
		}
		break;
	case 'edit_candidate_bank_details' :
		$smarty -> assign('ID', $_REQUEST["flexihire_user_id"]);
		$smarty -> assign('DATA', $candidate -> get_candidate_bank_details($dbHelper, $mysqli, $_SESSION["flexihire_user_id"]));
		$smarty -> assign('PAGE', 'candidates/availability.tpl');
		$smarty -> display('candidate/layout.tpl');
		break;
	case 'update_candidate_bank_details' :
		$bankDetails -> updateBankDetailsFront($dbHelper, $mysqli, 'candidate_bank_details');
		break;
	case 'delete_candidate_bank_details' :
		$bankDetails -> deleteBankDetailsFront($dbHelper, $mysqli, $_REQUEST["id"], 'candidate_bank_details');
		break;
	case 'savework_history' :
		$employementHistory -> addEmployementHistory($mysqli, $dbHelper);
		break;
	case'update_work_history' :
		$employementHistory -> updateEmployementHistory($mysqli, $dbHelper, $_SESSION["flexihire_user_id"]);
		break;
	case 'getpastdata' :
		$employementHistory -> getEmployementHistory($mysqli, $dbHelper);
		break;
	case 'deleteoldhistroy' :
		$employementHistory -> deleteEmployementHistory($mysqli, $dbHelper, $_REQUEST["id"]);
		break;
	case 'candidate_loc' :
		if ($_SESSION["flexihire_user_id"] != "") {
			$smarty -> assign('MSG', $_REQUEST["msg"]);
			$smarty -> assign('CID', $_SESSION["flexihire_user_id"]);
			$smarty -> assign('DATA', $candidateLoc -> getCandidateLocation($dbHelper, $mysqli, $_SESSION["flexihire_user_id"], ""));
			$smarty -> assign('PAGE', 'candidate/candidate_location.tpl');
			$smarty -> display('candidate/layout.tpl');
		} else {
			header('Location: index.php');
		}
		break;
	case 'save_candidate_loc' :
		if ($user -> checkSubscription($dbHelper, $mysqli, $_SESSION["flexihire_user_id"], $_action, "candidate_loc", "added_date", "cid")) {
			$candidateLoc -> insertCandidateLocationForFront($dbHelper, $mysqli);
		} {
			header('Location: ?action=candidate_loc&msg=Please upgrade your subscription plan.');
		}
		break;
	case'update_candidate_loc' :
		$candidateLoc -> updateCandidateLocationForFront($dbHelper, $mysqli);
		break;
	case'delete_candidate_loc' :
		$candidateLoc -> deleteCandidateLocationForFront($dbHelper, $mysqli, $_REQUEST["id"]);
		break;
	case 'candidate_skill' :
		if ($_SESSION["flexihire_user_id"] != "") {
			$smarty -> assign('MSG', $_REQUEST["msg"]);
			$smarty -> assign('CID', $_SESSION["flexihire_user_id"]);
			$smarty -> assign('DATA', $candidateSkill -> getCandidateSkill($dbHelper, $mysqli, $_SESSION["flexihire_user_id"], ""));
			$smarty -> assign('PAGE', 'candidate/candidate_skill.tpl');
			$smarty -> display('candidate/layout.tpl');
		} else {
			header('Location: index.php');
		}
		break;
	case 'save_candidate_skill' :
		if ($user -> checkSubscription($dbHelper, $mysqli, $_SESSION["flexihire_user_id"], $_action, "candidate_skill", "added_date", "cid")) {
			$candidateSkill -> insertCandidateSkillForFront($dbHelper, $mysqli);
		} else {
			header('Location: ?action=candidate_skill&msg=Please upgrade your subscription plan.');
		}
		break;
	case'update_candidate_skill' :
		$candidateSkill -> updateCandidateSkillForFront($dbHelper, $mysqli);
		break;
	case'delete_candidate_skill' :
		$candidateSkill -> deleteCandidateSkillForFront($dbHelper, $mysqli, $_REQUEST["id"]);
		break;
	/*  candidate education   */
	case 'can_education' :
		if ($_SESSION["flexihire_user_id"] != "") {
			$smarty -> assign('CID', $_SESSION["flexihire_user_id"]);
			$smarty -> assign('DOC', $candidateDocs -> getCandidateDoc($dbHelper, $mysqli, $_SESSION["flexihire_user_id"], ""));
			$smarty -> assign('DATA', $userEducation -> getUserEducationByUser($dbHelper, $mysqli, $_SESSION["flexihire_user_id"]));
			$smarty -> assign('PAGE', 'candidate/candidate_education.tpl');
			$smarty -> display('candidate/layout.tpl');
		} else {
			header('Location: index.php');
		}
		break;
	case 'save_can_education' :
		$userEducation -> insertUserEducationFront($dbHelper, $mysqli);
		break;
	case'update_can_education' :
		$userEducation -> updateUserEducationFront($dbHelper, $mysqli);
		break;
	case'delete_can_education' :
		$userEducation -> deleteUserEducationFront($dbHelper, $mysqli, $_REQUEST["id"]);
		break;

	/*   END Education */

	/*    Insert Subscription */
	case 'insert_subscription' :
		if ($_SESSION["flexihire_user_id"] != "") {
			$subscription -> insertUserSubscription($dbHelper, $mysqli, $_REQUEST['sr_id'], $_REQUEST['uid'], 'candidate.php');
		} else {
			header('Location: candidate.php');
		}
		break;
	/*  end insertion subscription */
	/*  REDIRECT_NOTIFICATION   */
	case 'can_notification' :
		if ($_SESSION["flexihire_user_id"] != "") {
			$smarty -> assign('DATA', $user -> getNotificationForUser($dbHelper, $mysqli, $_SESSION["flexihire_user_id"]));
			$smarty -> assign('PAGE', 'candidate/candidate_notification.tpl');
			$smarty -> display('candidate/layout.tpl');
		} else {
			header('Location: index.php');
		}
		break;
	/*  END NOTIFICATION   */
}
?>
