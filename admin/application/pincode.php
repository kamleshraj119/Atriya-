<?php
    include_once '../include/psl-config.php';
    include_once '../include/functions.php';
    require_once ('DBHelper.class.php');
    set_time_limit(0);
    $dbHelper=new DBHelper;
    function clean($data) {
        $data = stripslashes($data);
        $data = htmlentities($data, ENT_QUOTES);
        return $data;
    }
    function getState($name){
        $dbHelper=new DBHelper;
        $mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
        $data = array();
        $data = $dbHelper -> getData($mysqli, 'sp_getStateByName', array($name));
        return $data;
    }
    
    function getDistrict($name){
        $dbHelper=new DBHelper;
        $mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
        $data = array();
        $data = $dbHelper -> getData($mysqli, 'sp_getDistrictByName', array($name));
        return $data;
    }
    function getArea($name){
        $dbHelper=new DBHelper;
        $mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
        $data = array();
        $data = $dbHelper -> getData($mysqli, 'sp_getAreaByName', array($name));
        return $data;
    }
    function getLocality($name, $pincode){
        $dbHelper=new DBHelper;
        $mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
        $data = array();
        $data = $dbHelper -> getData($mysqli, 'sp_getLocalityByNameAndPin', array($name, $pincode));
        return $data;
    }
    
    
    $mysqli = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
    $csvFile = fopen("bihar.csv", "r") or die("Unable to open file!");
    fgetcsv($csvFile);
            $count = 0;
            //parse data from csv file line by line
            while (($line = fgetcsv($csvFile)) !== FALSE) {
                $stateId='';
                $districtId='';
                $areaId='';
                $localId='';
                $exState=array();
                $exDist=array();
                $exArea=array();
                $exLocal=array();
                
               
                
                echo '</br>';
                echo $local = clean($line[0]);
                echo $pin = clean($line[1]);
                echo $area = clean($line[2]);
                if (strcasecmp( $area, 'NA' ) == 0 ){
                      $area=$local;
                }
                echo $district = clean($line[3]);
                echo $state = clean($line[4]);
                echo '</br>';
                $exState=getState($state);
                if (count($exState) < 1) {
                    $dbHelper -> performOperation($mysqli, 'sp_insertState', array($state));
                    echo 'inserted state :'.$state;
                    $exState=getState($state);
                }
                $stateId=$exState[0]["id"];
                $exDist=getDistrict($district);
                if (count($exDist) < 1) {
                    $dbHelper -> performOperation($mysqli, 'sp_insertDistrict', array($stateId, $district));
                    echo '</br>inserted district :'.$district;
                    $exDist=getDistrict($district);
                }
                $districtId=$exDist[0]["district_id"];
                $exArea=getArea($area);
                 if (count($exArea) < 1) {
                    $dbHelper -> performOperation($mysqli, 'sp_insertArea', array($districtId, $area));
                    echo '</br>inserted area :'.$area;
                    $exArea=getArea($area);
                }
                $areaId=$exArea[0]["area_id"];
                $exLocal=getLocality($local, $pin);
                if (count($exLocal) < 1) {
                    $dbHelper -> performOperation($mysqli, 'sp_insertLocality', array($areaId, $local, $pin));
                    echo '</br>inserted local :'.$local.','.$pin;
                }
                
            }
            
            
?>