<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include_once("db_connect.php");
include_once 'psl-config.php';
 
$error_msg = "";
 
if (isset($_POST['username'], $_POST['emailid'])) {
    // Sanitize and validate the data passed in
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
	 $email = filter_input(INPUT_POST, 'emailid', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
   
	
   
 
    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
    //
 
    $prep_stmt = "SELECT id FROM members
						inner join member_details
						on members.id = member_details.uid
				 WHERE members.username = ? and member_details.emailid= ?  LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
    if ($stmt) {
        $stmt->bind_param('ss', $username,$email);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
            // A user with this email address already exists
            
 
    // TODO: 
    // We'll also have to account for the situation where the user doesn't have
    // rights to do registration, by checking what type of user is attempting to
    // perform the operation.
 
   
        // Create a random salt
		$random_salt = hash('sha512', uniqid(rand(1,10000000), TRUE));
        //$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
 		$passwordword = generatePasswd();
        // Create salted password 
        $password = hash('sha512', $passwordword);
		$password = hash('sha512', $password . $random_salt);
		 $urole="101";
 		$status="Pending";
		$email_verification = "PENDING"; 
		$email_activation = md5($username.time());               
        // Insert the new user into the database 
        if ($insert_stmt = $mysqli->prepare("update members set password=?, salt=? where username=?")) {
             $insert_stmt->bind_param('sss', $password, $random_salt, $username);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../forgotpassword.php?s=fail');
            }
			else
			{
				
				
				 $to=$email;
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Additional headers]
		$from = "verifyprotaper@dentsply.com";
		$headers .= 'To: '.$to . "\r\n";
		$headers .= 'From: ' .$from. "\r\n";
		$subject= "Forgot Password - www.verifyprotaper.com";
		$message = "<table><tr><td>Dear $username,</td></tr>";
		$message .= "<tr><td><br>Your new password is $passwordword</td></tr>";
		
		$message .= "<tr><td><br><br><br><br>Team<br>Dentsply</td></tr>";
		
		$message .= "</table>";
		//echo $message;
		$sentmail = mail($to, $subject, $message, $headers);
        header('Location: ../forgotpassword.php?s=success');
			}
        }
		else
		{
			header('Location: ../forgotpassword.php?s=fail');
		}
	}
	else
		{
			header('Location: ../forgotpassword.php?s=fail');
		}
		
		
	}
	
		else
		{
			header('Location: ../forgotpassword.php?s=fail');
		}
		
		
		
    
	
}
function generatePasswd()
	{
	   $listAlpha = 'abcdefghijklmnopqrstuvwxyz';
	   $listNum = '0123456789';
	  $listNonAlpha = '!?*&@*&?$';
	   return str_shuffle(
		  substr(str_shuffle($listAlpha),0,3).
      substr(str_shuffle($listNonAlpha),0,1).
	   substr(str_shuffle($listNum),0,2)
		 
		);
	}