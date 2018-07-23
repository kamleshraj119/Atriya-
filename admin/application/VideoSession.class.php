<?php
class VideoSession {
	    
	function VideoSession() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}

	function getSheduledVideoSessionForToday($dbHelper, $mysqli) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getSheduledVideoSessionForToday', array());
		return $data;
	}
    
    function getVideoSessionByReviewee($dbHelper, $mysqli,$revieweeId) {
        $data = array();
        $data = $dbHelper -> getData($mysqli, 'sp_getVideoSessionByReviewee', array($revieweeId));
        return $data;
    }
    
    function getAllApprovedVideoSessionCandidate($dbHelper, $mysqli,$uid) {
        $data = array();
        $data = $dbHelper -> getData($mysqli, 'sp_getAllApprovedVideoSessionCandidate', array($uid));
        return $data;
    }
    
    function getVideoSessionReviewParam($dbHelper, $mysqli,$sessionId,$guestId) {
        $data = array();
        $data = $dbHelper -> getData($mysqli, 'sp_getVideoSessionReviewParam', array($sessionId,$guestId));
        return $data;
    }
    
    function getVideoSessionByReviewer($dbHelper, $mysqli,$reviewerId) {
        $data = array();
        $data = $dbHelper -> getData($mysqli, 'sp_getVideoSessionByReviewer', array($reviewerId));
        return $data;
    }
    
    function getVideoSessionByStatus($dbHelper, $mysqli,$status) {
        $data = array();
        $data = $dbHelper -> getData($mysqli, 'sp_getVideoSessionByStatus', array($status));
        return $data;
    }

    function getVideoSessionById($dbHelper, $mysqli,$id) {
        $data = array();
        $data = $dbHelper -> getData($mysqli, 'sp_getVideoSessionById', array($id));
        return $data;
    }

	function addVideoSessionGuest($dbHelper, $mysqli,$sessionId,$guestUserId,$guestUserRole,$gmailId,$revieweId,$interviewer) {
		return $dbHelper -> multiquery($mysqli, 'sp_addVideoSessionGuest', array($sessionId,$guestUserId,$guestUserRole,$gmailId,$revieweId,$interviewer), "select @outGuest;", array("@outGuest"));
	}

    function updateVideoSessionGuest($dbHelper, $mysqli,$gusetId,$gmail) {
        return $dbHelper -> performOperation($mysqli, 'sp_updateVideoSessionGuest', array($gusetId,$gmail));
    }
    
    function updateVideoReviewParamValue($dbHelper, $mysqli,$paramId,$value) {
        return $dbHelper -> performOperation($mysqli, 'sp_updateVideoReviewParamValue', array($paramId,$value));
    }
    
     function updateVideoSessionGuestEmail($dbHelper, $mysqli) {
         $guestId=$_REQUEST["guest_id"];
         $email=$this->clean($_REQUEST["gmail"]);
         $this->updateVideoSessionGuest($dbHelper, $mysqli, $guestId, $email);
         header('Location: skill-mitra.php?action=video_meeting');      
    }
    
    function insertVideoSessionReq($dbHelper, $mysqli,$from,$to,$location,$description,$postedBy,$title) {
        return $dbHelper -> multiquery($mysqli, 'sp_insertVideoSessionReq', array($from,$to,$location,$description,$postedBy,$title), "select @outSession;", array("@outSession"));
    }

    function resheduleVideoSessionReq($dbHelper, $mysqli,$sessionId,$from,$to,$location,$description,$title) {
        return $dbHelper -> performOperation($mysqli, 'sp_resheduleVideoSessionReq', array($sessionId,$from,$to,$location,$description,$title));
    }

    function sheduleVideoSession($dbHelper, $mysqli,$sessionId,$eventId) {
        return $dbHelper -> performOperation($mysqli, 'sp_sheduleVideoSession', array($sessionId,$eventId));
    }

    function deleteVideoSessionGuest($dbHelper, $mysqli,$guestId) {
        return $dbHelper -> performOperation($mysqli, 'sp_deleteVideoSessionGuest', array($guestId));
    }
    
    function addVideoReviewParam($dbHelper, $mysqli,$guestId,$param) {
        return $dbHelper -> performOperation($mysqli, 'sp_addVideoReviewParam', array($guestId,$param));
    }
    
    function updateVideoSessionReqStatus($dbHelper, $mysqli,$sessionId,$videoUrl,$status) {
        return $dbHelper -> performOperation($mysqli, 'sp_updateVideoSessionReqStatus', array($sessionId,$videoUrl,$status));
    }
    
    function requestVideoSession($dbHelper,$mysqli){
        $uid=$_REQUEST["uid"];
        $title=$this->clean($_REQUEST["title"]);
        $email=$this->clean($_REQUEST["gmail"]);
        $from=$this->clean($_REQUEST["from"]);
        $to=$this->clean($_REQUEST["to"]);
        $skill=explode(",", $_REQUEST["skill_name"]);
        $result=$this->insertVideoSessionReq($dbHelper, $mysqli, $from, $to, $location, $description, $uid, $title);
           if($result[0]=="Success"){
            $sessionId=$result[1];
            $interviewer="NO";   
            $this->addVideoSessionGuest($dbHelper, $mysqli, $sessionId, $uid, "200", $email, "0",$interviewer);
            $skmResult=$dbHelper->getDataFromQuery($mysqli, "Select sector.name,member_details.skc,skm_member_dertails.email from member_details left outer join member_details skm_member_dertails on member_details.skc=skm_member_dertails.uid LEFT OUTER JOIN courses ON member_details.jobcategory=courses.course_id 
                        LEFT OUTER JOIN sector ON courses.sector_id=sector.id where member_details.uid='".$uid."'");
            $this->addVideoSessionGuest($dbHelper, $mysqli, $sessionId, $skmResult[0]["skc"], "700", $skmResult[0]["email"], $uid,$interviewer);
            $q1="SELECT guru_jobs_cat.guru,member_details.email from guru_jobs_cat left outer join member_details on guru_jobs_cat.guru=member_details.uid where jobs = '".$skmResult[0]["name"]."' order by rand() limit 0,3;";
            $dataGuru=$dbHelper->getDataFromQuery($mysqli, $q1);
            for($j=0;$j<count($dataGuru);$j++){
                if($j==0)
                    $interviewer="YES";
                else $interviewer="NO";      
                $resultGuest=$this->addVideoSessionGuest($dbHelper, $mysqli, $sessionId, $dataGuru[$j]["guru"], "500", $dataGuru[$j]["email"], $uid,$interviewer);
                for($i=0;$i<count($skill);$i++){
                     $this->addVideoReviewParam($dbHelper, $mysqli, $resultGuest[1], $skill[$i]);
                }
            }           
        }       
        header('Location: candidate.php?action=video_meeting');      
    }
    
     function updateVideoSessionReview($dbHelper, $mysqli) {
         $sessionId=$_REQUEST["sid"];
         $guestId=$this->clean($_REQUEST["gid"]);
         $data=$this->getVideoSessionReviewParam($dbHelper, $mysqli, $sessionId, $guestId);
         if(count($data)>0){
             for($i=0;$i<count($data);$i++){
                 $selId="sl".$data[$i]["param_id"];
                 $pval=$_REQUEST[$selId];
                 $this->updateVideoReviewParamValue($dbHelper, $mysqli, $data[$i]["param_id"], $pval);
             }
         }
         header('Location: guru.php?action=video_meeting');      
     }
     
     function updateVideoSessionStatusAdmin($dbHelper, $mysqli){
         $ssid=$_REQUEST["ssid"];
         $status=$this->clean($_REQUEST["videoMeetStatus"]);
         $vidurl=$this->clean($_REQUEST["videoUrl"]);
         $this->updateVideoSessionReqStatus($dbHelper, $mysqli, $ssid, $vidurl, $status);
          header('Location: admin.php?action=video_meeting&status='.$status);     
     }
	function clean($data) {
		$data = stripslashes($data);
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}
}
?>