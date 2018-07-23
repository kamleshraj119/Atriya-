<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include_once("db_connect.php");
include_once 'psl-config.php';
 
$error_msg = "";
 
if (isset($_POST['username'], $_POST['emailid'], $_POST['password'])) {
    // Sanitize and validate the data passed in
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
   
	
	$first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
	$last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
	 $email = filter_input(INPUT_POST, 'emailid', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
	$mobile = filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_STRING);
	$city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
	$country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
	$mobile_country = filter_input(INPUT_POST, 'mobile_country', FILTER_SANITIZE_STRING);
	$profession = filter_input(INPUT_POST, 'profession', FILTER_SANITIZE_STRING);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
    }
 
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $error_msg .= '<p class="error">Invalid password configuration.</p>';
    }
 
    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
    //
 
    $prep_stmt = "SELECT id FROM members WHERE username = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
            // A user with this email address already exists
            $error_msg .= '<p class="error">A user with this email address already exists.</p>';
        }
    } else {
        $error_msg .= '<p class="error">Database error</p>';
    }
 
    // TODO: 
    // We'll also have to account for the situation where the user doesn't have
    // rights to do registration, by checking what type of user is attempting to
    // perform the operation.
 
    if (empty($error_msg)) {
        // Create a random salt
		$random_salt = hash('sha512', uniqid(rand(1,10000000), TRUE));
        //$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
 
        // Create salted password 
        $password = hash('sha512', $password . $random_salt);
		 $urole="101";
 		$status="Pending";
		$email_verification = "PENDING"; 
		$email_activation = md5($username.time());               
        // Insert the new user into the database 
        if ($insert_stmt = $mysqli->prepare("INSERT INTO members (username, password, salt,user_role,user_status,email_verification,email_activation) VALUES (?,  ?, ?,?,?,?,?)")) {
             $insert_stmt->bind_param('sssssss', $username, $password, $random_salt,$urole,$status,$email_verification,$email_activation);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../error.php?err=Registration failure: INSERT');
            }
			else
			{
				
				$uid = $insert_stmt->insert_id;
				
				$registered_on=date('Y-m-d H:i:s');
				$registered_ip=$_SERVER['REMOTE_ADDR'];
				$insert_stmt2 = $mysqli->prepare("INSERT INTO member_details (uid, first_name, last_name,emailid,mobile,city,country,mobile_country,profession,registered_on,registered_ip) VALUES (?,  ?, ?,?,?,?,?,?,?,?,?)");
            	 $insert_stmt2->bind_param('sssssssssss', $uid, $first_name, $last_name,$email,$mobile,$city,$country,$mobile_country,$profession,$registered_on,$registered_ip);
				 $insert_stmt2->execute();
				 $to=$email;
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Additional headers]
		$from = "verifyprotaper@dentsply.com";
		$headers .= 'To: '.$to . "\r\n";
		$headers .= 'From: ' .$from. "\r\n";
		$subject= "Registered Successfully - www.verifyprotaper.com";
		$message = "<table><tr><td>Dear $first_name $last_name ,</td></tr>";
		$message .= "<tr><td><br>You have successfully registered with us. Please click on below link to activate your account.</td></tr>";
		$message .= "<tr><td><br><br><a href='http://verifyprotaper.com/activate.php?i=$email_activation' target='_blank'>Activate your account</a></td></tr>";
		$message .= "<tr><td><br><br><br><br>Team<br>Dentsply</td></tr>";
		
		$message .= "</table>";
		//echo $message;
		$sentmail = mail($to, $subject, $message, $headers);
        header('Location: ../register_success.php');
			}
        }
		
    }
}