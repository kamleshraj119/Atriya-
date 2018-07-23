<?php

class Trainee {

	function Trainee() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}

	function delete_trainee($mysqli, $uid, $page) {
		$query = "delete from members where id='" . $uid . "'";
		$mysqli -> query($query);

		$query1 = "delete from member_details where uid='" . $uid . "'";
		$mysqli -> query($query1);

		$query2 = "delete from videos where uid='" . $uid . "'";
		$mysqli -> query($query2);
		header('Location: admin.php?action=' . $page);
	}

	function admin_save_trainee_profile($mysqli) {
		$uid = $_REQUEST["uid"];
		$name = $this -> clean($_REQUEST["name"]);
		$father_name = $this -> clean($_REQUEST["father_name"]);
		$dob = $this -> clean($_REQUEST["dob"]);
		$gender = $this -> clean($_REQUEST["gender"]);
		$marital_status = $this -> clean($_REQUEST["marital_status"]);
		$mobile = $this -> clean($_REQUEST["mobile"]);
		$email = $this -> clean($_REQUEST["email"]);
		$aadhaar = $this -> clean($_REQUEST["aadhaar"]);
		$address = $this -> clean($_REQUEST["address"]);
		$state = $this -> clean($_REQUEST["state"]);
		$city = $this -> clean($_REQUEST["city"]);
		$pincode = $this -> clean($_REQUEST["pincode"]);
		$facebook = $this -> clean($_REQUEST["facebook"]);
		$linkedin = $this -> clean($_REQUEST["linkedin"]);
		$education = $this -> clean($_REQUEST["education"]);
		$alternate_id_no = $this -> clean($_REQUEST["alternate_id_no"]);
		$alternate_id = $this -> clean($_REQUEST["alternate_id"]);
		$jobcategory = $this -> clean($_REQUEST["jobcategory"]);
		$query = "insert into members(username,user_role,user_status)
				values('" . $mobile . "','300','Inactive')";
		$mysqli -> query($query);
		$uid = $mysqli -> insert_id;
		$query = "insert into member_details(regd_by,regd_date,uid,aadhaar,name,mobile,pincode,jobcategory)
				values('" . $_SESSION["ps4a_admin_user_id"] . "','" . date('Y-m-d') . "','" . $uid . "','" . $aadhaar . "','" . $name . "','" . $mobile . "','" . $pincode . "','" . $jobcategory . "')";
		$mysqli -> query($query);

		$q = "update member_details set
					alternate_id_no='" . $alternate_id_no . "',
					alternate_id='" . $alternate_id . "',
					education='" . $education . "',
					name='" . $name . "',
					father_name='" . $father_name . "',
					dob='" . $dob . "',
					gender='" . $gender . "',
					marital_status='" . $marital_status . "',
					mobile='" . $mobile . "',
					email='" . $email . "',
					address='" . $address . "',
					city='" . $city . "',
					state='" . $state . "',
					pincode='" . $pincode . "',
					aadhaar='" . $aadhaar . "',
					facebook='" . $facebook . "',
					linkedin='" . $linkedin . "'
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
		header('Location: admin.php?action=trainee');
	}

	function admin_upload_trainee_profile($mysqli) {

		$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
		if (!empty($_FILES['file']['tmp_name']) && in_array($_FILES['file']['type'], $csvMimes)) {

			$csvFile = fopen($_FILES["file"]["tmp_name"], 'r');

			//skip first line
			fgetcsv($csvFile);
			$count = 0;
			//parse data from csv file line by line
			while (($line = fgetcsv($csvFile)) !== FALSE) {
				$name = $line[0];
				$father_name = $line[1];
				$dob = $line[2];
				$mobile = $line[3];
				$gender = $line[4];
				$marital_status = $line[5];
				$email = $line[6];
				$aadhaar = $line[7];
				$alternate_id = $line[8];
				$alternate_id_no = $line[9];
				$education = $line[10];
				$city = $line[11];
				$pincode = $line[12];
				$address = $line[13];
				$linkedin = $line[14];
				$facebook = $line[15];

				$sql = "SELECT * FROM members where username='" . $mobile . "'";

				if ($result = mysqli_query($mysqli, $sql)) {
					$rowcount = mysqli_num_rows($result);
					if ($rowcount > 0) {
						echo $mobile . " already exist.";
					} else {
						$query = "insert into members(username,user_role,user_status)
						values('" . $mobile . "','300','Inactive')";
						$mysqli -> query($query);
						$uid = $mysqli -> insert_id;
						$query = "insert into member_details(regd_by,regd_date,uid,aadhaar,name,mobile,pincode)
								values('" . $_SESSION["ps4a_admin_user_id"] . "','" . date('Y-m-d') . "','" . $uid . "','" . $aadhaar . "','" . $name . "','" . $mobile . "','" . $pincode . "')";
						$mysqli -> query($query);

						$q = "update member_details set
									alternate_id_no='" . $alternate_id_no . "',
									alternate_id='" . $alternate_id . "',
									education='" . $education . "',
									name='" . $name . "',
									father_name='" . $father_name . "',
									dob='" . $dob . "',
									gender='" . $gender . "',
									marital_status='" . $marital_status . "',
									mobile='" . $mobile . "',
									email='" . $email . "',
									address='" . $address . "',
									city='" . $city . "',
									pincode='" . $pincode . "',
									aadhaar='" . $aadhaar . "',
									facebook='" . $facebook . "',
									linkedin='" . $linkedin . "'
									where uid='" . $uid . "'

									";
						$mysqli -> query($q);
						$count++;
					}
				}

			}
			if ($count < 1) {
				echo "No Trainee uploaded.";
			} else if ($count == 1) {
				echo $count . " Trainee uploaded successfully.";
			} else {
				echo $count . " Trainees uploaded successfully.";
			}
		} else
			echo "Please upload csv file.";

	}

	function admin_save_trainee_skill_mitra($mysqli, $skt, $tid) {
		$q = "update member_details set
					skt='" . $skt . "'
					where uid='" . $tid . "'	
					";
		$mysqli -> query($q);
		header('Location: admin.php?action=trainee');
	}

	function admin_update_trainee_profile($mysqli) {
		$uid = $_REQUEST["uid"];
		$name = $this -> clean($_REQUEST["name"]);
		$father_name = $this -> clean($_REQUEST["father_name"]);
		$dob = $this -> clean($_REQUEST["dob"]);
		$gender = $this -> clean($_REQUEST["gender"]);
		$marital_status = $this -> clean($_REQUEST["marital_status"]);
		$mobile = $this -> clean($_REQUEST["mobile"]);
		$email = $this -> clean($_REQUEST["email"]);
		$aadhaar = $this -> clean($_REQUEST["aadhaar"]);
		$address = $this -> clean($_REQUEST["address"]);
		$state = $this -> clean($_REQUEST["state"]);
		$city = $this -> clean($_REQUEST["city"]);
		$pincode = $this -> clean($_REQUEST["pincode"]);
		$facebook = $this -> clean($_REQUEST["facebook"]);
		$linkedin = $this -> clean($_REQUEST["linkedin"]);
		$education = $this -> clean($_REQUEST["education"]);
		$alternate_id_no = $this -> clean($_REQUEST["alternate_id_no"]);
		$alternate_id = $this -> clean($_REQUEST["alternate_id"]);

		$jobcategory = $this -> clean($_REQUEST["jobcategory"]);
		$q = "update member_details set
					jobcategory='" . $jobcategory . "',
					alternate_id_no='" . $alternate_id_no . "',
					alternate_id='" . $alternate_id . "',
					education='" . $education . "',
					name='" . $name . "',
					father_name='" . $father_name . "',
					dob='" . $dob . "',
					gender='" . $gender . "',
					marital_status='" . $marital_status . "',
					mobile='" . $mobile . "',
					email='" . $email . "',
					address='" . $address . "',
					city='" . $city . "',
					state='" . $state . "',
					pincode='" . $pincode . "',
					aadhaar='" . $aadhaar . "',
					facebook='" . $facebook . "',
					linkedin='" . $linkedin . "'
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
		header('Location: admin.php?action=trainee');
	}

	function update_trainee_profile($mysqli) {
		$uid = $_SESSION["skill_champs_user_id"];
		$name = $this -> clean($_REQUEST["name"]);
		$father_name = $this -> clean($_REQUEST["father_name"]);
		$dob = $this -> clean($_REQUEST["dob"]);
		$gender = $this -> clean($_REQUEST["gender"]);
		$marital_status = $this -> clean($_REQUEST["marital_status"]);
		$mobile = $this -> clean($_REQUEST["mobile"]);
		$email = $this -> clean($_REQUEST["email"]);
		$aadhaar = $this -> clean($_REQUEST["aadhaar"]);
		$address = $this -> clean($_REQUEST["address"]);
		$state = $this -> clean($_REQUEST["state"]);
		$city = $this -> clean($_REQUEST["city"]);
		$pincode = $this -> clean($_REQUEST["pincode"]);
		$facebook = $this -> clean($_REQUEST["facebook"]);
		$linkedin = $this -> clean($_REQUEST["linkedin"]);
		$q = "update member_details set
					name='" . $name . "',
					father_name='" . $father_name . "',
					dob='" . $dob . "',
					gender='" . $gender . "',
					marital_status='" . $marital_status . "',
					mobile='" . $mobile . "',
					email='" . $email . "',
					address='" . $address . "',
					city='" . $city . "',
					state='" . $state . "',
					pincode='" . $pincode . "',
					aadhaar='" . $aadhaar . "',
					facebook='" . $facebook . "',
					linkedin='" . $linkedin . "'
					where uid='" . $uid . "'
					
					";
		$mysqli -> query($q);
		if (!is_dir("admin/images/candidate/" . $uid)) {
			mkdir("admin/images/candidate/" . $uid, 0777);
		}
		$profile_pic = $_FILES["profile_pic"]["name"];
		if ($profile_pic != '') {

			$query = "update member_details set 
							profile_pic='" . $profile_pic . "'
							where uid ='" . $uid . "'
				";
			$mysqli -> query($query);
			move_uploaded_file($_FILES["profile_pic"]["tmp_name"], "admin/images/candidate/" . $uid . "/" . $profile_pic);

		}
		header('Location: trainee.php');
	}

	function save_trainee_registration($mysqli) {
		$name = $this -> clean($_REQUEST["name"]);
		$mobile = $this -> clean($_REQUEST["mobile"]);
		$pincode = $this -> clean($_REQUEST["pincode"]);
		$aadhaar = $this -> clean($_REQUEST["aadhaar"]);
		$jobcategory = $this -> clean($_REQUEST["jobcategory"]);

		$query = "insert into members(username,user_role,user_status)
				values('" . $mobile . "','300','Inactive')";
		$mysqli -> query($query);
		$uid = $mysqli -> insert_id;
		$query = "insert into member_details(regd_date,uid,aadhaar,name,mobile,pincode,jobcategory)
				values('" . date('Y-m-d') . "','" . $uid . "','" . $aadhaar . "','" . $name . "','" . $mobile . "','" . $pincode . "','" . $jobcategory . "')";
		$mysqli -> query($query);
		$smsmsg = "Thank%20you%20for%20registering%20with%20us.%20We%20will%20contact%20you%20soon";
		$this -> postdata($mobile, $smsmsg);
		$subject = "Skill Champs- New Trainee Registered: " . $name;
		$message = "New Trainee registered on Skill Champs
				<br>Name:" . $name . "
				<br>Mobile:" . $mobile;

		$emailfrom = "admin@skillchamps.in";
		$fromname = "Skill Champs";
		$to = "cwarajivpandey@gmail.com,admin@skillchamps.in";
		$headers = 'Return-Path: ' . $emailfrom . "\r\n" . 'From: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 'X-Priority: 3' . "\r\n" . 'X-Mailer: PHP ' . phpversion() . "\r\n" . 'Reply-To: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Transfer-Encoding: 8bit' . "\r\n" . 'Content-Type: text/html; charset=utf-8' . "\r\n";
		$mailer = new Mailer;
		$mailer -> sendMail($to, $emailfrom, $subject, $message, "", "");

		header('Location: ?action=regd_success&t=trainee');
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

	function getTraineesWithSkillMitra($mysqli, $urole, $id) {
		$data = array();
		$sql = "";
		if ($id != "") {
			$sql .= " and md.uid='" . $id . "'";
		}
		if ($urole != "") {
			$sql .= " and m.user_role = '" . $urole . "'";
		}

		$query = "SELECT md.uid,md.name,md.mobile,m.username,md.regd_date,
						m.user_status,skmd.name as 'skillmitra' 
						FROM member_details as md
						inner join members as m
						on md.uid = m.id
						left outer join members as skm
						on md.skt = skm.username
						left outer join member_details as skmd
						on skm.id = skmd.uid
						where m.id!=''
						
						
						 $sql order by m.id DESC
						";

		$result = $mysqli -> query($query);
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			array_push($data, $row);
		}
		return $data;
	}

	function clean($data) {
		$data = stripslashes($data);
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}

}
?>