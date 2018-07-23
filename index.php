<?php

date_default_timezone_set("Asia/Kolkata");
include_once 'include/functions.php';
error_reporting(E_ALL);
sec_session_start();

require_once ("./libs.inc.php");

$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'home';
if (isset($_REQUEST['action'])) {
	if ($_REQUEST['action'] == "") {
		$_action = "home";
	}
}
$smarty -> assign('page', $_action);
$smarty -> assign('JOB_CATEGORY', $course -> getCourse($dbHelper, $mysqli, ''));
$smarty -> assign('SECTORS', $sector -> getSector($dbHelper, $mysqli, ''));
$smarty -> assign('STATES', $state -> getState($dbHelper, $mysqli, ''));
//$smarty -> assign('DATA', $blog -> ReplaceImageBlogsFrontEnd($mysqli, '800'));

switch($_action) {

	case 'logout' :
		// Unset all session values
		$_SESSION = array();

		// get session parameters
		$params = session_get_cookie_params();

		// Delete the actual cookie.
		setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);

		// Destroy session
        session_destroy();
        header('Location: index.php');
        //header('Location: http://www.psalltraining.com/');
        break;
    case 'home' :
        header('Location: home.php');
        break;
    case 'register-candidate' :
        $smarty -> display('register/candidate.tpl');
        break;
    case 'save_candidate_registration' :
        $candidate -> save_candidate_registration($mysqli);
        break;
    case 'regd_success' :
        $smarty -> display('register/regd_success.tpl');
        break;
   
    case 'register-employer' :
        $smarty -> display('register/employer.tpl');
        break;
    case 'save_employer_registration' :
        $emp -> save_employer_registration($mysqli);
        break;
   
    case 'search_candidates' :
        $smarty -> assign('DATA', $candidate -> searchCandidatesByEmployer($mysqli, $_REQUEST["pincode"], $_REQUEST["category"]));
        $smarty -> assign('PAGE', 'employer/search_candidate_old.tpl');
        $smarty -> display('employer/search_candidate_old.tpl');
        break;
    case 'Frontblog' :
        $smarty -> assign('DATA', $blog ->getBlogPage($mysqli, $dbHelper));
        $smarty -> display('templates/home/blog_list.tpl');
        break;

    case 'readblog' :
        $smarty -> assign('RECENT', $blog ->getBlogPage($mysqli, $dbHelper));
        $smarty -> assign('DATA', $blog -> getBlogsFrontEnd($mysqli, $_REQUEST['id']));
        $smarty -> display('templates/home/read_blog.tpl');
        break;
}
?>