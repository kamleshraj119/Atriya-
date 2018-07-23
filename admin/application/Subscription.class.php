<?php
class Subscription {

	function Subscription() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}
    
    
    function getSubscriptionType($dbHelper, $mysqli,$id) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getSubscriptionType', array($id));
		return $data;
	}
    
    function insertSubscriptionType($dbHelper, $mysqli, $name, $period,$unit) {
        return $dbHelper -> performOperation($mysqli, 'sp_insertSubscriptionType', array( $name, $period,$unit));
    }
    
    function updateSubscriptionType($dbHelper, $mysqli, $name, $period,$unit, $id) {
        return $dbHelper -> performOperation($mysqli, 'sp_updateSubscriptionType', array( $name, $period,$unit,$id));
    }
    
    function deleteSubscriptionType($dbHelper, $mysqli, $id) {
        return $dbHelper -> performOperation($mysqli, 'sp_deleteSubscriptionType', array($id));
    }
    
    
    function insertSubscriptionTypeAdmin($dbHelper, $mysqli) {
        $name = $this->clean($_REQUEST["name"]);
        $period= $this->clean($_REQUEST["period"]);
        $unit = $this->clean($_REQUEST["unit"]);
        $this->insertSubscriptionType($dbHelper, $mysqli, $name, $period, $unit);
        header('Location: admin.php?action=subscription_type');
    }
  
	
	function updateSubscriptionTypeAdmin($dbHelper, $mysqli) {
	    $id = $_REQUEST["id"];
	    $name = $this->clean($_REQUEST["name"]);
        $period= $this->clean($_REQUEST["period"]);
        $unit = $this->clean($_REQUEST["unit"]);
        $this->updateSubscriptionType($dbHelper, $mysqli, $name, $period, $unit, $id);
        header('Location: admin.php?action=subscription_type');
	}
    
    function deleteSubscriptionTypeAdmin($dbHelper, $mysqli, $id) {
        $this->deleteSubscriptionType($dbHelper, $mysqli, $id);
        header('Location: admin.php?action=subscription_type');
    }

    function getSubscriptionDef($dbHelper, $mysqli, $id) {
        $data = array();
        $data = $dbHelper -> getData($mysqli, 'sp_getSubscriptionDef', array($id));
        return $data;
    }
    
    function insertSubscriptionDef($dbHelper, $mysqli, $name, $des,$role,$status) {
        return $dbHelper -> performOperation($mysqli, 'sp_insertSubscriptionDef', array($name, $des,$role,$status));
    }
    
    function updateSubscriptionDef($dbHelper, $mysqli,$id, $name, $des,$role,$status) {
        return $dbHelper -> performOperation($mysqli, 'sp_updateSubscriptionDef', array( $id, $name, $des,$role,$status));
    }
    
    function updateSubscriptionDefStatus($dbHelper, $mysqli, $id, $status) {
        return $dbHelper -> performOperation($mysqli, 'sp_updateSubscriptionDefStatus', array($id, $status));
    }
    
    function deleteSubscriptionDef($dbHelper, $mysqli, $id) {
        return $dbHelper -> performOperation($mysqli, 'sp_deleteSubscriptionDef', array($id));
    }
    
    function insertSubscriptionDefAdmin($dbHelper, $mysqli) {
        $name = $this->clean($_REQUEST["name"]);
        $des= $this->clean($_REQUEST["des"]);
        $role = $this->clean($_REQUEST["user_role"]);
        $status = $this->clean($_REQUEST["status"]);
        $this->insertSubscriptionDef($dbHelper, $mysqli, $name, $des, $role, $status);
        header('Location: admin.php?action=subscription_def');
    }
  
    
    function updateSubscriptionDefAdmin($dbHelper, $mysqli) {
        $id = $_REQUEST["id"];
        $name = $this->clean($_REQUEST["name"]);
        $des= $this->clean($_REQUEST["des"]);
        $role = $this->clean($_REQUEST["user_role"]);
        $status = $this->clean($_REQUEST["status"]);
        $this->updateSubscriptionDef($dbHelper, $mysqli, $id, $name, $des, $role, $status);
        header('Location: admin.php?action=subscription_def');
    }
    
    function deleteSubscriptionDefAdmin($dbHelper, $mysqli, $id) {
        $this->deleteSubscriptionDef($dbHelper, $mysqli, $id);
        header('Location: admin.php?action=subscription_def');
    }
        
          
    function getSubscriptionRate($dbHelper, $mysqli, $id) {
        $data = $dbHelper -> getData($mysqli, 'sp_getSubscriptionRate', array($id));
        return $data;
    }
	
	function getSubscriptionRateByUserRole($dbHelper, $mysqli, $userRole){
		 $data = $dbHelper -> getData($mysqli, 'sp_getSubscriptionRateByUserRole', array($userRole));
        return $data;
	}
	
	function getSubscriptionRateFront($dbHelper, $mysqli, $userRole,$cid){
		$dataS=$this->getSubscriptionRateByUserRole($dbHelper, $mysqli, $userRole);
		$dataAs=$dbHelper->getData($mysqli, "sp_getActiveSubscriptionUser", array($cid));
		$activeSdId=$dataAs[0]["sd_id"];
		$data=array();
		if (count($dataS) > 0) {
            $prv="";
            $cur="";
            for($i=0;$i<count($dataS);$i++){
                $cur=$dataS[$i]["sd_id"];
                $rate=$dataS[$i]["rate"];
                $gst=($rate*18)/100;
                $total=$rate+$gst;
                if($cur!=$prv){
                    $tempR=array('sr_id'=>$dataS[$i]["sr_id"],'st_id'=>$dataS[$i]["st_id"],
                    'rate'=>$rate,'gst'=>$gst,'total'=>$total,'st_name'=>$dataS[$i]["st_name"],'period'=>$dataS[$i]["period"],'unit'=>$dataS[$i]["unit"]);  
                     if($activeSdId==$dataS[$i]["sd_id"])
                        $tempS=array('sd_id'=>$dataS[$i]["sd_id"],'name'=>$dataS[$i]["name"],'des'=>$dataS[$i]["des"],'rates'=>array(),'active'=>'YES','start_date'=>$dataAs[0]["start_date"],'end_date'=>$dataAs[0]["end_date"]);
                    else
                        $tempS=array('sd_id'=>$dataS[$i]["sd_id"],'name'=>$dataS[$i]["name"],'des'=>$dataS[$i]["des"],'rates'=>array(),'active'=>'NO','start_date'=>'','end_date'=>'');
                    array_push($data,$tempS);
                    $c=count($data);
                    $c=$c-1;
                    array_push($data[$c]["rates"],$tempR);
                }else{
                   $tempR=array('sr_id'=>$dataS[$i]["sr_id"],'st_id'=>$dataS[$i]["st_id"],
                   'rate'=>$rate,'gst'=>$gst,'total'=>$total,'st_name'=>$dataS[$i]["st_name"],'period'=>$dataS[$i]["period"],'unit'=>$dataS[$i]["unit"]);  
                   $c=count($data);
                   $c=$c-1;
                   array_push($data[$c]["rates"],$tempR);
                }
                $prv=$cur;
            }    
            
        }
		//echo "<pre>";print_r($data);exit;
		return $data;
	}
    
	function insertUserSubscription($dbHelper, $mysqli,$srId,$cid,$redirectPage){
		$dataSubscriptionRate=$dbHelper->getData($mysqli, 'sp_getSubscriptionRate', array($srId));
        $sdId=$dataSubscriptionRate[0]['sd_id']; 
        $value=ceil($dataSubscriptionRate[0]['rate']); 
        $period=$dataSubscriptionRate[0]['period'];
        $unit=$dataSubscriptionRate[0]['unit'];
        $q="select member_details.uid,member_details.mobile,member_details.name,member_details.company_name,member_details.address,member_details.gstin,states.state_name,states.code,members.user_role from member_details Left outer join members on member_details.uid=members.id LEFT outer join states on member_details.uid=states.id where member_details.uid='".$cid."'";
        $memberDetails=$dbHelper->getDataFromQuery($mysqli, $q);               
        $mobile=$memberDetails[0]['mobile'];
        $mode="CREDIT";
        $startDate=date('Y-m-d');
        $result=$dbHelper->performOperation($mysqli, "sp_insertUserSubscription", array($sdId,$cid,$value,$period,$unit,$mode));
		
		header("location:$redirectPage?action=home&msg=".urlencode("you have subscribed successfully for plan."));
	}
	
    function insertSubscriptionRate($dbHelper, $mysqli, $stId, $sdId,$rate) {
        return $dbHelper -> performOperation($mysqli, 'sp_insertSubscriptionRate', array($stId, $sdId,$rate));
    }
    
    function updateSubscriptionRate($dbHelper, $mysqli,$id, $stId, $sdId,$rate) {
        return $dbHelper -> performOperation($mysqli, 'sp_updateSubscriptionRate', array( $id, $stId, $sdId,$rate));
    }
    
    function deleteSubscriptionRate($dbHelper, $mysqli, $id) {
        return $dbHelper -> performOperation($mysqli, 'sp_deleteSubscriptionRate', array($id));
    }
    
    function insertSubscriptionRateAdmin($dbHelper, $mysqli) {
        $stId = $_REQUEST["st_id"];
        $sdId= $_REQUEST["sd_id"];
        $rate = $this->clean($_REQUEST["rate"]);
        $this->insertSubscriptionRate($dbHelper, $mysqli, $stId, $sdId, $rate);
        header('Location: admin.php?action=subscription_rate');
    }
  
    
    function updateSubscriptionRateAdmin($dbHelper, $mysqli) {
        $id = $_REQUEST["id"];
        $stId = $_REQUEST["st_id"];
        $sdId= $_REQUEST["sd_id"];
        $rate = $this->clean($_REQUEST["rate"]);
        $this->updateSubscriptionRate($dbHelper, $mysqli, $id, $stId, $sdId, $rate);
        header('Location: admin.php?action=subscription_rate');
    }
    
    function deleteSubscriptionRateAdmin($dbHelper, $mysqli, $id) {
        $this->deleteSubscriptionRate($dbHelper, $mysqli, $id);
        header('Location: admin.php?action=subscription_rate');
    }    
	
   
	function clean($data) {
		$data = stripslashes($data);
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}
    /*  Added By Kamlesh 2018-05-17 */ 
   	 function updateSubscriptionDefStatusAdmin($dbHelper, $mysqli){
   	 	$status='';	
   	 	$id = $_REQUEST['id'];
		$status = $this->clean($_REQUEST['status']);
		if($status == "ACTIVE"){
			$status="INACTIVE";
		}else if($status == "INACTIVE"){
			$status="ACTIVE";
		}
		$result = $this->updateSubscriptionDefStatus($dbHelper, $mysqli, $id, $status);
		 if($result == "Success");
		header('Location: admin.php?action=subscription_def');
   	 }
    /*  End Added  */
}
?>