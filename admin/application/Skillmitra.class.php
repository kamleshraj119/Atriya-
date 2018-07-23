<?php

class Skillmitra {

	function Skillmitra() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}
    
    function getPendingVideoCountBySkillmitra($dbHelper,$mysqli,$skid){
        $data=array();
        $data=$dbHelper->getDataFromQuery($mysqli, "select count(*) as num from videos left outer join member_details on videos.uid=member_details.uid 
        where videos.sk_approve_status='Pending' AND member_details.skc='".$skid."'");
        return $data[0]["num"];
    }
    
     function getTotalCreditBySkillmitra($dbHelper,$mysqli,$skid){
        $data=array();
        $data=$dbHelper->getData($mysqli, 'sp_getTotalCreditByToUid', array($skid));
        return $data;
    }
    
    function getCreditBySkillmitra($dbHelper,$mysqli,$skid){
        $data=array();
        $data=$dbHelper->getData($mysqli, 'sp_getCreditByToUid', array($skid));
        return $data;
    }
    
    function getVideosSkillmitra($dbHelper, $mysqli, $skid, $status){
        $data = array();
        $data = $dbHelper -> getData($mysqli, 'sp_getVideoSkillmitra', array($skid,$status));
        return $data;
    }
    
     function upadteCandidateVideoSkillMitraFront($dbHelper, $mysqli) {
        $comment=$this->clean($_REQUEST["v_comment"]);
        $id=$_REQUEST["v_id"];
        $status=$this->clean($_REQUEST["v_status"]);
        $this->upadteCandidateVideoSkillMitra($dbHelper, $mysqli, $id, $status, $comment);
        header('Location: skill-mitra.php?action=videos&status='.$status);
    }
    
    function upadteCandidateVideoSkillMitra($dbHelper, $mysqli, $id, $status, $comment) {
        $dbHelper -> performOperation($mysqli, 'sp_upadteCandidateVideoSkillMitra', array( $id, $status, $comment));      
    }

	function getAvailableSkillMitra($mysqli, $uid) {
		$data = array();
		$sql = "";
		$query = "SELECT pincode
						FROM member_details
						where uid = '" . $uid . "'";
		$r = mysqli_query($mysqli, $query);
		$v = mysqli_fetch_assoc($r);
		$pincode = (int)$v["pincode"];

		$query = "SELECT *
						FROM members as m
						left outer join
						member_details as md
						on m.id=md.uid
						where (md.pincode = '" . $pincode . "' 
						or md.pincode ='" . ($pincode - 1) . "'
						or md.pincode ='" . ($pincode - 2) . "'
						or md.pincode ='" . ($pincode - 3) . "'
						or md.pincode ='" . ($pincode - 4) . "'
						or md.pincode ='" . ($pincode - 5) . "'
						or md.pincode ='" . ($pincode + 1) . "'
						or md.pincode ='" . ($pincode + 2) . "'
						or md.pincode ='" . ($pincode + 3) . "'
						or md.pincode ='" . ($pincode + 4) . "'
						or md.pincode ='" . ($pincode + 5) . "')
						and m.user_role='700'
						";
		$result = $mysqli -> query($query);
		$row_cnt = $result -> num_rows;
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			array_push($data, $row);
			$sql .= " and md.uid!='" . $row["uid"] . "'";
		}
		$limit = 10 - $row_cnt;
		if ($row_cnt < 10) {
			$query = "SELECT *
						FROM members as m
						left outer join
						member_details as md
						on m.id=md.uid
						where m.user_role='700'" . $sql . "
						limit " . $limit;
			$result = $mysqli -> query($query);
			while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
				array_push($data, $row);
			}
		}
		return $data;
	}

	function update_skill_mitra_admin_profile($mysqli) {
		$uid = $this -> clean($_REQUEST["uid"]);
		$name = $this -> clean($_REQUEST["name"]);
		$dob = $this -> clean($_REQUEST["dob"]);
		$email = $this -> clean($_REQUEST["email"]);
		$aadhaar = $this -> clean($_REQUEST["aadhaar"]);
		$address = $this -> clean($_REQUEST["address"]);
		$pincode = $this -> clean($_REQUEST["pincode"]);
		$facebook = $this -> clean($_REQUEST["facebook"]);
		$linkedin = $this -> clean($_REQUEST["linkedin"]);
		$gender = $this -> clean($_REQUEST["gender"]);
		$alternate_id = $this -> clean($_REQUEST["alternate_id"]);
		$alternate_id_no = $this -> clean($_REQUEST["alternate_id_no"]);
		$mobile = $this -> clean($_REQUEST["mobile"]);
		$state = $this -> clean($_REQUEST["state"]);
		$city = $this -> clean($_REQUEST["city"]);
		$q = "update member_details set
					name='" . $name . "',
					dob='" . $dob . "',
					email='" . $email . "',
					address='" . $address . "',
					pincode='" . $pincode . "',
					aadhaar='" . $aadhaar . "',
					facebook='" . $facebook . "',
					linkedin='" . $linkedin . "',
					gender='" . $gender . "',
					mobile='" . $mobile . "',
					city='" . $city . "',
					state='" . $state . "',	
					alternate_id='" . $alternate_id . "',
					alternate_id_no='" . $alternate_id_no . "'
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
		header('Location: admin.php?action=skill-mitra');

	}

	function update_skill_mitra_profile($mysqli) {
		$uid = $_SESSION["skill_champs_user_id"];
		$name = $this -> clean($_REQUEST["name"]);
		$father_name = $this -> clean($_REQUEST["father_name"]);
		$dob = $this -> clean($_REQUEST["dob"]);
		$email = $this -> clean($_REQUEST["email"]);
		$aadhaar = $this -> clean($_REQUEST["aadhaar"]);
		$address = $this -> clean($_REQUEST["address"]);
		$pincode = $this -> clean($_REQUEST["pincode"]);
		$facebook = $this -> clean($_REQUEST["facebook"]);
		$linkedin = $this -> clean($_REQUEST["linkedin"]);
		$gender = $this -> clean($_REQUEST["gender"]);
		$q = "update member_details set
					name='" . $name . "',
					father_name='" . $father_name . "',
					dob='" . $dob . "',
					email='" . $email . "',
					address='" . $address . "',
					pincode='" . $pincode . "',
					aadhaar='" . $aadhaar . "',
					facebook='" . $facebook . "',
					linkedin='" . $linkedin . "',
					gender='" . $gender . "'
					
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
		header('Location: skill-mitra.php');

	}

	function save_skillmitra_admin_profile($mysqli) {
		$uid = $_REQUEST["uid"];
		$name = $this -> clean($_REQUEST["name"]);
		$dob = $this -> clean($_REQUEST["dob"]);
		$gender = $this -> clean($_REQUEST["gender"]);
		$mobile = $this -> clean($_REQUEST["mobile"]);
		$email = $this -> clean($_REQUEST["email"]);
		$aadhaar = $this -> clean($_REQUEST["aadhaar"]);
		$address = $this -> clean($_REQUEST["address"]);
		$state = $this -> clean($_REQUEST["state"]);
		$city = $this -> clean($_REQUEST["city"]);
		$pincode = $this -> clean($_REQUEST["pincode"]);
		$facebook = $this -> clean($_REQUEST["facebook"]);
		$linkedin = $this -> clean($_REQUEST["linkedin"]);
		$alternate_id_no = $this -> clean($_REQUEST["alternate_id_no"]);
		$alternate_id = $this -> clean($_REQUEST["alternate_id"]);

		$query = "insert into members(username,user_role,user_status)
				values('" . $mobile . "','700','Inactive')";
		$mysqli -> query($query);
		$uid = $mysqli -> insert_id;
		$query = "insert into member_details(regd_by,regd_date,uid,aadhaar,name,mobile,pincode,jobcategory)
				values('" . $_SESSION["ps4a_admin_user_id"] . "','" . date('Y-m-d') . "','" . $uid . "','" . $aadhaar . "','" . $name . "','" . $mobile . "','" . $pincode . "','" . $jobcategory . "')";
		$mysqli -> query($query);

		$q = "update member_details set
					alternate_id_no='" . $alternate_id_no . "',
					alternate_id='" . $alternate_id . "',
					name='" . $name . "',			
					dob='" . $dob . "',
					gender='" . $gender . "',
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
		header('Location: admin.php?action=skill-mitra');
	}

	function admin_upload_skillmitra_profile($mysqli) {

		$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
		if (!empty($_FILES['file']['tmp_name']) && in_array($_FILES['file']['type'], $csvMimes)) {

			$csvFile = fopen($_FILES["file"]["tmp_name"], 'r');

			//skip first line
			fgetcsv($csvFile);
			$count = 0;
			//parse data from csv file line by line
			while (($line = fgetcsv($csvFile)) !== FALSE) {
				$name = $line[0];
				$dob = $line[1];
				$mobile = $line[2];
				$gender = $line[3];
				$email = $line[4];
				$aadhaar = $line[5];
				$alternate_id = $line[6];
				$alternate_id_no = $line[7];
				$city = $line[8];
				$pincode = $line[9];
				$address = $line[10];
				$linkedin = $line[11];
				$facebook = $line[12];

				$sql = "SELECT * FROM members where username='" . $mobile . "'";

				if ($result = mysqli_query($mysqli, $sql)) {
					$rowcount = mysqli_num_rows($result);
					if ($rowcount > 0) {
						echo $mobile . " already exist.";
					} else {
						$query = "insert into members(username,user_role,user_status)
						values('" . $mobile . "','700','Inactive')";
						$mysqli -> query($query);
						$uid = $mysqli -> insert_id;
						$query = "insert into member_details(regd_by,regd_date,uid,aadhaar,name,mobile,pincode)
								values('" . $_SESSION["ps4a_admin_user_id"] . "','" . date('Y-m-d') . "','" . $uid . "','" . $aadhaar . "','" . $name . "','" . $mobile . "','" . $pincode . "')";
						$mysqli -> query($query);

						$q = "update member_details set
									alternate_id_no='" . $alternate_id_no . "',
									alternate_id='" . $alternate_id . "',
									name='" . $name . "',
									dob='" . $dob . "',
									gender='" . $gender . "',
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
				echo "No Skill Mitra uploaded.";
			} else if ($count == 1) {
				echo $count . " Skill Mitra uploaded successfully.";
			} else {
				echo $count . " Skill Mitra uploaded successfully.";
			}
		} else
			echo "Please upload csv file.";

	}

	function save_skill_mitra_registration($mysqli) {
		$name = $this -> clean($_REQUEST["name"]);
		$dob = $this -> clean($_REQUEST["dob"]);
		$gender = $this -> clean($_REQUEST["gender"]);
		$mobile = $this -> clean($_REQUEST["mobile"]);
		$email = $this -> clean($_REQUEST["email"]);
		$aadhaar = $this -> clean($_REQUEST["aadhaar"]);
		$alternate_id = $this -> clean($_REQUEST["alternate_id"]);
		$alternate_id_no = $this -> clean($_REQUEST["alternate_id_no"]);
		$address = $this -> clean($_REQUEST["address"]);
		$state = $this -> clean($_REQUEST["state"]);
		$city = $this -> clean($_REQUEST["city"]);
		$pincode = $this -> clean($_REQUEST["pincode"]);
		$facebook = $this -> clean($_REQUEST["facebook"]);
		$twitter = $this -> clean($_REQUEST["twitter"]);
		$linkedin = $this -> clean($_REQUEST["linkedin"]);
		$instagram = $this -> clean($_REQUEST["instagram"]);
		$education = $this -> clean($_REQUEST["education"]);
		$working_experience = $this -> clean($_REQUEST["working_experience"]);

		$query = "insert into members(username,user_role,user_status)
				values('" . $mobile . "','700','Inactive')";
		$mysqli -> query($query);
		$uid = $mysqli -> insert_id;
		$query = "insert into member_details
		(
				uid,
				name,
				dob,
				gender,
				mobile,
				email,
				aadhaar,
				alternate_id,
				alternate_id_no,
				address,
				state,
				city,
				pincode,
				education,
				working_experience,
				facebook,
				twitter,
				linkedin,
				instagram,
				regd_date)
				values(
				'" . $uid . "',
				'" . $name . "',
				'" . $dob . "',
				'" . $gender . "',
				'" . $mobile . "',
				'" . $email . "',
				'" . $aadhaar . "',
				'" . $alternate_id . "',
				'" . $alternate_id_no . "',
				'" . $address . "',
				'" . $state . "',
				'" . $city . "',
				'" . $pincode . "',
				'" . $education . "',
				'" . $working_experience . "',
				'" . $facebook . "',
				'" . $twitter . "',
				'" . $linkedin . "',
				'" . $instagram . "',
				'" . date('Y-m-d') . "')";
		$mysqli -> query($query);
		$subject = "Skill Champs-New Skill Mitra Registered: " . $name;
		$message = "New Skill Mitra registered on Skill Champs
				<br>Name:" . $name . "
				<br>Mobile:" . $mobile . "
				<br>Email:" . $email;
		$emailfrom = "admin@skillchamps.in";
		$fromname = "Skill Champs";
		$to = "cwarajivpandey@gmail.com,admin@skillchamps.in";
		$mailer = new Mailer;
		$mailer -> sendMail($to, $emailfrom, $subject, $message, "", "");

		$subject11 = "Skill Champs- You have successfully Registered";
		$message = "Thank you for registering with us. We will contact you soon.<br><br>
		Team<br>Skill Champs";
		$mailer -> sendMail($email, $emailfrom, $subject1, $message1, "", "");

		header('Location: ?action=regd_success&t=skill mitra');
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

}
?>