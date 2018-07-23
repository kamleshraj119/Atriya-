<?php
date_default_timezone_set('Europe/London');
include_once 'include/functions.php';
error_reporting(E_ALL ^ E_NOTICE);
sec_session_start();
require_once ("./libs.inc.php");
if ($_SESSION["flexihire_user_role"] != "400") {
    header('Location: index.php?action=logout');
}

$smarty -> assign('STATES', $state -> getState($dbHelper, $mysqli, ''));

$dataActiveSubsciptionStatus = $subscriptionFeature -> getUserSubsciption($dbHelper, $mysqli, $_SESSION["flexihire_user_id"]);
$smarty -> assign('SUBSCRIPTION_USER', $dataActiveSubsciptionStatus);
$subCount = count($dataActiveSubsciptionStatus);
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
if ($subCount > 0 || $_action == 'insert_subscription') {
	$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'home';
	if (isset($_REQUEST['action'])) {
		if ($_REQUEST['action'] == "") {
			$_action = "home";
		}
	}
} else {
	$_action = 'subscribed';
}


$smarty -> assign('SUBJECT', $message -> getSubject($dbHelper, $mysqli, ''));
$smarty -> assign('JOB_CATEGORY', $course -> getCourse($dbHelper, $mysqli, ''));
$smarty -> assign('HIRED_CANDIDATES_COUNT', $candidate -> getHiredCandidatesByEmployerCount($mysqli, $_SESSION["flexihire_user_id"]));
$smarty -> assign('SHORTLISTED_CANDIDATES_COUNT', $candidate -> getShortlistedCandidatesByEmployerCount($mysqli, $_SESSION["flexihire_user_id"]));
$smarty -> assign('CART_CANDIDATES_COUNT', $candidate -> getCartCandidatesByEmployerCount($mysqli, $_SESSION["flexihire_user_id"]));
$smarty -> assign('SECTORS', $sector -> getSector($dbHelper, $mysqli, ''));
$smarty -> assign('AREA', $area -> getArea($dbHelper, $mysqli, ''));
$smarty -> assign('DISTRICT', $district -> getDistrict($dbHelper, $mysqli, ''));
$smarty -> assign('LOCALITY', $locality -> getLocality($dbHelper, $mysqli, ''));
$smarty -> assign('STATES', $state -> getState($dbHelper, $mysqli, ''));
$smarty -> assign('JOBTYPE', $user -> getJobtype($dbHelper, $mysqli, ''));
$smarty -> assign('SKILL', $skill -> getSkill($dbHelper, $mysqli, ''));
$smarty -> assign('DETAILS', $user -> getMembers($mysqli, '400', $_SESSION["flexihire_user_id"]));
$smarty -> assign('BLOGS', $blog -> getBlogsByJobrole($mysqli, '400'));
$smarty -> assign('ARTICLES', $article -> getArticlesByJobrole($mysqli, '400'));
$smarty -> assign('INBOX', $message -> getInbox($dbHelper, $mysqli, $_SESSION["flexihire_user_id"], ''));
$smarty -> assign('CANDIDATENOTIFICATION', $user ->getNotificationForUser($dbHelper, $mysqli,$_SESSION["flexihire_user_id"]));	
switch($_action) {
		case 'subscribed' :
		if ($_SESSION["flexihire_user_id"] != "") {
			$smarty -> assign('TYPE', CANDIDATE_USE_SUBSCRIPTION); 
			$smarty -> assign('DATA', $subscription -> getSubscriptionRateFront($dbHelper, $mysqli, '400',$_SESSION["flexihire_user_id"]));
			$smarty -> assign('USERDETAILS', $user -> getMembers($mysqli, "400", $_SESSION["flexihire_user_id"]));
			$smarty -> assign('PAGE', 'employer/subscription.tpl');
			$smarty -> display('employer/layout.tpl');
		} else {
			header('Location: index.php');
		}
		break;
    case 'home' :
        if ($_SESSION["flexihire_user_id"] != "") {
			$smarty -> assign('MSG', $_REQUEST['msg']);
			$mailDetails = json_decode($_REQUEST["email_detail"]);		
            $smarty -> assign('DATA', $message -> getInbox($dbHelper, $mysqli, $_SESSION["flexihire_user_id"], ''));
            $smarty -> assign('PAGE', 'employer/dashboard.tpl');
			if (count($mailDetails) > 0)
				GenerateInvoice::emailInvoices($mailDetails[0], $mailDetails[1], $mailDetails[2], $dbHelper, $mysqli, 'invoice/generated/');
            $smarty -> display('employer/layout.tpl');

        } else {
            header('Location: index.php');
        }
        break;
    case 'update_profile' :
        if ($_SESSION["flexihire_user_id"] != "") {
            $emp -> update_employer_profile($mysqli);
        } else {
            header('Location: index.php');
        }
        break;
    case 'save_candidate_hired' :
        if ($_SESSION["flexihire_user_id"] != "") {
            $candidate -> save_candidate_hired($mysqli, $_REQUEST["cid"]);
        } else {
            header('Location: index.php');
        }
        break;
    case 'save_candidate_shortlisted' :
        if ($_SESSION["flexihire_user_id"] != "") {
            $candidate -> save_candidate_shortlisted($mysqli, $_REQUEST["cid"]);
        } else {
            header('Location: index.php');
        }
        break;
    case 'shortlisted_candidates' :
        if ($_SESSION["flexihire_user_id"] != "") {
            $smarty -> assign('EMP_ID', $_SESSION["flexihire_user_id"]);
            $smarty -> assign('DATA', $hireCandidate -> getShortiltsedCandidateByEmp($dbHelper, $mysqli, $_SESSION["flexihire_user_id"]));
            $smarty -> assign('PAGE', 'employer/shortlisted_candidates.tpl');
            $smarty -> display('employer/layout.tpl');

        } else {
            header('Location: index.php');
        }
        break;
    case 'cart_candidates' :
        if ($_SESSION["flexihire_user_id"] != "") {
            $smarty -> assign('EMP_ID', $_SESSION["flexihire_user_id"]);
            $smarty -> assign('DATA', $hireCandidate -> getCartCandidateByEmp($dbHelper, $mysqli, $_SESSION["flexihire_user_id"]));
            $smarty -> assign('PAGE', 'employer/cart_candidates.tpl');
            $smarty -> display('employer/layout.tpl');

        } else {
            header('Location: index.php');
        }
        break;
    case 'hired_candidates' :
        if ($_SESSION["flexihire_user_id"] != "") {
            $smarty -> assign('HIRED_CANDIDATES', $hireCandidate -> getHiredCandidateByEmp($dbHelper, $mysqli, $_SESSION["flexihire_user_id"],$_REQUEST['period']));
            $smarty -> assign('PAGE', 'employer/hired_candidates.tpl');
            $smarty -> display('employer/layout.tpl');
        } else {
            header('Location: index.php');
        }
        break;
    case 'search_candidates' :
        if ($_SESSION["flexihire_user_id"] != "") {
            $smarty -> assign('DATA', $hireCandidate -> getSearchCandidate($dbHelper, $mysqli, $_REQUEST["pincode"], $_REQUEST["category"]));
            $smarty -> assign('PAGE', 'employer/search_candidate.tpl');
            $smarty -> display('employer/layout.tpl');
        } else {
            header('Location: index.php');
        }
        break;
    case 'get_available_candidate_for_job' :
        if ($_SESSION["flexihire_user_id"] != "") {
            $smarty -> assign('EMP_ID', $_SESSION["flexihire_user_id"]);
            $smarty -> assign('EMP_JOB_ID', $_REQUEST["emp_job_id"]);
            $smarty -> assign('DATA', $hireCandidate -> getAvailableCandidateForJob($dbHelper, $mysqli, $_REQUEST["emp_job_id"]));
            $smarty -> assign('PAGE', 'employer/avail_candidates_job.tpl');
            $smarty -> display('employer/layout.tpl');
        } else {
            header('Location: index.php');
        }
        break;
    case 'shortlisted_candidates_jobs' :
        if ($_SESSION["flexihire_user_id"] != "") {
            $smarty -> assign('EMP_ID', $_SESSION["flexihire_user_id"]);
            $smarty -> assign('DATA', $hireCandidate -> getShortlistedCandidateByJob($dbHelper, $mysqli, $_REQUEST["emp_job_id"]));
            $smarty -> assign('PAGE', 'employer/shortlisted_candidates_job.tpl');
            $smarty -> display('employer/layout.tpl');

        } else {
            header('Location: index.php');
        }
        break;
    case 'cart_candidates_jobs' :
        if ($_SESSION["flexihire_user_id"] != "") {
            $smarty -> assign('EMP_ID', $_SESSION["flexihire_user_id"]);
            $smarty -> assign('DATA', $hireCandidate -> getCartCandidateByJob($dbHelper, $mysqli, $_REQUEST["emp_job_id"]));
            $smarty -> assign('PAGE', 'employer/cart_candidates_job.tpl');
            $smarty -> display('employer/layout.tpl');

        } else {
            header('Location: index.php');
        }
        break;
    case 'hired_candidates_jobs' :
        if ($_SESSION["flexihire_user_id"] != "") {
            $smarty -> assign('DATA', $hireCandidate -> getHiredCandidateByJob($dbHelper, $mysqli, $_REQUEST["emp_job_id"]));
            $smarty -> assign('PAGE', 'employer/hired_candidates_job.tpl');
            $smarty -> display('employer/layout.tpl');
        } else {
            header('Location: index.php');
        }
        break;
    case 'blogs' :
        if ($_SESSION["flexihire_user_id"] != "") {
            $smarty -> assign('DATA', $blog -> ReplaceImageBlogsFrontEnd($mysqli, '400'));
            $smarty -> assign('PAGE', 'employer/blogs.tpl');
            $smarty -> display('employer/layout.tpl');
        } else {
            header('Location: index.php');
        }
        break;
    case 'articles' :
        if ($_SESSION["flexihire_user_id"] != "") {
            $smarty -> assign('DATA', $article -> ReplaceImageAricleFrontEnd($mysqli, '400'));
            $smarty -> assign('PAGE', 'employer/articles.tpl');

            $smarty -> display('employer/layout.tpl');
        } else {
            header('Location: index.php');
        }
        break;
    case 'readblog' :
        if ($_SESSION["flexihire_user_id"] != "") {
            $smarty -> assign('DATA', $blog -> getBlogsFrontEnd($mysqli, $_REQUEST['id']));
            $smarty -> assign('PAGE', 'employer/read_blogs.tpl');
            $smarty -> display('employer/layout.tpl');
        } else {
            header('Location: index.php');
        }
        break;
    case 'readarticles' :
        if ($_SESSION["flexihire_user_id"] != "") {
            $smarty -> assign('DATA', $article -> getArticleFrontEnd($mysqli, $_REQUEST['id']));
            $smarty -> assign('PAGE', 'employer/read_articles.tpl');
            $smarty -> display('employer/layout.tpl');
        } else {
            header('Location: index.php');
        }
        break;
    case 'messages' :
        if ($_SESSION["flexihire_user_id"] != "") {
            $smarty -> assign('DATA', $message -> getInbox($dbHelper, $mysqli, $_SESSION["flexihire_user_id"], ''));
            $smarty -> assign('PAGE', 'employer/messages.tpl');
            $smarty -> display('employer/layout.tpl');
        } else {
            header('Location: index.php');
        }
        break;
    case 'compose' :
        if ($_SESSION["flexihire_user_id"] != "") {
            $smarty -> assign('PAGE', 'employer/compose.tpl');
            $smarty -> display('employer/layout.tpl');
        } else {
            header('Location: index.php');
        }
        break;
    case 'send_message' :
        $message -> send_message($dbHelper,$mysqli, $_SESSION["flexihire_user_id"]);
        break;
	/* Send Messages to Hired Candidate */
	case 'send_message_to_hired';
		$message -> send_message_to_hired($dbHelper,$mysqli, $_SESSION["flexihire_user_id"]);
        break;			  
	/* End Send Messages */	
    case 'read_message' :
        if ($_SESSION["flexihire_user_id"] != "") {
            $smarty -> assign('DATA', $message -> getInbox($dbHelper, $mysqli, $_SESSION["flexihire_user_id"], $_REQUEST["id"]));
            $smarty -> assign('REPLY', $message -> getReplies($mysqli, $_REQUEST["id"]));
            $smarty -> assign('PAGE', 'employer/read_message.tpl');
            $smarty -> display('employer/layout.tpl');
        } else {
            header('Location: index.php');
        }
        break;
    case 'send_reply' :
        $mid = $_REQUEST["mid"];
        $message -> send_reply($dbHelper, $mysqli, $_SESSION["flexihire_user_id"],'messages');
        header('Location:?action=read_message&id=' . $mid);
        break;
    case 'employer_jobs' :
        if ($_SESSION["flexihire_user_id"] != "") {
        	$smarty -> assign('MSG',$_REQUEST["msg"]);
            $smarty -> assign('EMP_ID', $_SESSION["flexihire_user_id"]);
            $smarty -> assign('EJLC', $empJobLocation -> getEmpJobsLocation($dbHelper, $mysqli, $_SESSION["flexihire_user_id"], ''));
            $smarty -> assign('DATA', $empJob -> getEmpJobsByEmp($dbHelper, $mysqli, $_SESSION["flexihire_user_id"]));
            $smarty -> assign('PAGE', 'employer/employer_jobs.tpl');
            $smarty -> display('employer/layout.tpl');
        } else {
            header('Location: index.php');
        }

        break;
    case 'employer_order' :
        if ($_SESSION["flexihire_user_id"] != "") {
            $smarty -> assign('EMP_ID', $_SESSION["flexihire_user_id"]);
            $smarty -> assign('DATA', $hireCandidate -> getOrderByEmp($dbHelper, $mysqli, $_SESSION["flexihire_user_id"]));
            $smarty -> assign('PAGE', 'employer/order.tpl');
            $smarty -> display('employer/layout.tpl');
        } else {
            header('Location: index.php');
        }

        break;
    case 'update_employer_jobs' :
        $empJob -> updateEmployerJobsByIdForFront($dbHelper, $mysqli);
        break;
    case 'delete_employer_jobs' :
        $empJob -> deleteEmployerForFront($dbHelper, $mysqli, $_REQUEST["id"]);
        break;
   case 'save_employer_jobs' :
		if ($user -> checkSubscription($dbHelper, $mysqli, $_SESSION["flexihire_user_id"], $_action, "emp_jobs", "to_date","eid")){
        	$empJob -> insertEmployerJobsForFront($dbHelper, $mysqli);
		}else {
			header('Location: ?action=employer_jobs&msg=Please upgrade your subscription plan.');
		}
        break;
    case 'attendance_report_candidate' :
        if ($_SESSION["flexihire_user_id"] != "") {
            $smarty -> assign('EMP_ID', $_SESSION["flexihire_user_id"]);
            $smarty -> assign('DATA', $emp ->getHiredCandidatesAttendance($dbHelper, $mysqli, $_SESSION["flexihire_user_id"], $_REQUEST["fromdate"], $_REQUEST["todate"]));
            $smarty -> assign('PAGE', 'employer/candidate_attendance_report.tpl');
            $smarty -> display('employer/layout.tpl');
        } else {
            header('Location: index.php');
        }
        break;
    case 'insert_user_rating' :
        if ($_SESSION["flexihire_user_id"] != "") {
            $smarty -> assign('UID_TO', $_REQUEST["cid"]);
            $smarty -> assign('UID_FROM', $_SESSION["flexihire_user_id"]);
            $smarty -> assign('PAGE', 'employer/rating.tpl');
            $smarty -> display('employer/layout.tpl');
        } else {
            header('Location: index.php');
        }
        break;
    case 'save_user_rating' :
        if ($_SESSION["flexihire_user_id"] != "") {
            $userRating -> saveUserRating($dbHelper, $mysqli);
        } else {
            header('Location: index.php');
        }
        break;

    case 'employer_jobs_loc' :
        if ($_SESSION["flexihire_user_id"] != "") {
        	$smarty -> assign('MSG',$_REQUEST["msg"]);
            $smarty -> assign('EMP_ID', $_SESSION["flexihire_user_id"]);
            $smarty -> assign('DATA', $empJobLocation -> getEmpJobsLocation($dbHelper, $mysqli, $_SESSION["flexihire_user_id"], ''));
            $smarty -> assign('PAGE', 'employer/employer_job_location.tpl');
            $smarty -> display('employer/layout.tpl');
        } else {
            header('Location: index.php');
        }

        break;
    case 'update_employer_job_loc' :
        $empJobLocation -> updateEmployerJobLocationForFront($dbHelper, $mysqli);
        break;
    case 'delete_employer_job_loc' :
        $empJobLocation -> deleteEmployerForFront($dbHelper, $mysqli, $_REQUEST["id"]);
        break;
    case 'save_employer_job_loc' :
        if ($user -> checkSubscription($dbHelper, $mysqli, $_SESSION["flexihire_user_id"], $_action, "emp_job_loc", "added_date","emp_id")) {
       		 $empJobLocation -> insertEmployerJobLocationForFront($dbHelper, $mysqli);
        }else {
			header('Location: ?action=employer_jobs_loc&msg=Please upgrade your subscription plan.');
		}
        break;
    case 'order_success' :
        if ($_SESSION["flexihire_user_id"] != "") {
            $smarty -> assign('EMP_ID', $_SESSION["flexihire_user_id"]);
            $mailDetails=json_decode($_REQUEST["email_detail"]);
            $smarty -> assign('DATASUCCESS', $hireCandidate -> getSuccessfullHiredCandiadte($dbHelper, $mysqli, $_REQUEST["success"]));
            $smarty -> assign('DATAFAILED', $hireCandidate -> getFailedHiredCandiadte($dbHelper, $mysqli, $_REQUEST["failed"]));
            $smarty -> assign('PAGE', 'employer/employer_order_success.tpl');
            GenerateInvoice::emailInvoices($mailDetails[0], $mailDetails[1], $mailDetails[2], $dbHelper, $mysqli, 'invoice/generated/');
            $smarty -> display('employer/layout.tpl');
           
        } else {
            header('Location: index.php');
        }

        break;

    case 'order_failed' :
        if ($_SESSION["flexihire_user_id"] != "") {
            $smarty -> assign('EMP_ID', $_SESSION["flexihire_user_id"]);
            $smarty -> assign('MSG', $_REQUEST["msg"]);
            $smarty -> assign('PAGE', 'employer/employer_order_failed.tpl');
            $smarty -> display('employer/layout.tpl');
        } else {
            header('Location: index.php');
        }

        break;
		
		
	/*    Insert Subscription */
	case 'insert_subscription' :
		if ($_SESSION["flexihire_user_id"] != "") {
			$subscription -> insertUserSubscription($dbHelper, $mysqli, $_REQUEST['sr_id'], $_REQUEST['uid'],"employer.php");
		} else {
			header('Location: employer.php');
		}
		break;
	/*  end insertion subscription */
	
	 /*  REDIRECT_NOTIFICATION   */
	 case 'emp_notification':
	  if ($_SESSION["flexihire_user_id"] != "") {
			$smarty -> assign('DATA', $user -> getNotificationForUser($dbHelper, $mysqli,$_SESSION["flexihire_user_id"]));
			$smarty -> assign('PAGE', 'employer/employer_notification.tpl');
			$smarty -> display('employer/layout.tpl');
		} else {
			header('Location: index.php');
		}
		break;
     
     /*  END NOTIFICATION   */
		
}
?>
