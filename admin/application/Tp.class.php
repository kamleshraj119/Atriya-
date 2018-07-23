<?php
error_reporting(E_ALL);
 class Tp {

	function Tp() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}
	
	function update_tp_profile($mysqli) {
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
		header('Location: training-center.php');

	}
	
	function getTpInfra($mysqli, $id) {
		$sql = "";
		if ($id != "") {
			$sql .= " where mem.id='" . $id . "'";
		}
		$data = array();
		$query = "SELECT mem.id,
		IFNULL(tpc.comp,0) as comp,IFNULL(tpac.ac,0) as ac,
		IFNULL(tpcou.course,0) as course,IFNULL(tpb.batch,0) as batch,
		IFNULL(tpim.image,0) as image,
		IFNULL(tpt.trainer,0) as trainer,
		IFNULL(tpv.video,0) as video,
	    sum(IFNULL(tpc.comp,0)+IFNULL(tpac.ac,0)+IFNULL(tpcou.course,0)
	    +IFNULL(tpb.batch,0)+IFNULL(tpim.image,0)+
		IFNULL(tpt.trainer,0)+IFNULL(tpv.video,0)) as total
						FROM
						(SELECT m.id
						FROM members as m
						where m.id!=''
						and m.user_role = '600'
						order by m.id DESC) mem
						
						left outer join 
						(SELECT id,uid,count(*) as comp from tp_computer
					     group by uid) tpc
						on mem.id=tpc.uid
						
						left outer join
						(SELECT id,uid,count(*) as ac from tp_ac
					     group by uid) tpac
						on mem.id=tpac.uid
						
						left outer join
						(SELECT id,uid,count(*) as course from tp_courses
					     group by uid) tpcou
						on mem.id=tpcou.uid
						
						left outer join
						(SELECT tp_batch.id,tp_courses.uid,count(*) as batch from tp_batch
						left outer join tp_courses
						on tp_batch.tp_course_id= tp_courses.id
					     group by uid) tpb
						on mem.id=tpb.uid
						
						
						left outer join
						(SELECT id,uid,count(*) as image from tp_image
					     group by uid) tpim
						on mem.id=tpim.uid
						
						left outer join
						(SELECT id,uid,count(*) as trainer from tp_trainer
					     group by uid) tpt
						on mem.id=tpt.uid
						
						left outer join
						(SELECT vid,uid,count(*) as video from videos
					     group by uid) tpv
						on mem.id=tpv.uid
						$sql
						
						";

		$result = $mysqli -> query($query);
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			array_push($data, $row);
		}
		return $data;
	}

	function getTpInfraComp($mysqli, $id) {
		$sql = "";
		if ($id != "") {
			$sql .= " where members.id='" . $id . "'";
		}
		$data = array();
		$query = "SELECT *,tp_computer.id as compid FROM tp_computer
				  left outer join members
				  on tp_computer.uid=members.id
				   $sql
				   order by tp_computer.id DESC	
				   ";

		$result = $mysqli -> query($query);
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			array_push($data, $row);
		}
		return $data;
	}

	function getTpInfraAc($mysqli, $id) {
		$sql = "";
		if ($id != "") {
			$sql .= " where members.id='" . $id . "'";
		}
		$data = array();
		$query = "SELECT *,tp_ac.id as acid FROM tp_ac
				  left outer join members
				  on tp_ac.uid=members.id
				   $sql
				   order by tp_ac.id DESC	
				   ";

		$result = $mysqli -> query($query);
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			array_push($data, $row);
		}
		return $data;
	}

	function getTpInfraCourses($mysqli, $id) {
		$sql = "";
		if ($id != "") {
			$sql .= " where members.id='" . $id . "'";
		}
		$data = array();
		$query = "SELECT *,tp_courses.id as tpcid FROM tp_courses
				  left outer join members
				  on tp_courses.uid=members.id
				  left outer join courses
				  on tp_courses.jobcategory=courses.course_id
				   $sql
				   order by tp_courses.id DESC	
				   ";

		$result = $mysqli -> query($query);
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			array_push($data, $row);
		}
		return $data;
	}

	function getTpInfraBatches($mysqli, $id) {
		$sql = "";
		if ($id != "") {
			$sql .= " where tp_id='" . $id . "'";
		}
		$data = array();
		$query = "SELECT *,tp_batch.id as bid FROM tp_batch
		           left outer join tp_courses on
		           tp_batch.tp_course_id=tp_courses.id
		           left outer join courses
                  on tp_courses.jobcategory=courses.course_id
				   $sql
				   order by tp_batch.id DESC	
				   ";

		$result = $mysqli -> query($query);
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			array_push($data, $row);
		}
		return $data;
	}

	function getTpInfraImages($mysqli, $id) {
		$sql = "";
		if ($id != "") {
			$sql .= " where members.id='" . $id . "'";
		}
		$data = array();
		$query = "SELECT *,tp_image.id as imid FROM tp_image
				  left outer join members
				  on tp_image.uid=members.id
				   $sql
				   order by tp_image.id DESC	
				   ";

		$result = $mysqli -> query($query);
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			array_push($data, $row);
		}
		return $data;
	}

	function getTpInfraTrainer($mysqli, $id) {
		$sql = "";
		if ($id != "") {
			$sql .= " where members.id='" . $id . "'";
		}
		$data = array();
		$query = "SELECT *,tp_trainer.id as tptid FROM tp_trainer
				  left outer join members
				  on tp_trainer.uid=members.id
				   $sql
				   order by tp_trainer.id DESC	
				   ";

		$result = $mysqli -> query($query);
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			array_push($data, $row);
		}
		return $data;
	}

	function getTpInfraVideos($mysqli, $id) {
		$sql = "";
		if ($id != "") {
			$sql .= " where members.id='" . $id . "'";
		}
		$data = array();
		$query = "SELECT *,videos.video as videoURL FROM videos
				  left outer join members
				  on videos.uid=members.id
				   $sql
				   order by videos.vid DESC	
				   ";

		$result = $mysqli -> query($query);
		while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
			array_push($data, $row);
		}
		return $data;
	}
	
	function admin_upload_tp_profile($mysqli)
	{
		$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values','application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    	if(!empty($_FILES['file']['tmp_name']) && in_array($_FILES['file']['type'],$csvMimes)){
			
			$csvFile = fopen($_FILES["file"]["tmp_name"], 'r');
            
			//skip first line
			fgetcsv($csvFile);
			$count=0;
			//parse data from csv file line by line
			while(($line = fgetcsv($csvFile)) !== FALSE){
				$center_name = $line[0];
				$tc_regd_id = $line[1];
				$mobile = $line[2];
				$landline = $line[3];
				$email = $line[4];
				$address = $line[5];
				$trg_level = $line[6];
				$trg_hour = $line[7];	
				$trg_type = $line[8];
				$city = $line[9];
				$pincode = $line[10];
				$linkedin = $line[11];
				$facebook = $line[12];
				
				$sql="SELECT * FROM members where username='".$mobile."'";

				if ($result=mysqli_query($mysqli,$sql))
				{
					$rowcount=mysqli_num_rows($result);
					if($rowcount>0){
						echo $mobile." already exist.";
					}else{
						$query = "insert into members(username,user_role,user_status)
						values('".$mobile."','600','Inactive')";
						$mysqli->query($query);
						$uid = $mysqli->insert_id;

						$query1 = "insert into member_details(regd_by,regd_date,uid,center_name,mobile,pincode)
								values('".$_SESSION["ps4a_admin_user_id"]."','".date('Y-m-d')."','".$uid."','".$center_name."','".$mobile."','".$pincode."')";
						$mysqli->query($query1);

						$q = "update member_details set
									mobile='".$mobile."',
									email='".$email."',
									address='".$address."',
									city='".$city."',
									pincode='".$pincode."',
									facebook='".$facebook."',
									linkedin='".$linkedin."',
									center_name='".$center_name."',
									tc_regd_id='".$tc_regd_id."',
									landline='".$landline."',
									trg_level='".$trg_level."',
									trg_hour='".$trg_hour."',
									trg_type='".$trg_type."'
									where uid='".$uid."'

									";
						$mysqli->query($q);
						$count++;
					}
				}
				
			}
			if($count<1){
				echo "No Training partner uploaded.";
			}else if($count==1){
				echo $count." Training partner uploaded successfully.";
			}else{
				echo $count." Training partner uploaded successfully.";
			}
		}else echo "Please upload csv file.";
		
	}

	function admin_update_tp_profile($mysqli)
	{
		$uid = $_REQUEST["uid"];
		$center_name = $this->clean($_REQUEST["center_name"]);
		$tc_regd_id = $this->clean($_REQUEST["tc_regd_id"]);
		$skill_sector = $this->clean($_REQUEST["jobcategory"]);
		$mobile = $this->clean($_REQUEST["mobile"]);
		$landline = $this->clean($_REQUEST["landline"]);
		$email = $this->clean($_REQUEST["email"]);
		$address = $this->clean($_REQUEST["address"]);
		$state = $this->clean($_REQUEST["state"]);
		$city = $this->clean($_REQUEST["city"]);
		$pincode = $this->clean($_REQUEST["pincode"]);
		$facebook = $this->clean($_REQUEST["facebook"]);
		$twitter = $this->clean($_REQUEST["twitter"]);
		$trg_level = $this->clean($_REQUEST["trg_level"]);
		$trg_hour = $this->clean($_REQUEST["trg_hour"]);
		$trg_type = $this->clean($_REQUEST["trg_type"]);
		
		$q = "update member_details set
					mobile='".$mobile."',
					email='".$email."',
					address='".$address."',
					state='".$state."',
					city='".$city."',
					pincode='".$pincode."',
					facebook='".$facebook."',
					linkedin='".$linkedin."',
					center_name='".$center_name."',
					tc_regd_id='".$tc_regd_id."',
					jobcategory='".$skill_sector."',
					landline='".$landline."',
					trg_level='".$trg_level."',
					trg_hour='".$trg_hour."',
					trg_type='".$trg_type."'
					where uid='".$uid."'
					
					";
			$mysqli->query($q);
			header('Location: admin.php?action=training-partner');
	}
	
	function save_training_center_registration($mysqli,$mailer)
	{
		$center_name = $this->clean($_REQUEST["center_name"]);
		$tc_regd_id = $this->clean($_REQUEST["tc_regd_id"]);
		$skill_sector = $this->clean($_REQUEST["jobcategory"]);
		$mobile = $this->clean($_REQUEST["mobile"]);
		$landline = $this->clean($_REQUEST["landline"]);
		$email = $this->clean($_REQUEST["email"]);
		$address = $this->clean($_REQUEST["address"]);
		$state = $this->clean($_REQUEST["state"]);
		$city = $this->clean($_REQUEST["city"]);
		$pincode = $this->clean($_REQUEST["pincode"]);
		$facebook = $this->clean($_REQUEST["facebook"]);
		$twitter = $this->clean($_REQUEST["twitter"]);
		$linkedin = $this->clean($_REQUEST["linkedin"]);
		$instagram = $this->clean($_REQUEST["instagram"]);
		$trg_level = $this->clean($_REQUEST["trg_level"]);
		$trg_hour = $this->clean($_REQUEST["trg_hour"]);
		$trg_type = $this->clean($_REQUEST["trg_type"]);
		
		$query = "insert into members(username,user_role,user_status)
				values('".$mobile."','600','Inactive')";
		$mysqli->query($query);
		$uid = $mysqli->insert_id;
		if(count($_FILES['upload']['name'])>0){
			$valid_types = array("image/jpg", "image/jpeg", "image/bmp", "image/gif", "image/png");
			for($i=0; $i<count($_FILES['upload']['name']); $i++){
				if (in_array($_FILES['upload']['type'][$i], $valid_types)){
					$tmpFilePath = $_FILES['upload']['tmp_name'][$i];
                    if($tmpFilePath != ""){
                    	$shortname = $_FILES['upload']['name'][$i];
						if(!is_dir("admin/images/tp/certificates/".$uid))
							mkdir("admin/images/tp/certificates/".$uid, 0777);
						$query ="insert into tp_agreement(uid,file_name,date) values('".$uid."','".$shortname."','".date('Y-m-d H:i:s')."')";
						$mysqli->query($query);
						$target_path = "admin/images/tp/certificates/".$uid."/";
						if(move_uploaded_file($tmpFilePath, "admin/images/tp/certificates/". $uid."/".$shortname." ")) {}
                    	
                    }
                      
				}
			}
		}
		$query = "insert into member_details
		(
				uid,
				center_name,
				tc_regd_id,
				jobcategory,
				mobile,
				landline,
				email,
				address,
				state,
				city,
				pincode,
				facebook,
				twitter,
				linkedin,
				instagram,
				trg_level,
				trg_hour,
				trg_type,
				regd_date)
				values(
				'".$uid."',
				'".$center_name."',
				'".$tc_regd_id."',
				'".$skill_sector."',
				'".$mobile."',
				'".$landline."',
				'".$email."',
				'".$address."',
				'".$state."',
				'".$city."',
				'".$pincode."',
				'".$facebook."',
				'".$twitter."',
				'".$linkedin."',
				'".$instagram."',
				'".$trg_level."',
				'".$trg_hour."',
				'".$trg_type."',
				'".date('Y-m-d')."')";
		$mysqli->query($query);
		$subject = "Skill Champs-New Training Center Registered: ".$name;
		$message ="New Training Center registered on Skill Champs
				<br>Name:".$name."
				<br>Mobile:".$mobile."
				<br>Email:".$email;
				$emailfrom="admin@skillchamps.in";
				$fromname = "Skill Champs";
				$to = "cwarajivpandey@gmail.com,admin@skillchamps.in";
		
		$mailer->sendMail($to,$emailfrom,$subject,$message,"","");
		
		$subject11 = "Skill Champs- You have successfully Registered";
		$message ="Thank you for registering with us. We will contact you soon.<br><br>
		Team<br>Skill Champs";
		$mailer->sendMail($email,$emailfrom,$subject1,$message1,"","");
		
		
		header('Location: ?action=regd_success&t=training center');
	}

	function save_tp($mysqli)
	{
		$center_name = $this->clean($_REQUEST["center_name"]);
		$tc_regd_id = $this->clean($_REQUEST["tc_regd_id"]);
		$skill_sector = $this->clean($_REQUEST["skill_sector"]);
		$mobile = $this->clean($_REQUEST["mobile"]);
		$landline = $this->clean($_REQUEST["landline"]);
		$email = $this->clean($_REQUEST["email"]);
		$address = $this->clean($_REQUEST["address"]);
		$state = $this->clean($_REQUEST["state"]);
		$city = $this->clean($_REQUEST["city"]);
		$pincode = $this->clean($_REQUEST["pincode"]);
		$facebook = $this->clean($_REQUEST["facebook"]);
		$twitter = $this->clean($_REQUEST["twitter"]);
		$linkedin = $this->clean($_REQUEST["linkedin"]);
		$instagram = $this->clean($_REQUEST["instagram"]);
		$trg_level = $this->clean($_REQUEST["trg_level"]);
		$trg_hour = $this->clean($_REQUEST["trg_hour"]);
		$trg_type = $this->clean($_REQUEST["trg_type"]);
		
		$query = "insert into members(username,user_role,user_status)
				values('".$mobile."','600','Inactive')";
		$mysqli->query($query);
		$uid = $mysqli->insert_id;
		$query = "insert into member_details
		(
				uid,
				center_name,
				tc_regd_id,
				skill_sector,
				mobile,
				landline,
				email,
				address,
				state,
				city,
				pincode,
				facebook,
				twitter,
				linkedin,
				instagram,
				trg_level,
				trg_hour,
				trg_type,
				regd_date)
				values(
				'".$uid."',
				'".$center_name."',
				'".$tc_regd_id."',
				'".$skill_sector."',
				'".$mobile."',
				'".$landline."',
				'".$email."',
				'".$address."',
				'".$state."',
				'".$city."',
				'".$pincode."',
				'".$facebook."',
				'".$twitter."',
				'".$linkedin."',
				'".$instagram."',
				'".$trg_level."',
				'".$trg_hour."',
				'".$trg_type."',
				'".date('Y-m-d')."')";
		$mysqli->query($query);
		$subject = "Skill Champs-New Training Center Registered: ".$name;
		$message ="New Training Center registered on Skill Champs
				<br>Name:".$name."
				<br>Mobile:".$mobile."
				<br>Email:".$email;
				$emailfrom="admin@skillchamps.in";
				$fromname = "Skill Champs";
				$to = "cwarajivpandey@gmail.com,admin@skillchamps.in";
		$mailer = new Mailer;
		$mailer->sendMail($to,$emailfrom,$subject,$message,"","");
		
		$subject11 = "Skill Champs- You have successfully Registered";
		$message ="Thank you for registering with us. We will contact you soon.<br><br>
		Team<br>Skill Champs";
		$mailer->sendMail($email,$emailfrom,$subject1,$message1,"","");
		
		
		header('Location: ?action=training-partner');
	}
	
	function admin_save_tp_profile($mysqli)
	{
		$center_name = $this->clean($_REQUEST["center_name"]);
		$tc_regd_id = $this->clean($_REQUEST["tc_regd_id"]);
		$skill_sector = $this->clean($_REQUEST["jobcategory"]);
		$mobile = $this->clean($_REQUEST["mobile"]);
		$landline = $this->clean($_REQUEST["landline"]);
		$email = $this->clean($_REQUEST["email"]);
		$address = $this->clean($_REQUEST["address"]);
		$state = $this->clean($_REQUEST["state"]);
		$city = $this->clean($_REQUEST["city"]);
		$pincode = $this->clean($_REQUEST["pincode"]);
		$facebook = $this->clean($_REQUEST["facebook"]);
		$twitter = $this->clean($_REQUEST["twitter"]);
		$linkedin = $this->clean($_REQUEST["linkedin"]);
		$instagram = $this->clean($_REQUEST["instagram"]);
		$trg_level = $this->clean($_REQUEST["trg_level"]);
		$trg_hour = $this->clean($_REQUEST["trg_hour"]);
		$trg_type = $this->clean($_REQUEST["trg_type"]);
		
		$query = "insert into members(username,user_role,user_status)
				values('".$mobile."','600','Inactive')";
		$mysqli->query($query);
		$uid = $mysqli->insert_id;
		
		$query1 = "insert into member_details(regd_by,regd_date,uid,center_name,mobile,pincode)
				values('".$_SESSION["ps4a_admin_user_id"]."','".date('Y-m-d')."','".$uid."','".$center_name."','".$mobile."','".$pincode."')";
		$mysqli->query($query1);
		
		$q = "update member_details set
					mobile='".$mobile."',
					email='".$email."',
					address='".$address."',
					state='".$state."',
					city='".$city."',
					pincode='".$pincode."',
					facebook='".$facebook."',
					linkedin='".$linkedin."',
					center_name='".$center_name."',
					tc_regd_id='".$tc_regd_id."',
					jobcategory='".$skill_sector."',
					landline='".$landline."',
					trg_level='".$trg_level."',
					trg_hour='".$trg_hour."',
					trg_type='".$trg_type."'
					where uid='".$uid."'
					
					";
		$mysqli->query($q);
		header('Location: ?action=training-partner');
	}
	
	function save_tp_infra_comp($mysqli,$uid){
		$code=$this->clean($_REQUEST["code"]);
		if($code!=''){
			$query = "insert into tp_computer(uid,code)
					values('".$uid."','".$code."')";
			$mysqli->query($query);
		}
		header('Location: training-center.php?action=tp_infra_comp');
	}
	
	function delete_tp_infra_comp($mysqli,$id){
		if($id!=''){
			$query = "delete from tp_computer where id='".$id."'";
			$mysqli->query($query);
		}
		header('Location: training-center.php?action=tp_infra_comp');
	}
	
	function save_tp_infra_trainer($mysqli,$uid){
		$name=$this->clean($_REQUEST["name"]);
		if($name!=''){
			$query = "insert into tp_trainer(uid,trainer_name)
					values('".$uid."','".$name."')";
			$mysqli->query($query);
		}
		header('Location: training-center.php?action=tp_infra_trainer');
	}
	
	function delete_tp_infra_trainer($mysqli,$id){
		if($id!=''){
			$query = "delete from tp_trainer where id='".$id."'";
			$mysqli->query($query);
		}
		header('Location: training-center.php?action=tp_infra_trainer');
	}
	
	function save_tp_infra_course($mysqli,$uid){
		$jobcategory=$this->clean($_REQUEST["jobcategory"]);
		if($jobcategory!=''){
			$query = "insert into tp_courses(uid,jobcategory)
					values('".$uid."','".$jobcategory."')";
			$mysqli->query($query);
		}
		header('Location: training-center.php?action=tp_infra_course');
	}
	
	function delete_tp_infra_course($mysqli,$id){
		if($id!=''){
			$query = "delete from tp_courses where id='".$id."'";
			$mysqli->query($query);
		}
		header('Location: training-center.php?action=tp_infra_course');
	}
	
	function save_tp_infra_batch($mysqli){
	    $uid=$_SESSION["skill_champs_user_id"];
		$jobcategory=$this->clean($_REQUEST["jobcategory"]);
		$batch_no=$this->clean($_REQUEST["batch_no"]);
		$timing=$this->clean($_REQUEST["timing"]);
		$seats=$this->clean($_REQUEST["seats"]);
		$male_seats=$this->clean($_REQUEST["male_seats"]);
		$female_seats=$this->clean($_REQUEST["female_seats"]);
		if($jobcategory!=''){
			$query = "insert into tp_batch(  tp_course_id,batch_no,timing,seats,
            male_seats,female_seats,tp_id)values('".$jobcategory."','".$batch_no."','".
                $timing."','".$seats."','".$male_seats."','".
                $female_seats."','".$uid."')";
			$mysqli->query($query);
		}
		header('Location: training-center.php?action=tp_infra_batch');
	}
	
	function delete_tp_infra_batch($mysqli,$id){
		if($id!=''){
			$query = "delete from tp_batch where id='".$id."'";
			$mysqli->query($query);
		}
		header('Location: training-center.php?action=tp_infra_batch');
	}
	
	function save_tp_infra_ac($mysqli,$uid){
		$code=$this->clean($_REQUEST["code"]);
		if($code!=''){
			$query = "insert into tp_ac(uid,code)
					values('".$uid."','".$code."')";
			$mysqli->query($query);
		}
		header('Location: training-center.php?action=tp_infra_ac');
	}
	
	function delete_tp_infra_ac($mysqli,$id){
		if($id!=''){
			$query = "delete from tp_ac where id='".$id."'";
			$mysqli->query($query);
		}
		header('Location: training-center.php?action=tp_infra_ac');
	}
	
	function save_tp_infra_video($mysqli)
	{
		$id = $_SESSION["skill_champs_user_id"];
		
		
		if($_POST["youtube"]!="")
		{
			$youtube = $this->clean($_POST["youtube"]);
			$youtube1 = explode("?",$youtube);
			$video = substr($youtube1[1],2);
			$posted_on = date('Y-m-d H:i:s');
			$query = "insert into videos(uid,youtube,video,posted_by,posted_on)
						values('".$id."','".$youtube."','".$video."','".$uid."','".$posted_on."')";
			mysqli_query($mysqli,$query);
			$vid=mysqli_insert_id($mysqli);
		}
		else
		{
			$filename = time().".mp4";
			if(!is_dir("videos/".$id))
			{
				mkdir("videos/".$id, 0777);
			}
			$q1 = "insert into videos(tag,video,vtype,uid,posted_on)
					values('".$tag."','".$filename."','mp4','".$id."','".date('Y-m-d H:i:s')."')";
			mysqli_query($mysqli,$q1);
			$vid=mysqli_insert_id($mysqli);
			
			$target_path = "videos/".$id."/";
			$target_path = $target_path . $filename;
			
			if (!move_uploaded_file($_FILES['filename']['tmp_name'], $target_path)) {
			
			}
		}
		 
		header('Location: training-center.php?action=tp_infra_video'); 
	}
	
	function delete_tp_infra_video($mysqli,$id){
		if($id!=''){
			$q = "select * from 
			videos 
			where vid='".$id."'";
			$r = mysqli_query($mysqli,$q);
			$v = mysqli_fetch_assoc($r);
			if($v["vtype"]=="mp4"){
				$filename=$v["video"];
				$cid=$v["uid"];
				$target_path = "videos/".$cid."/";
				$target_path = $target_path . $filename;
				unlink($target_path);
			} 
			$query = "delete from videos where vid='".$id."'";
			$mysqli->query($query);
		}
		header('Location: training-center.php?action=tp_infra_video');
	}
	
	function save_tp_infra_image($mysqli)
	{
		$id = $_SESSION["skill_champs_user_id"];
		$name = $_FILES['filename']['name'];
		$ext = end((explode(".", $name))); # extra () to prevent notice

		$filename = time().'.'.$ext;
		if(!is_dir("admin/images/tp/".$id))
		{
			mkdir("admin/images/tp/".$id, 0777);
		}
		$q1 = "insert into tp_image(uid,image,upload_date)
				values('".$id."','".$filename."','".date('Y-m-d H:i:s')."')";
		mysqli_query($mysqli,$q1);
		$vid=mysqli_insert_id($mysqli);

		$target_path = "admin/images/tp/".$id."/";
		$target_path = $target_path . $filename;
		
		

		if (!move_uploaded_file($_FILES['filename']['tmp_name'], $target_path)) {

		}
		 
		header('Location: training-center.php?action=tp_infra_image'); 
	}
	
	function delete_tp_infra_image($mysqli,$id){
		if($id!=''){
			$q = "select * from 
			tp_image 
			where id='".$id."'";
			$r = mysqli_query($mysqli,$q);
			$v = mysqli_fetch_assoc($r);
			
			$filename=$v["image"];
			$cid=$v["uid"];
			$target_path = "admin/images/tp/".$cid."/";
			$target_path = $target_path . $filename;
			unlink($target_path);
			
			$query = "delete from tp_image where id='".$id."'";
			$mysqli->query($query);
		}
		header('Location: training-center.php?action=tp_infra_image');
	}
	
    function getConnectedCandidateTp($dbHelper,$mysqli,$id){
        $data=array();
        $data=$dbHelper->getData($mysqli, 'sp_getConnectedCandidateTp', array($id));
        return $data;
    }
	
    function upload_candidate_profile($dbHelper,$mysqli) {
        $batch=$_REQUEST["batch"];
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
                $city = $line[10];
                $pincode = $line[11];
                $address = $line[12];
                $linkedin = $line[13];
                $facebook = $line[14];

                $sql = "SELECT * FROM members where username='" . $mobile . "'";

                if ($result = mysqli_query($mysqli, $sql)) {
                    $rowcount = mysqli_num_rows($result);
                    if ($rowcount > 0) {
                        echo $mobile . " already exist.";
                    } else {
                        echo $dbHelper->performOperation($mysqli, 'sp_uploadBatchTp', array($batch,$mobile,$name,$father_name,$dob,$gender,$marital_status,$email,$aadhaar,$alternate_id,$alternate_id_no,$city,$pincode,$address,$linkedin,$facebook));
                        $count++;
                    }
                }

            }
            if ($count < 1) {
                echo "No Candidate uploaded.";
            } else if ($count == 1) {
                echo $count . " Candidate uploaded successfully.";
            } else {
                echo $count . " Candidates uploaded successfully.";
            }
        } else
            echo "Please upload csv file.";

    }
	
	function postdata($msisdn,$message){
		$varUserName="t1cybssapi";
		$varPWD="55200745";
		$varSenderID="CHAMPS";
		$varPhNo=$msisdn;
		$varMSG=$message;
		$url="http://nimbusit.co.in/api/swsendSingle.asp";
		$data="username=".$varUserName."&password=".$varPWD."&sender=".$varSenderID."&sendto=".
		$varPhNo."&message=".$varMSG;
		
		//The function uses CURL for posting data to
		 $objURL = curl_init($url);
		curl_setopt($objURL, CURLOPT_RETURNTRANSFER,
		1); curl_setopt($objURL,CURLOPT_POST,1);
		curl_setopt($objURL, CURLOPT_POSTFIELDS,$data);
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