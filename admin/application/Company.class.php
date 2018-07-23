<?php
class Company {

	function Company() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
        ini_set('xdebug.max_nesting_level', 500);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}
    
    function updateCompProfile($dbHelper,$mysqli,$uid,$profilePic,$name,$comp,$landline,$mobile,$email,$aadhar,$pan,$panPic,$gstin,$gstinCer,$tan,$address,$city,$state,$pin,$facebook,$linkdin) {
        return $dbHelper->performOperation($mysqli, 'sp_updateCompProfile', array($uid,$profilePic,$name,$comp,$landline,$mobile,$email,$aadhar,$pan,$panPic,$gstin,$gstinCer,$tan,$address,$city,$state,$pin,$facebook,$linkdin));
    }
    
    function updateCompProfileFront($dbHelper,$mysqli,$redirect) {
        $uid = $_REQUEST["uid"]; 
        $profilePic = isset($_FILES["pic"]["name"])?$_FILES["pic"]["name"]:"";
        $name = $this -> clean($_REQUEST["name"]); 
        $comp = $this -> clean($_REQUEST["comp"]);
        $landline = $this -> clean($_REQUEST["landline"]); 
        $mobile = $this -> clean($_REQUEST["mob"]); 
        $email = $this -> clean($_REQUEST["email"]);
        $aadhar  = $this -> clean($_REQUEST["aadhar"]);
        $pan = $this -> clean($_REQUEST["pan"]);
        $panPic =isset($_FILES["panpic"]["name"])?$_FILES["panpic"]["name"]:"";
        $gstin = $this -> clean($_REQUEST["gstin"]);
        $gstinCer =isset($_FILES["gstpic"]["name"])?$_FILES["gstpic"]["name"]:"";
        $tan = $this -> clean($_REQUEST["tan"]);
        $address = $this -> clean($_REQUEST["address"]);
        $city = $this -> clean($_REQUEST["city"]);
        $state = $this -> clean($_REQUEST["state"]);
        $pin  = $this -> clean($_REQUEST["pin"]);
        $facebook = $this -> clean($_REQUEST["facebook"]);
        $linkdin = $this -> clean($_REQUEST["linkedin"]);
        if (!is_dir("admin/images/candidate/" . $uid)) {
            mkdir("admin/images/candidate/" . $uid, 0777);
        }
        if ($profilePic != '') {
            move_uploaded_file($_FILES["pic"]["tmp_name"], "admin/images/candidate/" . $uid . "/" . $profilePic);
        }
        if ($panPic != '') {
            move_uploaded_file($_FILES["panpic"]["tmp_name"], "admin/images/candidate/" . $uid . "/" . $panPic);
        }
        if ($gstinCer != '') {
            move_uploaded_file($_FILES["gstpic"]["tmp_name"], "admin/images/candidate/" . $uid . "/" . $gstinCer);
        }
        $dbHelper->performOperation($mysqli, 'sp_updateCompProfile', array($uid,$profilePic,$name,$comp,$landline,$mobile,$email,
        $aadhar,$pan,$panPic,$gstin,$gstinCer,$tan,$address,$city,$state,$pin,$facebook,$linkdin));
        header('Location: '.$redirect);
    }

    
	 function updateAgreement($dbHelper,$mysqli,$redirect) {
        $uid = $_REQUEST["eid"]; 
        $agrement = isset($_FILES["agrement"]["name"])?$_FILES["agrement"]["name"]:"";
        $authl =isset($_FILES["authl"]["name"])?$_FILES["authl"]["name"]:"";
        $data=$dbHelper->getDataFromQuery($mysqli, "select aggrement_doc,auth_doc from member_details where uid='".$uid."'");       
        if (!is_dir("admin/images/candidate/" . $uid)) {
            mkdir("admin/images/candidate/" . $uid, 0777);
        }
        if ($agrement != '') {
            move_uploaded_file($_FILES["agrement"]["tmp_name"], "admin/images/candidate/" . $uid . "/" . $agrement);
        }else $agrement=$data[0]["aggrement_doc"];
        if ($authl != '') {
            move_uploaded_file($_FILES["authl"]["tmp_name"], "admin/images/candidate/" . $uid . "/" . $authl);
        }else $authl=$data[0]["auth_doc"];
        
        $dbHelper->performFromQuery($mysqli, "update member_details set aggrement_doc='".$agrement."', auth_doc='".$authl."' where uid='".$uid."'");
        header('Location: '.$redirect);
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
        $pwd = $this->random_password(6);
        $password = hash('sha512', $pwd);
        $random_salt = hash('sha512', uniqid(rand(1, 10000000), TRUE));
        $hash = md5( rand(0,1000) ); 
        $password = hash('sha512', $password . $random_salt);
        $query = "insert into members(username,password,salt,email_verification_code,user_role,user_status)
                values('" . $mobile ."','".$password."','".$random_salt."','".$hash."','800','Inactive')";
        $mysqli -> query($query);
        $uid = $mysqli -> insert_id;
        $query = "insert into member_details(regd_by,regd_date,uid,aadhaar,name,mobile,pincode,jobcategory)
                values('" . $_SESSION["ps4a_admin_user_id"] . "','" . date('Y-m-d') . "','" . $uid . "','" . $aadhaar . "','" . $name . "','" . $mobile . "','" . $pincode . "','" . $jobcategory . "')";
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
        
        $panPic =isset($_FILES["panpic"]["name"])?$_FILES["panpic"]["name"]:"";
        if ($panPic != '') {

            $query = "update member_details set 
                            pan_pic='" . $panPic . "'
                            where uid ='" . $uid . "'
                ";
            $mysqli -> query($query);
            move_uploaded_file($_FILES["panpic"]["tmp_name"], "images/candidate/" . $uid . "/" . $panPic);

        }
        
        $gstinCer =isset($_FILES["gstpic"]["name"])?$_FILES["gstpic"]["name"]:"";
        if ($gstinCer != '') {

            $query = "update member_details set 
                            gstin_cer='" . $gstinCer . "'
                            where uid ='" . $uid . "'
                ";
            $mysqli -> query($query);
            move_uploaded_file($_FILES["gstpic"]["tmp_name"], "images/candidate/" . $uid . "/" . $gstinCer);

        }
        
        $agrement = isset($_FILES["agrement"]["name"])?$_FILES["agrement"]["name"]:"";
        if ($agrement != '') {

            $query = "update member_details set 
                            aggrement_doc='" . $agrement . "'
                            where uid ='" . $uid . "'
                ";
            $mysqli -> query($query);
            move_uploaded_file($_FILES["agrement"]["tmp_name"], "images/candidate/" . $uid . "/" . $agrement);

        } 
        
        $authl =isset($_FILES["authl"]["name"])?$_FILES["authl"]["name"]:"";
        if ($authl != '') {

            $query = "update member_details set 
                            auth_doc='" . $authl . "'
                            where uid ='" . $uid . "'
                ";
            $mysqli -> query($query);
            move_uploaded_file($_FILES["authl"]["tmp_name"], "images/candidate/" . $uid . "/" . $authl);

        }
                
        $subject = "FLEXIHIRE- New Employer Registered: " . $name;
        $message = "New Employer registered on Flexihire
                <br>Name:" . $name . "
                <br>Mobile:" . $mobile . "
                <br>Email:" . $email;
        $emailfrom = "admin@flexihire.co.in";
        $fromname = "Flexihire";
        $to = "cwarajivpandey@gmail.com,admin@flexihire.co.in";
        $headers = 'Return-Path: ' . $emailfrom . "\r\n" . 'From: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 'X-Priority: 3' . "\r\n" . 'X-Mailer: PHP ' . phpversion() . "\r\n" . 'Reply-To: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Transfer-Encoding: 8bit' . "\r\n" . 'Content-Type: text/html; charset=utf-8' . "\r\n";
        $mailer = new Mailer;
        $mailer -> sendMail($to, $emailfrom, $subject, $message, "", "");
        $subject1 = "Flexihire- Successfully Registered: " . $name;
        $message1 = "Dear Sir/Mam,<br>You have successfully registered with Flexihire.Your user name is:".$mobile." and password is:".$pwd." Please login and update your details to start hiring. Please click on following link to verify email. <br>
        "." http://localhost:8080/skillchamps_site/index.php?action=verifylink&id=".$uid."&hash=".$hash."
        <br>
        Team<br>
        FLEXIHIRE";
        $mailer -> sendMail($email, $emailfrom, $subject1, $message1, "", "");
        
        header('Location: admin.php?action=enterprise');
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
        $panPic =isset($_FILES["panpic"]["name"])?$_FILES["panpic"]["name"]:"";
        if ($panPic != '') {

            $query = "update member_details set 
                            pan_pic='" . $panPic . "'
                            where uid ='" . $uid . "'
                ";
            $mysqli -> query($query);
            move_uploaded_file($_FILES["panpic"]["tmp_name"], "images/candidate/" . $uid . "/" . $panPic);

        }
        
        $gstinCer =isset($_FILES["gstpic"]["name"])?$_FILES["gstpic"]["name"]:"";
        if ($gstinCer != '') {

            $query = "update member_details set 
                            gstin_cer='" . $gstinCer . "'
                            where uid ='" . $uid . "'
                ";
            $mysqli -> query($query);
            move_uploaded_file($_FILES["gstpic"]["tmp_name"], "images/candidate/" . $uid . "/" . $gstinCer);

        }
        
        $agrement = isset($_FILES["agrement"]["name"])?$_FILES["agrement"]["name"]:"";
        if ($agrement != '') {

            $query = "update member_details set 
                            aggrement_doc='" . $agrement . "'
                            where uid ='" . $uid . "'
                ";
            $mysqli -> query($query);
            move_uploaded_file($_FILES["agrement"]["tmp_name"], "images/candidate/" . $uid . "/" . $agrement);

        } 
        
        $authl =isset($_FILES["authl"]["name"])?$_FILES["authl"]["name"]:"";
        if ($authl != '') {

            $query = "update member_details set 
                            auth_doc='" . $authl . "'
                            where uid ='" . $uid . "'
                ";
            $mysqli -> query($query);
            move_uploaded_file($_FILES["authl"]["tmp_name"], "images/candidate/" . $uid . "/" . $authl);

        }
        
        header('Location: admin.php?action=enterprise');
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
    
    function random_password($length = 6) {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $password = substr(str_shuffle($chars), 0, $length);
        return $password;
    }

	function clean($data) {
		$data = stripslashes($data);
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}

}
?>