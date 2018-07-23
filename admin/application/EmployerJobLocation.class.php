<?php
class EmployerJobLocation {

	function EmployerJobLocation() {
		set_time_limit(0);
		ini_set('memory_limit', '256M');
		ini_set('upload_max_filesize', '256M');
		ini_set('post_max_size', '256M');
		ini_set('max_input_time', 600);
		ini_set('display_errors', 'on');
		error_reporting(E_ALL ^ E_NOTICE);
		error_reporting(E_ALL ^ E_NOTICE);
	}

	function getEmpJobsLocation($dbHelper, $mysqli, $eid, $id) {
		$data = array();
		$data = $dbHelper -> getData($mysqli, 'sp_getEmpJobLocation', array($eid,$id));
		return $data;
	}
    
    function insertEmployerJobLocationAdmin($dbHelper, $mysqli) {
        $eid = $_REQUEST["eid"];
        $this->insertEmpJobLocation($dbHelper, $mysqli);       
        header('Location: admin.php?action=empjob_location&id='.$eid);
    }
  
		

	function insertEmpJobLocation($dbHelper, $mysqli) {
		$eid = $_REQUEST["eid"];
        $state=$this -> clean($_REQUEST["state"]);
        $district=$this -> clean($_REQUEST["district"]);
        $area=$this -> clean($_REQUEST["area"]);
        $locality=implode(",", $_REQUEST["locality"]);
        $address = isset($_REQUEST["address"])?$this -> clean($_REQUEST["address"]):$this -> clean($_REQUEST["address1"]);
        $latitude =  $_REQUEST["lat"];
        $longitude = $_REQUEST["lng"];
        $result="";
        if($latitude!='' && $longitude!=''){
            $result=$dbHelper -> performOperation($mysqli, 'sp_InsertEmpJobLocation', array($address, $latitude, $longitude, $state, $district, $area, $locality,$eid));
        }else $result="Latitude longitude can not be found.";
		return $result;
	}

	function insertEmployerJobLocationForFront($dbHelper, $mysqli) {
	    $this->insertEmpJobLocation($dbHelper, $mysqli);		
		header('Location: ?action=employer_jobs_loc');
	}

	function updateEmpJobLocation($dbHelper, $mysqli) {

		$id = $this -> clean($_REQUEST["t3id"]);
		$eid = $this -> clean($_REQUEST["eid"]);
        $state=$this -> clean($_REQUEST["state"]);
        $district=$this -> clean($_REQUEST["district"]);
        $area=$this -> clean($_REQUEST["area"]);
        $locality=implode(",", $_REQUEST["locality"]);
        $address = isset($_REQUEST["address"])?$this -> clean($_REQUEST["address"]):$this -> clean($_REQUEST["address1"]);
        $latitude =  $_REQUEST["lat"];
        $longitude = $_REQUEST["lng"];
        $result="";
        if($latitude!='' && $longitude!=''){
            $result=$dbHelper -> performOperation($mysqli, 'sp_updateEmpJobLocation', array($id,$address, $latitude, $longitude, $state, $district, $area, $locality));
        }else $result="Latitude longitude can not be found.";
        return $result;
	}


    function updateEmployerJobLocationForFront($dbHelper, $mysqli) {
        $this->updateEmpJobLocation($dbHelper, $mysqli);
		header('Location: ?action=employer_jobs_loc');
	}
    
    function updateEmployerJobLocationAdmin($dbHelper, $mysqli) {
        $eid = $_REQUEST["eid"];
        $this->updateEmpJobLocation($dbHelper, $mysqli);
        header('Location: admin.php?action=empjob_location&id='.$eid);
    }

	function deleteEmp($dbHelper, $mysqli, $id, $eid) {
		
		$dbHelper -> performOperation($mysqli, 'sp_deleteEmpJobLocation', array($id));
		header('Location: admin.php?action=empjob_location&id='.$eid);
	}
	
	function deleteEmployerForFront($dbHelper, $mysqli, $id,$eid) {
		$dbHelper -> performOperation($mysqli, 'sp_deleteEmpJobLocation', array($id));
		header('Location: ?action=employer_jobs_loc');
	}

	function clean($data) {
		$data = stripslashes($data);
		$data = htmlentities($data, ENT_QUOTES);
		return $data;
	}
    
    function getLatLong($dlocation){
        $address = $dlocation; // Google HQ
        $prepAddr = str_replace(' ','+',$address);
        $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
        $output= json_decode($geocode);
        return $output;
    }

}
?>