<?php

class Candidate {

    function Candidate() {
        set_time_limit(0);
        ini_set('memory_limit', '256M');
        ini_set('upload_max_filesize', '256M');
        ini_set('post_max_size', '256M');
        ini_set('max_input_time', 600);
        ini_set('display_errors', 'on');
        error_reporting(E_ALL ^ E_NOTICE);
        error_reporting(E_ALL ^ E_NOTICE);
    }
    
    
    function checkSubscription($dbHelper,$mysqli,$uid,$request,$tableName,$fieldName){
        if($uid==""||$request==""||$tableName==""||$fieldName=="")
        return false;
        else{
            $data=$dbHelper->getData($mysqli, 'sp_getSubscriptionFeatureByAction', array($uid,$request));
            if(count($data)>0){
               $status=$data[0]["sf_status"];
               $numRecordStatus=$data[0]["num_record_status"];
               $numRecord=$data[0]["num_record"];
               $subUnit=$data[0]["sub_unit"];
               if($status=="DISABLE")
                return false;
               elseif($status=='ENABLE' && ($numRecordStatus=='NA' || $numRecordStatus=='UNLIMITED')) 
                return true;
               else{
                   $dc=$dbHelper->getData($mysqli, "sp_getNumRecordBySubscription", array($uid,$tableName,$fieldName,$subUnit));
                   $count=$dc[0]["num"];
                   if($count<$numRecord)
                    return true;
                   else return true;
               }
            }else{
                return true;
            }
        }
    }
    

    function clean($data) {
        $data = stripslashes($data);
        $data = htmlentities($data, ENT_QUOTES);
        return $data;
    }

    function update_candidate_review($dbHelper,$mysqli) {
        $guru = $_SESSION["flexihire_user_id"];
        $vid = $_REQUEST["vid"];
        $personality = $this -> clean($_REQUEST["personality"]);
        $skills = $this -> clean($_REQUEST["skills"]);
        $qualifications = $this -> clean($_REQUEST["qualifications"]);
        $experience = $this -> clean($_REQUEST["experience"]);
        $type = $this -> clean($_REQUEST["type"]);
        $comment = $this->clean($_REQUEST["comment"]);
        $dbHelper->performOperation($mysqli, 'sp_guruVideoReview', array($guru,$vid,$personality,$skills,$qualifications,$experience,$type,$comment));
        header("Location: guru.php?action=review_candidate_videos&vid=" . $vid);
    }
    
    function getCandidateProfile($dbHelper,$mysqli,$id){
        $data=array();    
        $data=$dbHelper->getData($mysqli, 'sp_getCandidateProfile', array($id));
        for($i=0;$i<count($data);$i++){
            $count=0;
            $docCount=0;
            $profilePer=0;
            $overallPer=0;
            $docPer=0;  
            $remainPer=0;  
            if($data[$i]["name"]!='')
                $count++; 
            if($data[$i]["father_name"]!='')
                $count++;
            if($data[$i]["mobile"]!='')
                $count++;      
            if($data[$i]["email"]!='')
                $count++; 
            if($data[$i]["pincode"]!='')
                $count++;
            if($data[$i]["jobcategory"]>0)
                $count++; 
            if($data[$i]["dob"]!='')
                $count++; 
            if($data[$i]["gender"]!='')
                $count++;
            if($data[$i]["marital_status"]!='')
                $count++; 
            if($data[$i]["aadhaar"]!='')
                $count++; 
            if($data[$i]["address"]!='')
                $count++;
            if($data[$i]["state"]!='')
                $count++; 
            if($data[$i]["city"]!='')
                $count++; 
            if($data[$i]["facebook"]!='')
                $count++;
            if($data[$i]["linkedin"]!='')
                $count++;
            if($data[$i]["profile_pic"]!='')
                $remainPer++; 
            if($data[$i]["exp_count"]>0)
                $remainPer++;
            if($data[$i]["ac_count"]>0)
                $remainPer++;  
            if($data[$i]["vid_count"]>0)
                $remainPer++;
            if($data[$i]["edu_count"]>0)
                $remainPer++;  
            $remainPer=($remainPer*100)/5;
            $profilePer=($count*100)/15;
            $docPer=$data[$i]["doc_count"]+$data[$i]["cv_count"]+$data[$i]["cert_count"];
            if($docPer>3)
                $docPer=3;
            $docPer=($docPer*100)/3;  
            $overallPer=($profilePer+$docPer+$remainPer)/3;
            $data[$i]["profile_per"]=round($profilePer,0);
            $data[$i]["doc_per"]=round($docPer,0);
            $data[$i]["overall_per"]=round($overallPer,0);
            $dbHelper->performOperation($mysqli, 'sp_updateOverallPer', array($data[$i]["uid"],$data[$i]["overall_per"]));       
        }
        return $data;
    }

    function getCandidatesBySkillMitra($dbHelper,$mysqli, $id) {
        $data=array();    
        $data=$dbHelper->getData($mysqli, 'sp_getConnectedCandidateSkillMitra', array($id));
        for($i=0;$i<count($data);$i++){
            $count=0;
            $docCount=0;
            $profilePer=0;
            $overallPer=0;
            $docPer=0;  
            $remainPer=0;  
            if($data[$i]["name"]!='')
                $count++; 
            if($data[$i]["father_name"]!='')
                $count++;
            if($data[$i]["mobile"]!='')
                $count++;      
            if($data[$i]["email"]!='')
                $count++; 
            if($data[$i]["pincode"]!='')
                $count++;
            if($data[$i]["jobcategory"]>0)
                $count++; 
            if($data[$i]["dob"]!='')
                $count++; 
            if($data[$i]["gender"]!='')
                $count++;
            if($data[$i]["marital_status"]!='')
                $count++; 
            if($data[$i]["aadhaar"]!='')
                $count++; 
            if($data[$i]["address"]!='')
                $count++;
            if($data[$i]["state"]!='')
                $count++; 
            if($data[$i]["city"]!='')
                $count++; 
            if($data[$i]["facebook"]!='')
                $count++;
            if($data[$i]["linkedin"]!='')
                $count++;
            if($data[$i]["profile_pic"]!='')
                $remainPer++; 
            if($data[$i]["exp_count"]>0)
                $remainPer++;
            if($data[$i]["ac_count"]>0)
                $remainPer++;  
            if($data[$i]["vid_count"]>0)
                $remainPer++;
            if($data[$i]["edu_count"]>0)
                $remainPer++;  
            $remainPer=($remainPer*100)/5;
            $profilePer=($count*100)/15;
            $docPer=$data[$i]["doc_count"]+$data[$i]["cv_count"]+$data[$i]["cert_count"];
             if($docPer>3)
                $docPer=3;
            $docPer=($docPer*100)/3;  
            $overallPer=($profilePer+$docPer+$remainPer)/3;
            $data[$i]["profile_per"]=round($profilePer,0);
            $data[$i]["doc_per"]=round($docPer,0);
            $data[$i]["overall_per"]=round($overallPer,0);   
            $dbHelper->performOperation($mysqli, 'sp_updateOverallPer', array($data[$i]["uid"],$data[$i]["overall_per"]));        
        }
        return $data;
    }
    
     
    function getCandidatesBySkillMitraCount($dbHelper,$mysqli, $id) {
        $query = "SELECT count(*) as num
                        FROM member_details
                        inner join members
                        on member_details.uid = members.id
                        where members.user_role='200'
                        and skc='" . $id . "'";

        $data=array();
        $data=$dbHelper->getDataFromQuery($mysqli,$query);
        return $data[0]["num"];
    }
    function getCandidatesByTpCount($dbHelper,$mysqli, $id) {
        $query = "SELECT count(*) as num
                        FROM member_details
                        inner join members
                        on member_details.uid = members.id
                        left outer join tp_batch 
                        on member_details.tp_batch_id=tp_batch.id
                        where members.user_role='200'
                        and tp_batch.tp_id='" . $id . "'";

        $data=array();
        $data=$dbHelper->getDataFromQuery($mysqli,$query);
        return $data[0]["num"];
    }

    function getCandidatesVideos($mysqli, $uid, $vid = '') {
        $sql = "";
        $data = array();
        if ($vid != '') {
            $sql .= " and vid='" . $vid . "'";
        }

        $query = "SELECT *,videos.video as videoURL,videos.status as fstatus,videos.approved_on as approved_on,videos.posted_on as added_date
                        FROM videos
                        left outer join guru_video
                        on videos.vid = guru_video.video
                        where videos.uid ='" . $uid . "'
                        $sql
                        
                        
                          order by vid DESC
                        ";
        $result = $mysqli -> query($query);
        while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
            array_push($data, $row);
        }
        return $data;
    }
    
    function getCandidatesVideosCount($dbHelper,$mysqli, $uid) {
        $count=0;
        $data=array();    
        $query = "SELECT count(*) as vcount FROM videos  where videos.uid ='" . $uid . "'";
        $data= $dbHelper->getDataFromQuery($mysqli, $query);
        $count=(int)$data[0]["vcount"];
        $query="SELECT count(*) as vscount FROM video_session_request left outer join video_session_guests on video_session_request.session_id=video_session_guests.session_id  
        where video_session_guests.guest_user_id ='" . $uid . "' and video_session_guests.guest_user_role='200' and video_session_request.video_url!=''";
        $data= $dbHelper->getDataFromQuery($mysqli, $query);
        $count=$count+(int)$data[0]["vscount"];
        return $count;
    }

    function getCandidatesWithSkillMitra($mysqli, $urole, $id) {
        $data = array();
        $sql = "";
        if ($id != "") {
            $sql .= " and md.uid='" . $id . "'";
        }

        $query = "";
        if ($id != "") {
            $query = "SELECT md.uid,md.name,md.mobile,m.username,md.regd_date, m.user_status,skmd.name as 'skillmitra'
            FROM member_details as md inner join members as m on md.uid = m.id 
            left outer join members as skm on md.skc = skm.id 
            left outer join member_details as skmd on skm.id = skmd.uid where m.id!='' and m.user_role = '200' and md.skc!=''
                $sql
            ";
        } else {
            $query = "Select * from 
            ((SELECT md.uid,md.name,md.mobile,m.username,md.regd_date, m.user_status,skmd.name as 'skillmitra'
            FROM member_details as md inner join members as m on md.uid = m.id 
            left outer join members as skm on md.skc = skm.id 
            left outer join member_details as skmd on skm.id = skmd.uid where m.id!='' and m.user_role = '200' and md.skc!='' )
            Union 
            (SELECT md.uid,md.name,md.mobile,m.username,md.regd_date, m.user_status,'' as 'skillmitra' FROM member_details as md 
            inner join members as m on md.uid = m.id where m.id!='' and m.user_role = '200' and md.skc=0)) 
            s order by s.uid DESC";
        }
        $result = $mysqli -> query($query);
        while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
            array_push($data, $row);
        }
        return $data;
    }

    function upload_video($mysqli,$client,$youtube) {
        $htmlBody="";
        $id = $_SESSION["flexihire_user_id"];
        $q = "select id,jobcategory from 
            members 
            inner join member_details
            on members.id = member_details.uid
            where members.id='" . $id . "'";
        $r = mysqli_query($mysqli, $q);
        $v = mysqli_fetch_assoc($r);
        $posted_on = date('Y-m-d H:i:s');
        if ($_POST["youtube"] != "") {
            $youtube = $this -> clean($_POST["youtube"]);
            $youtube1=array();
            $video="";
            $query ="";
            
            if (strpos($youtube, 'youtube') !== false) {
                $youtube1 = explode("?", $youtube);
                $video = substr($youtube1[1], 2);
                $query = "insert into videos(uid,youtube,video,posted_by,posted_on)
                        values('" . $id . "','" . $youtube . "','" . $video . "','" . $id . "','" . $posted_on . "')";
            }elseif(strpos($youtube, 'drive.google') !== false){
                $youtube1 = explode("=", $youtube);
                $video = $youtube1[1];
                $query = "insert into videos(tag,drive,video,vtype,uid,posted_on)
                    values('" . $tag . "','" . $youtube . "','" . $video . "','drive','" . $id . "','" . $posted_on . "')";
            }
            if($query!=""){
                mysqli_query($mysqli, $query);
                $vid = mysqli_insert_id($mysqli);
            }                
        } else {
            $allowedTypeArr = array("video/mp4", "video/avi", "video/mpeg", "video/mpg", "video/mov", "video/wmv", "video/rm");
           if(!in_array($_FILES['filename']['type'], $allowedTypeArr)){
                 $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
                        "Can not upload file.Unsupported format.");
            }else{
                $ext = end(explode('.', $_FILES['filename']['name']));
                $filename = time() . ".".$ext;
                if (!is_dir("../videos/" . $id)) {
                    mkdir("../videos/" . $id, 0777);
                }
                /*$q1 = "insert into videos(tag,video,vtype,uid,posted_on)
                        values('" . $tag . "','" . $filename . "','mp4','" . $id . "','" . date('Y-m-d H:i:s') . "')";
                mysqli_query($mysqli, $q1);
                $vid = mysqli_insert_id($mysqli);*/
    
                $target_path = "../videos/" . $id . "/";
                $target_path = $target_path . $filename;
                
                if (!move_uploaded_file($_FILES['filename']['tmp_name'], $target_path)) {
                    $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
                        "Can not upload file.Please make sure file size is not greater than 32MB.Please try again.");
                }else{
                   try{
                    // REPLACE this value with the path to the file you are uploading.
                    $videoPath = $target_path;
                                   
                    // Create a snippet with title, description, tags and category ID
                    // Create an asset resource and set its snippet metadata and type.
                    // This example sets the video's title, description, keyword tags, and
                    // video category.
                    $snippet = new Google_Service_YouTube_VideoSnippet();
                    $snippet->setTitle("Flexihire Video");
                    $snippet->setDescription("video introducation for flexihire");
                    $snippet->setTags(explode(",","flexihire"));
                
                    // Numeric video category. See
                    // https://developers.google.com/youtube/v3/docs/videoCategories/list
                    $snippet->setCategoryId("22");
                
                    // Set the video's status to "public". Valid statuses are "public",
                    // "private" and "unlisted".
                    $status = new Google_Service_YouTube_VideoStatus();
                    $status->privacyStatus = "public";
                
                    // Associate the snippet and status objects with a new video resource.
                    $video = new Google_Service_YouTube_Video();
                    $video->setSnippet($snippet);
                    $video->setStatus($status);
                
                    // Specify the size of each chunk of data, in bytes. Set a higher value for
                    // reliable connection as fewer chunks lead to faster uploads. Set a lower
                    // value for better recovery on less reliable connections.
                    $chunkSizeBytes = 1 * 1024 * 1024;
                
                    // Setting the defer flag to true tells the client to return a request which can be called
                    // with ->execute(); instead of making the API call immediately.
                    $client->setDefer(true);
                
                    // Create a request for the API's videos.insert method to create and upload the video.
                    $insertRequest = $youtube->videos->insert("status,snippet", $video);
                
                    // Create a MediaFileUpload object for resumable uploads.
                    $media = new Google_Http_MediaFileUpload(
                        $client,
                        $insertRequest,
                        'video/*',
                        null,
                        true,
                        $chunkSizeBytes
                    );
                    $media->setFileSize(filesize($videoPath));
                
                
                    // Read the media file and upload it chunk by chunk.
                    $status = false;
                    $handle = fopen($videoPath, "rb");
                    while (!$status && !feof($handle)) {
                      $chunk = fread($handle, $chunkSizeBytes);
                      $status = $media->nextChunk($chunk);
                    }
                
                    fclose($handle);
                
                    // If you want to make other calls after the file upload, set setDefer back to false
                    $client->setDefer(false);
                                       
                    // delete video file from local server
                   
                    
                    // uploaded video data
                    $videoTitle = $status['snippet']['title'];
                    $videoDesc = $status['snippet']['description'];
                    $videoTags = implode(",",$status['snippet']['tags']);
                    $videoId = $status['id'];
                    $videoUrl="https://www.youtube.com/watch?v=".$videoId;
                    $query = "insert into videos(uid,youtube,video,posted_by,posted_on)
                            values('" . $id . "','" . $videoUrl . "','" . $videoId . "','" . $uid . "','" . $posted_on . "')";
                    mysqli_query($mysqli, $query);        
                    // uploaded video embed html
                   
                    
                  } catch (Google_Service_Exception $e) {
                    $htmlBody .= sprintf('<p>A service error occurred: <code>%s</code></p>',
                        htmlspecialchars($e->getMessage()));
                  } catch (Google_Exception $e) {
                      if($e->getMessage()=='Failed to start the resumable upload (HTTP 401: youtube.header, Unauthorized)'){
                          $htmlBody .= sprintf('<p>An client error occurred:In order to upload video.You must <a href="https://youtube.com/create_channel" target="_blank" >%s</a></p>',
                        htmlspecialchars(" create a channel"));
                      }else
                      $htmlBody .= sprintf('<p>An client error occurred: <code>%s</code></p>',
                        htmlspecialchars($e->getMessage()));
                  }
                  @unlink($videoPath);  
                  $_SESSION[$tokenSessionKey] = $client->getAccessToken(); 
                }
            }
            
               
        }
        /*$qq = "select sector.name from courses left outer join sector on sector.id=courses.sector_id where course_id='" . $v["jobcategory"] . "'";
        $rr = mysqli_query($mysqli, $qq);
        $vv = mysqli_fetch_assoc($rr);
        $sector = $vv["name"];

        $q3 = "select guru from guru_jobs_cat
                where jobs = '" . $sector . "' order by rand() limit 0,1";

        $r3 = mysqli_query($mysqli, $q3);
        if (mysqli_num_rows($r3) > 0) {
            $v3 = mysqli_fetch_assoc($r3);
            $guru = $v3["guru"];

            $q4 = "insert into guru_video(guru,video,gv_status,posted_on)
                values('" . $guru . "','" . $vid . "','Pending','" . date('Y-m-d H:i:s') . "')";

            mysqli_query($mysqli, $q4);
        }*/

        header('Location: candidate.php?action=videos&msg='.$htmlBody);
    }

    function delete_video($mysqli, $uid, $id) {
        $query = "delete from videos where video_id='" . $id . "' and candidate='" . $uid . "'";
        $mysqli -> query($query);
        header('Location: candidates.php?action=videos');
    }
    
    function getHiredCandidatesByEmployerCount($mysqli, $employer) {
        $data = array();

        $query = "SELECT count(*) as count
                        FROM member_details
                        inner join members
                        on member_details.uid = members.id
                        inner join hired_candidates
                        on hired_candidates.hcid = member_details.uid
                        where members.user_role='200'
                        and hired_candidates.heid='" . $employer . "'
                        
                        
                         $sql order by members.id DESC
                        ";

        $result = $mysqli -> query($query);
        while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
            array_push($data, $row);
        }

        return $data[0]["count"];
    }

    function getShortlistedCandidatesByEmployerCount($mysqli, $employer) {
        $data = array();

        $query = "SELECT count(*) as count
                        FROM shortlisted_candidates
                        where shortlisted_candidates.seid='" . $employer . "'
                        ";  
        $result = $mysqli -> query($query);
        while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
            array_push($data, $row);
        }

        return $data[0]["count"];
    }
    
    function getCartCandidatesByEmployerCount($mysqli, $employer) {
        $data = array();

        $query = "SELECT count(*) as count
                        FROM temp_cart
                        where temp_cart.cart_eid='" . $employer . "'
                        ";  
        $result = $mysqli -> query($query);
        while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
            array_push($data, $row);
        }

        return $data[0]["count"];
    }

    function getHiredCandidatesByEmployer($mysqli, $employer) {
        $data = array();

        $query = "SELECT *
                        FROM member_details
                        inner join members
                        on member_details.uid = members.id
                        inner join hired_candidates
                        on hired_candidates.hcid = member_details.uid
                        where members.user_role='200'
                        and hired_candidates.heid='" . $employer . "'
                        
                        
                         $sql order by members.id DESC
                        ";

        $result = $mysqli -> query($query);
        while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
            array_push($data, $row);
        }

        return $data;
    }

    function getShortlistedCandidatesByEmployer($mysqli, $employer) {
        $data = array();

        $query = "SELECT *
                        FROM member_details
                        inner join members
                        on member_details.uid = members.id
                        inner join shortlisted_candidates
                        on shortlisted_candidates.scid = member_details.uid
                        where members.user_role='200'
                        and shortlisted_candidates.seid='" . $employer . "'
                        
                        
                         $sql order by members.id DESC
                        ";

        $result = $mysqli -> query($query);
        while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
            array_push($data, $row);
        }

        return $data;
    }

    function searchCandidatesByEmployer($mysqli, $pincode, $category) {
        $data = array();
        $sql = "";
        if ($pincode != "") {
            $sql .= " and pincode='" . $pincode . "'";
        }
        if ($category != "") {
            $sql .= " and jobcategory = '" . $category . "'";
        }

        $query = "SELECT *
                        FROM member_details
                        inner join members
                        on member_details.uid = members.id
                        
                        where members.user_role='200'
                        
                        
                         $sql order by members.id DESC
                        ";

        $result = $mysqli -> query($query);
        while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
            array_push($data, $row);
        }

        return $data;
    }

    function getShortlistedCandidatedByGuru($mysqli, $gid) {
        $data = array();
        $query = "SELECT *
                        FROM shortlisted_candidates as sc
                        left outer join member_details as md
                        on sc.scid=md.uid
                        where sc.sgid='" . $gid . "'
                        order by md.uid DESC
                        ";

        $result = $mysqli -> query($query);
        while ($row = $result -> fetch_array(MYSQLI_ASSOC)) {
            array_push($data, $row);
        }
        return $data;
    }

    function approve_candidates_video($mysqli) {
        $reason = $this -> clean($_REQUEST["reason"]);
        $cid = $this -> clean($_REQUEST["cid"]);
        $vid = $this -> clean($_REQUEST["vid"]);
        $query = "update videos set 
                            status='Approved',
                            reason='" . $reason . "', 
                            approved_on='" . date('Y-m-d') . "' 
                            where vid ='" . $vid . "'
                ";
        $mysqli -> query($query);
        header('Location: admin.php?action=candidate_videos&uid=' . $cid);
    }

    function reject_candidates_video($mysqli) {
        $reason = $this -> clean($_REQUEST["reason"]);
        $cid = $this -> clean($_REQUEST["cid"]);
        $vid = $this -> clean($_REQUEST["vid"]);

        $query = "update videos set 
                            status='Rejected',
                            reason='" . $reason . "', 
                            approved_on='" . date('Y-m-d') . "' 
                            where vid ='" . $vid . "'
                ";
        $mysqli -> query($query);
        header('Location: admin.php?action=candidate_videos&uid=' . $cid);
    }

    function delete_candidates_video($mysqli, $cid, $vid) {
        $q = "select * from 
            videos 
            where vid='" . $vid . "'";
        $r = mysqli_query($mysqli, $q);
        $v = mysqli_fetch_assoc($r);
        if ($v["vtype"] == "mp4") {
            $filename = $v["video"];
            $target_path = "../videos/" . $cid . "/";
            $target_path = $target_path . $filename;
            unlink($target_path);
        }
        $query = "delete from guru_video where video='" . $vid . "'";
        $mysqli -> query($query);
        $query = "delete from videos where vid='" . $vid . "'";
        $mysqli -> query($query);

        header('Location: admin.php?action=candidate_videos&uid=' . $cid);
    }

    function delete_candidate($mysqli, $uid, $page) {
        $query = "delete from members where id='" . $uid . "'";
        $mysqli -> query($query);

        $query1 = "delete from member_details where uid='" . $uid . "'";
        $mysqli -> query($query1);

        $query2 = "delete from videos where uid='" . $uid . "'";
        $mysqli -> query($query2);
        header('Location: admin.php?action=' . $page);
    }

    function save_candidate_hired($mysqli, $cid) {
        $eid = $_SESSION["flexihire_user_id"];
        $q = "select * from hired_candidates 
            where hcid='" . $cid . "' and heid='" . $eid . "'";
        $r = $mysqli -> query($q);
        if ($r -> num_row > 0) {

        } else {
            $q = "insert into hired_candidates(hcid,heid,hired_posted_on)
                    values('" . $cid . "','" . $eid . "','" . date('Y-m-d') . "')";
            $mysqli -> query($q);
        }
        header('Location: employer.php?action=hired_candidates');
    }

    function admin_save_candidate_profile($mysqli) {
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
        $working_experience = $this -> clean($_REQUEST["working_experience"]);
        $jobcategory = $this -> clean($_REQUEST["jobcategory"]);
        $query = "insert into members(username,user_role,user_status)
                values('" . $mobile . "','200','Inactive')";
        $mysqli -> query($query);
        $uid = $mysqli -> insert_id;
        $query = "insert into member_details(regd_by,regd_date,uid,aadhaar,name,mobile,pincode,jobcategory)
                values('" . $_SESSION["ps4a_admin_user_id"] . "','" . date('Y-m-d') . "','" . $uid . "','" . $aadhaar . "','" . $name . "','" . $mobile . "','" . $pincode . "','" . $jobcategory . "')";
        $mysqli -> query($query);

        $q = "update member_details set
                    alternate_id_no='" . $alternate_id_no . "',
                    alternate_id='" . $alternate_id . "',
                    working_experience='" . $working_experience . "',
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
        header('Location: admin.php?action=candidates');
    }

    function save_candidate_shortlisted($mysqli, $cid) {
        $eid = $_SESSION["flexihire_user_id"];
        $q = "select * from shortlisted_candidates 
            where scid='" . $cid . "' and seid='" . $eid . "'";
        $r = $mysqli -> query($q);
        if ($r -> num_row > 0) {

        } else {
            $q = "insert into shortlisted_candidates(scid,seid,shortlisted_on)
                    values('" . $cid . "','" . $eid . "','" . date('Y-m-d') . "')";
            $mysqli -> query($q);
        }
        header('Location: employer.php?action=shortlisted_candidates');
    }

    function admin_upload_candidate_profile($mysqli) {

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
                $working_experience = $line[11];
                $city = $line[12];
                $pincode = $line[13];
                $address = $line[14];
                $linkedin = $line[15];
                $facebook = $line[16];

                $sql = "SELECT * FROM members where username='" . $mobile . "'";

                if ($result = mysqli_query($mysqli, $sql)) {
                    $rowcount = mysqli_num_rows($result);
                    if ($rowcount > 0) {
                        echo $mobile . " already exist.";
                    } else {
                        $query = "insert into members(username,user_role,user_status)
                        values('" . $mobile . "','200','Inactive')";
                        $mysqli -> query($query);
                        $uid = $mysqli -> insert_id;
                        $query = "insert into member_details(regd_by,regd_date,uid,aadhaar,name,mobile,pincode)
                                values('" . $_SESSION["ps4a_admin_user_id"] . "','" . date('Y-m-d') . "','" . $uid . "','" . $aadhaar . "','" . $name . "','" . $mobile . "','" . $pincode . "')";
                        $mysqli -> query($query);

                        $q = "update member_details set
                                    alternate_id_no='" . $alternate_id_no . "',
                                    alternate_id='" . $alternate_id . "',
                                    working_experience='" . $working_experience . "',
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
                echo "No Candidate uploaded.";
            } else if ($count == 1) {
                echo $count . " Candidate uploaded successfully.";
            } else {
                echo $count . " Candidates uploaded successfully.";
            }
        } else
            echo "Please upload csv file.";

    }

    function admin_update_candidate_profile($mysqli) {
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
        $working_experience = $this -> clean($_REQUEST["working_experience"]);
        $jobcategory = $this -> clean($_REQUEST["jobcategory"]);
        $q = "update member_details set
                    jobcategory='" . $jobcategory . "',
                    alternate_id_no='" . $alternate_id_no . "',
                    alternate_id='" . $alternate_id . "',
                    working_experience='" . $working_experience . "',
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
        header('Location: admin.php?action=candidates');
    }

    function admin_save_candidate_skill_mitra($mysqli, $skc, $cid) {
        $q = "update member_details set
                    skc='" . $skc . "'
                    where uid='" . $cid . "'    
                    ";
        $mysqli -> query($q);
        header('Location: admin.php?action=candidates');
    }

    function update_candidates_profile($mysqli) {
        $uid = $_SESSION["flexihire_user_id"];
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
        $jobcat = $_REQUEST["jobcat"];
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
                    jobcategory='" . $jobcat . "',
                    state='" . $state . "',
                    pincode='" . $pincode . "',
                    aadhaar='" . $aadhaar . "',
                    facebook='" . $facebook . "',
                    linkedin='" . $linkedin . "'
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
        header('Location: candidate.php');
    }

    function save_candidate_registration($mysqli) {
        $skillmitra = $this -> clean($_REQUEST["skc"]);
        $name = $this -> clean($_REQUEST["name"]);
        $mobile = $this -> clean($_REQUEST["mobile"]);
        $pincode = $this -> clean($_REQUEST["pincode"]);
        $aadhaar = $this -> clean($_REQUEST["aadhaar"]);
        $jobcategory = $this -> clean($_REQUEST["jobcategory"]);
        
        $q1 = "select id from members where username='" . $skillmitra . "' and user_role='700'";
        $r1 = mysqli_query($mysqli, $q1);
        $v1 = mysqli_fetch_assoc($r1);
        
        $query = "insert into members(username,user_role,user_status)
                values('" . $mobile . "','200','Inactive')";
        $mysqli -> query($query);
        $uid = $mysqli -> insert_id;
        $query = "insert into member_details(regd_by,regd_date,uid,aadhaar,name,mobile,pincode,jobcategory,skc)
                values('" . $uid . "','" . date('Y-m-d') . "','" . $uid . "','" . $aadhaar . "','" . $name . "','" . $mobile . "','" . $pincode . "','" . $jobcategory .  "','" . $v1["id"] ."')";
        $mysqli -> query($query);
        $smsmsg = "Thank%20you%20for%20registering%20with%20us.%20We%20will%20contact%20you%20soon";
        $this -> postdata($mobile, $smsmsg);

        $subject = "FLEXIHIRE-New Candidate Registered: " . $name;
        $message = "New Candidate registered on FLEXIHIRE
                <br>Name:" . $name . "
                <br>Mobile:" . $mobile;

        $emailfrom = "admin@flexihire.co.in";
        $fromname = "FLEXIHIRE";
        $to = "cwarajivpandey@gmail.com,admin@flexihire.co.in";
        $headers = 'Return-Path: ' . $emailfrom . "\r\n" . 'From: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 'X-Priority: 3' . "\r\n" . 'X-Mailer: PHP ' . phpversion() . "\r\n" . 'Reply-To: ' . $fromname . ' <' . $emailfrom . '>' . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Transfer-Encoding: 8bit' . "\r\n" . 'Content-Type: text/html; charset=utf-8' . "\r\n";
        $mailer = new Mailer;
        $mailer -> sendMail($to, $emailfrom, $subject, $message, "", "");

        header('Location: ?action=regd_success&t=candidate');
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

    
    


    function get_candidate_payment_details($dbHelper, $mysqli) {
        $fromdate = $_REQUEST["fromdate"];
        $todate = $_REQUEST["todate"];
        $data = array();
        $dataHiredCandidate = array();
        $dataHiredCandidate = $dbHelper -> getData($mysqli, "sp_getHiredCandidateBetweenDate", array($fromdate, $todate,''));
        for ($i = 0; $i < count($dataHiredCandidate); $i++) {
            $jobTypeId = $dataHiredCandidate[$i]["job_type_id"];
            $sal = $dataHiredCandidate[$i]["sal"];
            $period = $dataHiredCandidate[$i]["period"];
            $data[$i]["hid"] = $dataHiredCandidate[$i]["hid"];
            $data[$i]["hcid"] = $dataHiredCandidate[$i]["hcid"];
            $data[$i]["job_type_id"] = $dataHiredCandidate[$i]["job_type_id"];
            $data[$i]["from_date"] = $dataHiredCandidate[$i]["from_date"];
            $data[$i]["to_date"] = $dataHiredCandidate[$i]["to_date"];
            $data[$i]["from_time"] = $dataHiredCandidate[$i]["from_time"];
            $data[$i]["to_time"] = $dataHiredCandidate[$i]["to_time"];
            $dataHiredCandidate[$i]["period"] = $this -> calculateTotalPeriod($jobTypeId, $period);
            $data[$i]["period"] = $dataHiredCandidate[$i]["period"];
            $dataHiredCandidate[$i]["sal"] = $this -> calculateSalery($jobTypeId, $sal);
            $data[$i]["sal"] = $dataHiredCandidate[$i]["sal"];
            $data[$i]["status"] = $dataHiredCandidate[$i]["status"];
            $data[$i]["modified_date"] = $dataHiredCandidate[$i]["modified_date"];
            $data[$i]["account_number"] = $dataHiredCandidate[$i]["account_number"];
            $data[$i]["ifsc_code"] = $dataHiredCandidate[$i]["ifsc_code"];
            $data[$i]["name"] = $dataHiredCandidate[$i]["name"];
            $data[$i]["pancard"] = $dataHiredCandidate[$i]["pancard"];
            $data[$i]["hdfc"] = $dataHiredCandidate[$i]["hdfc"];
            $data[$i]["job_type"] = $dataHiredCandidate[$i]["job_type"];
            $dataAttendence = array();
            $dataAttendence = $dbHelper -> getData($mysqli, "sp_getAttendenceReport", array($jobTypeId, $dataHiredCandidate[$i]["from_date"], $dataHiredCandidate[$i]["to_date"], $dataHiredCandidate[$i]["to_time"], $dataHiredCandidate[$i]["hcid"]));
            $data[$i]["candidate_id"] = $dataAttendence[0]["candidate_id"];
            $data[$i]["payable_period"] = $dataAttendence[0]["payable_period"];
            $data[$i]["absent"] = abs($data[$i]["period"] - $data[$i]["payable_period"]);
            $data[$i]["amount_payable"] = $dataAttendence[0]["payable_period"] * $dataHiredCandidate[$i]["sal"];

        }
        return $data;
    }


    function get_candidate_payment_details_on_heid($dbHelper, $mysqli, $eid) {
        $fromdate = $_REQUEST["fromdate"];
        $todate = $_REQUEST["todate"];
        $data = array();
        $dataHiredCandidate = array();
        $dataHiredCandidate = $dbHelper -> getData($mysqli, "sp_getHiredCandidateBetweenDateByEmpJob", array($fromdate, $todate, $eid));
        echo $dataHiredCandidate ;
        for ($i = 0; $i < count($dataHiredCandidate); $i++) {
            $jobTypeId = $dataHiredCandidate[$i]["job_type_id"];
            $sal = $dataHiredCandidate[$i]["sal"];
            $period = $dataHiredCandidate[$i]["period"];
            $data[$i]["hid"] = $dataHiredCandidate[$i]["hid"];
            $data[$i]["hcid"] = $dataHiredCandidate[$i]["hcid"];
            $data[$i]["job_type_id"] = $dataHiredCandidate[$i]["job_type_id"];
            $data[$i]["from_date"] = $dataHiredCandidate[$i]["from_date"];
            $data[$i]["to_date"] = $dataHiredCandidate[$i]["to_date"];
            $data[$i]["from_time"] = $dataHiredCandidate[$i]["from_time"];
            $data[$i]["to_time"] = $dataHiredCandidate[$i]["to_time"];
            $dataHiredCandidate[$i]["period"] = $this -> calculateTotalPeriod($jobTypeId, $period);
            $data[$i]["period"] = $dataHiredCandidate[$i]["period"];
            $dataHiredCandidate[$i]["sal"] = $this -> calculateSalery($jobTypeId, $sal);
            $data[$i]["sal"] = $dataHiredCandidate[$i]["sal"];
            $data[$i]["status"] = $dataHiredCandidate[$i]["status"];
            $data[$i]["modified_date"] = $dataHiredCandidate[$i]["modified_date"];
            $data[$i]["account_number"] = $dataHiredCandidate[$i]["account_number"];
            $data[$i]["ifsc_code"] = $dataHiredCandidate[$i]["ifsc_code"];
            $data[$i]["name"] = $dataHiredCandidate[$i]["name"];
            $data[$i]["pancard"] = $dataHiredCandidate[$i]["pancard"];
            $data[$i]["hdfc"] = $dataHiredCandidate[$i]["hdfc"];
            $data[$i]["job_type"] = $dataHiredCandidate[$i]["job_type"];
            $dataAttendence = array();
            $dataAttendence = $dbHelper -> getData($mysqli, "sp_getAttendenceReport", array($jobTypeId, $dataHiredCandidate[$i]["from_date"], $dataHiredCandidate[$i]["to_date"], $dataHiredCandidate[$i]["to_time"], $dataHiredCandidate[$i]["hcid"]));
            $data[$i]["candidate_id"] = $dataAttendence[0]["candidate_id"];
            $data[$i]["payable_period"] = $dataAttendence[0]["payable_period"];
            $data[$i]["absent"] = abs($data[$i]["period"] - $data[$i]["payable_period"]);
            $data[$i]["amount_payable"] = $dataAttendence[0]["payable_period"] * $dataHiredCandidate[$i]["sal"];

        }
        return $data;
    }
    function calculateSalery($jobTypeId, $sal) {
        switch($jobTypeId) {
            case 1 :
                return $sal;
                break;
            case 2 :
                return $sal;
                break;
            case 3 :
                return round($sal / 7);
                break;
            case 4 :
                return round($sal / 30);
                break;
            default :
                return $sal;
                break;
        }
    }

    function calculateTotalPeriod($jobTypeId, $period) {
        switch($jobTypeId) {
            case 1 :
                return $period . hours;
                break;
            case 2 :
                return $period . days;
                break;
            case 3 :
                return ($period * 7) . days;
                break;
            case 4 :
                return ($period * 30) . days;
                break;
            default :
                return $sal;
                break;
        }
    } 
    /* CANDIDATE HOME  ADDED BY KAMLESH */
   function candidateHome($dbHelper, $mysqli,$cid){
   	    $dataTop5 = $dbHelper -> getData($mysqli, "sp_getTopFiveEarnerNew", array());
        $dataRocket = $dbHelper -> getData($mysqli, "sp_getRocket", array($cid));
        $dataPockect = $dbHelper -> getData($mysqli, "sp_getPocket", array($cid));
        $creditData=$dbHelper->getData($mysqli, 'sp_getSkillchampsCreditBalanceByUid', array($cid));
        $work_hard = array('cash' => $dataPockect[0]["total"], 'points' => 0, 'credits' => $creditData[0]["credit"]);
        $feel_good = array('incentive' => $dataPockect[0]["in_incentive"], 'awards' => 0, 'loylty' => 0);
        $compliance = array('tarining' => 'No Data', 'counselling' => 'No Data', 'Bench' => 'No Data');
        $growing_old = array('earned' => $dataPockect[0]["ytd"], 'lost' => 0, 'opportunity' => 0);
        $feel_young = array('earned' => $dataPockect[0]["mtd"], 'lost' => 0, 'opportunity' => 0);
        $pockect = array('work_hard' => $work_hard, 'feel_good' => $feel_good, 'compliance' => $compliance, 'growing_old' => $growing_old, 'feel_young' => $feel_young);
        $q1 = "SELECT user_role FROM members WHERE id='" . $cid . "'";
        $dataFcm = $dbHelper -> getDataFromQuery($mysqli, $q1);
        $userRole = $dataFcm[0]["user_role"];
		$data= array();
		$data = array('top_five' => $dataTop5, 'rocket' => $dataRocket, 'pocket' => $pockect);
	   //echo "<pre>";print_r($data);exit;
		return $data;
   }
 
 /*  END CANDIDATE HOME */
}
?>