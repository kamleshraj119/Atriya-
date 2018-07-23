<?php
include_once 'db_connect.php';
include_once 'functions.php';
 
sec_session_start(); // Our custom secure way of starting a PHP session.
 
if (isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; // The hashed password.
 	
    if (login($username, $password, $mysqli) == true) {
		//echo "test".$_SESSION["msf_admin_user_id"];
        // Login success 
		if($_SESSION["ps4a_admin_user_role"]=="100")
		{
        	header('Location: ../admin.php');
		}
		else if($_SESSION["ps4a_admin_user_role"]=="200")
		{
        	header('Location: ../admin.php');
		}
		else if($_SESSION["ps4a_admin_user_role"]=="103")
		{
        	header('Location: ../trainer.php');
		}
		else if($_SESSION["ps4a_admin_user_role"]=="104")
		{
        	header('Location: ../delegates.php');
		}
    } else {
        // Login failed 
       header('Location: ../index.php?status=failed');
    }
} else {
    // The correct POST variables were not sent to this page. 
    echo 'Invalid Request';
}