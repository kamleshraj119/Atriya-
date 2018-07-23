<?php

class Employer {

	function Employer() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}

	function save_employer($mysqli) {
		$uid = $_REQUEST["uid"];
		$name = $this -> clean($_REQUEST["name"]);
		$company_name = $this -> clean($_REQUEST["company_name"]);
		$landline = $this -> clean($_REQUEST["landline"]);
		$mobile = $this -> clean($_REQUEST["mobile"]);
		$jobcategory = $this -> clean($_REQUEST["jobcategory"]);
		$email = $this -> clean($_REQUEST["email"]);
		$aadhaar = $this -> clean($_REQUEST["aadhaar"]);
		$address = $this -> clean($_REQUEST["address"]);
		$pincode = $this -> clean($_REQUEST["pincode"]);
		$city = $this -> clean($_REQUEST["city"]);
		$state = $this -> clean($_REQUEST["state"]);
		$facebook = $this -> clean($_REQUEST["facebook"]);
		$linkedin = $this -> clean($_REQUEST["linkedin"]);
		$gstin = $this -> clean($_REQUEST["gstin"]);
		$pan_no = $this -> clean($_REQUEST["pan_no"]);
		$tan_no = $this -> clean($_REQUEST["tan_no"]);
		$query = "insert into members(username,user_role,user_status)
				values('" . $mobile . "','400','Inactive')";
		$mysqli -> query($query);
		$uid = $mysqli -> insert_id;
		$query = "insert into member_details(regd_by,regd_date,uid,aadhaar,name,mobile,pincode,jobcategory)
				values('" . $_SESSION["ps4a_admin_user_id"] . "','" . date('Y-m-d') . "','" . $uid . "','" . $aadhaar . "','" . $name . "','" . $mobile . "','" . $pincode . "','" . $jobcategory . "')";
		$mysqli -> query($query);
		echo $q = "update member_details set
					name='" . $name . "',
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
					tan_no='" . $tan_no . "',
					mobile = '" . $mobile . "',
					city = '" . $city . "',
					state = '" . $state . "'
					where uid='" . $uid . "'
					
					";
		$mysqli -> query($q);
		if (!is_dir("images/candidate/" . $uid)) {
			mkdir("images/candidate/" . $uid, 0777);
		}
		$profile_pic = $_FILES["profile_pic"]["name"];
		if ($profile_pic != '') {

			$query = "update member_details set 
							profile_pic='" . $profile_pic . "'
							where uid ='" . $uid . "'
				";
			$mysqli -> query($query);
			move_uploaded_file($_FILES["profile_pic"]["tmp_name"], "images/candidate/" . $uid . "/" . $profile_pic);

		}
		header('Location: admin.php?action=employer');
	}

	function update_admin_employer_profile($mysqli) {
		$uid = $this -> clean($_REQUEST["uid"]);
		$name = $this -> clean($_REQUEST["name"]);
		$company_name = $this -> clean($_REQUEST["company_name"]);
		$jobcategory = $this -> clean($_REQUEST["jobcategory"]);
		$landline = $this -> clean($_REQUEST["landline"]);
		$mobile = $this -> clean($_REQUEST["mobile"]);
		$email = $this -> clean($_REQUEST["email"]);
		$aadhaar = $this -> clean($_REQUEST["aadhaar"]);
		$address = $this -> clean($_REQUEST["address"]);
		$pincode = $this -> clean($_REQUEST["pincode"]);
		$city = $this -> clean($_REQUEST["city"]);
		$state = $this -> clean($_REQUEST["state"]);
		$facebook = $this -> clean($_REQUEST["facebook"]);
		$linkedin = $this -> clean($_REQUEST["linkedin"]);
		$gstin = $this -> clean($_REQUEST["gstin"]);
		$pan_no = $this -> clean($_REQUEST["pan_no"]);
		$tan_no = $this -> clean($_REQUEST["tan_no"]);
		$q = "update member_details set
					name='" . $name . "',
					company_name='" . $company_name . "',
					landline='" . $landline . "',
					email='" . $email . "',
					jobcategory='" . $jobcategory . "',
					address='" . $address . "',
					pincode='" . $pincode . "',
					aadhaar='" . $aadhaar . "',
					facebook='" . $facebook . "',
					linkedin='" . $linkedin . "',
					gstin='" . $gstin . "',
					pan_no='" . $pan_no . "',
					tan_no='" . $tan_no . "',
					mobile = '" . $mobile . "',
					city = '" . $city . "',
					state = '" . $state . "'
					where uid='" . $uid . "'
					
					";
		$mysqli -> query($q);
		if (!is_dir("images/candidate/" . $uid)) {
			mkdir("images/candidate/" . $uid, 0777);
		}
		$profile_pic = $_FILES["profile_pic"]["name"];
		if ($profile_pic != '') {

			$query = "update member_details set 
							profile_pic='" . $profile_pic . "'
							where uid ='" . $uid . "'
				";
			$mysqli -> query($query);
			move_uploaded_file($_FILES["profile_pic"]["tmp_name"], "images/candidate/" . $uid . "/" . $profile_pic);

		}
		header('Location: admin.php?action=employer');
	}

	function update_employer_profile($mysqli) {
		$uid = $_SESSION["flexihire_user_id"];
		$name = $this -> clean($_REQUEST["name"]);
		$company_name = $this -> clean($_REQUEST["company_name"]);
		$landline = $this -> clean($_REQUEST["landline"]);
		$email = $this -> clean($_REQUEST["email"]);
		$aadhaar = $this -> clean($_REQUEST["aadhaar"]);
		$address = $this -> clean($_REQUEST["address"]);
		$pincode = $this -> clean($_REQUEST["pincode"]);
		$facebook = $this -> clean($_REQUEST["facebook"]);
		$linkedin = $this -> clean($_REQUEST["linkedin"]);
		$pan_no = $this -> clean($_REQUEST["pan_no"]);
		$tan_no = $this -> clean($_REQUEST["tan_no"]);
		$q = "update member_details set
					name='" . $name . "',
					company_name='" . $company_name . "',
					landline='" . $landline . "',
					email='" . $email . "',
					address='" . $address . "',
					pincode='" . $pincode . "',
					aadhaar='" . $aadhaar . "',
					facebook='" . $facebook . "',
					linkedin='" . $linkedin . "',
					pan_no='" . $pan_no . "',
					tan_no='" . $tan_no . "'
					where uid='" . $uid . "'
					
					";
		$mysqli -> query($q);
		if (!is_dir("../admin/images/candidate/" . $uid)) {
			mkdir("../admin/images/candidate/" . $uid, 0777);
		}
		$profile_pic = $_FILES["profile_pic"]["name"];
		if ($profile_pic != '') {

			$query = "update member_details set 
							profile_pic='" . $profile_pic . "'
							where uid ='" . $uid . "'
				";
			$mysqli -> query($query);
			move_uploaded_file($_FILES["profile_pic"]["tmp_name"], "../admin/images/candidate/" . $uid . "/" . $profile_pic);
		}
		header('Location: employer.php');
	}

	function getAvailableEmployer($mysqli, $gid) {
		$data = array();
		$sql = "";
		$query = "SELECT *
					FROM guru_employer where gid='" . $gid . "' order by eid DESC";
		$result = $mysqli -> query($query);
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			$sql = $sql . " and members.id!='" . $row["eid"] . "'";
		}
		$q1 = "SELECT *
						FROM member_details
						inner join members
						on member_details.uid = members.id
						where members.id!='' and members.user_role = '400'
						 $sql order by members.id DESC
						";
		$result1 = $mysqli -> query($q1);
		while ($row1 = $result1 -> fetch_array(MYSQLI_ASSOC)) {
			array_push($data, $row1);
		}
		return $data;
	}

	function admin_upload_employer_profile($mysqli) {
		$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
		if (!empty($_FILES['file']['tmp_name']) && in_array($_FILES['file']['type'], $csvMimes)) {

			$csvFile = fopen($_FILES["file"]["tmp_name"], 'r');

			//skip first line
			fgetcsv($csvFile);
			$count = 0;
			//parse data from csv file line by line
			while (($line = fgetcsv($csvFile)) !== FALSE) {
				$name = $line[0];
				$company_name = $line[1];
				$landline = $line[2];
				$mobile = $line[3];
				$email = $line[4];
				$aadhaar = $line[5];
				$address = $line[6];
				$service_tax_no = $line[7];
				$pan_no = $line[8];
				$tan_no = $line[9];
				$city = $line[10];
				$pincode = $line[11];
				$linkedin = $line[12];
				$facebook = $line[13];

				$sql = "SELECT * FROM members where username='" . $mobile . "'";

				if ($result = mysqli_query($mysqli, $sql)) {
					$rowcount = mysqli_num_rows($result);
					if ($rowcount > 0) {
						echo $mobile . " already exist.";
					} else {

						$query = "insert into members(username,user_role,user_status)
						values('" . $mobile . "','400','Inactive')";
						$mysqli -> query($query);
						$uid = $mysqli -> insert_id;
						$query = "insert into member_details(regd_by,regd_date,uid,aadhaar,name,mobile,pincode)
								values('" . $_SESSION["ps4a_admin_user_id"] . "','" . date('Y-m-d') . "','" . $uid . "','" . $aadhaar . "','" . $name . "','" . $mobile . "','" . $pincode . "')";
						$mysqli -> query($query);
						$q = "update member_details set
									name='" . $name . "',
									company_name='" . $company_name . "',
									landline='" . $landline . "',
									email='" . $email . "',
									address='" . $address . "',
									pincode='" . $pincode . "',
									aadhaar='" . $aadhaar . "',
									facebook='" . $facebook . "',
									linkedin='" . $linkedin . "',
									service_tax_no='" . $service_tax_no . "',
									pan_no='" . $pan_no . "',
									tan_no='" . $tan_no . "',
									mobile = '" . $mobile . "',
									city = '" . $city . "' 
									where uid='" . $uid . "'

									";
						$mysqli -> query($q);
						$count++;
					}
				}

			}
			if ($count < 1) {
				echo "No Employer uploaded.";
			} else if ($count == 1) {
				echo $count . " Employer uploaded successfully.";
			} else {
				echo $count . " Employers uploaded successfully.";
			}
		} else
			echo "Please upload csv file.";

	}

	function verifyEmail($dbHelper, $mysqli, $uid, $hash) {
		$query = "Select count(*) as num from members where email_verification_code='" . $hash . "' and id='" . $uid . "'";
		$data = $dbHelper -> getDataFromQuery($mysqli, $query);
		$count = (int)$data[0]["num"];
		if ($count > 0) {
			$result = $dbHelper -> performFromQuery($mysqli, "update members set email_verified='YES' where id='" . $uid . "'");
			header('Location: index.php?action=verify_email&msg=success');
		} else {
			header('Location: index.php?action=verify_email&msg=fail');
		}

	}

	function save_employer_registration($mysqli) {
		$name = $this -> clean($_REQUEST["name"]);
		$company_name=$this -> clean($_REQUEST["company_name"]);
		$phone = $this -> clean($_REQUEST["phone"]);
		$email = $this -> clean($_REQUEST["email"]);
		$pincode = $this -> clean($_REQUEST["pincode"]);
		$query = "insert into members(username,user_role,user_status)
				values('" . $phone . "','400','Inactive')";
		$mysqli -> query($query);
		$uid = $mysqli -> insert_id;
		$query = "insert into member_details(regd_date,uid,name,company_name,pincode,mobile,email)
				values('" . date('Y-m-d') . "','" . $uid . "','" . $name . "','" . $company_name . "','" . $pincode . "','" . $phone . "','" . $email . "')";
		$mysqli -> query($query);
		$subject = "Flexihire- New Employer Registered: " . $name;
		$message = "New Employer registered on Flexihire
				<br>Name:" . $name . "
				<br>Mobile:" . $phone . "
				<br>Email:" . $email;
		$emailfrom = "admin@flexihire.co.in";
		$fromname = "FLEXIHIRE";
		$to = "cwarajivpandey@gmail.com,admin@flexihire.co.in";
		$headers = 'Return-Path: ' . $emailfrom . "\r\n" . 'From: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 'X-Priority: 3' . "\r\n" . 'X-Mailer: PHP ' . phpversion() . "\r\n" . 'Reply-To: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Transfer-Encoding: 8bit' . "\r\n" . 'Content-Type: text/html; charset=utf-8' . "\r\n";
		$mailer = new Mailer;
		$mailer -> sendMail($to, $emailfrom, $subject, $message, "", "");
		$subject1 = "Flexihire- Successfully Registered: " . $name;
		$message1 = "Dear Sir/Mam,<br>You have successfully registered with Flexihire. We will contact you soon.<br><br>
		Team<br>
		FLEXIHIRE";
		$mailer -> sendMail($email, $emailfrom, $subject1, $message1, "", "");

		header('Location: ?action=regd_success&t=employer');
	}

	function save_comp_registration($mysqli) {
		$name = $this -> clean($_REQUEST["c_name"]);
		$company_name = $this -> clean($_REQUEST["c_company_name"]);
		$phone = $this -> clean($_REQUEST["c_phone"]);
		$email = $this -> clean($_REQUEST["c_email"]);
		$password = $this -> clean($_REQUEST["c_password"]);
		$pincode = $this -> clean($_REQUEST["c_pincode"]);
		$pan = $this -> clean($_REQUEST["c_pan"]);
		$gstin = $this -> clean($_REQUEST["c_gstin"]);
		$password = hash('sha512', $password);
		$random_salt = hash('sha512', uniqid(rand(1, 10000000), TRUE));
		$hash = md5(rand(0, 1000));
		$password = hash('sha512', $password . $random_salt);
		$query = "insert into members(username,password,salt,email_verification_code,user_role,user_status)
                values('" . $phone . "','" . $password . "','" . $random_salt . "','" . $hash . "','800','Inactive')";
		$mysqli -> query($query);
		$uid = $mysqli -> insert_id;
		$query = "insert into member_details(regd_date,uid,name,company_name,pincode,mobile,email,gstin,pan_no)
                values('" . date('Y-m-d') . "','" . $uid . "','" . $name . "','" . $company_name . "','" . $pincode . "','" . $phone . "','" . $email . "','" . $gstin . "','" . $pan . "')";
		$mysqli -> query($query);

		$subject = "Flexihire- New Employer Registered: " . $name;
		$message = "New Employer registered on Flexihire
                <br>Name:" . $name . "
                <br>Mobile:" . $phone . "
                <br>Email:" . $email;
		$emailfrom = "admin@flexihire.co.in";
		$fromname = "FLEXIHIRE";
		$to = "cwarajivpandey@gmail.com,admin@flexihire.co.in";
		$headers = 'Return-Path: ' . $emailfrom . "\r\n" . 'From: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 'X-Priority: 3' . "\r\n" . 'X-Mailer: PHP ' . phpversion() . "\r\n" . 'Reply-To: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Transfer-Encoding: 8bit' . "\r\n" . 'Content-Type: text/html; charset=utf-8' . "\r\n";
		$mailer = new Mailer;
		$mailer -> sendMail($to, $emailfrom, $subject, $message, "", "");
		$subject1 = "FLEXIHIRE- Successfully Registered: " . $name;
		$message1 = "Dear Sir/Mam,<br>You have successfully registered with Flexihire. Please login and update your details to start hiring. Please click on following link to verify email. <br>
        " . " http://localhost:8080/skillchamps_site/index.php?action=verifylink&id=" . $uid . "&hash=" . $hash . "
        <br>
        Team<br>
        FLEXIHIRE";
		$mailer -> sendMail($email, $emailfrom, $subject1, $message1, "", "");

		header('Location: ?action=regd_success&t=employer');
	}

	function postdata($msisdn, $message) {
		$varUserName = "t1cybssapi";
		$varPWD = "55200745";
		$varSenderID = "CHAMPS";
		$varPhNo = $msisdn;
		$varMSG = $message;
		$url = "http://nimbusit.co.in/api/swsendSingle.asp";
		$data = "username=" . $varUserName . "&password=" . $varPWD . "&sender=" . $varSenderID . "&sendto=" . $varPhNo . "&message=" . $varMSG;

		//The function uses CURL for posting data to
		$objURL = curl_init($url);
		curl_setopt($objURL, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($objURL, CURLOPT_POST, 1);
		curl_setopt($objURL, CURLOPT_POSTFIELDS, $data);
		$retval = trim(curl_exec($objURL));
		curl_close($objURL);
		return $retval;
	}

	function clean($data) {
		$data = stripslashes($data);
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}

	function getHiredCandidatesAttendance($dbHelper, $mysqli, $eid, $fromDate, $toDate) {
		$data = array();
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
		
		return $data;
	}

	function getHiredCandidateDailyDeliveryReport($dbHelper, $mysqli, $eid, $fromDate, $toDate) {
		$data = array();
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
		return $data;
	}
}
?>