<?php
require ("class.phpmailer.php");

class Mailer {

	function Mailer() {
		//session_start();
	}

	function sendMail($to, $from, $subject, $message, $path, $file_name) {
		$host = $_SERVER['HTTP_HOST'];
		if( strpos( $host, "flexihire.co.in" ) !== false ) {
			$toArr = explode(",", $to);
			$to = $toArr[0];

			$mail = new PHPMailer();
			$mail -> IsSMTP();
			// telling the class to use SMTP
			$mail -> Host = "mail.flexihire.co.in";
			// SMTP server
			$mail -> Port = 25;
			$mail -> SMTPAuth = true;
			$mail -> Username = "donot-reply@flexihire.co.in";
			$mail -> Password = "&J{cr8GwTJZ9";
			$mail -> From = $from;
			$mail -> FromName = "FLEXIHIRE";
			//	$mail->AddAddress($hodEmail[0]["emailid"]);
			$mail -> AddAddress($to);
			for ($i = 1; $i < count($toArr); $i++) {
				$mail -> AddCC($toArr[$i]);
			}
			$mail -> IsHTML(true);
			if ($path != "") {
				$mail -> addStringAttachment(file_get_contents($path), $file_name);
			}
			$mail -> Subject = $subject;
			$mail -> Body = stripslashes($message);
           	//$mail->Send();
			if (!$mail -> Send()) {
				//echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
				//echo "Message sent!";
			}
		}
	}

    function sendMailWithAttachment($to, $from, $subject, $message, $path, $file_name,$attchement) {
        $host = $_SERVER['HTTP_HOST'];
        //if( strpos( $host, "flexihire.co.in" ) !== false ) {
            $toArr = explode(",", $to);
            $to = $toArr[0];
            
            $mail = new PHPMailer();
            $mail -> IsSMTP();
        
            // telling the class to use SMTP
            $mail -> Host = "mail.flexihire.co.in";
            // SMTP server
            $mail -> Port = 25;
            $mail -> SMTPAuth = true;
            $mail -> Username = "donot-reply@flexihire.co.in";
            $mail -> Password = "&J{cr8GwTJZ9";
            $mail -> From = $from;
            $mail -> FromName = "FLEXIHIRE";
            //  $mail->AddAddress($hodEmail[0]["emailid"]);
            $mail -> AddAddress($to);
            for ($i = 1; $i < count($toArr); $i++) {
                $mail -> AddCC($toArr[$i]);
            }
            $mail -> IsHTML(true);
            if ($path != "") {
                $mail -> addStringAttachment(file_get_contents($path), $file_name);
            }
            $mail -> Subject = $subject;
            $mail -> Body = stripslashes($message);
            for($i=0;$i<count($attchement);$i++){
                $mail->AddAttachment($attchement[$i]);
            } 
            //$mail->Send();
            if (!$mail -> Send()) {
               // echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                //echo "Message sent!";
            }
        //}
    }

}
