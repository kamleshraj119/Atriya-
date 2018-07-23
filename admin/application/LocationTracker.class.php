<?php
    class LocationTracker{
        
        function deactivateAlert($dbHelper,$mysqli,$alertId){
            return $result=$dbHelper->performOperation($mysqli, "sp_deactivateAlert", array($alertId));
        }
        
        function getActiveAlertByCandidate($dbHelper,$mysqli,$cid){
            $data=array();
            $data=$dbHelper->getData($mysqli, "sp_getActiveAlertByCandidate", array($cid));
            return $data;
        }
        
        function getActiveAlerts($dbHelper,$mysqli){
            $data=array();
            $data=$dbHelper->getData($mysqli, "sp_getActiveAlerts", array());
            return $data;
        }
        
        function getAlertsByCandidate($dbHelper,$mysqli,$cid){
            $data=array();
            $data=$dbHelper->getData($mysqli, "sp_getAlertsByCandidate", array($cid));
            return $data;
        }
        
        function getAlertsBySkillmitra($dbHelper,$mysqli,$skm,$status){
            $data=array();
            $data=$dbHelper->getData($mysqli, "sp_getAlertsBySkillmitra", array($skm,$status));
            return $data;
        }
        
        function getActiveAlertsCountBySkillmitra($dbHelper,$mysqli,$skm){
            $data=array();
            $data=$dbHelper->getDataFromQuery($mysqli, "select count(*) as num from alert where status='Active' AND skm='".$skm."'");
            return $data[0]["num"];
        }
        
        function getLocatinDetailsByAlert($dbHelper,$mysqli,$alertId){
            $data=array();
            $data=$dbHelper->getData($mysqli, "sp_getLocatinDetailsByAlert", array($alertId));
            return $data;
        }
        
        function insertAlert($dbHelper,$mysqli,$cid,$type){
            if($type=="Battery Low")
            return $result=$dbHelper->multiquery($mysqli, "sp_insertBatteryAlert", array($cid,$type),"Select @outId,@outMob,@outCan;", array('@outId','@outMob','@outCan'));
            else
            return $result=$dbHelper->multiquery($mysqli, "sp_insertAlert", array($cid,$type),"Select @outId,@outMob,@outCan;", array('@outId','@outMob','@outCan'));
        }
        
        function insertAlertLocationDetail($dbHelper,$mysqli,$alertId,$lat,$long){
            return $result=$dbHelper->performOperation($mysqli, "sp_insertAlertLocationDetail", array($alertId,$lat,$long));
        }
        
        function getLocationTrackingDetailByCidAndDate($dbHelper,$mysqli,$cid,$date){
            $data=array();
            $data=$dbHelper->getData($mysqli, "sp_getLocationTrackingDetailByCidAndDate", array($cid,$date));
            return $data;
        }
        
        function insertLocationTracking($dbHelper,$mysqli,$cid,$lat,$lng){
            return $result=$dbHelper->performOperation($mysqli, "sp_insertLocationTracking", array($cid,$lat,$lng));
        }
        
        function updateAlertType($dbHelper,$mysqli,$alertId,$type){
            return $result=$dbHelper->performOperation($mysqli, "sp_updateAlertType", array($alertId,$type));
        }
        
        function getConnectedCandidateLocSkillmitra($dbHelper,$mysqli,$skid){
            $data=array();
            return $data=$dbHelper->getData($mysqli, 'sp_getCurrentCandidateLocationSkillmitra', array($skid));
        }
        
        function getConnectedCandidateLocSkillmitraJson($dbHelper,$mysqli,$skid,$env){
            $data=array();
            $data=$dbHelper->getData($mysqli, 'sp_getCurrentCandidateLocationSkillmitra', array($skid));
            for($i=0;$i<count($data);$i++){
                $profilePic=$data[$i]["profile_pic"];
                if($env=='PROD'){
                     if($profilePic=="")
                    $profile_pic="http://flexihire.co.in/assets/images/individu-1.png";
                    else $profilePic="http://flexihire.co.in/admin/images/candidate/".$data[$i]["uid"]."/".$profilePic;
                }else{
                     if($profilePic=="")
                    $profile_pic="http://localhost:8080/skillchamps_site/assets/images/individu-1.png";
                    else $profilePic="http://localhost:8080/skillchamps_site/admin/images/candidate/".$data[$i]["uid"]."/".$profilePic;
                }
               
                $data[$i]["profile_pic"]=$profilePic;
            }
           return json_encode($data);
        }
        
    }
?>