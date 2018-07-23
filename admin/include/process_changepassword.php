<?php
include_once 'db_connect.php';
include_once 'functions.php';
 
sec_session_start(); // Our custom secure way of starting a PHP session.
 
if (isset($_POST['op'], $_POST['np'])) {
    $oldpassword = $_POST['op'];
	
    $newpassword = $_POST['np']; // The hashed password.
 	
    if (changepassword($oldpassword, $newpassword, $mysqli) == true) {
		//echo "test".$_SESSION["msf_admin_user_id"];
        // Login success 
        header('Location: ../index.php?action=changepassword&status=success');
    } else {
        // Login failed 
        header('Location: ../index.php?action=changepassword&status=fail');
    }
} else {
    // The correct POST variables were not sent to this page. 
    echo 'Invalid Request';
}