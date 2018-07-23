<?php

class Guru {

	function Guru() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}

	function clean($data) {
		$data = stripslashes($data);
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}
    
     function getTotalCreditByGuru($dbHelper,$mysqli,$skid){
        $data=array();
        $data=$dbHelper->getData($mysqli, 'sp_getTotalCreditByToUid', array($skid));
        return $data;
    }
    
    function getCreditByGuru($dbHelper,$mysqli,$skid){
        $data=array();
        $data=$dbHelper->getData($mysqli, 'sp_getCreditByToUid', array($skid));
        return $data;
    }

	function update_guru_profile($mysqli) {
		$uid = $_SESSION["skill_champs_user_id"];
		$name = $this -> clean($_REQUEST["name"]);
		$dob = $this -> clean($_REQUEST["dob"]);
		$email = $this -> clean($_REQUEST["email"]);
		$aadhaar = $this -> clean($_REQUEST["aadhaar"]);
		$address = $this -> clean($_REQUEST["address"]);
		$pincode = $this -> clean($_REQUEST["pincode"]);
		$facebook = $this -> clean($_REQUEST["facebook"]);
		$linkedin = $this -> clean($_REQUEST["linkedin"]);
		$gender = $this -> clean($_REQUEST["gender"]);
		$father_name = $this -> clean($_REQUEST["father_name"]);
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
		header('Location: guru.php');

	}

	function getGuruAssignedEmployer($mysqli, $gid) {
		$data = array();
		$sql = "";
		if ($gid != "") {
			$sql = " where ge.gid='" . $gid . "'";
		}
		$query = "SELECT *
					FROM guru_employer as ge
					left outer join
					member_details as md
					on ge.eid=md.uid
					$sql
					 order by ge.eid DESC
					";
		$result = $mysqli -> query($query);
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			array_push($data, $row);
		}
		return $data;
	}

	function getGuruReviews($mysqli, $guru, $status, $vid) {
		$data = array();
		$sql = "";
		if ($vid != "") {
			$sql .= " and videos.vid='" . $vid . "'";
		}
		if ($status != "") {
			$sql .= " and guru_video.gv_status='" . $status . "'";
		}

		$query = "SELECT *
						FROM guru_video
						inner join videos
						on guru_video.video = videos.vid
						where guru_video.guru = '" . $guru . "'
						$sql
						
						 order by vid DESC
						";

		$result = $mysqli -> query($query);
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			array_push($data, $row);
		}

		return $data;
	}

	function getGuruWithPenVideoAndShCondidates($mysqli) {
		$data = array();
		$query = "SELECT mem.uid,mem.name,mem.mobile,mem.username,mem.regd_date,
						mem.user_status,gv.pending,sh.shortlisted 
						FROM
						(SELECT md.uid,md.name,md.mobile,m.username,md.regd_date,
						m.user_status 
						FROM member_details as md
						inner join members as m
						on md.uid = m.id
						and m.user_role = '500'
						where m.id!=''
						order by m.id DESC) mem
						left outer join 
						(SELECT giv.guru,count(*) as pending from guru_video as giv left outer join videos as v
						on giv.video=v.vid 
						WHERE v.vid!='' and giv.gv_status='Pending' group by giv.guru ) gv
						on mem.uid=gv.guru
						left outer join
						(SELECT sgid,count(*) as shortlisted from shortlisted_candidates WHERE sgid!='0' group by sgid ) sh
						on mem.uid=sh.sgid
						";

		$result = $mysqli -> query($query);
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			array_push($data, $row);
		}
		return $data;
	}

	function getPendingVideoByGuru($mysqli, $gid) {
		$data = array();
		$query = "SELECT gv.guru,v.vid,v.uid,v.video as videourl,v.youtube,v.vtype,md.name,md.aadhaar
						FROM guru_video as gv
						left outer join videos as v
						on gv.video = v.vid
						left outer join member_details as md
						on v.uid=md.uid
						where gv.guru='" . $gid . "'
						 and gv_status='Pending'
						 and v.vid!=''
						 order by gv.guru DESC
						";

		$result = $mysqli -> query($query);
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			array_push($data, $row);
		}
		return $data;
	}
	
	
    
     function getPendingVideoCountByGuru($dbHelper,$mysqli,$gid){
        $data=array();
        $data=$dbHelper->getDataFromQuery($mysqli, "select count(*) as num from guru_video where guru_video.gv_status='Pending' AND guru_video.guru='".$gid."'");
        return $data[0]["num"];
    }

	function update_guru_admin_profile($mysqli) {
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
		$assigned_jobs = $_REQUEST["assigned_jobs"];
		//echo count($assigned_jobs);
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
		$q = "delete from guru_jobs_cat where guru='" . $uid . "'";
		$mysqli -> query($q);
		for ($i = 0; $i < count($assigned_jobs); $i++) {
			$q = "insert into guru_jobs_cat
			(guru,jobs)
			values(
				'" . $uid . "',
				'" . $assigned_jobs[$i] . "'
			)";
			$mysqli -> query($q);
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
		header('Location: admin.php?action=guru');

	}

	function admin_assign_guru_emp($mysqli) {
		$gid = $_REQUEST["gid"];
		foreach ($_REQUEST['emp'] as $eid) {
			$query = "insert into guru_employer(gid,eid)
						values('" . $gid . "','" . $eid . "')";
			$mysqli -> query($query);
		}
		header('Location: admin.php?action=assign_guru_emp&id=' . $gid);
	}

	function admin_upload_guru_profile($mysqli) {
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
						values('" . $mobile . "','500','Inactive')";
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
				echo "No Guru uploaded.";
			} else if ($count == 1) {
				echo $count . " Guru uploaded successfully.";
			} else {
				echo $count . " Guru uploaded successfully.";
			}
		} else
			echo "Please upload csv file.";
      }

	function save_guru_admin_profile($mysqli) {
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

		$assigned_jobs = $_REQUEST["assigned_jobs"];
		$query = "insert into members(username,user_role,user_status)
				values('" . $mobile . "','500','Inactive')";
		$mysqli -> query($query);
		$uid = $mysqli -> insert_id;

		$query = "insert into member_details(regd_by,regd_date,uid,aadhaar,name,mobile,pincode)
				values('" . $_SESSION["ps4a_admin_user_id"] . "','" . date('Y-m-d') . "','" . $uid . "','" . $aadhaar . "','" . $name . "','" . $mobile . "','" . $pincode . "')";
		$mysqli -> query($query);

		//echo count($assigned_jobs);
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

		for ($i = 0; $i < count($assigned_jobs); $i++) {
			$q = "insert into guru_jobs_cat
			(guru,jobs)
			values(
				'" . $uid . "',
				'" . $assigned_jobs[$i] . "'
			)";
			$mysqli -> query($q);
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
		header('Location: admin.php?action=guru');

	}

	function delete_guru($mysqli, $uid, $page) {
		$query = "delete from members where id='" . $uid . "'";
		$mysqli -> query($query);

		$query1 = "delete from member_details where uid='" . $uid . "'";
		$mysqli -> query($query1);

		$query2 = "delete from videos where uid='" . $uid . "'";
		$mysqli -> query($query2);

		$query3 = "delete from guru_jobs_cat where guru='" . $uid . "'";
		$mysqli -> query($query3);

		$qq = "select gv.gv_id,gv.video,gv.guru,md.jobcategory,c.sector 
				from guru_video as gv
				left outer join 
				videos as v on
				gv.video=v.vid
				left outer join 
				member_details as md on
				v.uid=md.uid
				left outer join 
				courses as c on
				md.jobcategory=c.course_id
				where guru='" . $uid . "' and gv_status='Pending'";

		if ($result = mysqli_query($mysqli, $qq)) {

			while ($row = mysqli_fetch_assoc($result)) {
				$sector = $row["sector"];
				$vid = $row["video"];
				$q3 = "select guru from guru_jobs_cat
						where jobs = '" . $sector . "' order by rand() limit 0,1";

				$r3 = mysqli_query($mysqli, $q3);
				if (mysqli_num_rows($r3) > 0) {
					$v3 = mysqli_fetch_assoc($r3);
					$guru = $v3["guru"];

					$q4 = "update guru_video set
					guru='" . $guru . "' 
					where video='" . $vid . "'";
					mysqli_query($mysqli, $q4);
				}
			}
		}

		header('Location: admin.php?action=' . $page);
	}

	function save_guru_registration($mysqli) {
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

		$query = "insert into members(username,user_role,user_status)
				values('" . $mobile . "','500','Inactive')";
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
				'" . $facebook . "',
				'" . $twitter . "',
				'" . $linkedin . "',
				'" . $instagram . "',
				'" . date('Y-m-d') . "')";
		$mysqli -> query($query);
		$subject = "Skill Champs-New Guru Registered: " . $name;
		$message = "New Guru registered on Skill Champs
				<br>Name:" . $name . "
				<br>Mobile:" . $mobile . "
				<br>Email:" . $email;
		$emailfrom = "admin@skillchamps.in";
		$fromname = "Skill Champs";
		$to = "cwarajivpandey@gmail.com,admin@skillchamps.in";
		$mailer = new Mailer;
		$mailer -> sendMail($to, $emailfrom, $subject, $message, "", "");

		$subject1 = "Skill Champs- You have successfully Registered";
		$message1 = "Thank you for registering with us. We will contact you soon.<br><br>
		Team<br>Skill Champs";
		$mailer -> sendMail($email, $emailfrom, $subject1, $message1, "", "");

		header('Location: ?action=regd_success&t=guru');
	}

	function admin_delete_guru_emp($mysqli, $uid, $page, $gid) {
		$query = "delete from guru_employer where eid='" . $uid . "'";
		$mysqli -> query($query);
		header('Location: admin.php?action=' . $page . '&id=' . $gid);
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

}
?>