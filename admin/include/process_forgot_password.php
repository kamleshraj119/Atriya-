<?php
include_once 'db_connect.php';
include_once 'functions.php';
 
sec_session_start(); // Our custom secure way of starting a PHP session.
 
if (isset($_POST['username'], $_POST['email'])) {
    $username = $_POST['username'];
    $email = $_POST['email']; // The hashed password.
 	
    if (forgotpassword($username, $email, $mysqli) == true) {
		//echo "test".$_SESSION["msf_admin_user_id"];
        // Login success 
        header('Location: ../forgotpassword.php?s=success');
    } else {
        // Login failed 
       header('Location: ../forgotpassword.php?s=failed');
    }
} else {
    // The correct POST variables were not sent to this page. 
    echo 'Invalid Request';
}